<?php
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function mailto($to,$subject,$message){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'ssl://smtp.titan.email';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'admin@pinecapitalnetwork.com';                     //SMTP username
        $mail->Password   = '@zwiD6?uTef5Brs';                               //SMTP password
        $mail->SMTPSecure = 'SSL';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('admin@pinecapitalnetwork.com', 'pinecapitalnetwork');
        $mail->addAddress($to);               //Name is optional
        $mail->addReplyTo('admin@pinecapitalnetwork.com', 'pinecapitalnetwork');
      
    
      
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = 'Non html body';
    
        $mail->send();
    } catch (Exception $e) {
        // echo "Email could not be sent. Mailer Error: </br> </br>{$mail->ErrorInfo}";
    }

}









?>