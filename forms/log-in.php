<?php

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = 'root1234';
$dbDataBase = 'blog_videojuegos';
$dbPort = 3307;

$connDb = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDataBase, $dbPort);

function logInUser($email, $password){
    global $connDb;

    $stmt = $connDb -> prepare("SELECT COUNT(*) AS userExists FROM users WHERE email = ? AND password = (SELECT SHA1(?)) GROUP BY email, password");
    $stmt -> bind_param('ss', $email, $password);

    $stmt -> execute();
    $stmt -> bind_result($userExists);

    while($stmt -> fetch()){
        if($userExists){
            return true;
        }
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
            header("Location: ./../index.php?l=1");
        }else{
            header("Location: ./../index.php?l=-1");
        }
    }
}else{
    echo 'Please, fill all mandatory fields';
}