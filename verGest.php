<?php
    define('FITXER_GESTORS', "usuaris/gestors");

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
</body>
</html>
