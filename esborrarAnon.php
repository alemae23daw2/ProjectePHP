<?php
function eliminarCarpeta($carpeta){
        if (is_dir($carpeta)) {
            $archivos = glob($carpeta . '/*');
            foreach ($archivos as $archivo) {
                if (is_dir($archivo)) {
                    eliminarCarpeta($archivo);
                } else {
                    unlink($archivo);
                }
            }
            rmdir($carpeta);
        }
    }

for($i = 0; $i < 3; $i++){
    $usrs = ["ga1", "ga2", "ga3"];

    $nombreArchivo = 'usuaris/gestors';

    $lineas = file($nombreArchivo);
    
    $archivo = fopen($nombreArchivo, 'w');
    
    foreach ($lineas as $linea) {
        if (strpos($linea, $usrs[$i]) === false) {
            fwrite($archivo, $linea);
        }
    }
    fclose($archivo);

    eliminarCarpeta($usrs[$i]);
    
}

header("refresh: 1; url=registreGestor.php");

?>
