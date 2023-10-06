<?php
  include 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $operator = $_POST['id'];
    
    $myObj = (object)array();
    
    //........................................ 
    $pdo = KIBDataBase::connect();
    $sql = ' SELECT operator_name FROM kibdata_operator WHERE id = "' . $operator . '"';
    foreach ($pdo->query($sql) as $row) {
        echo $row['operator_name'];
    }
      KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>