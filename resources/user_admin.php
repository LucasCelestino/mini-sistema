<?php
require_once("connection.php");

function getUserAdmin($key,$value)
{
    $conn = Connection::getConnection();

    $stmt = $conn->prepare("SELECT * FROM users WHERE $key = :{$key}");
    $stmt->bindValue(":{$key}", $value);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function loginUserAdmin()
{
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);

    if(!$email)
    {
        header("Location: index.php?invalidFormat=true");
        exit();
    }

    $conn = Connection::getConnection();

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();

    if($user)
    {
        if(password_verify($password, $user['password']))
        {
            session_start();
            $_SESSION['auth'] = $user['id'];
            header("Location: home.php");
        }
        else
        {
            header("Location: index.php?invalidPassword=true");
            exit();
        }
    }
    else
    {
        header("Location: index.php?undefinedEmail=true");
        exit();
    }
}

function loggoutUserAdmin()
{
    session_destroy();
    header("Location: index.php");
}

function addUserAdmin()
{
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRIPPED);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
    $passwordVerify = filter_input(INPUT_POST, 'verify_password', FILTER_SANITIZE_STRIPPED);

    $user = getUserAdmin('email', $email);

    if($user)
    {
        header("Location: form_add_user_admin.php?emailExists=true");
        exit();
    }

    if($username & $password & $passwordVerify)
    {
        if($email)
        {
            if($password === $passwordVerify)
            {
                $conn = Connection::getConnection();

                $password = password_hash($password, PASSWORD_BCRYPT);

                $stmt = $conn->prepare("INSERT INTO users (name,email,password) VALUES (:name,:email,:password)");
                $stmt->bindValue(':name', $username);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':password', $password);
                
                if($stmt->execute())
                {
                    header("Location: form_add_user_admin.php?success=true");
                    exit();
                }
            }
            else
            {
                header("Location: form_add_user_admin.php?invalidVerifyPass=true");
                exit();
            }
        }
        else
        {
            header("Location: form_add_user_admin.php?invalidFormat=true");
            exit();
        }
    }
    else
    {
        header("Location: form_add_user_admin.php?emptyFields=true");
        exit();
    }
}