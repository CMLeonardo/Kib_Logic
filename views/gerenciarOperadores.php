<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
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
                <a href="../index.html"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </header>
            <div class="main-content">
                <div class="panel-row">
                    <button class="panel panel-50" a-view="cadastrarOperador" onclick="fetchContent(this)" a-folder="peso">Cadastrar Operador</button>
                    <button class="panel panel-50" a-view="atualizarOperador" onclick="fetchContent(this)" a-folder="peso">Atualizar Operador</button>
                </div>
                <div class="content" id="ajax-content">

                </div>
            </div>
        </main>
    </div>
    <script>
        //------------------------------------------------------------
        function new_operator(operator_name) {
            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.open("POST","../KIB_database/UpdateKIBOperator.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=&operator_name"+operator_name);
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
            xmlhttp.open("POST","../KIB_database/UpdateKIBOperator.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id="+id+"&operator_name"+operator_name);
        }
        //------------------------------------------------------------
    </script>
    <script src="../js/ajax.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/fontawesome/js/all.min.js"></script>
</body>
</html>