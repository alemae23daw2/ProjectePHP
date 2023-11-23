<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuari_real = "admin";  //credencials provisionals
    $contrasenya_real = "123";

    $usuari_introduit = $_POST["usuari"];
    $contrasenya_introduida = $_POST["contrasenya"];

    if ($usuari_introduit == $usuari_real && $contrasenya_introduida == $contrasenya_real) {
        header("Location: main.html");
        exit();
    } else {
        header("Location: login_error.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="usuari">Usuari:</label>
        <input type="text" id="usuari" name="usuari" required><br>

        <label for="contrasenya">Contrasenya:</label>
        <input type="password" id="contrasenya" name="contrasenya" required><br>

        <input type="submit" value="Iniciar sessió">
        <button type="button" onclick="location='index.php'">Inici</button>
    </form>
</body>
</html>