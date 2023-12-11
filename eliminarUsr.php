<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>

    <?php
    $usuarios = file('usuaris/usuaris', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($usuarios) {
        echo '<ul>';
        foreach ($usuarios as $usuario) {
            echo '<li>' . $usuario . ' <a href="eliminar.php?usuario=' . urlencode($usuario) . '">Eliminar</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No hay usuarios registrados.</p>';
    }
    ?>
    <button onclick="history.back()">Torna enrere</button>

</body>
</html>

