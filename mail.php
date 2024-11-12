<?php
// Load Composer's autoloader
require 'vendor/autoload.php'; 

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function MailSender($ReceiverMail,$MSubject,$MText,$FileDestination)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'hyperlightandsoundtest123@gmail.com';  // SMTP username (your Gmail)
    $mail->Password   = 'txnb gxkt bkje zagu';                    // SMTP password (Use Gmail app-specific password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to (TLS)

    //Recipients
    $mail->setFrom('hyperlightandsoundtest123@gmail.com', 'HyperLightandSound');  // Set your email
    $mail->addAddress($ReceiverMail);                           // Add a recipient

    if($MText != "")
    {
        $mail->Body    = $MText;
    }
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $MSubject;
    if($FileDestination != "")
    {
        $mail->addAttachment($FileDestination);
    }
   

    $mail->send();
    echo 'Message has been sent';
}

?>