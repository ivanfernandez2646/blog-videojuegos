<aside class="right-menu">
<?php
    $addErrorLogIn = '';
    $res = false;

    if(isset($_SESSION['login'])){
        if(!is_null($_SESSION['login'])) {
            $res = $_SESSION['login'];

            if ($res) {
                echo '<article id="welcomeUser" class ="form-log-sign-in box-shadows">
                    <form id="formLogOut" action="./forms/log-out.php" method="POST"> 
                        <h4>Bienvenido, '.$_SESSION['nameUser'].' '.$_SESSION['surnameUser'].'</h4>
                        <button>Cerrar sesión</button>
                    </form>   
                  </article>';
            } else {
                $addErrorLogIn = '<p class="log-in-ko">Se ha producido un error en el login</p>';
            }
        }
    }

    if(!$res){
        echo '<article id="signIn" class="form-log-sign-in box-shadows">
                <h4>Identifícate</h4>';
        echo    $addErrorLogIn;
        echo    '<form id="formLogin" action="./forms/log-in.php" method="POST">
                    <label for="txtEmail">Email:</label>
                    <br/>
                    <input type="text" id="txtEmail" name="txtEmail" required>
                    <br/>
                    <label for="txtPassword">Contraseña:</label>
                    <br/>
                    <input type="password" id="txtPassword" name="txtPassword" required>
                    <br/>
                    <input type="submit" value="Entrar">
                 </form>
              </article>';
        $addErrorLogIn = '';

        echo '<article class="form-log-sign-in sign-in box-shadows">
            <h4>Regístrate</h4>';

        if (isset($_SESSION['register'])) {
            if (!is_null($_SESSION['register'])) {
                $res = $_SESSION['register'];

                if ($res) {
                    echo '<p class="sign-in-ok">Registro realizado correctamente</p>';
                } else {
                    echo '<p class="sign-in-ko">Se ha producido un error en el registro</p>';
                }
            }
        }

        echo '<form id="formLogin" action="./forms/sign-in.php" method="POST">
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
        </article>';
    }
?>
</aside>