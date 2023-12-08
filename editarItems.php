<?php
define('ARCHIVO_ITEMS', 'items.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];
    $disponible = isset($_POST['disponible']) ? 'Si' : 'No';


    $lineaProducto = "$nombre:$precio:$descuento:$disponible\n";

    $archivo = fopen(ARCHIVO_ITEMS, 'a');

    if ($archivo) {
        fwrite($archivo, $lineaProducto);

        fclose($archivo);

        echo "Producto añadido correctamente.";
    } else {
        echo "Error al abrir el archivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Añadir Producto</title>
</head>
<body>
    <h2>Añadir Producto</h2>
    <form method="post" action="">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required><br>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" required><br>

        <label for="descuento">Descuento:</label>
        <input type="text" name="descuento" required><br>

        <label for="disponible">Disponible:</label>
        <input type="checkbox" name="disponible" checked><br>

        <input type="submit" value="Añadir Producto">
    </form>
</body>
</html>
