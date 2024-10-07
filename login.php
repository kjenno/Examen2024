<?php
// Start sessie om gebruiker in te loggen
session_start();

// Database connectie details
$servername = "localhost";
$username = "root";
$password = "";
$database = "HyperLight";

// Maak een connectie met de database
$conn = new mysqli($servername, $username, $password, $database);

// Controleer connectie
if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}

// Verwerk het formulier als het is verzonden via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Controleer of het e-mailadres in de database staat
    $stmt = $conn->prepare("SELECT Uuid, Password FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Controleer of de gebruiker bestaat
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Controleer of het ingevoerde wachtwoord overeenkomt
        if (password_verify($password, $hashed_password)) {
            // Sla de gebruiker id op in de sessie
            $_SESSION['user_id'] = $id;
            header("Location: klant-pagina.php"); // Verwijs naar een beveiligde pagina
            exit();
        } else {
            $error_message = "Onjuist wachtwoord.";
        }
    } else {
        $error_message = "Geen account gevonden met dit e-mailadres.";
    }

    $stmt->close();
}

// Sluit de databaseconnectie
$conn->close();
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
                <!-- Het formulier stuurt gegevens naar deze zelfde pagina (login.php) -->
                <form class="form2" action="login.php" method="post">
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
                        <a href="./wachtwoord-vergeten.php" class="link">Wachtwoord vergeten?</a>
                    </div>
                </form>
                <!-- Toon eventuele foutmeldingen -->
                <?php
                if (!empty($error_message)) {
                    echo "<p style='color: red; text-align: center;'>$error_message</p>";
                }
                ?>
            </div>
            <div class="footer1"></div>
        </section>
    </div>
</body>
</html>

