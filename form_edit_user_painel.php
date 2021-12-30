<?php
require("resources/user_painel.php");

session_start();

if(!$_SESSION['auth'])
{
  header("Location: index.php");
  exit;
}

$user = getUserPainel('id',$_GET['id']);
?>
<!DOCTYPE html>
<html lang="pt-BR"">
<head>
    <title>Editar Usuário</title>
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
<body class="bg-light">
    <div class="container-fluid py-3 d-flex align-items-center" style="background-color:#2C3E50;">
        <div class="container d-flex justify-content-between align-items-center">
            <p class="text-white m-0 h6">Bem vindo, Fulano de Tal</p>
            <a href="loggout_user_admin.php" class="text-white">Sair</a>
        </div>
    </div>
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h2 mb-4">Editar Usuário</h2>
            <a href="home.php" class="btn btn-primary mb-2">Voltar</a>
        </div>
        <form action="edit_user_painel.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Nome</label>
              <input type="text" name="name" class="form-control pl-2 border" value="<?=$user['name'];?>">
            </div>
            <div class="form-group">
              <label for="">Sobrenome</label>
              <input type="text" name="last_name" class="form-control pl-2 border" value="<?=$user['last_name'];?>">
            </div>
            <div class="form-group">
              <label for="">E-mail</label>
              <input type="text" name="email" class="form-control pl-2 border" value="<?=$user['email'];?>">
            </div>
              <div class="form-group">
                <small for="exampleFormControlFile1">Selecione uma foto para o usuário</small>
                <input type="file" name="files" class="form-control-file pl-2 mt-2">
              </div>
            <input type="hidden" name="id" value="<?=$user['id'];?>">
            <button type="submit" class="btn btn-success" style="width: 200px;">Editar</button>
          </form>
          <?php if(isset($_GET['invalidFormat'])): ?>
              <div class="alert alert-danger" role="alert">
              Digite um e-mail válido.
              </div>
          <?php elseif(isset($_GET['invalidPhoto'])): ?>
              <div class="alert alert-danger" role="alert">
		          Formato inválido de foto. Formatos aceitos: JPEG, JPG, PNG.
		          </div>
          <?php elseif(isset($_GET['emptyName'])): ?>
              <div class="alert alert-danger" role="alert">
		          Digite um nome e sobrenome para o usuário.
		          </div>
          <?php elseif(isset($_GET['success'])): ?>
              <div class="alert alert-success" role="alert">
		          Usuário editado com sucesso. <a href="home.php">Clique aqui</a> para voltar para a exibição dos usuários
		          </div>
          <?php endif; ?>
    </div>
</body>
</html>
