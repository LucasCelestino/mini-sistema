<?php

session_start();

if(isset($_SESSION['auth']))
{
  require("resources/user_admin.php");
  loggoutUserAdmin();
}
else
{
  header("Location: index.php");
  exit;
}