<?php
session_start(); // Start een nieuwe of bestaande sessie om gebruikersgegevens tijdelijk op te slaan.

// Voeg bestanden toe voor de mailfunctionaliteit en databaseverbinding.
include("mail.php");
include("DatabaseConnection.php");

// Controleer of het formulier is ingediend via een POST-verzoek.
if (isset($_POST['submit'])) {
    // Haal de actie op die bepaalt welke taak uitgevoerd moet worden.
    $Action = $_POST['action'];
    
    // Controleer of de actie 'request_code' is om een wachtwoordherstelcode te genereren en te versturen.
    if ($Action == 'request_code') {
        // Haal het ingevoerde e-mailadres op uit de POST-gegevens.
        $Email = $_POST['email'];
        
        // Stel het onderwerp en de inhoud van de e-mail in.
        $MSubject = "Wachtwoord Vergeten";
        
        // Genereer een willekeurige 6-cijferige code en sla deze op in de sessie.
        $_SESSION['code'] = mt_rand(100000, 999999);
        $_SESSION['email'] = $Email;

        // Stel de inhoud van de e-mail in als de gegenereerde code.
        $MText = $_SESSION['code'];
        
        // Verzend de e-mail met de herstelcode (zonder bijlage in dit geval).
        $File = "";
        MailSender($Email, $MSubject, $MText, $File);

        // Stuur de gebruiker door naar de pagina waar ze een nieuw wachtwoord kunnen instellen.
        header("Location: wachtwoord-instellen.php");

    } elseif ($Action == 'reset_password') {
        // Verwerk de reset-wachtwoordactie.
        $Code = $_POST['code']; // Haal de ingevoerde code op.
        $Password = $_POST['password']; // Haal het nieuwe wachtwoord op.
        $PasswordConfirm = $_POST['password_confirm']; // Haal de bevestiging van het wachtwoord op.

        // Controleer of de ingevoerde code overeenkomt met de gegenereerde code in de sessie.
        if ($Code == $_SESSION['code']) {
            // Controleer of de twee wachtwoorden hetzelfde zijn.
            if ($Password == $PasswordConfirm) {
                // Hash het wachtwoord voor veilige opslag.
                $Password = password_hash($Password, PASSWORD_DEFAULT);

                // Haal het e-mailadres op dat in de sessie is opgeslagen.
                $Email = $_SESSION['email'];

                // Bereid een SQL-statement voor om het wachtwoord in de database bij te werken.
                $Stmt = $Conn->prepare("UPDATE user SET Password = ? WHERE email = ?");
                $Stmt->bind_param("ss", $Password, $Email); // Bind de wachtwoord-hash en het e-mailadres als strings.

                // Voer de query uit en sluit de statement en verbinding.
                $Stmt->execute();
                $Stmt->close();
                $Conn->close();

                // Verwijder alle gegevens uit de sessie en stuur de gebruiker naar de inlogpagina.
                session_unset();
                header("Location: login.php");
            } else {
                // Foutmelding: wachtwoorden komen niet overeen.
                $Message = "Wachtwoorden komen niet overeen.";
                header("Location: wachtwoord-instellen.php?message=" . urlencode($Message));
            }
        } else {
            // Foutmelding: de ingevoerde code is onjuist.
            $Message = "Code onjuist.";
            header("Location: wachtwoord-instellen.php?message=" . urlencode($Message));
        }
    }
}
?>

