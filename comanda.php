<?php
session_start();

$nomUsuari = $_SESSION["usuari"];
$rutaCistella = "{$nomUsuari}/cistella";
$rutaComanda = "{$nomUsuari}/comanda";
$cistellaContenido = file_get_contents($rutaCistella);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    file_put_contents($rutaComanda, $cistellaContenido, FILE_APPEND);
    file_put_contents($rutaCistella, '');
    $cistellaContenido = ''; 
    echo '<p>¡Compra realizada con éxito!</p>';
}

echo '<h2>Productos en la cesta:</h2>';
echo '<pre>' . $cistellaContenido . '</pre>';

$comandaContenido = file_get_contents($rutaComanda);
echo '<h2>Productos en la comanda:</h2>';
echo '<pre>' . $comandaContenido . '</pre>';
?>

<h1>Tienda Online</h1>

<form method="post" action="">
    <input type="submit" name="comprar" value="Comprar">
</form>
<a href="menuUsuari.php">Torna al menu</a>