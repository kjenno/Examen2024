<?php
include("Logincheck.php");
include("admincheck.php");
$UrlId = isset($_GET['id']) ? $_GET['id'] : null;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./admin-right-pagina.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
</head>
<body>
  <div class="admin-right-pagina">
    <main class="na-het-inloggen-2">
      <header class="navbar-61">
        <div class="content16">
          <div class="content17">
            <a href="index.php">
              <img class="color-dark2" loading="lazy" alt="Logo" src="./public/logo.png" />
            </a>
            <nav class="column1">
              <div class="link-text4"><a href="over-ons.php">Over Ons</a></div>
              <div class="link-text5"><a href="diensten.php">Diensten</a></div>
              <div class="link-text6"><a href="projecten.php" id="linkText2">Projecten</a></div>
              <div class="nav-link-dropdown1">
                <div class="link-text4"><a href="planning.php">Planning</a></div>
              </div>
            </nav>
          </div>
          <div class="stylesecondary-smalltrue-a7">
        <a href="logout.php" class="button15">uitloggen</a>
        </div>
        </div>
      </header>
      <section class="header-65">
        <div class="container1">
          <div class="section-title2">
            <div class="tagline-wrapper2">
              <div class="tagline1">Beheer</div>
            </div>
            <div class="content18">
              <h1 class="short-heading-here1">Welkom Dennis!</h1>
              <div class="lorem-ipsum-dolor1">Beheer je account en volg je opdrachten.</div>
            </div>
          </div>
        </div>
      </section>
      <section class="layout-240">
        <h1 class="heading10">Beheer je afspraken en facturen eenvoudig via ons gebruiksvriendelijke menu.</h1>
        <div class="content19">
          <div class="row3">
            <div class="column2">
              <img class="image-icon" loading="lazy" alt="Afspraken" src="./public/image@2x.png" />
              <div class="content20">
                <div class="content21">
                  <h3 class="heading11">Laat uw geplande afspraken zien</h3>
                  <div class="separator">Voer uw maandplanning in</div>
                </div>
                <div class="action">
                  <a href="admin-agenda.php<?php echo $UrlId ? '?id=' . $UrlId : ''; ?>" class="stylelink-smallfalse-alter">
                    <div class="link-text4">Plan</div>
                    <img class="icon-chevron-right" loading="lazy" alt="Chevron" src="./public/icon--chevronright.svg" />
                  </a>
                </div>
              </div>
            </div>
            <div class="column2">
              <img class="image-icon" loading="lazy" alt="Producten" src="./public/image-1@2x.png" />
              <div class="content20">
                <div class="content21">
                  <h3 class="heading11">Beheer uw producten</h3>
                  <div class="separator">Bekijk hier alle producten</div>
                </div>
                <div class="action">
                  <a href="add-products.php<?php echo $UrlId ? '?id=' . $UrlId : ''; ?>" class="stylelink-smallfalse-alter">
                    <div class="button4">Producten</div>
                    <img class="icon-chevron-right" loading="lazy" alt="Chevron" src="./public/icon--chevronright.svg" />
                  </a>
                </div>
              </div>
            </div>
            <div class="column2">
              <img class="image-icon" loading="lazy" alt="Gegevens" src="./public/image-2@2x.png" />
              <div class="content20">
                <div class="content21">
                  <h3 class="heading13">Toegang tot al je gegevens op één centrale plek.</h3>
                  <div class="separator">Bekijk je afspraken, facturen en meer met één klik.</div>
                </div>
                <div class="action">
                  <a href="factuur.php<?php echo $UrlId ? '?id=' . $UrlId : ''; ?>" class="stylelink-smallfalse-alter2">
                    <div class="link-text4">Gegevens</div>
                    <img class="icon-chevron-right" loading="lazy" alt="Chevron" src="./public/icon--chevronright.svg" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="layout-18">
        <div class="container2">
          <div class="content26">
            <div class="content27">
              <h1 class="heading14">Afspraken maken - Plan snel en eenvoudig een nieuwe afspraak met ons team</h1>
              <div class="text11">
                Bij Hyper Light and Sound kun je gemakkelijk een nieuwe afspraak maken met ons team via de handige kalender.
              </div>
            </div>
            <div class="list">
              <div class="list-item">
                <img class="icon-relume" loading="lazy" alt="" src="./public/icon--relume.svg" />
                <div class="lorem-ipsum-dolor2">Selecteer een datum en tijd die jou uitkomt.</div>
              </div>
              <div class="list-item">
                <img class="icon-relume" loading="lazy" alt="" src="./public/icon--relume.svg" />
                <div class="lorem-ipsum-dolor2">Kies de gewenste dienst en locatie.</div>
              </div>
              <div class="list-item">
                <img class="icon-relume" loading="lazy" alt="" src="./public/icon--relume.svg" />
                <div class="lorem-ipsum-dolor2">Bevestig je afspraak en ontvang een bevestiging.</div>
              </div>
            </div>
          </div>
          <img class="image-icon3" loading="lazy" alt="" src="./public/image-3@2x.png" />
        </div>
      </section>
      <section class="footer-71">
        <div class="content28">
          <div class="logo1">
            <img class="color-dark3" loading="lazy" alt="" src="./public/color--dark.svg" />
          </div>
          <div class="links1">
            <a href="over-ons.php" class="link-one1">Over ons</a>
            <a href="admin-agenda.php" class="link-one1">Diensten</a>
            <a href="projecten.php" class="link-one1">Projecten</a>
            <a href="contact.php" class="link-four1">Contact</a>
            <a href="blog.php" class="link-one1">Blog</a>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
