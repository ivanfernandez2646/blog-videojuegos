<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Blog de Videojuegos</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <!-- HEADER -->
        <header>
            <h1 class="title">Blog de Videojuegos</h1>
        </header>
        <!-- NAV -->
        <nav class="nav-main-menu">
            <ul class="ul-main-menu">
                <li><a href="#">Inicio</a></li><!--
                --><li><a href="#">Categoría 1</a></li><!--
                --><li><a href="#">Categoría 2</a></li><!--
                --><li><a href="#">Categoría 3</a></li><!--
                --><li><a href="#">Categoría 4</a></li><!--
                --><li><a href="#">Sobre nosotros</a></li><!--
                --><li><a href="#">Contacto</a></li>
            </ul>
        </nav>
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
            <aside class="right-menu">
                <article class="form-log-sign-in box-shadows">
                    <h4>Identifícate</h4>
                    <form id="formLogin" action="log-in.php" method="POST">
                        <label for="txtEmail">Email:</label>
                        <br/>
                        <input type="text" id="txtEmail" name="txtEmail">
                        <br/>
                        <label for="txtPassword">Contraseña:</label>
                        <br/>
                        <input type="password" id="txtPassword" name="txtPassword">
                        <br/>
                        <input type="submit" value="Entrar">
                    </form>
                </article>
                <article class="form-log-sign-in sign-in box-shadows">
                    <h4>Regístrate</h4>
                    <form id="formLogin" action="sign-in.php" method="POST">
                        <label for="txtName">Nombre:</label>
                        <br/>
                        <input type="text" id="txtName" name="txtName">
                        <br/>
                        <label for="txtSurname">Apellidos:</label>
                        <br/>
                        <input type="text" id="txtSurname" name="txtSurname">
                        <br/>
                        <label for="txtEmail">Email:</label>
                        <br/>
                        <input type="text" id="txtEmail" name="txtEmail">
                        <br/>
                        <label for="txtPassword">Contraseña:</label>
                        <br/>
                        <input type="password" id="txtPassword" name="txtPassword">
                        <br/>
                        <input type="submit" value="Registrar">
                    </form>
                </article>
            </aside>
        </main>
        <!-- FOOTER -->
        <footer>

        </footer>
    </body>
</html>