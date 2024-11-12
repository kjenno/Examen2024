<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="./global.css">
    <link rel="stylesheet" href="./registreren.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap">
    <title>Registreren</title>
</head>
<body>
<div class="registreren">
    <main class="main1">
        <header class="content35">
            <div class="content36">
                <a href="./index.php">
                    <img class="color-dark6" loading="lazy" alt="Logo" src="./public/color--dark.svg">
                </a>
                <nav class="column6">
                    <a href="./over-ons.php" class="link-text12">Over Ons</a>
                    <a href="./diensten.php" class="link-text13">Diensten</a>
                    <a href="./projecten.php" class="link-text14">Projecten</a>
                    <a href="./planning.php" class="nav-link-dropdown3">Planning</a>
                </nav>
            </div>
            <button class="stylesecondary-smalltrue-a3">
                <a href="./login.php" class="button7">Inloggen</a>
            </button>
        </header>

        <section class="sign-up-1">
            <div class="navbar">
                <div class="container5">
                    <div class="column7">
                        <img class="color-dark7" loading="lazy" alt="Logo" src="./public/color--dark.svg">
                    </div>
                    <div class="content37">
                        <div class="already-have-an">Heb je al een account?</div>
                        <a href="./login.php" class="log-in">Log In</a>
                    </div>
                </div>
            </div>

            <div class="content38">
                <div class="section-title4">
                    <h1 class="heading19">Meld je aan</h1>
                    <div class="bsb-networks">
                        Vul je gegevens hieronder in om een account te maken.
                    </div>
                </div>

                <!-- Registratieformulier -->
                <form class="form1" action="B_registreren.php" method="post">
                    <div class="input5">
                        <label for="name" class="name">Naam*</label>
                        <input id="name" class="typedefault-alternatefalse4" type="text" name="name" required>
                    </div>
                    <div class="input5">
                        <label for="email" class="name">Email*</label>
                        <input id="email" class="typedefault-alternatefalse4" type="email" name="email" required>
                    </div>
                    <div class="input5">
                        <label for="password" class="name">Wachtwoord*</label>
                        <input id="password" class="typedefault-alternatefalse4" type="password" name="password" required>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="styleprimary-smallfalse-al1">
                            <div class="button8">Meld je aan</div>
                        </button>
                    </div>
                </form>

                <!-- Meldingen -->
                <?php
                $Message = $_GET['message'] ?? null;
                if (!empty($Message)) {
                    echo "<p style='color: red; text-align: center;'>$Message</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer class="footer-73">
        <div class="content39">
            <div class="logo3">
                <a href="./index.php">
                    <img class="color-dark8" loading="lazy" alt="Logo" src="./public/color--dark.svg">
                </a>
            </div>
            <div class="links3">
                <a href="./over-ons.php" class="link-one3">Over ons</a>
                <a href="./diensten.php" class="link-one3">Diensten</a>
                <a href="./projecten.php" class="link-one3">Projecten</a>
                <a href="./contact.php" class="link-four3">Contact</a>
                <a href="./blog.php" class="link-one3">Blog</a>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
