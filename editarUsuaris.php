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

    foreach ($usuariosArray as $usuarioInfo) {
        $usuarioData = explode(":", $usuarioInfo);

        echo "<li>";
        echo "Nombre de usuario: " . $usuarioData[0] . "<br>";
        echo "Correo electrónico: " . $usuarioData[2] . "<br>";
        echo "Nombre completo: " . $usuarioData[5] . "<br>";
        echo "</li>";
    }

    echo "</ul>";
    ?>

    <h2>Editar Usuario</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $nombre = $_POST["nombre"];
        $nombreC = $_POST["nombreC"];
        $IDusuari = $_POST["idusr"];
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

            if (!empty($IDusuari)) {
                $usuarioData[4] = $IDusuari;
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
        <label for="username">Nombre de usuario que quieres editar:</label>
        <input type="text" name="username" required>
        <br>

        <label for="password">Nueva contraseña (dejar en blanco para no cambiar):</label>
        <input type="password" name="password">
        <br>

        <label for="email">Nuevo correo electrónico (dejar en blanco para no cambiar):</label>
        <input type="email" name="email">
        <br>

        <label for="nombre">Nuevo nombre de usuario (dejar en blanco para no cambiar):</label>
        <input type="text" name="nombre">
        <br>

        <label for="nombreC">Nuevo nombre completo (dejar en blanco para no cambiar):</label>
        <input type="text" name="nombreC">
        <br>

        <label for="idusr">Nuevo ID (dejar en blanco para no cambiar):</label>
        <input type="text" name="idusr">
        <br>

        <label for="telf">Nuevo telefono (dejar en blanco para no cambiar):</label>
        <input type="text" name="telf">
        <br>
        
        <label for="visa">Nueva visa (dejar en blanco para no cambiar):</label>
        <input type="text" name="visa">
        <br>

        <label for="cp">Nuevo codigo postal (dejar en blanco para no cambiar):</label>
        <input type="text" name="cp">
        <br>

        <input type="submit" value="Editar Usuario">
    </form>
</body>
</html>
