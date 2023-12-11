<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar y Mostrar Administradores</title>
</head>
<body>
    <h2>Lista de Administradores</h2>

    <?php
    $adminFile = "usuaris/admin";
    $adminContent = file_get_contents($adminFile);

    $adminArray = explode(":", $adminContent);

    echo "<ul>";
    echo "<li>";
    echo "Nombre de usuario: " . $adminArray[0] . "<br>";
    echo "Correo electrónico: " . $adminArray[2] . "<br>";
    echo "Nombre completo: " . $adminArray[4] . "<br>";
    echo "</li>";
    echo "</ul>";
    ?>

    <h2>Editar Administrador (dejar campo en blanco para no cambiar)</h2>

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

        $adminFile = "usuaris/admin";
        $adminContent = file_get_contents($adminFile);
        $adminArray = explode(":", $adminContent);

        if (!empty($password)) {
            $adminArray[1] = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!empty($email)) {
            $adminArray[2] = $email;
        }

        if (!empty($nombre)) {
            $adminArray[0] = $nombre;
        }

        if (!empty($nombreC)) {
            $adminArray[4] = $nombreC;
        }

        if (!empty($telf)) {
            $adminArray[5] = $telf;
        }
        $adminContent = implode(":", $adminArray);
        file_put_contents($adminFile, $adminContent);

        echo "<p>Administrador editado exitosamente.</p>";
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

    <input type="submit" value="Editar Administrador">
</form>

    <br>
    <button onclick="history.back()">Torna enrere</button>
    <label class="diahora"> 
        <?php
            echo "<p>Usuari actual: ".$_SESSION['usuari']."</p>";
            date_default_timezone_set('Europe/Andorra');
            echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";
        ?>
    </label>
</body>
</html>
