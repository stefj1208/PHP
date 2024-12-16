<?php
use PHPMailer\PHPMailer\PHPMailer; // On importe la classe tout en haut
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // On charge l'autoloader de composer
$mail = new PHPMailer(true); // Instantiation
// Paramètres du serveur
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
// Informations envoyeur/réceptionneur
$mail->Username = 'testadrar6@gmail.com';
$mail->Password = 'genx bgzh qwca nzmk';
$mail->From = 'testadrar6@gmail.com';
$mail->FromName = 'Test';
$mail->addAddress('stephan.jaune@gmail.com');
// Contenu
$mail->isHTML(true); // Permet l'interprétation de l'HTML dans le mail
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->Subject = '{voilà}';
$body = '{<p>This is a test message</p>}';
$mail->Body = $body;
try {
    $mail->send();
} catch(Exception $e) {
    echo "Erreur: ". $e->getMessage();
}
exit;