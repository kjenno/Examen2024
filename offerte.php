<?php
include("mail.php");

// Form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
      $Voornaam = isset($_POST['voornaam']) ? htmlspecialchars(trim($_POST['voornaam'])) : '';
      $Achternaam = isset($_POST['achternaam']) ? htmlspecialchars(trim($_POST['achternaam'])) : '';
      $Email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
      $Telefoon = isset($_POST['telefoon']) ? htmlspecialchars(trim($_POST['telefoon'])) : '';
      $Bericht = isset($_POST['bericht']) ? htmlspecialchars(trim($_POST['bericht'])) : '';
  
    
    // Set email details
    $FileDestination = "";
    $ReceiverMail = "hyperlightandsoundtest123@gmail.com";  // Destination email
    $MSubject = "Nieuwe offerte aanvraag van $Voornaam $Achternaam";
    $MText = "Naam: $Voornaam $Achternaam\n" .
             "E-mail: $Email\n" .
             "Telefoonnummer: $Telefoon\n\n" .
             "Bericht:\n$Bericht";
    
    // Call MailSender to send the email and capture the feedback message
    $FeedbackMessage = MailSender($ReceiverMail, $MSubject, $MText, $FileDestination);
}
?>