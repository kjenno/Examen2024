<?php
include("DatabaseConnection.php");

// Verwerk het formulier als het is verzonden via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['password'])) {
    $Email = trim($_POST['email']);
    $Password = trim($_POST['password']);

    // Controleer of het e-mailadres in de database staat
    $Stmt = $Conn->prepare("SELECT Uuid, Admin, Password FROM user WHERE Email = ?");
    $Stmt->bind_param("s", $Email);
    $Stmt->execute();
    $Stmt->store_result();

    // Controleer of de gebruiker bestaat
    if ($Stmt->num_rows > 0) {
        $Stmt->bind_result($Id, $Admin, $HashedPassword);
        $Stmt->fetch();

        // Controleer of het ingevoerde wachtwoord overeenkomt
        if (password_verify($Password, $HashedPassword)) {
            session_start();
            $_SESSION['id'] = $Id;
            $_SESSION['loggedin'] = true;
            if ($Admin == 2) {
                header("Location: klant-pagina.php?id=$Id");
            } elseif ($Admin == 1) {
                header("Location: admin-right-pagina.php?id=$Id");
            }
            exit();
        } else {
            $Message = "Onjuist wachtwoord.";
            header("Location: login.php?message=" . urlencode($Message));
        }
    } else {
        $Message = "Geen account gevonden met dit e-mailadres.";
        header("Location: login.php?message=" . urlencode($Message));
    }

    $Stmt->close();
}

// Sluit de databaseconnectie
$Conn->close();
?>
