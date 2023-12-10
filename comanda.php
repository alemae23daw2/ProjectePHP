<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
</head>
<body>

<?php
// Función para leer el contenido de cistella.txt
function leerCistella() {
    $archivo = 'cistella.txt';
    if (file_exists($archivo)) {
        return file_get_contents($archivo);
    } else {
        return '';
    }
}

// Función para añadir un producto a comanda.txt y eliminarlo de cistella.txt
function comprarProducto($producto) {
    $cistella = leerCistella();
    $comanda = 'comanda.txt';

    // Añadir producto a comanda.txt
    file_put_contents($comanda, $producto . PHP_EOL, FILE_APPEND);

    // Eliminar producto de cistella.txt
    $cistella = str_replace($producto . PHP_EOL, '', $cistella);
    file_put_contents('cistella.txt', $cistella);
}
?>

<h1>Tienda Online</h1>

<h2>Cistella</h2>
<pre><?php echo leerCistella(); ?></pre>

<form method="post" action="">
    <input type="submit" name="comprar" value="Comprar">
</form>

<?php
// Procesar la compra cuando se hace clic en el botón
if (isset($_POST['comprar'])) {
    // Obtener el contenido actual de cistella.txt
    $cistella = leerCistella();

    // Comprobar si la cistella no está vacía antes de realizar la compra
    if (!empty($cistella)) {
        // Dividir la cistella en líneas (cada línea es un producto)
        $productos = explode(PHP_EOL, $cistella);

        // Comprar el primer producto de la cistella
        foreach ($productos as $producto) {
            comprarProducto($producto);
        // Redirigir para actualizar la página y mostrar los cambios
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

</body>
</html>
