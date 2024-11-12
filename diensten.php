<?php
include("DatabaseConnection.php");
include("offerte.php");

// Assuming $Conn is the MySQLi connection object
$CategorieQuery = "SELECT DISTINCT categorie FROM products";
$CategorieResult = $Conn->query($CategorieQuery);
$Categorieen = $CategorieResult->fetch_all(MYSQLI_ASSOC);

// Get the selected category from the GET parameter, defaulting to 'Geluid' if not set
$GekozenCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : 'Geluid';

// Prepare and execute the SQL query for products with the chosen category
$Sql = "SELECT naam, foto FROM products WHERE categorie = ?";
$Stmt = $Conn->prepare($Sql);
$Stmt->bind_param("s", $GekozenCategorie);
$Stmt->execute();
$Producten = $Stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Optionally, close the prepared statement
$Stmt->close();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./diensten.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap"
    />
  </head>
  <body>
    <div class="diensten">
      <section class="main">
        <header class="inloggen">
          <div class="navbar-6">
            <div class="content">
              <div class="content1">
                <a href="./index.php">
                  <img
                    class="color-dark"
                    loading="lazy"
                    alt="Logo"
                    src="./public/color--dark.svg"
                  />
                </a>

                <nav class="column">
                  <a href="./diensten.php" class="link-text1">Diensten</a>
                  <a href="./projecten.php" class="link-text2">Projecten</a>
                  <a href="./planning.php" class="link-text3">Planning</a>
                </nav>
              </div>
              <a href="./login.php" class="stylesecondary-smalltrue-a">
                <div class="button">Inloggen</div>
              </a>
            </div>
          </div>
        </header>

        <div class="header-54" id="header54">
          <h1 class="short-heading-here">Diensten</h1>
          <div class="lorem-ipsum-dolor">
            Vraag uw offerte eenvoudig aan en bekijk onze producten
          </div>
        </div>

        <!-- Categorie Selectie -->
        <form method="GET" class="category-selector">
          <label for="categorie">Kies een categorie:</label>
          <select name="categorie" id="categorie" onchange="this.form.submit()">
            <?php foreach ($Categorieen as $Categorie): ?>
              <option value="<?php echo htmlspecialchars($Categorie['categorie']); ?>" <?php echo ($Categorie['categorie'] == $GekozenCategorie) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($Categorie['categorie']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </form>

        <div class="product-1">
          <div class="title">
            <div class="section-title">
              <div class="tagline-wrapper"></div>
              <div class="content2">
                <h1 class="heading">Producten in categorie: <?php echo htmlspecialchars($GekozenCategorie); ?></h1>
                <div class="text">Bekijk onze producten in de geselecteerde categorie.</div>
              </div>
            </div>
            <div class="actions"></div>
          </div>

          <div class="content3">
            <?php if (count($Producten) > 0): ?>
              <?php foreach ($Producten as $Product): ?>
                <div class="product">
                  <img
                    class="placeholder-image-icon"
                    loading="lazy"
                    alt="<?php echo htmlspecialchars($Product['naam']); ?>"
                    src="uploads/<?php echo htmlspecialchars($Product['foto']); ?>"
                    
                  />
                  <div class="content4">
                    <div class="header">
                      <div class="heading1"><?php echo htmlspecialchars($Product['naam']); ?></div>
                      <div class="product-description">Variant</div>
                    </div>
                    <div class="price">Vraag uw offerte aan</div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>Geen producten beschikbaar in deze categorie.</p>
            <?php endif; ?>
          </div>
        </div>
      </section>

      <section class="container-wrapper">
        <div class="container">
          <div class="content12">
            <div class="section-title1">
              <div class="tagline-wrapper1">
                <div class="tagline">Contact</div>
              </div>
              <div class="content13">
                <h1 class="heading">Vraag een offerte aan!</h1>
                <div class="text">
                  Heb je vragen of hulp nodig? Neem contact met ons op via onderstaand formulier.
                </div>
              </div>
            </div>

            <div class="content14">
              <div class="row">
                <img class="icon-envelope" loading="lazy" alt="Email Icon" src="./public/icon--envelope.svg" />
                <div class="link-text">support@hyperlightandsound.com</div>
              </div>
              <div class="row">
                <img class="icon-envelope" loading="lazy" alt="Telefoon Icon" src="./public/icon--phone.svg" />
                <div class="link-text">+31 (0)123 456789</div>
              </div>
              <div class="row">
                <img class="icon-envelope" loading="lazy" alt="Map Icon" src="./public/icon--map.svg" />
                <div class="link-text">Straatnaam 1, 1234 AB Amsterdam</div>
              </div>
            </div>
          </div>

          <div class="feedback-message">
            <?php if (!empty($feedbackMessage)): ?>
              <p><?php echo $feedbackMessage; ?></p>
            <?php endif; ?>
          </div>

          <div class="form">
          <form method="POST">
    <div class="inputs">
        <div class="input">
            <div class="first-name">Voornaam</div>
            <input class="typedefault-alternatefalse" type="text" name="voornaam" required />
        </div>
        <div class="input">
            <div class="first-name">Achternaam</div>
            <input class="typedefault-alternatefalse" type="text" name="achternaam" required />
        </div>
    </div>
    <div class="inputs">
        <div class="input">
            <div class="first-name">E-mail</div>
            <input class="typedefault-alternatefalse" type="email" name="email" required />
        </div>
        <div class="input">
            <div class="first-name">Telefoonnummer</div>
            <input class="typedefault-alternatefalse" type="text" name="telefoon" />
        </div>
    </div>
    <div class="input4">
        <div class="first-name">Bericht</div>
        <textarea class="typedefault-alternatefalse" name="bericht" placeholder="Typ hier je bericht..." required></textarea>
    </div>
    <button type="submit" class="styleprimary-smallfalse-al">
        <div class="button1">Verzend</div>
    </button>
</form>

</div>



        </div>
      </section>

      <section class="footer-7">
        <div class="content15">
          <a href=".index.php">
            <div class="logo">
              <img class="color-dark1" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
            </div>
          </a>
        </div>
      </section>
    </div>
  </body>
</html>
