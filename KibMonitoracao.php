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
      .content {padding: 5px; }
      .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 15px;}
      .card.header {background-color: #0c6980; color: white; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px;}
      .cards {max-width: 700px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));}
      .reading {font-size: 1.3rem;}
      .packet {color: #bebebe;}
      .temperatureColor {color: #fd7e14;}
      .humidityColor {color: #1b78e2;}
      .statusreadColor {color: #702963; font-size:12px;}
      .LEDColor {color: #183153;}
      
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
          <div class="card header">
            <h3 style="font-size: 1rem;">Último Acesso Operadores</h3>
          </div>
          
          <!-- Displays the humidity and temperature values received from ESP32. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> OPERADOR 1</h4>
          <p class="temperatureColor"><span class="reading"><span id="lastTimeOperator1"></span></span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> OPERADOR 2</h4>
          <p class="humidityColor"><span class="reading"><span id="lastTimeOperator2"></span></span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> OPERADOR 3</h4>
          <p class="humidityColor"><span class="reading"><span id="lastTimeOperator3"></span></span></p>
          <!-- *********************************************************************** -->
        </div>
        <!-- ======================================================================================================= -->        
      </div>
    </div>
    
    <br>
    
    <div class="content">
      <div class="cards">
        <div class="card header" style="border-radius: 15px;">
            <h3 style="font-size: 0.7rem;">ÚLTIMA INFORMAÇÃO RECEBIDA DO ESP32 [ <span id="ESP32_LTRD"></span> ]</h3>
            <button onclick="window.open('KibHistorico.php', '_blank');">Open Record Table</button>
            <h3 style="font-size: 0.7rem;"></h3>
        </div>
      </div>
    </div>
    <!-- ___________________________________________________________________________________________________________________________________ -->
    
    <script>   
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
            var lstime = myObj.lstime == null ? "NN" : myObj.lstime;
            var lsdate = myObj.lsdate == null ? "NN" : myObj.lsdate;
            document.getElementById("lastTimeOperator"+id).innerHTML = "Hora: " + time + " <br>Data: " + date;
            document.getElementById("ESP32_LTRD").innerHTML = "Hora: " + lstime + " | Data: " + lsdate;
          }
        };
        xmlhttp.open("POST","KIB_database/getSensorData.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
			}
      //------------------------------------------------------------
    </script>
  </body>
</html>