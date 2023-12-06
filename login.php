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

    $fitxers = [FITXER_ADMIN, FITXER_USUARIS, FITXER_GESTORS];

    function fLlegeixFitxer($nomFitxer){
        if ($fp=fopen($nomFitxer,"r")) {
            $midaFitxer=filesize($nomFitxer);
            $dades = explode(PHP_EOL, fread($fp,$midaFitxer));
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
                $ctsUsuari = $dadesUsuari[1];
                $tipusUsuari = $dadesUsuari[3];
                if(($nomUsuari == $nomUsuariComprova) && (password_verify($_POST['contrasenya'],$ctsUsuari))){
                    $autenticat=true;
                    return [$autenticat, $tipusUsuari];
                }
                else $autenticat=false;
            }
            
        }
		return [$autenticat, $tipusUsuari];
	}

    if ((isset($_POST['usuari'])) && (isset($_POST['contrasenya']))){
		[$autenticat, $tipusUsuari] = fAutenticacio($_POST['usuari'], $fitxers);
		if($autenticat){
			session_start();
			$_SESSION['usuari'] = $_POST['usuari'];
			$_SESSION['expira'] = time() + TEMPS_EXPIRACIO;
            if($tipusUsuari == ADMIN){
                header("Location: menuAdmin.php");
            }else if($tipusUsuari == GESTOR){
                header("Location: menuGestor.php");
            }else if($tipusUsuari == USR){
                header("Location: menuUsuari.php");
            }
		}else{
            header("Location: login_error.php");
        }				
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="usuari">Usuari:</label>
        <input type="text" id="usuari" name="usuari" required><br>

        <label for="contrasenya">Contrasenya:</label>
        <input type="password" id="contrasenya" name="contrasenya" required><br>

        <input type="submit" value="Iniciar sessió"><br><br>
        <a href="registre.php"><button type="button">Registre</button></a>
        <a href="index.php"><button type="button">Inici</button></a>
    </form>
</body>
</html>