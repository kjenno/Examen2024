<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./registreren.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap"
    />
  </head>
  <body>
    <div class="registreren">
      <main class="main1">
        <header class="content35">
          <div class="content36">
            <img
              class="color-dark6"
              loading="lazy"
              alt=""
              src="./public/color--dark.svg"
              id="colorDark"
            />

            <nav class="column6">
              <div class="link-text12">Over Ons</div>
              <div class="link-text13" id="linkText1">Diensten</div>
              <div class="link-text14" id="linkText2">Projecten</div>
              <div class="nav-link-dropdown3" id="navLinkDropdown">
                <div class="link-text12">planning</div>
              </div>
            </nav>
          </div>
          <button
            class="stylesecondary-smalltrue-a3"
            id="styleSecondarySmallTrueA"
          >
            <div class="button7">inloggen</div>
          </button>
        </header>
        <section class="sign-up-1">
          <div class="navbar">
            <div class="container5">
              <div class="column7">
                <img
                  class="color-dark7"
                  loading="lazy"
                  alt=""
                  src="./public/color--dark.svg"
                />
              </div>
              <div class="content37" id="contentContainer">
                <div class="already-have-an">Already have an account?</div>
                <div class="log-in">Log In</div>
              </div>
            </div>
          </div>
          <div class="content38">
            <div class="section-title4">
              <h1 class="heading19">Sign Up</h1>
              <div class="bsb-networks">
                Lorem ipsum dolor sit amet adipiscing elit.
              </div>
            </div>
            <form class="form1">
              <div class="input5">
                <div class="name">Name*</div>
                <input class="typedefault-alternatefalse4" type="text" />
              </div>
              <div class="input5">
                <div class="name">Email*</div>
                <input class="typedefault-alternatefalse4" type="text" />
              </div>
              <div class="input5">
                <div class="name">Password*</div>
                <input class="typedefault-alternatefalse4" type="text" />
              </div>
              <div class="buttons">
                <div
                  class="styleprimary-smallfalse-al1"
                  id="stylePrimarySmallFalseAl"
                >
                  <div class="button8">Sign up</div>
                </div>
                <button class="stylesecondary-smallfalse">
                  <img
                    class="icon-google"
                    alt=""
                    src="./public/icon--google.svg"
                  />

                  <div class="button8">Sign up with Google</div>
                </button>
              </div>
            </form>
          </div>
          <div class="footer"></div>
        </section>
      </main>
      <footer class="footer-73">
        <div class="content39">
          <div class="logo3">
            <img
              class="color-dark8"
              loading="lazy"
              alt=""
              src="./public/color--dark.svg"
            />
          </div>
          <div class="links3">
            <div class="link-one3">Over ons</div>
            <div class="link-one3">Diensten</div>
            <div class="link-one3">Projecten</div>
            <div class="link-four3">Contact</div>
            <div class="link-one3">Blog</div>
          </div>
        </div>
      </footer>
    </div>

    <script>
      var colorDark = document.getElementById("colorDark");
      if (colorDark) {
        colorDark.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }
      
      var linkText1 = document.getElementById("linkText1");
      if (linkText1) {
        linkText1.addEventListener("click", function (e) {
          window.location.href = "./diensten.html";
        });
      }
      
      var linkText2 = document.getElementById("linkText2");
      if (linkText2) {
        linkText2.addEventListener("click", function (e) {
          window.location.href = "./projecten.html";
        });
      }
      
      var navLinkDropdown = document.getElementById("navLinkDropdown");
      if (navLinkDropdown) {
        navLinkDropdown.addEventListener("click", function (e) {
          window.location.href = "./planning.html";
        });
      }
      
      var styleSecondarySmallTrueA = document.getElementById(
        "styleSecondarySmallTrueA"
      );
      if (styleSecondarySmallTrueA) {
        styleSecondarySmallTrueA.addEventListener("click", function (e) {
          window.location.href = "./login.html";
        });
      }
      
      var contentContainer = document.getElementById("contentContainer");
      if (contentContainer) {
        contentContainer.addEventListener("click", function (e) {
          window.location.href = "./login.html";
        });
      }
      
      var stylePrimarySmallFalseAl = document.getElementById(
        "stylePrimarySmallFalseAl"
      );
      if (stylePrimarySmallFalseAl) {
        stylePrimarySmallFalseAl.addEventListener("click", function (e) {
          window.location.href = "./admin-right-pagina.html";
        });
      }
      </script>
  </body>
</html> -->



<!-- <!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./registreren.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap"
    />
    <title>Registreren</title>
  </head>
  <body>
    <div class="registreren">
      <main class="main1">
        <header class="content35">
          <div class="content36">
            <a href="./index.html">
              <img
                class="color-dark6"
                loading="lazy"
                alt="Logo"
                src="./public/color--dark.svg"
              />
            </a>

            <nav class="column6">
              <a href="./over-ons.html" class="link-text12">Over Ons</a>
              <a href="./diensten.html" class="link-text13">Diensten</a>
              <a href="./projecten.html" class="link-text14">Projecten</a>
              <a href="./planning.html" class="nav-link-dropdown3">Planning</a>
            </nav>
          </div>
          <button class="stylesecondary-smalltrue-a3">
            <a href="./login.html" class="button7">Inloggen</a>
          </button>
        </header>

        <section class="sign-up-1">
          <div class="navbar">
            <div class="container5">
              <div class="column7">
                <img
                  class="color-dark7"
                  loading="lazy"
                  alt="Logo"
                  src="./public/color--dark.svg"
                />
              </div>
              <div class="content37">
                <div class="already-have-an">Heb je al een account?</div>
                <a href="./login.html" class="log-in">Log In</a>
              </div>
            </div>
          </div>

          <div class="content38">
            <div class="section-title4">
              <h1 class="heading19">Meld je aan</h1>
              <div class="bsb-networks">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              </div>
            </div>

            <form class="form1" action="./admin-right-pagina.html" method="post">
              <div class="input5">
                <label for="name" class="name">Naam*</label>
                <input id="name" class="typedefault-alternatefalse4" type="text" name="name" required />
              </div>
              <div class="input5">
                <label for="email" class="name">Email*</label>
                <input id="email" class="typedefault-alternatefalse4" type="email" name="email" required />
              </div>
              <div class="input5">
                <label for="password" class="name">Wachtwoord*</label>
                <input id="password" class="typedefault-alternatefalse4" type="password" name="password" required />
              </div>

              <div class="buttons">
                <button type="submit" class="styleprimary-smallfalse-al1">
                  <div class="button8">Meld je aan</div>
                </button>
                <button class="stylesecondary-smallfalse">
                  <img
                    class="icon-google"
                    alt="Google Icon"
                    src="./public/icon--google.svg"
                  />
                  <div class="button8">Meld je aan met Google</div>
                </button>
              </div>
            </form>
          </div>
        </section>
      </main>

      <footer class="footer-73">
        <div class="content39">
          <div class="logo3">
            <a href="./index.html">
              <img
                class="color-dark8"
                loading="lazy"
                alt="Logo"
                src="./public/color--dark.svg"
              />
            </a>
          </div>
          <div class="links3">
            <a href="./over-ons.html" class="link-one3">Over ons</a>
            <a href="./diensten.html" class="link-one3">Diensten</a>
            <a href="./projecten.html" class="link-one3">Projecten</a>
            <a href="./contact.html" class="link-four3">Contact</a>
            <a href="./blog.html" class="link-one3">Blog</a>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html> -->





<?php
// Controleer of het formulier is ingediend en verwerk de gegevens
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database verbindingsgegevens
    $servername = "localhost";
    $username = "root";
    $password = ""; // Vul hier je MySQL root wachtwoord in als je er een hebt
    $dbname = "registratie_db";

    // Maak verbinding met de database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controleer de verbinding
    if ($conn->connect_error) {
        die("Verbinding mislukt: " . $conn->connect_error);
    }

    // Ontvang de gegevens van het formulier
    $naam = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $wachtwoord = password_hash($_POST['password'], PASSWORD_DEFAULT); // Versleuteld wachtwoord

    // Controleer of het e-mailadres al bestaat
    $check_email = "SELECT * FROM gebruikers WHERE email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        $melding = "Het e-mailadres is al geregistreerd.";
    } else {
        // Voeg de nieuwe gebruiker toe aan de database
        $sql = "INSERT INTO gebruikers (naam, email, wachtwoord) VALUES ('$naam', '$email', '$wachtwoord')";

        if ($conn->query($sql) === TRUE) {
            $melding = "Registratie succesvol!";
        } else {
            $melding = "Fout bij het registreren: " . $conn->error;
        }
    }

    // Sluit de verbinding
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./registreren.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
    <title>Registreren</title>
</head>
<body>
<div class="registreren">
    <main class="main1">
        <header class="content35">
            <div class="content36">
                <a href="./index.html">
                    <img class="color-dark6" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
                </a>

                <nav class="column6">
                    <a href="./over-ons.html" class="link-text12">Over Ons</a>
                    <a href="./diensten.html" class="link-text13">Diensten</a>
                    <a href="./projecten.html" class="link-text14">Projecten</a>
                    <a href="./planning.html" class="nav-link-dropdown3">Planning</a>
                </nav>
            </div>
            <button class="stylesecondary-smalltrue-a3">
                <a href="./login.html" class="button7">Inloggen</a>
            </button>
        </header>

        <section class="sign-up-1">
            <div class="navbar">
                <div class="container5">
                    <div class="column7">
                        <img class="color-dark7" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
                    </div>
                    <div class="content37">
                        <div class="already-have-an">Heb je al een account?</div>
                        <a href="./login.html" class="log-in">Log In</a>
                    </div>
                </div>
            </div>

            <div class="content38">
                <div class="section-title4">
                    <h1 class="heading19">Meld je aan</h1>
                    <div class="bsb-networks">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                </div>

                <!-- Registratieformulier -->
                <form class="form1" action="registreren.php" method="post">
                    <div class="input5">
                        <label for="name" class="name">Naam*</label>
                        <input id="name" class="typedefault-alternatefalse4" type="text" name="name" required />
                    </div>
                    <div class="input5">
                        <label for="email" class="name">Email*</label>
                        <input id="email" class="typedefault-alternatefalse4" type="email" name="email" required />
                    </div>
                    <div class="input5">
                        <label for="password" class="name">Wachtwoord*</label>
                        <input id="password" class="typedefault-alternatefalse4" type="password" name="password" required />
                    </div>

                    <div class="buttons">
                        <button type="submit" class="styleprimary-smallfalse-al1">
                            <div class="button8">Meld je aan</div>
                        </button>
                    </div>
                </form>

                <!-- Meldingen -->
                <?php if (isset($melding)): ?>
                    <div class="melding">
                        <?php echo htmlspecialchars($melding); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="footer-73">
        <div class="content39">
            <div class="logo3">
                <a href="./index.html">
                    <img class="color-dark8" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
                </a>
            </div>
            <div class="links3">
                <a href="./over-ons.html" class="link-one3">Over ons</a>
                <a href="./diensten.html" class="link-one3">Diensten</a>
                <a href="./projecten.html" class="link-one3">Projecten</a>
                <a href="./contact.html" class="link-four3">Contact</a>
                <a href="./blog.html" class="link-one3">Blog</a>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
