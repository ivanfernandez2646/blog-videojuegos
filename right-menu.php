<aside class="right-menu">
    <article class="form-log-sign-in box-shadows">
        <h4>Identifícate</h4>
        <?php
        if (!empty($_GET['l'])){
            $res = $_GET['l'];
            switch ((string)$res) {
                case "-1":
                    echo '<p class="log-in-ko">Error al realizar el log-in</p>';
                    break;
                case "1":
                    echo '<p class="log-in-ok">Log-in correcto!!</p>';
                    break;
            }
        }
        ?>
        <form id="formLogin" action="./forms/log-in.php" method="POST">
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
    </article>
    <article class="form-log-sign-in sign-in box-shadows">
        <h4>Regístrate</h4>
        <?php
            if (!empty($_GET['r'])){
                $res = $_GET['r'];
                switch ((string)$res) {
                    case "-1":
                        echo '<p class="sign-in-ko">Se ha producido un error en el registro</p>';
                        break;
                    case "1":
                        echo '<p class="sign-in-ok">Registro realizado correctamente</p>';
                        break;
                }
            }
        ?>
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
            <input type="text" id="txtEmail" name="txtEmail" required>
            <br/>
            <label for="txtPassword">Contraseña:</label>
            <br/>
            <input type="password" id="txtPassword" name="txtPassword" required>
            <br/>
            <input type="submit" value="Registrar">
        </form>
    </article>
</aside>