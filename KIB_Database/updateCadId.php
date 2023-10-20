<?php
  require 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $biometric_id = $_POST['biometric_id'];
    //........................................
    
    //........................................ Updating the data in the table.
    $pdo = KIBDataBase::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE kibdata_cadtog SET biometric_id = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($biometric_id,$id));
    KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>