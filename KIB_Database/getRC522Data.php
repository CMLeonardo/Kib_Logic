<?php
  include 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $rfid = $_POST['rfid'];
    
    $myObj = (object)array();
    
    //........................................ 
    $pdo = KIBDataBase::connect();
    $sql = ' SELECT * FROM kibdata_rfid_acces WHERE rfid="' . $rfid . '"';
    $q = $pdo->prepare($sql);
    $q->execute();

    // Verificar se a consulta retornou alguma linha
    if ($data = $q->fetch()) {
        echo "true"; // Valor encontrado
    } else {
        echo "false"; // Valor não encontrado
    }

    KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>