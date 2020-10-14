<?php
require_once('../includes/helpers.php');
session_start();

$connDb = getConn();

function updateArticle($idArticle, $titleArticle, $descriptionArticle){
    global $connDb;

    $stmt = $connDb->prepare("UPDATE articles SET title = ?, description = ? WHERE id = ?");
    $stmt->bind_param('ssi', $titleArticle, $descriptionArticle, $idArticle);

    return $stmt->execute();
}

if(!empty($_GET['idArticle'])
    and !empty($_GET['titleArticle'])
    and !empty($_GET['descriptionArticle'])){

    $idArticle = $_GET['idArticle'];
    $titleArticle = urldecode($_GET['titleArticle']);
    $descriptionArticle = urldecode($_GET['descriptionArticle']);

    if ($connDb) {
        $res = updateArticle($idArticle, $titleArticle, $descriptionArticle);

        if ($res) {
            $_SESSION['updateArticle'] = true;
            header("Location: ./../index.php?article=".$idArticle);
        } else {
            $_SESSION['updateArticle'] = false;
            header("Location: ./../index.php?article=".$idArticle);
        }
    }else{
        echo 'ERROR connecting MariaDB ' . mysqli_connect_errno();
        echo mysqli_connect_error();
        $_SESSION['updateArticle'] = false;
        header("Location: ./../index.php?article=".$idArticle);
    }
} else {
    echo 'Please, fill all mandatory fields';
}