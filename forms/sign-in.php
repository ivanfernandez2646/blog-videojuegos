<?php
require_once ('../includes/helpers.php');
session_start();

$connDb = getConn();

function registerUser($name, $surname, $email, $password){
    global $connDb;

    $stmt = $connDb -> prepare("INSERT INTO users(name, surname, email, password) VALUES(?,?,?,(SELECT SHA1(?)))");
    $stmt -> bind_param("ssss", $name, $surname, $email, $password);

    return $stmt -> execute();
}

if (!empty($_POST['txtName'])
    and !empty($_POST['txtSurname'])
    and !empty($_POST['txtEmail'])
    and !empty($_POST['txtPassword'])){

    $name = $_POST['txtName'];
    $surname = $_POST['txtSurname'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    if($connDb){
        $res = registerUser($name, $surname, $email, $password);

        if($res){
            $_SESSION['register'] = true;
            header("Location: ./../index.php");
        }else{
            $_SESSION['register'] = false;
            header("Location: ./../index.php");
        }
    }else{
        echo 'ERROR connecting MariaDB '.mysqli_connect_errno();
        echo mysqli_connect_error();
        $_SESSION['register'] = false;
        header("Location: ./../index.php");
    }
}else{
    echo 'Please, fill all mandatory fields';
}

