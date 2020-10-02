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
            <h2>Crear categorías</h2>
            <p>Añade nuevas categorías al blog para que los usuarios puedan usarlas al crear sus entradas.</p>
            <form id="formCreateCategory" class="formGeneric" action="./forms/add-category.php" method="GET">
                <label for="nameCategory">Nombre de la categoría:</label>
                <br/>
                <input id="nameCategory" name="nameCategory" type="text" required>
                <input type="submit" value="Crear" required>
            </form>
        </section>
        <?php require_once('./includes/right-menu.php'); ?>
    </main>
    <!-- FOOTER -->
    <?php require_once('./includes/footer.php'); ?>
    </body>
</html>