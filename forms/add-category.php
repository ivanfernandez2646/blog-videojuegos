<?php
require_once ('../includes/helpers.php');
session_start();

$connDb = getConn();

function insertCategory($nameCategory){
    global $connDb;

    $stmt = $connDb -> prepare("INSERT INTO categories VALUES(NULL, ?)");
    $stmt -> bind_param('s', $nameCategory);

    return $stmt -> execute();
}
if(!empty($_GET['nameCategory'])){
    $nameCategory = $_GET['nameCategory'];
    $nameCategory = ucfirst(strtolower($nameCategory));

    if($connDb){
        $res = insertCategory($nameCategory);

        if($res){
            $_SESSION['createCategory'] = true;
            header("Location: ./../index.php");
        }else{
            $_SESSION['createCategory'] = false;
            header("Location: ./../index.php");
        }
    }else{
        echo 'ERROR connecting MariaDB '.mysqli_connect_errno();
        echo mysqli_connect_error();
        $_SESSION['createCategory'] = false;
        header("Location: ./../index.php");
    }
}else{
    echo 'Please, fill all mandatory fields';
}
