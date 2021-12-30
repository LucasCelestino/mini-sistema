<?php
require_once("connection.php");

function getAllUsersPainel()
{
    $conn = Connection::getConnection();
    $stmt = $conn->prepare("SELECT * FROM users_painel WHERE id_user = :id_user");
    $stmt->bindValue(':id_user', $_SESSION['auth']);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserPainel($key, $value)
{
    $id = filter_var($value,FILTER_SANITIZE_STRIPPED);
    
    $conn = Connection::getConnection();
    $stmt = $conn->prepare("SELECT * FROM users_painel WHERE $key = :{$key}");
    $stmt->bindValue(":{$key}", $value);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteUserPainel($id)
{
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $user = getUserPainel('id',$id);

    if($id)
    {
        if(file_exists("static/img/{$user['photo']}"))
        {
            unlink("static/img/{$user['photo']}");
        }

        session_start();
        $conn = Connection::getConnection();
        $stmt = $conn->prepare("DELETE FROM users_painel WHERE id = :id AND id_user = :id_user");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':id_user', $_SESSION['auth']);

        if($stmt->execute())
        {
            header("Location: home.php");
        }
    }
}

function editUserPainel()
{
    $firstName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRIPPED);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $photo = $_FILES['files'];
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    $user = getUserPainel('id', $id);

    if($id)
    {
        if($firstName && $lastName)
        {
            if($email)
            {
                if($photo['name'])
                {
                    if($photo['type'] == "image/jpeg" || $photo['type'] == "image/jpg" || $photo['type'] == "image/png")
                    {
                        if(file_exists("static/img/{$user['photo']}"))
                        {
                            unlink("static/img/{$user['photo']}");
                        }
                        $photoName = md5(uniqid().$photo['name'].date('Y-m-d H:i:s')).'.jpg';

                        if(move_uploaded_file($photo['tmp_name'], 'static/img/'.$photoName))
                        {
                            session_start();
                            $conn = Connection::getConnection();
                            $stmt = $conn->prepare("UPDATE users_painel SET id_user = :id_user, name = :name, last_name = :last_name, email = :email, photo = :photo WHERE id = :id");
                            $stmt->bindValue(':id_user', $_SESSION['auth']);
                            $stmt->bindValue(':name', $firstName);
                            $stmt->bindValue(':last_name', $lastName);
                            $stmt->bindValue(':email', $email);
                            $stmt->bindValue(':photo', $photoName);
                            $stmt->bindValue(':id', $id);

                            if($stmt->execute())
                            {
                                header("Location: form_edit_user_painel.php?success=true&id={$id}");
                                exit();
                            }
                        }
                    }
                    else
                    {
                        header("Location: form_edit_user_painel.php?invalidPhoto=true&id={$id}");
                        exit();
                    }
                }
                else
                {
                    session_start();
                    $conn = Connection::getConnection();
                    $stmt = $conn->prepare("UPDATE users_painel SET id_user = :id_user, name = :name, last_name = :last_name, email = :email, photo = :photo WHERE id = :id");
                    $stmt->bindValue(':id_user', $_SESSION['auth']);
                    $stmt->bindValue(':name', $firstName);
                    $stmt->bindValue(':last_name', $lastName);
                    $stmt->bindValue(':email', $email);
                    $stmt->bindValue(':photo', $user['photo']);
                    $stmt->bindValue(':id', $id);

                    if($stmt->execute())
                    {
                        header("Location: form_edit_user_painel.php?success=true&id={$id}");
                        exit();
                    }
                }
            }
            else
            {
                header("Location: form_edit_user_painel.php?invalidFormat=true&id={$id}");
                exit();
            }
        }
        else
        {
            header("Location: form_edit_user_painel.php?emptyName=true&id={$id}");
            exit();
        }
    }
    else
    {
        header("Location: home.php");
        exit();
    }
}

function addUserPainel()
{
    $firstName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRIPPED);
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRIPPED);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $photo = $_FILES['files'];

    $user = getUserPainel('email', $email);

    if($user)
    {
        header("Location: form_add_user_painel.php?emailExists=true");
        exit();
    }

    if($email)
    {
        if($firstName && $lastName)
        {
            if($photo['type'] == "image/jpeg" || $photo['type'] == "image/jpg" || $photo['type'] == "image/png")
            {
                $photoName = md5(uniqid().$photo['name'].date('Y-m-d H:i:s')).'.jpg';

                if(move_uploaded_file($photo['tmp_name'], 'static/img/'.$photoName))
                {
                    session_start();
                    $conn = Connection::getConnection();
                    $stmt = $conn->prepare("INSERT INTO users_painel (id_user,name,last_name,email,photo) VALUES (:id_user,:name,:last_name,:email,:photo)");
                    $stmt->bindValue(':id_user', $_SESSION['auth']);
                    $stmt->bindValue(':name', $firstName);
                    $stmt->bindValue(':last_name', $lastName);
                    $stmt->bindValue(':email', $email);
                    $stmt->bindValue(':photo', $photoName);

                    if($stmt->execute())
                    {
                        header("Location: form_add_user_painel.php?success=true");
                        exit();
                    }
                }
            }
            else
            {
                header("Location: form_add_user_painel.php?invalidPhoto=true");
                exit();
            }
        }
        else
        {
            header("Location: form_add_user_painel.php?emptyName=true");
            exit();
        }
    }
    else
    {
        header("Location: cadastrar-usuario.php?invalidFormat=true");
        exit();
    }
}