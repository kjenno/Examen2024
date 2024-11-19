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
                <img class="color-dark13" loading="lazy" alt="Logo" src="./public/logo.png" id="colorDark">
                <nav class="column10">
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
                <!-- Het formulier stuurt gegevens naar B_login.php via POST -->
                <form class="form2" action="B_login.php" method="post">
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
                $Message = $_GET['message'] ?? null;
                if (!empty($Message)) {
                    echo "<p style='color: red; text-align: center;'>$Message</p>";
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>
