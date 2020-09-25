<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Blog de Videojuegos</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!-- HEADER -->
        <?php require_once('./header.php'); ?>
        <!-- NAV -->
        <?php require_once('./nav.php'); ?>
        <!-- MAIN -->
        <main>
            <section class="latest_posts box-shadows">
                <h2>Últimas Entradas</h2>
                <article class="post">
                    <h3 class="title-post">Título de mi entrada</h3>
                    <p class="p-post">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sem erat, tincidunt ut luctus sit amet,
                        imperdiet at turpis. Phasellus ullamcorper, justo ac dignissim imperdiet, nisl nunc lacinia ante, id volutpat nibh nibh et magna.
                    </p>
                </article>
                <article class="post">
                    <h3 class="title-post">Título de mi entrada</h3>
                    <p class="p-post">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sem erat, tincidunt ut luctus sit amet,
                        imperdiet at turpis. Phasellus ullamcorper, justo ac dignissim imperdiet, nisl nunc lacinia ante, id volutpat nibh nibh et magna.
                    </p>
                </article>
                <article class="post">
                    <h3 class="title-post">Título de mi entrada</h3>
                    <p class="p-post">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sem erat, tincidunt ut luctus sit amet,
                        imperdiet at turpis. Phasellus ullamcorper, justo ac dignissim imperdiet, nisl nunc lacinia ante, id volutpat nibh nibh et magna.
                    </p>
                </article>
            </section>

            <?php require_once('./right-menu.php'); ?>
        </main>
        <!-- FOOTER -->
        <?php require_once('./footer.php'); ?>
    </body>
</html>