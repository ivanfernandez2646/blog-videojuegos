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
                <br/>
                <article class ="form-log-sign-in box-shadows">
                    <h4>Modo personal</h4>
                    <p class="p-info">Sólo podrás visualizar tus artículos</p>
                    <form id="changeModeAccess" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" method="POST">
                        <label class="switch">
                            <?php
                            if(isset($_POST['checkBoxModeAccess']) and $_POST['checkBoxModeAccess'] == 'on'):
                                $_SESSION['selfMode'] = true;
                            ?>
                                <input id="checkBoxModeAccess" name="checkBoxModeAccess" type="checkbox" onchange="this.form.submit()" checked>
                            <?php elseif(isset($_SESSION['selfMode']) and $_SESSION['selfMode'] and isset($_POST['checkBoxModeAccess'])):
                                $_SESSION['selfMode'] = true;
                            ?>
                                <input id="checkBoxModeAccess" name="checkBoxModeAccess" type="checkbox" onchange="this.form.submit()" checked>
                            <?php elseif(isset($_SESSION['selfMode']) and $_SESSION['selfMode'] and !isset($_POST['isFromChangeModeAccess'])):
                                $_SESSION['selfMode'] = true;
                            ?>
                                <input id="checkBoxModeAccess" name="checkBoxModeAccess" type="checkbox" onchange="this.form.submit()" checked>
                            <?php else:$_SESSION['selfMode'] = false;?>
                                <input id="checkBoxModeAccess" name="checkBoxModeAccess" type="checkbox" onchange="this.form.submit()">
                            <?php endif;?>
                            <span class="slider round"></span>
                        </label>
                        <input id="isFromChangeModeAccess" name="isFromChangeModeAccess" type="checkbox" checked style="display: none;">
                    </form>
                </article>
            <?php else:
                $addErrorLogIn = '<p class="alert-ko">Se ha producido un error en el login</p>';
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
                            <p class="alert-ok">Registro realizado correctamente</p>
                        <?php else: ?>
                            <p class="alert-ko">Se ha producido un error en el registro</p>
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