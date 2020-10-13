<?php
require_once('../includes/helpers.php');
session_start();

$connDb = getConn();

function deleteArticle($idArticle){
    global $connDb;

    $stmt = $connDb->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->bind_param('i', $idArticle);

    return $stmt->execute();
}

if(!empty($_GET['idArticle'])){

    $idArticle = $_GET['idArticle'];

    if ($connDb) {
        $res = deleteArticle($idArticle);

        if ($res) {
            $_SESSION['deleteArticle'] = true;
            header("Location: ./../index.php");
        } else {
            $_SESSION['deleteArticle'] = false;
            header("Location: ./../index.php");
        }
    }else{
        echo 'ERROR connecting MariaDB ' . mysqli_connect_errno();
        echo mysqli_connect_error();
        $_SESSION['deleteArticle'] = false;
        header("Location: ./../index.php");
    }
} else {
    echo 'Please, fill all mandatory fields';
}