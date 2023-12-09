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

    require_once 'vendor/autoload.php';
    use Dompdf\Dompdf;

    ob_start();
    require_once("verUsuaris.php");
    $dompdf = new DOMPDF();
    $html = ob_get_clean();
    $dompdf->load_html($html);

    $dompdf->set_paper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream();
?>