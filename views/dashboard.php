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
    <title>KIB - Monitoracao</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li>
                        <i class="far fa-user"></i>
                        <a href="../views/gerenciarOperadores.php">Operadores</a>
                    </li>
                </ul>
            </div>   
        </sidebar>
        <main>
            <header>
                <a href="../views/dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
            </header>
            <div class="main-content"> 
              <!-- __ DISPLAYS MONITORING AND CONTROLLING ____________________________________________________________________________________________ -->
              <div class="content">
                <div class="cards">
                  
                  <!-- == MONITORING ======================================================================================== -->
                  <div class="card">
                    <div class="card-header" style="background: white;">
                      <h3 style="font-size: 1rem;"><span id="operator1"></span><br>Último Acesso</h3>
                    </div>
                    <p class="temperatureColor"><span class="reading"><span id="lastTimeOperator1"></span></span></p>
                    <!-- *********************************************************************** -->
                  </div>

                  <div class="card">
                    <div class="card-header" style="background: white;">
                      <h3 style="font-size: 1rem;"><span id="operator2"></span><br>Último Acesso</h3>
                    </div>
                    <p class="humidityColor"><span class="reading"><span id="lastTimeOperator2"></span></span></p>
                    <!-- *********************************************************************** -->
                  </div>

                  <div class="card">
                    <div class="card-header" style="background: white;">
                      <h3 style="font-size: 1rem;"><span id="operator3"></span><br>Último Acesso</h3>
                    </div>
                    <p class="humidityColor"><span class="reading"><span id="lastTimeOperator3"></span></span></p>
                    <!-- *********************************************************************** -->
                  </div>
                  <!-- ======================================================================================================= -->        
                </div>

                <div class="card">
                  <div class="card-header" style="background: white; border-bottom: 0px;">
                      <h3 style="font-size: 1rem;">Histórico</h3>
                  </div>

                  <table class="styled-table" id= "table_id" style=" background-color: #fff;">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>OPERADOR</th>
                        <th>HORA</th>
                        <th>DATA</th>
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
                        $sql = 'SELECT * FROM kibdata_biometric_sensor_historic ORDER BY id DESC';
                        foreach ($pdo->query($sql) as $row) {
                          $date = date_create($row['date']);
                          $dateFormat = date_format($date,"d-m-Y");
                          $num++;
                          echo '<tr>';
                          echo '<td>'. $num . '</td>';
                          echo '<td class="bdr">'. $row['operator'] . '</td>';
                          echo '<td class="bdr">'. $row['time'] . '</td>';
                          echo '<td>'. $dateFormat . '</td>';
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
            </div>
        </main>
    </div>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome/js/all.min.js"></script>
    <!-- ___________________________________________________________________________________________________________________________________ -->
              
    <script>   
      //------------------------------------------------------------
      function myTimer() {
        Get_Data("1");
        Get_Data("2");
        Get_Data("3");
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function Get_Data(id) {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            console.log(myObj);
            var time = myObj.time == null ? "NN" : myObj.time;
            var date = myObj.date == null ? "NN" : myObj.date;
            document.getElementById("lastTimeOperator"+id).innerHTML = "Hora: " + time + " <br>Data: " + date;
          }
        };
        xmlhttp.open("POST","../KIB_database/getSensorData.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
      }
      //------------------------------------------------------------
      function Get_Operator(id) {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onload = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var operator_name = this.responseText == "" ? "NN" : this.responseText;
            document.getElementById("operator"+id).innerHTML = operator_name;
          }
        };
        xmlhttp.open("POST","../KIB_database/getKIBOperator.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
      }

      //------------------------------------------------------------
      var current_page = 1;
      var records_per_page = 10;
      var l = document.getElementById("table_id").rows.length
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function apply_Number_of_Rows() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function changePage(page) {
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("table_id");
        var page_span = document.getElementById("page");
      
        // Validate page
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
            tr.style.display='none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
          if (listing_table.rows[i]) {
            listing_table.rows[i].style.display = ""
          } else {
            continue;
          }
        }
          
        if (page == 0 && numPages() == 0) {
          btn_prev.disabled = true;
          btn_next.disabled = true;
          return;
        }

        if (page == 1) {
          btn_prev.disabled = true;
        } else {
          btn_prev.disabled = false;
        }

        if (page == numPages()) {
          btn_next.disabled = true;
        } else {
          btn_next.disabled = false;
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function numPages() {
        return Math.ceil((l - 1) / records_per_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      window.onload = function() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);

        Get_Operator("1");
        Get_Operator("2");
        Get_Operator("3");

        myTimer();
      
        setInterval(myTimer, 5000);
      };
      //--------------------------------
    </script>
  </body>
</html>