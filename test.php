<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);




//sending mail to user when register
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "testingtrmcic@gmail.com";
$mail->Password   = "ocphwwhfisxkjjjs";

//Recipients
$mail->setFrom('sweethouse@example.com', 'Sweethouse');
$mail->addAddress('aleksandar.trmcic@gmail.com', "aca");     //Add a recipient
//                $mail->addAddress('ellen@example.com');               //Name is optional
$mail->addReplyTo('testingtrmcic@gmail.com', 'Aleksandar');
//                $mail->addCC('cc@example.com');
//                $mail->addBCC('bcc@example.com');

//                //Attachments
//                $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Successful registration!';
$mail->Body    = "hey how are you";
$mail->AltBody = 'Thank you for registering on our store!';

$mail->send();
echo 'Message has been sent';
?>
