<?php
  require 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //........................................ keep track POST values
    $id = $_POST['id'];
    $cadstate = $_POST['cadstate'];
    //........................................
    
    //........................................ Updating the data in the table.
    $pdo = KIBDataBase::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE kibdata_cadtog SET cadstate = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($cadstate,$id));
    KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>