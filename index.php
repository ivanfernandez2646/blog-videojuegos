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
                <?php if(empty($_GET['article'])):?>
                    <h2>Últimas Entradas</h2>
                <?php
                    $allArticles = !empty($_GET['allArticles']) ? $_GET['allArticles'] : false;
                    $isMaxArticlesReached = true;

                    if(!empty($_GET['category'])){
                        if((isset($_SESSION['selfMode']) and $_SESSION['selfMode'] and empty($_POST['isFromChangeModeAccess'])) or !empty($_POST['checkBoxModeAccess'])){
                            $articles = getArticles($allArticles,$isMaxArticlesReached, $_GET['category'], false);
                        }else{
                            $articles = getArticles($allArticles, $isMaxArticlesReached, $_GET['category']);
                        }
                    }else{
                        if((isset($_SESSION['selfMode']) and $_SESSION['selfMode'] and empty($_POST['isFromChangeModeAccess'])) or !empty($_POST['checkBoxModeAccess'])){
                            $articles = getArticles($allArticles, $isMaxArticlesReached,null, false);
                        }else{
                            $articles = getArticles($allArticles, $isMaxArticlesReached);
                        }
                    }

                    foreach($articles as $article):
                ?>
                    <article class="post">
                        <h3 class="title-post"><a href="./index.php?article=<?=$article['id']?>"><?=$article['title']?></a></h3>
                        <p class="p-info"><?=$article['datePublication'].' - '.$article['nameCategory'].' - '.$article['fullNameUser']?></p>
                        <p class="p-post">
                            <?=$article['shortDescription']?>
                        </p>
                    </article>
                <?php endforeach;?>
                    <?php if(count($articles) != 0):?>
                        <?php if((!$allArticles) && !$isMaxArticlesReached):?>
                            <form id="formAllArticles" action="<?php echo $_SERVER['PHP_SELF'].'?allArticles=true';?>" method="POST">
                                <div class="buttonHolder">
                                    <input id="btAllArticles" type="submit" value="Ver todas las entradas"/>
                                </div>
                            </form>
                        <?php endif;?>
                    <?php else:?>
                        <p>No hay entradas</p>
                    <?php endif;?>
                <?php else: $selectedArticle = getArticle($_GET['article'])?>
                    <h2 class="title-selected-post"><?=$selectedArticle['title']?></h2>
                    <article class="post">
                        <p class="p-info"><?=$selectedArticle['datePublication'].' - '.$selectedArticle['nameCategory'].' - '.$selectedArticle['fullNameUser']?></p>
                        <p class="p-post">
                            <?=$selectedArticle['description']?>
                        </p>
                    </article>
                    <?php if(!empty($_SESSION['idUser'])):?>
                        <?php if($selectedArticle['userId'] == $_SESSION['idUser']):?>
                            <a id="aEditArticle" class="mdArticle">Editar entrada</a>
                            <a id="aDeleteArticle" class="mdArticle" href="<?='./forms/delete-article.php?idArticle='.$selectedArticle['id']?> ">Borrar entrada</a>
                            <a id="aSaveChanges" class="mdArticle">Guardar cambios</a>
                            <a id="aReverseChanges" class="mdArticle"">Deshacer cambios</a>
                        <?php endif;?>
                    <?php endif;?>
                <?php endif;?>
            </section>
            <?php require_once('./includes/right-menu.php'); ?>
        </main>
        <!-- FOOTER -->
        <?php require_once('./includes/footer.php'); ?>
        <?php if(!empty($_GET['article'])):?>
            <?php if($selectedArticle['userId'] == $_SESSION['idUser']):?>
                <script type="application/javascript" src="index.js"></script>
            <?php endif;?>
        <?php endif;?>
    </body>
</html>