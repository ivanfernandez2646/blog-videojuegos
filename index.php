<!-- WARNING -- All forms and calls to different php files and resources
    are called since index.php. So, you can see some warnings with paths.
    It doesn't matter. I prefer this methodology for make this app.
    (Exception with calls from 'forms' directory).
-->
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
                <h2>Últimas Entradas</h2>
                <?php
                    if(!empty($_GET['category'])){
                        if((isset($_SESSION['selfMode']) and $_SESSION['selfMode'] and empty($_POST['isFromChangeModeAccess'])) or !empty($_POST['checkBoxModeAccess'])){
                            $articles = getArticles($_GET['category'], false);
                        }else{
                            $articles = getArticles($_GET['category']);
                        }
                    }else{
                        if((isset($_SESSION['selfMode']) and $_SESSION['selfMode'] and empty($_POST['isFromChangeModeAccess'])) or !empty($_POST['checkBoxModeAccess'])){
                            $articles = getArticles(null, false);
                        }else{
                            $articles = getArticles();
                        }
                    }

                    foreach($articles as $article):
                ?>
                    <article class="post">
                        <h3 class="title-post"><?=$article['title']?></h3>
                        <?php if (isset($_SESSION['sessionActive'])):?>
                            <p class="p-info"><?=$article['datePublication'].' - '.$article['nameCategory'].' - '.$article['fullNameUser']?></p>
                        <?php endif;?>
                        <p class="p-post">
                            <?=$article['description']?>
                        </p>
                    </article>
                <?php endforeach;?>
            </section>
            <?php require_once('./includes/right-menu.php'); ?>
        </main>
        <!-- FOOTER -->
        <?php require_once('./includes/footer.php'); ?>
    </body>
</html>