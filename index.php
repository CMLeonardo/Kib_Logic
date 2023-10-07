<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css">
    <title>Health Track</title>
</head>
<body>
    <div class="login">
        <div class="login-form">           
            <div class="login-form-wrapper">
                <div class="login-mobile">
                    <div class="login-title">
                        <h2>Log In</h2>
                        <a href="views/register.html">Cadastrar-se</a>
                    </div>
                    <form>
                        <div class="mb-3">
                        <label for="email" class="form-label">Email <i class="fa-solid fa-trash"></i></label>
                        <input type="email" class="form-control" id="email" placeholder="Insira seu Email">
                        </div>
                        <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" placeholder="Insira sua Senha">
                        </div>
                        <button type="button" class="btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="banner-login">
            <img src="images/Image-login.png" alt="">
            <h2>Health Track</h2>
        </div>
    </div>

    <script>
        let button = document.querySelector('form button.btn')
        button.addEventListener("click", () => {
            location.href = "views/dashboard.php"
        })
    </script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/fontawesome/js/all.min.js"></script>
</body>
</html>