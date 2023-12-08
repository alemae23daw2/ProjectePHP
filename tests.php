<?php

    function fActualitzaDades(){
        //$ctsnya_hash=password_hash($ctsnya,PASSWORD_DEFAULT);
        $dades_nou_usuari="elcoño de ru madre"."\n";
        if ($fp=fopen("test","a")) {
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

    $si = fActualitzaDades();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>hola</p>
</body>
</html>