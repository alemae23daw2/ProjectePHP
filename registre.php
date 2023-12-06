<?php
	define('FITXER_USUARIS',"usuaris/usuaris");
	define('USR',"0");

	session_start();

    function fActualitzaUsuaris($nomUsuari,$ctsnya,$mail){
		$ctsnya_hash=password_hash($ctsnya,PASSWORD_DEFAULT);
		$dades_nou_usuari=$nomUsuari.":".$ctsnya_hash.":".$mail.":"."0".":"."\n";
		if ($fp=fopen(FITXER_USUARIS,"a")) {
			if (fwrite($fp,$dades_nou_usuari)){
				$afegit=true;
			}
			else{
				$afegit=false;
			}				
			fclose($fp);
		}
		else{
			$afegit=false;
		}
		return $afegit;
	}

	if ((isset($_POST['nom_nou_usuari'])) && (isset($_POST['cts_nou_usuari'])) && (isset($_POST['mail_nou_usuari']))){		
		$afegit=fActualitzaUsuaris($_POST['nom_nou_usuari'],$_POST['cts_nou_usuari'],$_POST['mail_nou_usuari']);
		$_SESSION['afegit']=$afegit;
        echo "L'usuari ha sigut afegit";
		header("refresh: 2; url=login.php");
	}			
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<title>Registre</title>
	</head>
	<body>
		<h3><b>Registre d'usuaris del visualitzador de l'agenda</b></h3>
		<p><b>Indica les dades de l'usuari a registrar dins de l'aplicació: </b></p>			
		<form action="registre.php" method="POST">
			<p>
				<label>Nom del nou usuari:</label> 
				<input type="text" name="nom_nou_usuari" required>
			</p>
			<p>
				<label>Contrasenya del nou usuari:</label> 
				<input type="password" name="cts_nou_usuari" required>
			</p>
            <p>
				<label>Correu del nou usuari:</label> 
				<input type="text" name="mail_nou_usuari" required>
			</p>
			<input type="submit" value="Enregistra el nou usuari"/>
		</form>
		<a href="login.php"><button>Torna al menú</button></a>
	</body>
</html>

