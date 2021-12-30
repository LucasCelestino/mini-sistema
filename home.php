<?php
require("resources/user_painel.php");
require("resources/user_admin.php");

session_start();

if(!$_SESSION['auth'])
{
  header("Location: index.php");
  exit;
}

$user = getUserAdmin('id',$_SESSION['auth']);
$users = getAllUsersPainel();
$aux = 1;
?>
<!DOCTYPE html>
<html lang="pt-BR"">
<head>
    <title>Home</title>
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
            <p class="text-white m-0 h6">Bem vindo, <?=$user['name'];?></p>
            <a href="loggout_user_admin.php" class="text-white">Sair</a>
        </div>
    </div>
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h2 mb-4">Usuários</h2>
            <a href="form_add_user_painel.php" class="btn btn-success mb-2">Criar Usuário</a>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Avatar</th>
                <th scope="col">Nome</th>
                <th scope="col">Sobrenome</th>
                <th scope="col">Email</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <th scope="row">
                    <?php echo $aux; $aux++;?>
                  </th>
                  <td>
                      <img src="static/img/<?=$user['photo'];?>" width="50" height="50" style="border-radius: 50%;">
                  </td>
                  <td class="pt-4 h6"><?=$user['name'];?></td>
                  <td class="pt-4 h6"><?=$user['last_name'];?></td>
                  <td class="pt-4 h6"><?=$user['email'];?></td>
                  <td>
                      <a href="form_edit_user_painel.php?id=<?=$user['id'];?>" class="btn btn-outline-dark">Editar</a>
                      <a href="delete_user_painel.php?id=<?=$user['id'];?>" class="btn btn-outline-danger">Excluir</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
    </div>
</body>
</html>
