<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./login.css" />
    <link
      rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap"/>
  </head>
  <body>
    <div class="login">
      <header class="content49">
        <div class="content50">
          <img
            class="color-dark13"
            loading="lazy"
            alt=""
            src="./public/color--dark.svg"
            id="colorDark"
          />

          <nav class="column10">
            <div class="dont-have-an">Over Ons</div>
            <div class="link-text25" id="linkText1">Diensten</div>
            <div class="link-text26" id="linkText2">Projecten</div>
            <div class="nav-link-dropdown6" id="navLinkDropdown">
              <div class="dont-have-an">planning</div>
            </div>
          </nav>
        </div>
        <button class="stylesecondary-smalltrue-a6">
          <div class="button12">inloggen</div>
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
          <form class="form2">
            <div class="input8">
              <div class="email2">Email*</div>
              <input class="typedefault-alternatefalse7" type="text" />
            </div>
            <div class="input8">
              <div class="email2">Wachtwoord*</div>
              <input class="typedefault-alternatefalse7" type="text" />
            </div>
            <div class="container7">
              <div class="buttons1" id="buttonsContainer">
                <button class="styleprimary-smallfalse-al2">
                  <div class="button13">Inloggen</div>
                </button>
                <button class="stylesecondary-smallfalse1">
                  <img
                    class="icon-google1"
                    alt=""
                    src="./public/icon--google.svg"
                  />

                  <div class="button14">Inloggen met Google</div>
                </button>
              </div>
              <div class="link">Wachtwoord vergeten?</div>
            </div>
          </form>
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
                Met ons inlogsysteem kun je facturen ontvangen en eenvoudig
                beheren. Geen gedoe meer met papieren facturen. Alles wordt
                digitaal geregeld, zodat jij je kunt focussen op je opdrachten.
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="footer-76">
        <div class="content53">
          <div class="logo6">
            <img
              class="color-dark14"
              loading="lazy"
              alt=""
              src="./public/color--dark.svg"
            />
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
      
      var contentContainer = document.getElementById("contentContainer");
      if (contentContainer) {
        contentContainer.addEventListener("click", function (e) {
          window.location.href = "./registreren.html";
        });
      }
      
      var buttonsContainer = document.getElementById("buttonsContainer");
      if (buttonsContainer) {
        buttonsContainer.addEventListener("click", function (e) {
          window.location.href = "./admin-right-pagina.html";
        });
      }
      </script>
  </body>
</html> -->



<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./login.css" />
    <link
      rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap"/>
    <title>Inloggen</title>
  </head>
  <body>
    <div class="login">
      <header class="content49">
        <div class="content50">
          <a href="./index.html">
            <img
              class="color-dark13"
              loading="lazy"
              alt="logo"
              src="./public/color--dark.svg"
              id="colorDark"
            />
          </a>

          <nav class="column10">
            <a href="./over-ons.html" class="dont-have-an">Over Ons</a>
            <a href="./diensten.html" class="link-text25" id="linkText1">Diensten</a>
            <a href="./projecten.html" class="link-text26" id="linkText2">Projecten</a>
            <a href="./planning.html" class="nav-link-dropdown6" id="navLinkDropdown">Planning</a>
          </nav>
        </div>
        <button class="stylesecondary-smalltrue-a6">
          <a href="./inloggen.html" class="button12">Inloggen</a>
        </button>
      </header>

      <section class="login-1">
        <div class="navbar1">
          <div class="container6">
            <div class="column11"></div>
            <div class="content51" id="contentContainer">
              <div class="dont-have-an">Don't have an account?</div>
              <a href="./registreren.php" class="sign-up">Heb je nog geen account? Meld je aan</a>
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

          <form class="form2" action="./admin-right-pagina.html" method="post">
            <div class="input8">
              <label for="email" class="email2">Email*</label>
              <input class="typedefault-alternatefalse7" type="text" id="email" name="email" required />
            </div>
            <div class="input8">
              <label for="password" class="email2">Wachtwoord*</label>
              <input class="typedefault-alternatefalse7" type="password" id="password" name="password" required />
            </div>
            <div class="container7">
              <div class="buttons1">
                <button type="submit" class="styleprimary-smallfalse-al2">
                  <div class="button13">Inloggen</div>
                </button>
              </div>
              <a href="./wachtwoord-vergeten.html" class="link">Wachtwoord vergeten?</a>
            </div>
          </form>
        </div>
      </section>

      <section class="layout-246-wrapper">
        <div class="layout-246">
          <div class="section-title8">
            <div class="column12">
              <h1 class="heading33">Eenvoudig facturen ontvangen en beheren</h1>
            </div>
            <div class="column13">
              <div class="text-suspendisse-varius">
                Met ons inlogsysteem kun je facturen ontvangen en eenvoudig
                beheren. Geen gedoe meer met papieren facturen. Alles wordt
                digitaal geregeld, zodat jij je kunt focussen op je opdrachten.
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="footer-76">
        <div class="content53">
          <div class="logo6">
            <a href="./index.html">
              <img class="color-dark14" loading="lazy" alt="logo" src="./public/color--dark.svg" />
            </a>
          </div>
          <div class="links6">
            <a href="./over-ons.html" class="link-one6">Over ons</a>
            <a href="./diensten.html" class="link-one6">Diensten</a>
            <a href="./projecten.html" class="link-one6">Projecten</a>
            <a href="./contact.html" class="link-four6">Contact</a>
            <a href="./blog.html" class="link-one6">Blog</a>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>

