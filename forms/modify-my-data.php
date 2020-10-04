<?php
require_once('../includes/helpers.php');
session_start();

$connDb = getConn();

function checkDuplicateEmail($newEmailUser)
{
    global $connDb;

    if($newEmailUser != $_SESSION['emailUser']){
        $stmt = $connDb->prepare("SELECT email FROM users where email = ?");
        $stmt->bind_param('s', $newEmailUser);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows >= 1) {
            return true;
        }
    }

    return false;
}

function modifyUserData($idUser, $newNameUser, $newSurnameUser, $newEmailUser){
    global $connDb;

    if(!checkDuplicateEmail($newEmailUser)){
        $stmt = $connDb->prepare("UPDATE users SET name = ?, surname = ?, email = ? WHERE id = ? and email = ?");
        $stmt -> bind_param('sssis', $newNameUser, $newSurnameUser, $newEmailUser, $idUser, $_SESSION['emailUser']);

        if($stmt -> execute()){
            $_SESSION['nameUser'] = $newNameUser;
            $_SESSION['surnameUser'] = $newSurnameUser;
            $_SESSION['emailUser'] = $newEmailUser;
            return true;
        }
    }

    return false;
}

if (!empty($_GET['newNameUser'])
    and !empty($_GET['newSurnameUser'])
    and !empty($_GET['newEmailUser'])) {

    $newNameUser = $_GET['newNameUser'];
    $newSurnameUser = $_GET['newSurnameUser'];
    $newEmailUser = $_GET['newEmailUser'];

    if ($connDb) {
        $res = modifyUserData($_SESSION['idUser'], $newNameUser, $newSurnameUser, $newEmailUser);

        if ($res) {
            $_SESSION['modifyData'] = true;
            header("Location: ./../index.php");
        } else {
            $_SESSION['modifyData'] = false;
            header("Location: ./../index.php");
        }
    } else {
        echo 'ERROR connecting MariaDB ' . mysqli_connect_errno();
        echo mysqli_connect_error();
        $_SESSION['modifyData'] = false;
        header("Location: ./../index.php");
    }
} else {
    echo 'Please, fill all mandatory fields';
}