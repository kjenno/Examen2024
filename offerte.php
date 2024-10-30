<?php
// Load Composer's autoloader
require 'vendor/autoload.php'; 

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Define the MailSender function
function MailSender($ReceiverMail, $MSubject, $MText, $fileDestination = "")
{
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hyperlightandsoundtest123@gmail.com'; // Your Gmail address
        $mail->Password   = 'txnb gxkt bkje zagu';                  // App-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Recipients
        $mail->setFrom('hyperlightandsoundtest123@gmail.com', 'HyperLightandSound');
        $mail->addAddress($ReceiverMail);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $MSubject;
        $mail->Body    = nl2br($MText);  // Convert new lines to HTML line breaks
        
        // Optional attachment
        if ($fileDestination != "") {
            $mail->addAttachment($fileDestination);
        }
        
        $mail->send();
        return 'Uw offerte-aanvraag is succesvol verzonden!'; // Return success message
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}"); // Log the error
        return "Er is een fout opgetreden bij het verzenden van uw aanvraag. Probeer het opnieuw.";
    }
}

// Initialize a variable for feedback messages
$feedbackMessage = "";

// Form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
      $voornaam = isset($_POST['voornaam']) ? htmlspecialchars(trim($_POST['voornaam'])) : '';
      $achternaam = isset($_POST['achternaam']) ? htmlspecialchars(trim($_POST['achternaam'])) : '';
      $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
      $telefoon = isset($_POST['telefoon']) ? htmlspecialchars(trim($_POST['telefoon'])) : '';
      $bericht = isset($_POST['bericht']) ? htmlspecialchars(trim($_POST['bericht'])) : '';
  
    
    // Set email details
    $ReceiverMail = "504655@vistacollege.nl";  // Destination email
    $MSubject = "Nieuwe offerte aanvraag van $voornaam $achternaam";
    $MText = "Naam: $voornaam $achternaam\n" .
             "E-mail: $email\n" .
             "Telefoonnummer: $telefoon\n\n" .
             "Bericht:\n$bericht";
    
    // Call MailSender to send the email and capture the feedback message
    $feedbackMessage = MailSender($ReceiverMail, $MSubject, $MText);
}
?>