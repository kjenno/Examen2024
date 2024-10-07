<?php
// Start sessie om gebruiker in te loggen
session_start();

// Database connectie details
$servername = "localhost";
$username = "root";
$password = "";
$database = "klanten_db";

// Maak een connectie met de database
$conn = new mysqli($servername, $username, $password, $database);

// Controleer connectie
if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}

// Verwerk het formulier als het is verzonden via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Controleer of het e-mailadres in de database staat
    $stmt = $conn->prepare("SELECT id, wachtwoord FROM klanten WHERE email = ?");
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
            header("Location: dashboard.php"); // Verwijs naar een beveiligde pagina
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
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./login.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
</head>
<body>
    <div class="login">
        <header class="content49">
            <div class="content50">
                <img class="color-dark13" loading="lazy" alt="" src="./public/color--dark.svg" id="colorDark" />
                <nav class="column10">
                    <div class="dont-have-an">Over Ons</div>
                    <div class="link-text25" id="linkText1">Diensten</div>
                    <div class="link-text26" id="linkText2">Projecten</div>
                    <div class="nav-link-dropdown6" id="navLinkDropdown">
                        <div class="dont-have-an">Planning</div>
                    </div>
                </nav>
            </div>
            <button class="stylesecondary-smalltrue-a6">
                <div class="button12">Inloggen</div>
            </button>
        </header>
        <section class="login-1">
            <div class="navbar1">
                <div class="container6">
                    <div class="column11"></div>
                    <div class="content51" id="contentContainer">
                        <div class="dont-have-an">Don't have an account?</div>
                        <div class="sign-up">Heb je nog geen account? Meld je aan</div>
                    </div>
                </div>
            </div>
            <div class="content52">
                <div class="section-title7">
                    <h1 class="log-in1">Inloggen</h1>
                    <div class="login-description">
                        Voer je gegevens hieronder in om in te loggen
                    </div>
                </div>
                <!-- Het formulier stuurt gegevens naar deze zelfde pagina (login.php) -->
                <form class="form2" action="login.php" method="post">
                    <div class="input8">
                        <div class="email2">Email*</div>
                        <input class="typedefault-alternatefalse7" type="text" name="email" required />
                    </div>
                    <div class="input8">
                        <div class="email2">Wachtwoord*</div>
                        <input class="typedefault-alternatefalse7" type="password" name="password" required />
                    </div>
                    <div class="container7">
                        <div class="buttons1" id="buttonsContainer">
                            <button class="styleprimary-smallfalse-al2" type="submit">
                                <div class="button13">Inloggen</div>
                            </button>
                            <button class="stylesecondary-smallfalse1">
                                <img class="icon-google1" alt="" src="./public/icon--google.svg" />
                                <div class="button14">Inloggen met Google</div>
                            </button>
                        </div>
                        <div class="link">Wachtwoord vergeten?</div>
                    </div>
                </form>
                <?php
                // Toon eventuele foutmeldingen
                if (!empty($error_message)) {
                    echo "<p style='color: red;'>$error_message</p>";
                }
                ?>
            </div>
            <div class="footer1"></div>
        </section>
        <section class="layout-246-wrapper">
            <div class="layout-246">
                <div class="section-title8">
                    <div class="column12">
                        <h1 class="heading33">Eenvoudig facturen ontvangen en beheren</h1>
                    </div>
                    <div class="column13">
                        <div class="text-suspendisse-varius">
                            Met ons inlogsysteem kun je facturen ontvangen en eenvoudig beheren. Geen gedoe meer met papieren facturen. Alles wordt digitaal geregeld, zodat jij je kunt focussen op je opdrachten.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer-76">
            <div class="content53">
                <div class="logo6">
                    <img class="color-dark14" loading="lazy" alt="" src="./public/color--dark.svg" />
                </div>
                <div class="links6">
                    <div class="link-one6">Over ons</div>
                    <div class="link-one6">Diensten</div>
                    <div class="link-one6">Projecten</div>
                    <div class="link-four6">Contact</div>
                    <div class="link-one6">Blog</div>
                </div>
            </div>
        </section>
    </div>
    <script>
        // JavaScript code blijft ongewijzigd
    </script>
</body>
</html>
