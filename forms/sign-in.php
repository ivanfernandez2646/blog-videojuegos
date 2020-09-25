<?php

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = 'root1234';
$dbDataBase = 'blog_videojuegos';
$dbPort = 3307;

$connDb = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDataBase, $dbPort);

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
            header("Location: ./../index.php?r=1");
        }else{
            header("Location: ./../index.php?r=-1");
        }
    }else{
        echo 'ERROR connecting MariaDB '.mysqli_connect_errno();
        echo mysqli_connect_error();
        header("Location: ./../index.php?r=0");
    }
}else{
    echo 'Please, fill all mandatory fields';
}

