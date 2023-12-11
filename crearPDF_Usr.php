<?php
    session_start();
    
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