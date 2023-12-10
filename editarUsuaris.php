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
    // Mostrar la lista de usuarios
    $usuariosFile = "usuaris/usuaris";
    $usuariosContent = file_get_contents($usuariosFile);

    // Dividir la cadena en líneas
    $usuariosArray = explode("\n", $usuariosContent);

    echo "<ul>";

    foreach ($usuariosArray as $usuarioInfo) {
        // Dividir la información del usuario en campos
        $usuarioData = explode(":", $usuarioInfo);

        // Mostrar cada campo en un elemento de lista
        echo "<li>";
        echo "Nombre de usuario: " . $usuarioData[0] . "<br>";
        echo "Correo electrónico: " . $usuarioData[2] . "<br>";
        echo "Nombre completo: " . $usuarioData[5] . "<br>";
        // Agrega más campos según tus necesidades
        echo "</li>";
    }

    echo "</ul>";
    ?>

    <h2>Editar Usuario</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los valores del formulario
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        // Leer el archivo de usuarios
        $usuariosFile = "usuaris/usuaris";
        $usuariosContent = file_get_contents($usuariosFile);

        // Buscar el usuario en el archivo
        $userToEdit = $username . ":";
        $pos = strpos($usuariosContent, $userToEdit);

        if ($pos !== false) {
            // Usuario encontrado, extraer la información del usuario
            $usuarioData = explode(":", $usuariosArray[$pos]);

            // Realizar la edición
            if (!empty($password)) {
                // Cambiar la contraseña (implementa tu lógica)
                $usuarioData[1] = password_hash($password, PASSWORD_DEFAULT);
            }

            if (!empty($email)) {
                // Cambiar el correo electrónico (implementa tu lógica)
                $usuarioData[2] = $email;
            }

            // Actualizar la línea en la que se encuentra el usuario en el array
            $usuariosArray[$pos] = implode(":", $usuarioData);

            // Actualizar el contenido del archivo
            $usuariosContent = implode("\n", $usuariosArray);
            file_put_contents($usuariosFile, $usuariosContent);

            echo "<p>Usuario editado exitosamente.</p>";
        } else {
            echo "<p>Usuario no encontrado.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" required>
        <br>

        <label for="password">Nueva contraseña (dejar en blanco para no cambiar):</label>
        <input type="password" name="password">
        <br>

        <label for="email">Nuevo correo electrónico (dejar en blanco para no cambiar):</label>
        <input type="email" name="email">
        <br>

        <!-- Agrega más campos según tus necesidades -->

        <input type="submit" value="Editar Usuario">
    </form>
</body>
</html>
