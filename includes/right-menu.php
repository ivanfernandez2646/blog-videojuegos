<aside class="right-menu">
    <?php
    $addErrorLogIn = '';
    $res = false;

    if(isset($_SESSION['login'])):
        if(!is_null($_SESSION['login'])):
            $res = $_SESSION['login'];
            if ($res):
    ?>
                <article id="welcomeUser" class ="form-log-sign-in box-shadows">
                    <h4>Bienvenido, <?=$_SESSION['nameUser'].' '.$_SESSION['surnameUser']?></h4>
                    <a id="aCreateArticle" href="./create-article.php">Crear entrada</a>
                    <a id="aCreateCategory" href="./create-category.php">Crear categoría</a>
                    <a id="aMyData" href="./my-data.php">Mis datos</a>
                    <a id="aLogOut" href="./includes/log-out.php">Cerrar sesión</a>
                    <br/>
                </article>
            <?php else:
                $addErrorLogIn = '<p class="log-in-ko">Se ha producido un error en el login</p>';
            ?>
            <?php endif;?>
        <?php endif;?>
    <?php endif;?>

    <?php if(!$res):?>
        <article id="signIn" class="form-log-sign-in box-shadows">
            <h4>Identifícate</h4>
            <?=$addErrorLogIn?>
            <form id="formLogin" action="./forms/log-in.php" method="POST">
                <label for="txtEmail">Email:</label>
                <br/>
                <input type="email" id="txtEmail" name="txtEmail" required>
                <br/>
                <label for="txtPassword">Contraseña:</label>
                <br/>
                <input type="password" id="txtPassword" name="txtPassword" required>
                <br/>
                <input type="submit" value="Entrar">
            </form>
        </article>
        <?php $addErrorLogIn = '' ?>

        <article class="form-log-sign-in sign-in box-shadows">
            <h4>Regístrate</h4>
            <?php if (isset($_SESSION['register'])):
                    if (!is_null($_SESSION['register'])):
                        $res = $_SESSION['register'];
                        if ($res):
            ?>
                            <p class="sign-in-ok">Registro realizado correctamente</p>
                        <?php else: ?>
                            <p class="sign-in-ko">Se ha producido un error en el registro</p>
                        <?php endif; ?>
                    <?php endif; ?>
            <?php endif; ?>
            <form id="formLogin" action="./forms/sign-in.php" method="POST">
                <label for="txtName">Nombre:</label>
                <br/>
                <input type="text" id="txtName" name="txtName" required>
                <br/>
                <label for="txtSurname">Apellidos:</label>
                <br/>
                <input type="text" id="txtSurname" name="txtSurname" required>
                <br/>
                <label for="txtEmail">Email:</label>
                <br/>
                <input type="email" id="txtEmail" name="txtEmail" required>
                <br/>
                <label for="txtPassword">Contraseña:</label>
                <br/>
                <input type="password" id="txtPassword" name="txtPassword" required>
                <br/>
                <input type="submit" value="Registrar">
            </form>
        </article>
    <?php endif;?>
</aside>