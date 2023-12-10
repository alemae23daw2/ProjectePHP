<?php
	define('FITXER_GESTORS',"usuaris/gestors");
	define('GESTOR',"2");

	session_start();
	function fLlegeixFitxer($nomFitxer){
		if ($fp=fopen($nomFitxer,"r")) {
			$midaFitxer=filesize($nomFitxer);
			$dades = explode(PHP_EOL, fread($fp,$midaFitxer));
			array_pop($dades);			
			fclose($fp);
		}
		return $dades;
	}

	function fComprovaPermis(){
		$info = fLlegeixFitxer(FITXER_GESTORS);
		foreach ($info as $usuari) {
			$dadesUsuari = explode(":", $usuari);
			if($dadesUsuari[0] != $_SESSION['usuari']) continue;
			if($dadesUsuari[0] == $_SESSION['usuari']){
				return $dadesUsuari[3];
			}
		}
		return 26;
	}
	
	if(fComprovaPermis() != GESTOR){
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
		<title>Visualitzador d'ADMIN</title>
	</head>
	<body>
		<h3><b>Menú del visualitzador d'ADMIN</b></h3>
        <a href="personal.php">Canviar credencials d'ADMIN</a><br>
        <a href="professional.php">Agenda professional</a><br>
        <a href="serveis.php">Agenda de serveis</a><br>
        <p><a href="verUsuaris.php">Registre de nous usuaris</a></p>
		<p><a href="afegirProductes.php">Afegir productes</a></p>
        <p><a href="logout.php">Finalitza la sessió</a></p>
        <label class="diahora"> 
        <?php
			echo "<p>Usuari utilitzant l'agenda: ".$_SESSION['usuari']."</p>";
			date_default_timezone_set('Europe/Andorra');
			echo "<p>Data i hora: ".date('d/m/Y h:i:s')."</p>";	
        ?>
        </label>		
	</body>
</html>
