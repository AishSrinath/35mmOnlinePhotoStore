<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
$mail->SMTPAuth = true;
$mail->Username = '35mm2018@gmail.com';   //username
$mail->Password = 'bVQke"(s-$CA4"*x';   //password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;                    //SMTP port

$mail->setFrom('noreply@35mm.com', '35mm.com');
$mail->addAddress('aiswarya.g2008@gmail.com', 'Aiswarya G');

$mail->isHTML(true);

$mail->Subject = 'TEST FROM 35mm.com';
$mail->Body    = 'TEST FROM 35mm.com';

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>