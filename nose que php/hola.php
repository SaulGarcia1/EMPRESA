<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Configuración del correo
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Configura tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'sauulgarcia20@gmail.com; // Tu usuario SMTP
        $mail->Password = 'tu_contraseña'; // Tu contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinatarios
        $mail->setFrom($email, $name);
        $mail->addAddress('tu_correo@example.com'); // Añadir tu dirección de correo

        // Contenido del correo
        $mail->isHTML(false); // Establecer el formato del correo a texto plano
        $mail->Subject = "Nuevo mensaje de $name";
        $mail->Body    = "Nombre: $name\nCorreo Electrónico: $email\nTeléfono: $phone\n\nMensaje:\n$message";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "error: {$mail->ErrorInfo}";
    }
} else {
    echo "invalid";
}
?>
