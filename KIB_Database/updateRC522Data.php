<?php
  require 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $rfid = $_POST['rfid'];
    $operator = $_POST['operator'];
    //........................................

    //........................................ Entering data into a table.    
    $pdo = KIBDataBase::connect();
    
    //:::::::: The process of entering data into a table.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
    // This table is used to store and record DHT11 sensor data updated by ESP32. 
    // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // This table is operated with the "INSERT" command, so this table will contain many rows.
    $sql = ' SELECT operator_name FROM kibdata_operator WHERE id = "' . $operator . '"';
    foreach ($pdo->query($sql) as $row) {
      $operator_name = $row['operator_name'];
    }
    $sql = "INSERT INTO kibdata_rfid_acces (id,rfid,operator_name) values(?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($id,$rfid,$operator_name));
    //::::::::
    
    KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>