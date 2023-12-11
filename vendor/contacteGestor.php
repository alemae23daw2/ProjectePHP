<!DOCTYPE html>
<html lang="en">
</head>
<body>
    <form method="post">
        <h2>Formulari de Contacte</h2>
        <label for="email">Correu Electrònic:</label><br>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="assumpte">Assumpte:</label><br>
        <input type="text" id="assumpte" name="assumpte" required>
        <br><br>
        <label for="missatge">Missatge:</label><br>
        <textarea id="missatge" name="missatge" required></textarea>
        <br><br>
        <button type="submit" name="enviarCorreu">Enviar Correu</button>
    </form>

    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/phpmailer/src/Exception.php';
    require 'phpmailer/phpmailer/src/PHPMailer.php';
    require 'phpmailer/phpmailer/src/SMTP.php';

    if (isset($_POST["enviarCorreu"])) {
        $correu = new PHPMailer(true);

        try {
            $correu->isSMTP();
            $correu->Host = 'smtp.gmail.com';
            $correu->SMTPAuth = true;
            $correu->Username = 'moalex006@gmail.com';
            $correu->Password = 'iqgtehyxgetznlia';
            $correu->SMTPSecure = 'tls';
            $correu->Port = 587;
            $correu->setFrom('moalex006@gmail.com');
            $correu->addAddress($_POST["email"]);

            $correu->isHTML(true);
            $correu->Subject = $_POST["assumpte"];
            $correu->Body = $_POST["missatge"];

            $correu->send();
            header("refresh: 2; url=../menuUsuari.php");
        } catch (Exception $ex) {
            echo "Error en enviar el correu: {$correu->ErrorInfo}";
        }
    }
    ?>
</body>
</html>