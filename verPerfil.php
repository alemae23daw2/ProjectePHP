<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    define('FITXER_ADMIN',"usuaris/admin");
    define('FITXER_USUARIS',"usuaris/usuaris");
    define('FITXER_GESTORS',"usuaris/gestors");
    define('TEMPS_EXPIRACIO', 900);
    define('ADMIN',"1");
	define('USR',"0");
    define('GESTOR',"2");

    session_start();

    $fitxers = [FITXER_ADMIN, FITXER_USUARIS, FITXER_GESTORS];

    function fLlegeixFitxer($nomFitxer){
        if ($fp = fopen($nomFitxer, "r")) {
            $midaFitxer = filesize($nomFitxer);
            $dades = explode(PHP_EOL, fread($fp, $midaFitxer));
            array_pop($dades);
            fclose($fp);
        }
        return $dades;
    }

    function fAutenticacio($nomUsuariComprova, $f){
        for($i = 0, $size = count($f); $i < $size; $i++){
            $usuaris = fLlegeixFitxer($f[$i]);
            foreach ($usuaris as $usuari) {
                $dadesUsuari = explode(":", $usuari);
                $nomUsuari = $dadesUsuari[0];
                if(($nomUsuari == $nomUsuariComprova)){
                    return $dadesUsuari;
                }
            }
        }
	}

    $infoUser = fAutenticacio($_SESSION['usuari'], $fitxers);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 2px solid black;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
<h3><b>El teu perfil</b></h3>
    <table>
            <tr>
                <?php
                    for ($i = 0; $i < count($infoUser)-1; $i++){
                        if($i == 1 || $i == 3) continue;
                        echo "<td>{$infoUser[$i]}</td>";
                    }
                ?>
            </tr>
    </table>
    <br>
    <button onclick="history.back()">Torna enrere</button>
    <label class="diahora">
        <?php
			echo "<p>Usuari actual: ".$_SESSION['usuari']."</p>";
			date_default_timezone_set('Europe/Andorra');
			echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";	
        ?>
    </label>
</body>
</html>