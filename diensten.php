<?php
// Database verbinding
$host = 'localhost'; // je database host
$db = 'hyperlightandsound'; // je database naam
$user = 'root'; // je database gebruikersnaam
$pass = ''; // je database wachtwoord

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}

// Haal categorieën op uit de database
$categorieQuery = "SELECT DISTINCT categorie FROM products";
$categorieStmt = $pdo->prepare($categorieQuery);
$categorieStmt->execute();
$categorieen = $categorieStmt->fetchAll(PDO::FETCH_ASSOC);

// Haal producten op op basis van de gekozen categorie
$gekozenCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : 'Geluid'; // Standaard categorie is 'Geluid'

$sql = "SELECT naam, foto FROM products WHERE categorie = :categorie";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':categorie', $gekozenCategorie, PDO::PARAM_STR);
$stmt->execute();
$producten = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                  <a href="./over-ons.php" class="link-text">Over Ons</a>
                  <a href="#header54" class="link-text1">Diensten</a>
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
            <?php foreach ($categorieen as $categorie): ?>
              <option value="<?php echo htmlspecialchars($categorie['categorie']); ?>" <?php echo ($categorie['categorie'] == $gekozenCategorie) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($categorie['categorie']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </form>

        <div class="product-1">
          <div class="title">
            <div class="section-title">
              <div class="tagline-wrapper"></div>
              <div class="content2">
                <h1 class="heading">Producten in categorie: <?php echo htmlspecialchars($gekozenCategorie); ?></h1>
                <div class="text">Bekijk onze producten in de geselecteerde categorie.</div>
              </div>
            </div>
            <div class="actions"></div>
          </div>

          <div class="content3">
            <?php if (count($producten) > 0): ?>
              <?php foreach ($producten as $product): ?>
                <div class="product">
                  <img
                    class="placeholder-image-icon"
                    loading="lazy"
                    alt="<?php echo htmlspecialchars($product['naam']); ?>"
                    src="<?php echo htmlspecialchars($product['foto']); ?>"
                  />
                  <div class="content4">
                    <div class="header">
                      <div class="heading1"><?php echo htmlspecialchars($product['naam']); ?></div>
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

          <div class="form">
            <div class="inputs">
              <div class="input">
                <div class="first-name">Voornaam</div>
                <input class="typedefault-alternatefalse" type="text" />
              </div>
              <div class="input">
                <div class="first-name">Achternaam</div>
                <input class="typedefault-alternatefalse" type="text" />
              </div>
            </div>
            <div class="inputs">
              <div class="input">
                <div class="first-name">E-mail</div>
                <input class="typedefault-alternatefalse" type="text" />
              </div>
              <div class="input">
                <div class="first-name">Telefoonnummer</div>
                <input class="typedefault-alternatefalse" type="text" />
              </div>
            </div>

            <div class="input4">
              <div class="first-name">Bericht</div>
              <textarea class="typedefault-alternatefalse" placeholder="Typ hier je bericht..."></textarea>
            </div>

            <div class="selectedfalse-alternatefals">
              <input type="checkbox" class="checkbox" />
              <label class="label">Ik accepteer de voorwaarden</label>
            </div>

            <button class="styleprimary-smallfalse-al">
              <div class="button1">Verzend</div>
            </button>
          </div>
        </div>
      </section>

      <section class="footer-7">
        <div class="content15">
          <a href="./index.php">
            <div class="logo">
              <img class="color-dark1" loading="lazy" alt="Logo" src="./public/color--dark.svg" />
            </div>
          </a>

          <div class="links">
            <a href="./over-ons.php" class="link-one">Over ons</a>
            <a href="#header54" class="link-one">Diensten</a>
            <a href="./projecten.php" class="link-one">Projecten</a>
            <a href="./contact.php" class="tagline">Contact</a>
            <a href="./blog.php" class="link-one">Blog</a>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>
