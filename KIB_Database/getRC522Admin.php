<?php
  include 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];
    
    $myObj = (object)array();
    
    //........................................ 
    $pdo = KIBDataBase::connect();
    $sql = ' SELECT rfid FROM kibdata_rfid_acces WHERE id="' . $id . '"';
    foreach ($pdo->query($sql) as $row) {
        $rfid = $row['rfid'];
    }
    $q = $pdo->prepare($sql);
    $q->execute();

    // Verificar se a consulta retornou alguma linha
    if ($data = $q->fetch()) {
        echo $rfid; // Valor encontrado
    } else {
        echo "false"; // Valor não encontrado
    }

    KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>