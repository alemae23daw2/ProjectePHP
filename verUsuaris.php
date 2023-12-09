<?php
    define('FITXER_USUARIS', "usuaris/usuaris");

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

    $usuaris = fLlegeixFitxer(FITXER_USUARIS);
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <title>Llista d'Usuaris</title>
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
            <th>ID Usuari</th>
            <th>Usuari</th>
            <th>Nom Complet</th>
            <th>Correu</th>
            <th>Telèfon</th>
            <th>Visa</th>
            <th>Codi Postal</th>
            <th>Gestor</th>
        </tr>
        <?php foreach ($usuaris as $usuari) : ?>
            <?php $detallsUsuari = explode(":", $usuari); ?>
            <tr>
                <td><?= $detallsUsuari[4] ?></td>
                <td><?= $detallsUsuari[0] ?></td>
                <td><?= $detallsUsuari[5] ?></td>
                <td><?= $detallsUsuari[2] ?></td>
                <td><?= $detallsUsuari[6] ?></td>
                <td><?= $detallsUsuari[7] ?></td>
                <td><?= $detallsUsuari[8] ?></td>
                <td><?= $detallsUsuari[9] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="login.php"><button>Torna al menú</button></a>
    <a href="crearPDF_Usr.php"><button class="pdf">Descarrega en PDF</button></a>
</body>
</html>
