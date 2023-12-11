<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Item</title>
</head>
<body>
    <h2>Añadir Item</h2>

    <?php
    function agregarItem($nombre, $precio, $descuento, $disponible) {
        $nuevaLinea = "$nombre:$precio:$descuento:$disponible\n";

        $archivo = fopen("items.txt", "a");

        fwrite($archivo, $nuevaLinea);

        fclose($archivo);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descuento = $_POST["descuento"];
        $disponible = isset($_POST["disponible"]) ? "Sí" : "No";

        if (!empty($nombre) && !empty($precio) && !empty($descuento)) {
            agregarItem($nombre, $precio, $descuento, $disponible);
            echo "<p>Item agregado correctamente.</p>";
        } else {
            echo "<p>Todos los campos son obligatorios.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre del Item:</label>
        <input type="text" name="nombre" required><br>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" required><br>

        <label for="descuento">IVA (%):</label>
        <input type="text" name="descuento" required><br>

        <label for="disponible">Disponible:</label>
        <input type="checkbox" name="disponible"><br>

        <input type="submit" value="Agregar Item">
    </form>
    <button onclick="history.back()">Torna enrere</button>
</body>
</html>
