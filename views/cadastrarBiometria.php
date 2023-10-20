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
    <style>
        #toggle{
            display: none;
        }

        .buttonBiometria::after {
            content: url('../../_img/lua.png');
            width: 40px;
            height: 40px;
            background-color: #e3e3e3;
            border: solid 2px #0c6980;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
            display: grid;
            transition: background-color 1s, 
            transform 1s ease-in;
        }

        #toggle:checked + .buttonBiometria::after {
            content: url("../../_img/sol.png");
            background-color: #0c6980;
            border-color: #e3e3e3;
        }
    </style>
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
                        <i class="far fa-user"></i>
                        <a href="../views/cadastrarBiometria.php">Biometria</a>
                    </li>
                </ul>
            </div>   
        </sidebar>
        <main>
            <div class="main-content">
                <div class="panel-row">
                    <div class="content">
                        <label class="form-label">Cadastro Biométrico Ativo?<br>id atual: <span class="id_biometric"></span></label>
                        <input type="checkbox" id="toggle">
                        <label for="toggle" class="buttonBiometria" a-view="cadastrarBiometria" onclick="fetchContent(this); GetTogBtnCadState()" a-folder="biometria"></label>
                        <div class="content" id="ajax-content">
                        <div class="dynamic-content"></div>
                        </div>
                    </div>
                </div>         
            </div>
        </main>
    </div>
    <script>
        //------------------------------------------------------------
        function update_Biometric_Id() {
            var biometric_id = document.getElementById("biometric_id").value;

            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.open("POST","../KIB_database/updateCadId.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=1&biometric_id="+biometric_id);
        }
        //------------------------------------------------------------

        //------------------------------------------------------------
        function GetTogBtnCadState() {
            var togbtnchecked = document.getElementById(toggle).checked;
            var togbtncheckedsend = "";
            if (togbtnchecked == true) togbtncheckedsend = "true";
            if (togbtnchecked == false) togbtncheckedsend = "false";
            Update_Tog(togbtncheckedsend);
        }
        //------------------------------------------------------------
        
        //------------------------------------------------------------
        function Update_Tog(cadstate) {
            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
            // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //document.getElementById("demo").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("POST","updateCadTogState.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=1&cadstate="+cadstate);
        }
        //------------------------------------------------------------

        function Get_Tog() {
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
                    var biometric_cadstate = myObj.cadstate == null ? "NN" : myObj.cadstate;
                    var biometric_id = myObj.biometric_id == null ? "NN" : myObj.biometric_id;
                    if(biometric_cadstate == "true"){
                        document.getElementById("toggle").checked;
                    }
                    document.getElementById("id_biometric").innerHTML = biometric_id;
                }
            }
            xmlhttp.open("POST","getCadData.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=1");
        }
        //------------------------------------------------------------

        //------------------------------------------------------------
      window.onload = function() {
        Get_Tog();
      };
      //--------------------------------

    </script>
    <script src="../js/ajax.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome/js/all.min.js"></script>
</body>
</html>