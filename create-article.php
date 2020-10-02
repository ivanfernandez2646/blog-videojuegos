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
            <h2>Crear entradas</h2>
            <p>Añade nuevas entradas al blog.</p>
            <form id="formCreateArticle" class="formGeneric" action="./forms/add-article.php" method="POST">
                <label for="titleArticle">Título:</label>
                <br/>
                <input id="titleArticle" name="titleArticle" type="text" required>
                <label for="descriptionArticle">Descripción:</label>
                <br/>
                <textarea id="descriptionArticle" name="descriptionArticle" required></textarea>
                <label for="categoryArticle">Elige la categoría:</label>
                <select id="categoryArticle" name="categoryArticle" required>
                    <?php $categories = getCategories();
                        foreach ($categories as $category){
                            echo '<option value="'.strtolower($category['id']).'">'.$category['name'].'</option>';
                        }
                    ?>
                </select>
                <input type="submit" value="Crear" required>
            </form>
        </section>
        <?php require_once('./includes/right-menu.php'); ?>
    </main>
    <!-- FOOTER -->
    <?php require_once('./includes/footer.php'); ?>
    </body>
</html>