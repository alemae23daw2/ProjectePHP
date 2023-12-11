
<?php

if (isset($_GET['usuario'])) {
    $usuarioAEliminar = $_GET['usuario'];

    $usuarios = file('usuaris/usuaris', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $usuarios = array_diff($usuarios, [$usuarioAEliminar]);

    file_put_contents('usuaris/usuaris', implode(PHP_EOL, $usuarios));

    header('Location: index.php');
    exit;
}
?>