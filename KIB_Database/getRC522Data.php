<?php
  include 'KIBData.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $RFID = $_POST['RFID'];
    
    $myObj = (object)array();
    
    //........................................ 
    $pdo = KIBDataBase::connect();
    $sql = ' SELECT * FROM kibdata_rfid_acces WHERE RFID="' . $RFID . '"';
    $q = $pdo->prepare($sql);
    $q->execute();

    $result = $q -> get_result();

    // Verificar se a consulta retornou alguma linha
    if ($result->num_rows > 0) {
        echo "true"; // Valor encontrado
    } else {
        echo "false"; // Valor não encontrado
    }
    
    KIBDataBase::disconnect();
    //........................................ 
  }
  //---------------------------------------- 
?>