<?php
	define('FITXER_USUARIS',"usuaris/usuaris");
	define('USR',"0");
	define('FITXER_GESTORS',"usuaris/gestors");

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

    function fContaEntrades($f){
		$conta = 0;
		$usuaris = fLlegeixFitxer($f);
        foreach ($usuaris as $usuari) {
            $conta += 1;
        }
		return $conta;
	}

    function fActualitzaUsuaris($nomUsuari,$ctsnya,$fullname, $mail, $telf, $visa, $cp){
		$idUsr = fContaEntrades(FITXER_USUARIS) + 1;
		$ctsnya_hash=password_hash($ctsnya,PASSWORD_DEFAULT);
		$gestorID = fContaEntrades(FITXER_GESTORS);
		$gestorID = rand(1, $gestorID);
		$dades_nou_usuari=$nomUsuari.":".$ctsnya_hash.":".$mail.":"."0".":"."U-$idUsr".":"."$fullname".":"."$telf".":"."$visa".":"."$cp".":"."G-$gestorID".":"."\n";
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
		$carpeta_comandes = "comandes/{$nomUsuari}";
		$carpeta_cistelles = "cistelles/{$nomUsuari}";
		if (!file_exists($carpeta_comandes)) {
            mkdir($carpeta_comandes, 0777, true);
        }
		if (!file_exists($carpeta_cistelles)) {
            mkdir($carpeta_cistelles, 0777, true);
		}
		return $afegit;
	}

	if ((isset($_POST['nom_nou_usuari'])) && (isset($_POST['cts_nou_usuari'])) && (isset($_POST['fullname_nou_usuari'])) && (isset($_POST['mail_nou_usuari'])) && (isset($_POST['telf_nou_usuari'])) && (isset($_POST['visa_nou_usuari'])) && (isset($_POST['cp_nou_usuari']))){		
		$afegit=fActualitzaUsuaris($_POST['nom_nou_usuari'],$_POST['cts_nou_usuari'],$_POST['fullname_nou_usuari'],$_POST['mail_nou_usuari'],$_POST['telf_nou_usuari'],$_POST['visa_nou_usuari'],$_POST['cp_nou_usuari']);
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
		<h3><b>Registre de clients de la botiga</b></h3>
		<p><b>Indica les dades de l'usuari a registrar dins de l'aplicació: </b></p>			
		<form action="registreUsuari.php" method="POST">
			<p>
				<label>Nom del nou usuari:</label> 
				<input type="text" name="nom_nou_usuari" required>
			</p>
			<p>
				<label>Contrasenya del nou usuari:</label> 
				<input type="password" name="cts_nou_usuari" required>
			</p>
            <p>
				<label>Nom Complet del nou usuari:</label> 
				<input type="text" name="fullname_nou_usuari" required>
			</p>
			<p>
				<label>Correu del nou usuari:</label> 
				<input type="text" name="mail_nou_usuari" required>
			</p>
			<p>
				<label>Telefon del nou usuari:</label> 
				<input type="text" name="telf_nou_usuari" required>
			</p>
			<p>
				<label>Numero de Visa del nou usuari:</label> 
				<input type="text" name="visa_nou_usuari" required>
			</p>
			<p>
				<label>Codi postal del nou usuari:</label> 
				<input type="text" name="cp_nou_usuari" required>
			</p>
			<input type="submit" value="Enregistra el nou usuari"/>
		</form>
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

