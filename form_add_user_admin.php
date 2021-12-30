<!DOCTYPE html>
<html lang="pt-BR"">
<head>
    <title>Cadastro</title>
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
            <div class="modal-content bg-dark pt-3">
                <form class="col-12" action="add_user_admin.php" method="POST">
                    <h6 class="text-white h4 pb-2">Cadastre-se</h6>
                    <div class="form-group" id="user-group">
                        <input type="text" class="form-control" placeholder="Digite seu nome" name="username"/>
                    </div>
                    <div class="form-group" id="user-group">
                        <input type="text" class="form-control" placeholder="Digite seu email" name="email"/>
                    </div>
                    <div class="form-group" id="contrasena-group">
                        <input type="password" class="form-control" placeholder="Digite sua senha" name="password"/>
                    </div>
                    <div class="form-group" id="contrasena-group">
                        <input type="password" class="form-control" placeholder="Confirme sua senha" name="verify_password"/>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>  Cadastrar </button>
                </form>
                <div class="col-12 forgot">
                    <p class="text-white">Já tem uma conta? <a href="index.php" class="text-success">Login.</a></p>
                </div>
                <?php if(isset($_GET['invalidFormat'])): ?>
                    <div class="alert alert-danger" role="alert">
		            Digite um e-mail válido.
		            </div>
                <?php elseif(isset($_GET['invalidVerifyPass'])): ?>
                    <div class="alert alert-danger" role="alert">
		            As senhas não conferem, tente novamente.
		            </div>
                <?php elseif(isset($_GET['emptyFields'])): ?>
                    <div class="alert alert-danger" role="alert">
		            Preencha todos os campos.
		            </div>
                <?php elseif(isset($_GET['emailExists'])): ?>
                    <div class="alert alert-danger" role="alert">
		            O e-mail informado já está em uso, faça login <a href="index.php">aqui</a>.
		            </div>
                <?php elseif(isset($_GET['success'])): ?>
                    <div class="alert alert-success" role="alert">
		            Cadastrado realizado com sucesso, faça login <a href="index.php">aqui</a>.
		            </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
