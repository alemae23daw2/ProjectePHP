<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$ruta_archivo = "usuarios.txt";
$archivo = fopen($ruta_archivo, "r");

if ($archivo) {
    // Inicializar el buffer de salida
    ob_start();

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

    // Crear un objeto Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // Contenido HTML de la tabla
    $html = ob_get_clean();

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // Tamaño del papel y orientación (opcional)
    $dompdf->setPaper('A4', 'landscape');

    // Renderizar el PDF (primero se carga el HTML, luego se renderiza)
    $dompdf->render();

    // Nombre del archivo PDF generado
    $nombre_archivo = 'usuarios.pdf';

    // Enviar el PDF al navegador para descargar
    $dompdf->stream($nombre_archivo, array('Attachment' => 0));
}
?>
