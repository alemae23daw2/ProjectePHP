<h1><b>Pàgina web d'Alex Maench i Adria Milian</b></h1>

    <h2>Aquest lloc web:</h2>
    <label>a) Fa servir sessions d'usuari</label><br> 
    <label>b) Permet a un visitant crear una cistella amb un producte seleccionat</label><br>
    <label>c) Permet al visitant recuperar la cistella si tanca la sessió i la torna a obrir més tard</label><br>
    <label>f) Tanca sessions de manera correcta</label><br>
    <p>Per poder accedir a l'aplicació, és necessari tenir un compte d'usuari i una contrasenya d'accés</p>
    
    <h3>Tematica:</h3>
    <p>Es una botiga en la qual podras comprar diferents tipus de pedres o minerals desde el teu propi compte de usuari</p>

    <p><a href="index.php">Torna a la pàgina inicial</a></p>

    <label class="diahora"> 
    </label>
    <?php
        date_default_timezone_set('Europe/Madrid');
        echo "<p>Data i hora: " . date('d/m/Y h:i:s') . "</p>";
    ?>
</body>
</html>
