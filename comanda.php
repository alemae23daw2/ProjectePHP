<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
</head>
<body>

<?php
$cistellaContenido = file_get_contents('cistella.txt');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    file_put_contents('comanda.txt', $cistellaContenido, FILE_APPEND);
    file_put_contents('cistella.txt', '');
    $cistellaContenido = ''; 
    echo '<p>¡Compra realizada con éxito!</p>';
}
?>

<h1>Tienda Online</h1>

<h2>Productos en la cesta:</h2>
<pre><?php echo $cistellaContenido; ?></pre>

<form method="post" action="">
    <input type="submit" name="comprar" value="Comprar">
</form>

</body>
</html>
