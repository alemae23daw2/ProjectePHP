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
        session_start();

        $ruta_archivo = "items.txt";
        $archivo = fopen($ruta_archivo, "r");
        if ($archivo) {
            while (($linea = fgets($archivo)) !== false) {
                $datos = explode(":", $linea);
                echo "<div class='item'>";
                echo "<h2>$datos[0]</h2>";
                echo "<p>Disponibilidad: $datos[3]</p>";
                echo "<p>Precio: $datos[1]</p>";

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

        if (isset($_POST['agregarCarrito'])) {
            $producto = $_POST['producto'];
            $precio = $_POST['precio'];
            $disponibilidad = $_POST['disponibilidad'];
            $cantidad = $_POST['cantidad'];

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = array();
            }

            $indiceProducto = -1;
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
                if ($_SESSION['carrito'][$i]['producto'] === $producto) {
                    $indiceProducto = $i;
                    break;
                }
            }

            if ($indiceProducto !== -1) {
                $_SESSION['carrito'][$indiceProducto]['cantidad'] += $cantidad;
            } else {
                $item = array('producto' => $producto, 'precio' => $precio, 'disponibilidad' => $disponibilidad, 'cantidad' => $cantidad);
                array_push($_SESSION['carrito'], $item);
            }
        }
        ?>

    </div>
    <div id="borrarCesta">
        <form method="post">
            <button type="submit" name="vaciarCesta">Vaciar Cesta</button>
        </form>
    </div>

    <?php
    $nomUsuari = $_SESSION["usuari"];
    $rutaCistella = "{$nomUsuari}/cistella.txt";
    if (isset($_POST['vaciarCesta'])) {
        file_put_contents("$rutaCistella", "");
        unset($_SESSION['carrito']);
    }

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    $archivoCesta = fopen("$rutaCistella", "w");

    if ($archivoCesta) {
        foreach ($_SESSION['carrito'] as $item) {
            $linea = "{$item['producto']}:{$item['cantidad']}:{$item['precio']}\n";
            fwrite($archivoCesta, $linea);
        }

        fclose($archivoCesta);
    } else {
        echo "No se pudo abrir el archivo cistella.txt para escribir.";
    }
}

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    echo "<ul>";
    foreach ($_SESSION['carrito'] as $item) {
        echo "<li>{$item['producto']} - Cantidad: {$item['cantidad']} - Precio unitario: {$item['precio']}</li>";
    }
    echo "</ul>";
    echo "<form method='post'>";
    echo "</form>";
} else {
    echo "<p>El carrito está vacío.</p>";
}
?>
    <footer>
        <p>&copy; 2023 Piedras MilMan</p>
    </footer>

</body>
</html>
