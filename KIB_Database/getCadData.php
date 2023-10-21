<?php
  include 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];
    
    $myObj = (object)array();
    
    //........................................ 
    $pdo = KIBDataBase::connect();
    $sql = ' SELECT * FROM kibdata_cadtog WHERE id = "' . $id . '"';
    foreach ($pdo->query($sql) as $row) {
        $myObj->cadstate = $row['cadstate'];
        $myObj->biometric_id = $row['biometric_id'];

        $myJSON = json_encode($myObj);
        
        echo $myJSON;
    }
      KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>