<?php
  include 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $operator = $_POST['id'];
    
    $myObj = (object)array();
    
    //........................................ 
    $pdo = KIBDataBase::connect();
    $sql = ' SELECT * FROM kibdata_biometric_sensor_historic WHERE operator="' . $operator . '" ORDER BY id DESC LIMIT 1';
    foreach ($pdo->query($sql) as $row) {
      $date = date_create($row['date']);
      $dateFormat = date_format($date,"d-m-Y");
      
      $myObj->id = $row['id'];
      $myObj->operator = $row['operator'];
      $myObj->time = $row['time'];
      $myObj->date = $dateFormat;
      
    }
    $sql = ' SELECT * FROM kibdata_biometric_sensor_historic ORDER BY id DESC LIMIT 1';
    foreach ($pdo->query($sql) as $row) {
      $date = date_create($row['date']);
      $dateFormat = date_format($date,"d-m-Y");
      
      $myObj->lstime = $row['time'];
      $myObj->lsdate = $dateFormat;
      
      $myJSON = json_encode($myObj);
        
      echo $myJSON;
    }
      KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>