<?php
    define('FITXER_USUARIS',"usuaris/usuaris");
    define('USR',"0");

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
        $info = fLlegeixFitxer(FITXER_USUARIS);
        foreach ($info as $usuari) {
            $dadesUsuari = explode(":", $usuari);
            if($dadesUsuari[0] != $_SESSION['usuari']) continue;
            if($dadesUsuari[0] == $_SESSION['usuari']){
                return $dadesUsuari[3];
            }
        }
        return 26;
    }
    
    if(fComprovaPermis() != USR){
        header("Location: auth_error.php");
    }
    
    if (!isset($_SESSION['usuari'])){
        header("Location: login_error.php");
    }
    if (!isset($_SESSION['expira']) || (time() - $_SESSION['expira'] >= 0)){
        header("Location: logout_expira_sessio.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 1em;
            text-align: center;
        }

        .div1 {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            column-gap: 150px;
        }

        .item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
            padding: 20px;
            width: 200px;
            text-align: center;
        }

        #carrito {
            margin-top: 20px;
            padding: 10px;
            background-color: #ddd;
        }

        #borrarCesta {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <header>
        <h1>Tienda Online</h1>
    </header>

    <div class="div1">

        <?php
        session_start(); // Inicia la sesión

        $ruta_archivo = "items.txt";
        $archivo = fopen($ruta_archivo, "r");

        if ($archivo) {
            while (($linea = fgets($archivo)) !== false) {
                $datos = explode(":", $linea);

                echo "<div class='item'>";
                echo "<h2>$datos[0]</h2>";
                echo "<p>Disponibilidad: $datos[3]</p>";
                echo "<p>Precio: $datos[1]</p>";

                // Verifica la disponibilidad antes de mostrar el formulario
                if (trim($datos[3]) !== 'No') {
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='producto' value='$datos[0]'>";
                    echo "<input type='hidden' name='precio' value='$datos[1]'>";
                    echo "<input type='hidden' name='disponibilidad' value='$datos[3]'>";
                    echo "<label for='cantidad'>Cantidad:</label>";
                    echo "<input type='number' name='cantidad' value='1' min='1'>";
                    echo "<button type='submit' name='agregarCarrito'>Añadir al carrito</button>";
                    echo "</form>";
                } else {
                    echo "<p>Producto no disponible</p>";
                }

                echo "</div>";
            }

            fclose($archivo);
        } else {
            echo "No se pudo abrir el archivo.";
        }

        // Agregar al carrito
        if (isset($_POST['agregarCarrito'])) {
            $producto = $_POST['producto'];
            $precio = $_POST['precio'];
            $disponibilidad = $_POST['disponibilidad'];
            $cantidad = $_POST['cantidad'];

            // Verifica si el carrito ya existe en la sesión
            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = array();
            }

        // Verifica la disponibilidad antes de añadir al carrito
            $indiceProducto = -1;
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
                if ($_SESSION['carrito'][$i]['producto'] === $producto) {
                    $indiceProducto = $i;
                    break;
                }
            }

            // Si el producto está en el carrito, actualiza la cantidad
            if ($indiceProducto !== -1) {
                $_SESSION['carrito'][$indiceProducto]['cantidad'] += $cantidad;
            } else {
                // Si el producto no está en el carrito, lo agrega
                $item = array('producto' => $producto, 'precio' => $precio, 'disponibilidad' => $disponibilidad, 'cantidad' => $cantidad);
                array_push($_SESSION['carrito'], $item);
            }
        
        }
        ?>

    </div>

    <div id="carrito">
        <h2>Carrito de la compra</h2>
        <?php
        // Muestra los productos en el carrito
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
            foreach ($_SESSION['carrito'] as $item) {
                echo "<p>{$item['producto']} - Precio: {$item['precio']} - Cantidad: {$item['cantidad']} - Disponibilidad: {$item['disponibilidad']}</p>";
            }
        } else {
            echo "<p>El carrito está vacío.</p>";
        }
        ?>
    </div>

    <div id="borrarCesta">
        <form method="post">
            <button type="submit" name="borrarCesta">Borrar la Cesta</button>
        </form>
        <?php
        // Borrar la cesta
        if (isset($_POST['borrarCesta'])) {
            unset($_SESSION['carrito']);
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2023 Piedras MilMan</p>
    </footer>

</body>
</html>
