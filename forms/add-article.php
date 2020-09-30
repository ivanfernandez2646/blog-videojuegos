<?php
require_once('../includes/helpers.php');
session_start();

$connDb = getConn();

function insertArticle($title, $description, $idUser, $idCategory){
    global $connDb;

    $stmt = $connDb->prepare("INSERT INTO articles(user_id, category_id, title, description) VALUES(?, ?, ?, ?)");
    $stmt->bind_param('iiss', $idUser, $idCategory, $title, $description);

    return  $stmt->execute();
}

if (!empty($_POST['titleArticle'])
    and !empty($_POST['descriptionArticle'])
    and !empty($_POST['categoryArticle'])) {

    $titleArticle = $_POST['titleArticle'];
    $descriptionArticle = $_POST['descriptionArticle'];
    $categoryArticle = intval($_POST['categoryArticle']);

    if ($connDb) {
        $res = insertArticle($titleArticle, $descriptionArticle, $_SESSION['idUser'], $categoryArticle);

        if ($res) {
            $_SESSION['createArticle'] = true;
            header("Location: ./../index.php");
        } else {
            $_SESSION['createArticle'] = false;
            header("Location: ./../index.php");
        }
    } else {
        echo 'ERROR connecting MariaDB ' . mysqli_connect_errno();
        echo mysqli_connect_error();
        $_SESSION['createArticle'] = false;
        header("Location: ./../index.php");
    }
} else {
    echo 'Please, fill all mandatory fields';
}
