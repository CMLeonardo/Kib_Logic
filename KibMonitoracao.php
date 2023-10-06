<!DOCTYPE HTML>
<html>
  <head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    <style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.2rem;}
      h4 {font-size: 0.8rem;}
      body {margin: 0;}
      .topnav {overflow: hidden; background-color: #0c6980; color: white; font-size: 1.2rem;}
      .content {padding: 20px; display: flex ; flex-direction: column; gap: 20px;}
      .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border-radius: 15px;}
      .card-header {color: #0c6980; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px; background-color: transparent;}
      .cards {max-width: 1000px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));}
      .reading {font-size: 1.3rem;}
      
      /* ----------------------------------- Toggle Switch */
      .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
      }

      .switch input {display:none;}

      .sliderTS {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #D3D3D3;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
      }

      .sliderTS:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: #f7f7f7;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
      }

      input:checked + .sliderTS {
        background-color: #00878F;
      }

      input:focus + .sliderTS {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .sliderTS:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      .sliderTS:after {
        content:'OFF';
        color: white;
        display: block;
        position: absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 70%;
        font-size: 10px;
        font-family: Verdana, sans-serif;
      }

      input:checked + .sliderTS:after {  
        left: 25%;
        content:'ON';
      }

      input:disabled + .sliderTS {  
        opacity: 0.3;
        cursor: not-allowed;
        pointer-events: none;
      }
      
      /* ----------------------------------- TABLE STYLE */
      .styled-table {
        border-collapse: collapse;
        margin-left: auto; 
        margin-right: auto;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        border-radius: 0.5em;
        overflow: hidden;
        width: 90%;
      }

      .styled-table thead tr {
        background-color: #fff;
        color: #0c6980;
        border-bottom: 1px solid #0c6980;
        text-align: left;
      }

      .styled-table th {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table td {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
      }

      .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
      }

      
      td:hover {background-color: rgba(12, 105, 128, 0.21);}
      tr:hover {background-color: rgba(12, 105, 128, 0.15);}
      .styled-table tbody tr:nth-of-type(even):hover {background-color: rgba(12, 105, 128, 0.15);}
      /* ----------------------------------- */
      
      /* ----------------------------------- BUTTON STYLE */
      .btn-group .button {
        background-color: #0c6980; /* Green */
        border: 1px solid #e3e3e3;
        color: white;
        padding: 5px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        border-radius: 5px;
      }

      .btn-group .button:not(:last-child) {
        border-right: none; /* Prevent double borders */
      }

      .btn-group .button:hover {
        background-color: #094c5d;
      }

      .btn-group .button:active {
        background-color: #0c6980;
        transform: translateY(1px);
      }

      .btn-group .button:disabled,
      .button.disabled{
        color:#fff;
        background-color: #a0a0a0; 
        cursor: not-allowed;
        pointer-events:none;
      }
      /* ----------------------------------- */
    </style>
  </head>
  
  <body>
    <div class="topnav">
      <h3>ESP32 WITH MYSQL DATABASE</h3>
    </div>
    
    <br>
    
    <!-- __ DISPLAYS MONITORING AND CONTROLLING ____________________________________________________________________________________________ -->
    <div class="content">
      <div class="cards">
        
        <!-- == MONITORING ======================================================================================== -->
        <div class="card">
          <div class="card-header">
            <h3 style="font-size: 1rem;"><span id="operator1"></span><br>Último Acesso</h3>
          </div>
          <p class="temperatureColor"><span class="reading"><span id="lastTimeOperator1"></span></span></p>
          <!-- *********************************************************************** -->
        </div>

        <div class="card">
          <div class="card-header">
            <h3 style="font-size: 1rem;"><span id="operator2"></span><br>Último Acesso</h3>
          </div>
          <p class="humidityColor"><span class="reading"><span id="lastTimeOperator2"></span></span></p>
          <!-- *********************************************************************** -->
        </div>

        <div class="card">
          <div class="card-header">
            <h3 style="font-size: 1rem;"><span id="operator3"></span><br>Último Acesso</h3>
          </div>
          <p class="humidityColor"><span class="reading"><span id="lastTimeOperator3"></span></span></p>
          <!-- *********************************************************************** -->
        </div>
        <!-- ======================================================================================================= -->        
      </div>

      <div class="card">
        <div class="card-header">
            <h3 style="font-size: 1rem;">Historico</h3>
        </div>

        <table class="styled-table" id= "table_id" style="margin-top: 30px; background-color: #fff;">
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
              include 'KIB_Database/KIBData.php';
              $num = 0;
              //------------------------------------------------------------ The process for displaying a record table containing the DHT11 sensor data and the state of the LEDs.
              $pdo = KIBDataBase::connect();
              // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
              // This table is used to store and record DHT11 sensor data updated by ESP32. 
              // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
              // To store data, this table is operated with the "INSERT" command, so this table will contain many rows.
              $sql = 'SELECT * FROM kibdata_biometric_sensor_historic ORDER BY time, date DESC';
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
          <button class="button" id="btn_prev" onclick="prevPage()">Prev</button>
          <button class="button" id="btn_next" onclick="nextPage()">Next</button>
          <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; margin-left: 2px;">
            <p style="position:relative; font-size: 14px; color: #0c6980"> Table : <span id="page"></span></p>
          </div>
          <select name="number_of_rows" id="number_of_rows" style="position:relative; font-size: 14px; color: #0c6980">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
        </div>
      </div>
    </div>
    
    <!-- ___________________________________________________________________________________________________________________________________ -->
    
    <script>   
      Get_Operator("1");
      Get_Operator("2");
      Get_Operator("3");
      myTimer();
      
      setInterval(myTimer, 5000);
      
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
        xmlhttp.open("POST","KIB_database/getSensorData.php",true);
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
        xmlhttp.open("POST","KIB_database/getKIBOperator.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
			}
      //------------------------------------------------------------
      function update_operator(id, operator_name) {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.open("POST","KIB_database/UpdateKIBOperator.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id+"&operator_name"+operator_name);
      }
      //------------------------------------------------------------

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
      };
      //--------------------------------
    </script>
  </body>
</html>