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

    function fActualitzaUsuaris($nomUsuari,$ctsnya,$fullname, $mail, $telf, $visa, $cp, $id){
		$ctsnya_hash=password_hash($ctsnya,PASSWORD_DEFAULT);
		$gestorID = fContaEntrades(FITXER_GESTORS);
		$gestorID = rand(1, $gestorID);
		$dades_nou_usuari=$nomUsuari.":"."$id"."\n";
		if ($fp=fopen(FITXER_GESTORS,"a")) {
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
	}

    for($i = 0; $i<3; $i++){
        $ids = [101, 102, 103];
        $usrs = ["ga1", "ga2", "ga3"];
        $afegit=fActualitzaUsuaris($usrs[$i],null,null,null,null,null,null, $ids[$i]);
    }
    header("refresh: 1; url=registreGestor.php");
    
?>