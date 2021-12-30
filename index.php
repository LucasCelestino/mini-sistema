<?php
session_start();
if(isset($_SESSION['auth']))
{
  header("Location: home.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR"">
<head>
    <title>Página de Login</title>
    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!--Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="static/css/index.css">

</head>
<body style="background-color:#2C3E50;">
    <div class="modal-dialog text-center">
        <div class="col-sm-8 main-section">
            <div class="modal-content bg-dark">
                <div class="col-12 user-img">
                    <img src="static/img/login/user.png"/>
                </div>
                <form class="col-12" action="login_user_admin.php" method="POST">
                    <div class="form-group" id="user-group">
                        <input type="text" class="form-control" placeholder="Email" name="email"/>
                    </div>
                    <div class="form-group" id="contrasena-group">
                        <input type="password" class="form-control" placeholder="Senha" name="password"/>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>  Entrar </button>
                </form>
                <div class="col-12 forgot">
                    <p class="text-white">Não tem uma conta? <a href="form_add_user_admin.php" class="text-success">Cadastre-se aqui.</a></p>
                </div>
                <?php if(isset($_GET['invalidFormat'])): ?>
                    <div class="alert alert-danger" role="alert">
		            Digite um e-mail válido.
		            </div>
                <?php elseif(isset($_GET['invalidPassword'])): ?>
                    <div class="alert alert-danger" role="alert">
		            Senha incorreta, tente novamente.
		            </div>
                    <?php elseif(isset($_GET['undefinedEmail'])): ?>
                    <div class="alert alert-danger" role="alert">
		            Esse e-mail não está cadastrado no sistema.
		            </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
