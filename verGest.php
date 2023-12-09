<?php
    define('FITXER_GESTORS', "usuaris/gestors");
    session_start();
    function fLlegeixFitxer($nomFitxer)
    {
        if ($fp = fopen($nomFitxer, "r")) {
            $midaFitxer = filesize($nomFitxer);
            $dades = explode(PHP_EOL, fread($fp, $midaFitxer));
            array_pop($dades);
            fclose($fp);
        }
        return $dades;
    }

    $gestors = fLlegeixFitxer(FITXER_GESTORS);

    define('FITXER_ADMIN',"usuaris/admin");
	define('ADMIN',"1");

	function fComprovaPermis(){
		$info = fLlegeixFitxer(FITXER_ADMIN);
		foreach ($info as $usuari) {
			$dadesUsuari = explode(":", $usuari);
			if($dadesUsuari[0] != $_SESSION['usuari']) continue;
			if($dadesUsuari[0] == $_SESSION['usuari']){
				return $dadesUsuari[3];
			}
		}
		return 26;
	}
	
	if(fComprovaPermis() != ADMIN){
		header("Location: auth_error.php");
	}
	
	if (!isset($_SESSION['usuari'])){
		header("Location: login_error.php");
	}
	if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
		header("Location: logout_expira_sessio.php");
	}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Llista d'Gestors</title>
    <style>

        table {
            border: 5px solid black;
            border-spacing: 10px 5px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .pdf{
            background-color: red;
            color: white;
        }
        button{
            color: black;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h3><b>Llista d'Usuaris</b></h3>
    <table>
        <tr>
            <th>ID Gestor</th>
            <th>Usuari</th>
            <th>Nom Complet</th>
            <th>Correu</th>
            <th>Telèfon</th>
        </tr>
        <?php foreach ($gestors as $gestor) : ?>
            <?php $detallsGestor = explode(":", $gestor); ?>
            <tr>
                <td><?= $detallsGestor[4] ?></td>
                <td><?= $detallsGestor[0] ?></td>
                <td><?= $detallsGestor[5] ?></td>
                <td><?= $detallsGestor[2] ?></td>
                <td><?= $detallsGestor[6] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="login.php"><button>Torna al menú</button></a>
    <a href="crearPDF_Gest.php"><button class="pdf">Descarrega en PDF</button></a>
</body>
</html>
