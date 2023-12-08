<?php
        define('FITXER_ADMIN',"usuaris/admin");
        define('ADMIN',"1");
    
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

        function fActualitzaDades($nomUsuari,$ctsnya,$tipus){
            $dades = fLlegeixFitxer(FITXER_ADMIN);
            foreach($dades as $dada){
                
            }
            $ctsnya_hash=password_hash($ctsnya,PASSWORD_DEFAULT);
            $dades_nou_usuari=$nomUsuari.":".$ctsnya_hash.":".$tipus."\n";
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
        
        if(fComprovaPermis() != ADMIN){
            header("Location: auth_error.php");
        }
        
        if (!isset($_SESSION['usuari'])){
            header("Location: login_error.php");
        }
        if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
            header("Location: logout_expira_sessio.php");
        }

        if ((isset($_POST['nom_nou_usuari'])) && (isset($_POST['cts_nou_usuari'])) && (isset($_POST['fullname_nou_usuari'])) && (isset($_POST['mail_nou_usuari'])) && (isset($_POST['telf_nou_usuari']))){		
            $afegit=fActualitzaDades($_POST['nom_nou_usuari'],$_POST['cts_nou_usuari'],$_POST['fullname_nou_usuari'],$_POST['mail_nou_usuari'],$_POST['telf_nou_usuari']);
            $_SESSION['afegit']=$afegit;
            echo "L'usuari ha sigut afegit";
            header("refresh: 2; url=login.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3><b>Canvi de dades de l'ADMIN</b></h3>
		<p><b>Indica les dades de l'usuari a registrar dins de l'aplicació: </b></p>			
		<form action="canviarDadesAdmin.php" method="POST">
            <input type="hidden" name="_method" value="PUT"> <!-- Para enviar un put -->
			<p>
				<label>Canviar nom d'usuari de l'ADMIN:</label> 
				<input type="text" name="nom_nou_usuari" required>
			</p>
			<p>
				<label>Canviar contrasenya de l'ADMIN:</label> 
				<input type="password" name="cts_nou_usuari" required>
			</p>
            <p>
				<label>Canviar Nom Complet del nou Gestor:</label> 
				<input type="text" name="fullname_nou_usuari" required>
			</p>
			<p>
				<label>Canviar Correu del nou Gestor:</label> 
				<input type="text" name="mail_nou_usuari" required>
			</p>
			<p>
				<label>Canviar Telefon del nou Gestor:</label> 
				<input type="text" name="telf_nou_usuari" required>
			</p>
			<input type="submit" value="Enregistra el nou usuari"/>
		</form>
		<a href="login.php"><button>Torna al menú</button></a>
</body>
</html>