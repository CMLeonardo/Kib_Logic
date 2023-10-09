<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome/css/all.min.css">
    <title>KIB - Operadores</title>
</head>
<body>
    <div class="flex-dashboard">
        <sidebar>
            <div class="sidebar-title">
                <img src="../images/Image-login.png" alt="">
                <p>KIB</p>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <i class="fas fa-home"></i>
                        <a href="../views/dashboard.php">Dashboard</a>
                    </li>
                    <li>
                        <i class="far fa-user"></i>
                        <a href="../views/gerenciarOperadores.php">Operadores</a>
                    </li>
                    <li>
                        <i class="fas fa-tachometer-alt"></i> 
                        <a href="../views/gerenciarOperadores.php">Gerenciar Peso e Altura</a>
                    </li>
                    <li>
                        <i class="fas fa-heartbeat"></i>
                        <a href="#">Gerenciar Pressão Arterial</a>
                    </li>
                    <li>
                        <i class="fas fa-dumbbell"></i>
                        <a href="#">Gerenciar Atividade Físicas</a>
                    </li>
                    <li>
                        <i class="fas fa-utensils"></i>
                        <a href="#">Alimentação</a>
                    </li>
                </ul>
            </div>   
        </sidebar>
        <main>
            <header>
                <a href="dashboard.html"><i class="fas fa-home"></i> Dashboard</a>
            </header>
            <div class="main-content">
                <div class="panel-row">
                    <button class="panel panel-50" a-view="cadastrarOperador" onclick="fetchContent(this)" a-folder="operador">Cadastrar Operador</button>
                    <button class="panel panel-50" a-view="atualizarOperador" onclick="fetchContent(this)" a-folder="operador">Atualizar Operador</button>
                </div>
                <div class="content" id="ajax-content"><div class="dynamic-content"></div></div>
                <div class="card" style="margin-top: 20px;">
                  <div class="card-header" id="List" style="background: white; border-bottom: 0px;">
                      <h3 style="font-size: 1rem;">Lista Operadores</h3>
                  </div>

                  <table class="styled-table" id= "table_id" style=" background-color: #fff;">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>OPERADOR</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_table_record">
                      <?php
                        include '../KIB_Database/KIBData.php';
                        $num = 0;
                        //------------------------------------------------------------ The process for displaying a record table containing the DHT11 sensor data and the state of the LEDs.
                        $pdo = KIBDataBase::connect();
                        // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
                        // This table is used to store and record DHT11 sensor data updated by ESP32. 
                        // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
                        // To store data, this table is operated with the "INSERT" command, so this table will contain many rows.
                        $sql = 'SELECT * FROM kibdata_operator ORDER BY id';
                        foreach ($pdo->query($sql) as $row) {
                          echo '<tr>';
                          echo '<td class="bdr">'. $row['id'] . '</td>';
                          echo '<td class="bdr">'. $row['operator_name'] . '</td>';
                          echo '</tr>';
                        }
                        KIBDataBase::disconnect();
                        //------------------------------------------------------------
                      ?>
                    </tbody>
                  </table>
                  
                  <br>
                  
                  <div class="btn-group">
                    <button class="button" id="btn_prev" style="margin-right: 10px;" onclick="prevPage()">Prev</button>
                    <button class="button" id="btn_next" style="margin-right: 10px;" onclick="nextPage()">Next</button>
                    <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; margin-left: 2px;">
                      <p style="position:relative; font-size: 14px; color: #0c6980; margin-top: 8px;"> Table:</p>
                    </div>
                    <select name="number_of_rows" id="number_of_rows" style="font-size: 14px; color: #0c6980; margin-bottom: 10px;">
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select>
                    <button class="button" id="btn_apply" style="margin-left: 10px;" onclick="apply_Number_of_Rows()">Apply</button>
                  </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        //------------------------------------------------------------
        function new_operator() {
            var operator_name_input = document.getElementById("operator_name_input").value;

            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.open("POST","../KIB_database/UpdateKIBOperator.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=&operator_name="+operator_name);
        }
        //------------------------------------------------------------
        function update_operator() {
            var id_operator = document.getElementById("id_operator").value;
            var operator_name_input = document.getElementById("operator_name_input").value;

            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.open("POST","../KIB_database/UpdateKIBOperator.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id="+id+"&operator_name="+operator_name);
        }
        //------------------------------------------------------------
    </script>
    <script src="../js/ajax.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome/js/all.min.js"></script>
</body>
</html>