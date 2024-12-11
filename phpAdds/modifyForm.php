
<?php
    if ( isset($_SESSION['userSession']) ) {
        $userID = $_SESSION['userSession'];
        
    } elseif ( isset($_COOKIE['rememberedUser']) ) {
        $userID = $_COOKIE['rememberedUser'];
    }

    if ( isset($userID) ) {
        $query =
            "SELECT 
                U.IdUsuario,
                U.NomUsuario,
                U.Clave,
                U.Email,
                U.Sexo,
                U.FNacimiento,
                U.Ciudad,
                P.Nombre AS Pais,
                U.Foto,
                U.FRegistro,
                E.Nombre AS Estilo
            FROM 
                Usuarios U
            JOIN 
                Paises P ON U.Pais = P.IdPais
            LEFT JOIN 
                Estilos E ON U.Estilo = E.IdEstilo
            WHERE 
                U.IdUsuario = ?";
        
        $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
        $sentence = $connection->prepare($query);
        $sentence->bind_param("i", $userID);
        $sentence->execute();
        $result = $sentence->get_result();
        $user = $result->fetch_assoc();

        $connection->close();
        $sentence->close();

        $queryPaises = "SELECT IdPais, Nombre FROM Paises";
        $connectionPaises = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
        $sentencePaises = $connectionPaises->prepare($queryPaises);
        $sentencePaises->execute();
        $resultPaises = $sentencePaises->get_result();
        $paises = $resultPaises->fetch_all(MYSQLI_ASSOC);

        $connectionPaises->close();
        $sentencePaises->close();
    
    }
?> 


<form action="../private/modifyResponse.php" method="POST">
    <section class="inputGroup">
        <label for="email">Email</label>
        <input value="<?php echo isset($user['Email']) ? $user['Email'] : '' ?>" name="email" placeholder="usu@email.com" id="email">
    </section>
    <section class="inputGroup">
        <label for="user">Nombre de usuario</label>
        <input value="<?php echo isset($user['NomUsuario']) ? $user['NomUsuario'] : '' ?>" name="user" placeholder="nombreUsuario" id="user">
    </section>
    <section class="inputGroup">
        <label for="pass">Contraseña</label>
        <input type="password" name="pass" placeholder="contrasenyaMuySegura" id="passInput">
    </section>
    <section class="inputGroup">
        <label for="pass2">Repetir contraseña</label>
        <input type="password" name="pass2" placeholder="contrasenyaMuySegura" id="pass2">
    </section>
    <section class="inputGroup">
        <label for="sex">Sexo</label>
        <select name="sex" id="sex">
            <option selected value="hombre">Hombre</option>
            <option value="mujer">Mujer</option>
        </select>
    </section>
    <section class="inputGroup">
        <label for="birthdate">Fecha de nacimiento</label>
        <input type="date" name="birthdate" id="birth">
    </section>
    <section class="inputGroup">
        <label for="city">Ciudad</label>
        <input value="<?php echo isset($user['Ciudad']) ? $user['Ciudad'] : '' ?>"  name="city" placeholder="Sant Vicent del Raspeig">
    </section>
    <section class="inputGroup">
        <label for="country">País de residencia</label>
        <select name="country" id="country">
            <option selected>Selecciona tu país</option>
            <?php foreach ($paises as $pais): ?>
                <option value="<?= $pais['IdPais']?>"><?= htmlspecialchars($pais['Nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </section>
    <section class="inputGroup">
        <label for="pfp">Foto de perfil</label>
        <input name="pfp">
    </section>
    <button class="greenButton" id="submitLoginButton">Confirmar</button>
</form>