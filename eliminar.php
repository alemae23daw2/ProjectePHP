
<?php

if (isset($_GET['usuario'])) {
    $usuarioAEliminar = $_GET['usuario'];

    $usuarios = file('usuaris/usuaris', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $usuarios = array_diff($usuarios, [$usuarioAEliminar]);

    $content = implode(PHP_EOL, $usuarios) . PHP_EOL;

    file_put_contents('usuaris/usuaris', $content);

    $folderToDelete = $usuarioAEliminar;
    $folderPath = DIR . '/' . $folderToDelete;

    if (is_dir($folderPath)) {
        deleteDirectory($folderPath);
    }

    header('Location: menuAdmin.php');
    exit;
}
?>