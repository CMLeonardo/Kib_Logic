<?php
  require 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $rfid = $_POST['rfid'];
    $found_empty = false;
    //........................................

    $pdo = KIBDataBase::connect();
    if($id != "0"){
      //:::::::: Process to check if "id" is already in use.
      while ($found_empty == false) {
        $id_key = generate_string_id(10);
        // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
        // This table is used to store and record DHT11 sensor data updated by ESP32. 
        // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
        // This table is operated with the "INSERT" command, so this table will contain many rows.
        // Before saving and recording data in this table, the "id" will be checked first, to ensure that the "id" that has been created has not been used in the table.
        $sql = 'SELECT * FROM kibdata_rfid_acces WHERE id="' . $id_key . '"';
        $q = $pdo->prepare($sql);
        $q->execute();
        
        if (!$data = $q->fetch()) {
          $found_empty = true;
          $id = $id_key;
        }
      }
    }

    //........................................ Entering data into a table.    
    
    //:::::::: The process of entering data into a table.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
    // This table is used to store and record DHT11 sensor data updated by ESP32. 
    // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // This table is operated with the "INSERT" command, so this table will contain many rows.
    $sql = "INSERT INTO kibdata_rfid_acces (id,rfid) values(?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($id,$rfid));
    //::::::::
    
    KIBDataBase::disconnect();
    //........................................ 
  }

  //---------------------------------------- Function to create "id" based on numbers and characters.
  function generate_string_id($strength = 9) {
    $permitted_chars = '0123456789';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
      $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
    }
    return $random_string;
  }
  //---------------------------------------- 
?>