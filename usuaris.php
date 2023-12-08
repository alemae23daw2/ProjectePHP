<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    
</head>
<body>

<?php
require 'dompdf-master/autoload.inc.php';

$ruta_archivo = "usuarios.txt";
$archivo = fopen($ruta_archivo, "r");

if ($archivo) {
    echo "<table border='1'>";
    while (($linea = fgets($archivo)) !== false) {
        $dato = explode(":", $linea);

        echo "<tr>";
        echo "<td><b>ID:</b> $dato[0]</td>";
        echo "<td><b>Nom:</b> $dato[1]</td>";
        echo "<td><b>Passwd:</b> $dato[2]</td>";
        echo "<td><b>NomComplet:</b> $dato[4]</td>";
        echo "<td><b>Correu:</b> $dato[5]</td>";
        echo "<td><b>Telf:</b> $dato[6]</td>";
        echo "<td><b>CP:</b> $dato[7]</td>";
        echo "<td><b>Visa:</b> $dato[8]</td>";
        echo "<td><b>IDGestor:</b> $dato[9]</td>";
        echo "</tr>";
    }
    echo "</table>";
    fclose($archivo);

    echo "<form action='exportar_pdf.php' method='post'>";
    echo "<input type='submit' value='Exportar a PDF'>";
    echo "</form>";
}

?>

</body>
</html>
