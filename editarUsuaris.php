<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar y Mostrar Usuarios</title>
</head>
<body>
    <h2>Lista de Usuarios</h2>

    <?php
    $usuariosFile = "usuaris/usuaris";
    $usuariosContent = file_get_contents($usuariosFile);

    $usuariosArray = explode("\n", $usuariosContent);

    echo "<ul>";

    $totalUsuarios = count($usuariosArray);
    foreach ($usuariosArray as $key => $usuarioInfo) {
        if ($key >= $totalUsuarios - 1) {
            break;
        }
        $usuarioData = explode(":", $usuarioInfo);

        echo "<li>";
        echo "Nombre de usuario: " . $usuarioData[0] . "<br>";
        echo "Correo electrónico: " . $usuarioData[2] . "<br>";
        echo "Nombre completo: " . $usuarioData[5] . "<br>";
        echo "</li>";
    }

    echo "</ul>";
    ?>

    <h2>Editar Usuario (dejar campo en blanco para no cambiar)</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $nombre = $_POST["nombre"];
        $nombreC = $_POST["nombreC"];
        $telf = $_POST["telf"];
        $visa = $_POST["visa"];
        $cp = $_POST["cp"];
        $ges = $_POST["ges"];



        $usuariosFile = "usuaris/usuaris";
        $usuariosContent = file_get_contents($usuariosFile);

        $userToEdit = $username . ":";
        $pos = strpos($usuariosContent, $userToEdit);

        if ($pos !== false) {
            $usuarioData = explode(":", $usuariosArray[$pos]);

            if (!empty($password)) {
                $usuarioData[1] = password_hash($password, PASSWORD_DEFAULT);
            }

            if (!empty($email)) {
                $usuarioData[2] = $email;
            }

            if (!empty($nombre)) {
                $usuarioData[0] = $nombre;
            }

            if (!empty($nombreC)) {
                $usuarioData[5] = $nombreC;
            }

            if (!empty($telf)) {
                $usuarioData[6] = $telf;
            }

            if (!empty($visa)) {
                $usuarioData[7] = $visa;
            }

            if (!empty($cp)) {
                $usuarioData[8] = $cp;
            }
            
            if (!empty($ges)) {
                $usuarioData[9] = $ges;
            }

            $usuariosArray[$pos] = implode(":", $usuarioData);

            $usuariosContent = implode("\n", $usuariosArray);
            file_put_contents($usuariosFile, $usuariosContent);

            echo "<p>Usuario editado exitosamente.</p>";
        } else {
            echo "<p>Usuario no encontrado.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Nombre de usuario que quieres editar: </label>
        <input type="text" name="username" required>
        <br>

        <label for="password">Nueva contraseña:  </label>
        <input type="password" name="password">
        <br>

        <label for="email">Nuevo correo electrónico: </label>
        <input type="email" name="email">
        <br>

        <label for="nombre">Nuevo nombre de usuario: </label>
        <input type="text" name="nombre">
        <br>

        <label for="nombreC">Nuevo nombre completo: </label>
        <input type="text" name="nombreC">
        <br>

        <label for="telf">Nuevo telefono: </label>
        <input type="text" name="telf">
        <br>
        
        <label for="visa">Nueva visa: </label>
        <input type="text" name="visa">
        <br>

        <label for="cp">Nuevo codigo postal: </label>
        <input type="text" name="cp">
        <br>

        <input type="submit" value="Editar Usuario">
    </form>
    <br>
    <p><a href="login.php">Torna a la pàgina d'inici de sessió</a></p>
        <label class="diahora"> 
        <?php
            echo "<p>Usuari actual: ".$_SESSION['usuari']."</p>";
			date_default_timezone_set('Europe/Andorra');
			echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";
        ?>
        </label>
</body>
</html>
