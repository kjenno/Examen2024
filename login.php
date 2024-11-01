<?php

include("DatabaseConnection.php");

// Verwerk het formulier als het is verzonden via GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'], $_GET['password'])) {
    $Email = trim($_GET['email']);
    $Password = trim($_GET['password']);

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
            } 
            elseif ($Admin == 1) {
                header("Location: admin-right-pagina.php?id=$Id");
            }
            
            exit();
        } else {
            $ErrorMessage = "Onjuist wachtwoord.";
        }
    } else {
        $ErrorMessage = "Geen account gevonden met dit e-mailadres.";
    }

    $Stmt->close();
}

// Sluit de databaseconnectie
$Conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="./global.css">
    <link rel="stylesheet" href="./login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap">
    <title>Inloggen</title>
</head>
<body>
    <div class="login">
        <header class="content49">
            <div class="content50">
                <img class="color-dark13" loading="lazy" alt="Logo" src="./public/color--dark.svg" id="colorDark">
                <nav class="column10">
                    <a href="./over-ons.php" class="link-text25" id="linkText1">Over Ons</a>
                    <a href="./diensten.php" class="link-text26" id="linkText2">Diensten</a>
                    <a href="./projecten.php" class="link-text26" id="linkText3">Projecten</a>
                    <a href="./planning.php" class="link-text26" id="linkText4">Planning</a>
                </nav>
            </div>
            <button class="stylesecondary-smalltrue-a6">
                <div class="button12">Inloggen</div>
            </button>
        </header>
        <section class="login-1">
            <div class="content52">
                <div class="section-title7">
                    <h1 class="log-in1">Inloggen</h1>
                    <div class="login-description">
                        Voer je gegevens hieronder in om in te loggen.
                    </div>
                </div>
                <!-- Het formulier stuurt gegevens naar deze zelfde pagina (login.php) via GET -->
                <form class="form2" action="login.php" method="get">
                    <div class="input8">
                        <label for="email" class="email2">Email*</label>
                        <input id="email" class="typedefault-alternatefalse7" type="email" name="email" required>
                    </div>
                    <div class="input8">
                        <label for="password" class="email2">Wachtwoord*</label>
                        <input id="password" class="typedefault-alternatefalse7" type="password" name="password" required>
                    </div>
                    <div class="container7">
                        <div class="buttons1" id="buttonsContainer">
                            <button class="styleprimary-smallfalse-al2" type="submit">
                                <div class="button13">Inloggen</div>
                            </button>
                        </div>
                        <a href="./registreren.php" class="link">Geen Account?</a>
                        <a href="./wachtwoord-vergeten.php" class="link">Wachtwoord vergeten?</a>
                    </div>
                </form>
                <!-- Toon eventuele foutmeldingen -->
                <?php
                if (!empty($ErrorMessage)) {
                    echo "<p style='color: red; text-align: center;'>$ErrorMessage</p>";
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>
