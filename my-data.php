<?php
require_once ('./includes/helpers.php');
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<!-- HEADER -->
<?php require_once('./includes/header.php'); ?>
<!-- NAV -->
<?php require_once('./includes/nav.php'); ?>
<!-- MAIN -->
<main>
    <section class="main-left box-shadows">
        <h2>Mis Datos</h2>
        <p>Modifica tus datos de una manera muy sencilla.</p>
        <?php
        if(isset($_SESSION['duplicateEmail'])):
            if(!$_SESSION['duplicateEmail']):
        ?>
                <p class="alert-ok">Datos actualizados correctamente</p>
            <?php else:?>
                <p class="alert-ko">El email ya se encuentra registrado</p>
            <?php endif;?>
        <?php endif; unset($_SESSION['duplicateEmail'])?>
        <form id="formModifyMyData" class="formGeneric" action="./forms/modify-my-data.php" method="GET">
            <label for="newNameUser">Nombre:</label>
            <br/>
            <input id="newNameUser" name="newNameUser" type="text" value="<?=$_SESSION['nameUser']?>" required>
            <br/>
            <label for="newSurnameUser">Apellidos:</label>
            <br/>
            <input id="newSurnameUser" name="newSurnameUser" type="text" value="<?=$_SESSION['surnameUser']?>" required>
            <br/>
            <label for="newEmailUser">Email:</label>
            <br/>
            <input id="newEmailUser" name="newEmailUser" type="email" value="<?=$_SESSION['emailUser']?>" required>
            <input type="submit" value="Guardar" required>
        </form>
    </section>
    <?php require_once('./includes/right-menu.php'); ?>
</main>
<!-- FOOTER -->
<?php require_once('./includes/footer.php'); ?>
</body>
</html>