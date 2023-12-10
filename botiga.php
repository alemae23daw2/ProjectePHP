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
        ?>

    </div>

    <div id="carrito">
        <h2>Cesta de Compra</h2>
        <?php
        if (isset($_SESSION['usuari'])) {
            $claveUsuario = $_SESSION['usuari'];

            $cesta = isset($_SESSION['cesta'][$claveUsuario]) ? $_SESSION['cesta'][$claveUsuario] : array();

            if (isset($_POST['agregarCarrito'])) {
                $producto = $_POST['producto'];
                $precio = $_POST['precio'];
                $cantidad = $_POST['cantidad'];

                if (array_key_exists($producto, $cesta)) {
                    $cesta[$producto]['cantidad'] += $cantidad;
                } else {
                    $cesta[$producto] = array('precio' => $precio, 'cantidad' => $cantidad);
                }

                $_SESSION['cesta'][$claveUsuario] = $cesta;

                $archivoCesta = fopen("cistella_$claveUsuario.txt", "w");
                foreach ($cesta as $producto => $detalle) {
                    fwrite($archivoCesta, "$producto:{$detalle['cantidad']}\n");
                }
                fclose($archivoCesta);
            }

            if (!empty($cesta)) {
                echo "<ul>";
                foreach ($cesta as $producto => $detalle) {
                    echo "<li>$producto - Cantidad: {$detalle['cantidad']}</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>La cesta está vacía.</p>";
            }
        } else {
            echo "<p>Por favor, inicia sesión para ver tu cesta.</p>";
        }
        ?>
    </div>

    <div id="borrarCesta">
        <?php
        if (isset($_SESSION['usuari']) && isset($_POST['borrarCesta'])) {
            $claveUsuario = $_SESSION['usuari'];
            unset($_SESSION['cesta'][$claveUsuario]);

            file_put_contents("cistella_$claveUsuario.txt", "");
            echo "<p>Cesta borrada</p>";
        }
        ?>

        <?php
        if (isset($_SESSION['usuari'])) {
            echo "<form method='post'>";
            echo "<button type='submit' name='borrarCesta'>Borrar Cesta</button>";
            echo "</form>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2023 Piedras MilMan</p>
    </footer>

</body>
</html>