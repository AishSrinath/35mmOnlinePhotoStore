<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
function sendmail ($cxname,$cxemail,$subject,$body) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = '35mm2018@gmail.com';   //username
    $mail->Password = 'nXLif!{t-$AR4"*q';   //password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;                    //SMTP port
    $mail->setFrom('noreply@35mm.com', '35mm.com');
    $mail->addAddress($cxemail, $cxname);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
       // echo 'Message has been sent';
    }
}
?>