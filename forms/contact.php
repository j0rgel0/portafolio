<?php
require '../assets/vendor/PHPMailer/src/Exception.php';
require '../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../assets/vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$phpmailer = new PHPMailer();
try {
  //Server settings
  $phpmailer->isSMTP();
  $phpmailer->Mailer = "smtp";
  $phpmailer->Host = "mail.smtp2go.com";
  $phpmailer->Port = "2525"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
  $phpmailer->SMTPAuth = true;
  $phpmailer->SMTPSecure = 'tls';
  $phpmailer->Username = "jorge.lopezvz";
  $phpmailer->Password = "tfuzzarGgeNXhCsY";

  //Recipients
  $phpmailer->setFrom('jorge.lopezvz@gmail.com', 'Jorge');
  $phpmailer->addAddress($_POST['email'], $_POST['name']);     //Add a recipient
  $phpmailer->addCC('jorge.lopezvz@gmail.com');
  $phpmailer->addBCC('jorge.lopezvz@udlap.mx');

  $phpmailer->CharSet = 'UTF-8';

  //Content
  $phpmailer->isHTML(true);
  $phpmailer->Subject = 'Página Portafolio';
  $phpmailer->Body = "<strong>Nombre:</strong> " . $_POST['name'] . "<br><strong>Correo:</strong> " . $_POST['email'] . "<br><strong>Asunto:</strong> " . $_POST['subject'] . "<br><strong>Mensaje:</strong> " . $_POST['message'];
  $phpmailer->AltBody = $_POST['message'];

  $phpmailer->send();
  echo "¡Mensaje enviado!";
  header("Location: ../enviado.html");
  exit();

} catch (Exception $e) {
  echo "Error al mandar el mensaje {$phpmailer->ErrorInfo}";
}
