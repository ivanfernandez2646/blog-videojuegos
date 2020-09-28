<?php
require_once ('../includes/helpers.php');
session_start();

$connDb = getConn();

function logInUser($email, $password){
    global $connDb;

    $stmt = $connDb -> prepare("SELECT id, name, surname, email FROM users WHERE email = ? AND password = (SELECT SHA1(?))");
    $stmt -> bind_param('ss', $email, $password);

    $stmt -> execute();
    $stmt -> bind_result($idRes, $nameRes, $surnameRes, $emailRes);

    while($stmt -> fetch()){
        $_SESSION['idUser'] = $idRes;
        $_SESSION['nameUser'] = $nameRes;
        $_SESSION['surnameUser'] = $surnameRes;
        $_SESSION['emailRes'] = $emailRes;
        return true;
    }

    return false;
}

if(!empty($_POST['txtEmail'])
    and !empty($_POST['txtPassword'])){

    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    if($connDb){
        $res = logInUser($email, $password);

        if($res){
            $_SESSION['login'] = true;
            header("Location: ./../index.php");
        }else{
            $_SESSION['login'] = false;
            header("Location: ./../index.php");
        }
    }else{
        echo 'ERROR connecting MariaDB '.mysqli_connect_errno();
        echo mysqli_connect_error();
        $_SESSION['login'] = false;
        header("Location: ./../index.php");
    }
}else{
    echo 'Please, fill all mandatory fields';
}