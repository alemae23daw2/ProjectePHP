<?php
    require_once 'vendor/autoload.php';
    use PHPMailer\PHPMailer;

    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');

    //Content
    $mail->isHTML(false);
    $mail->Subject = $assumpte;
    $mail->Body    = $contingut;

    $mail->send();
    echo 'Missatge enviat!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Contactar amb l'ADMIN</h1>
    <form action="contacteAdmin.php" method="POST">
        <select name="asumpte">
            <option value="" disabled selected hidden>Assumpte del Correu</option>
            <option value="Petició d'addició de client">Petició d'addició de client</option>
            <option value="Petició de modificació de client">Petició de modificació de client</option>
            <option value="Petició d'esborrament de client">Petició d'esborrament de client</option>
        </select><br><br>
        <textarea name="message" placeholder="Cos del missatge: " tabindex="5"></textarea><br><br>
        <button type="submit" name="send" id="contact-submit">Submit Now</button>
    </form>
    <button onclick="history.back()">Torna enrere</button>
</body>
</html>