<?php
include("DatabaseConnection.php");
include("admincheck.php");



$GekozenCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';
// Als er een categorie is geselecteerd, haal de producten in die categorie op
if ($GekozenCategorie) {
    $Query = "SELECT naam, aantal, foto FROM products WHERE categorie = ?";
    $Stmt = $Conn->prepare($Query);
    if ($Stmt) {
        $Stmt->bind_param("s", $GekozenCategorie);
        $Stmt->execute();
        $Result = $Stmt->get_result();
    } else {
        echo "Fout bij het voorbereiden van de query: " . $Conn->error;
        exit;
    }
} else {
    // Als er geen categorie is geselecteerd, haal alle producten op
    $Query = "SELECT naam, aantal, foto FROM products";
    $Result = $Conn->query($Query);
}

// Controleer of de query succesvol is uitgevoerd
if ($Result) {
    while ($Row = $Result->fetch_assoc()) {
        $Producten[] = $Row; // Voeg producten toe aan de array
    }
} else {
    echo "Fout bij het ophalen van de producten: " . $Conn->error;
    exit;
}

// Sluit de verbinding
$Conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./add-products.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
</head>
<body>
    <div class="add-products">
        <section class="navbar-6-parent">
        <header class="navbar-65">
        <div class="content54">
            <div class="content55">
             <img class="color-dark15" loading="lazy" alt="" src="./public/color--dark.svg" id="colorDark" />
               <nav class="column14">
                <a href="diensten.php" class="link-text29">Diensten</a>
                <a href="projecten.php" class="link-text30" id="linkText2">Projecten</a>
                <div class="nav-link-dropdown7">
                    <a href="planning.php" class="link-text29">Planning</a>
                </div>
            </nav>
         </div>
        <div class="stylesecondary-smalltrue-a7">
        <a href="logout.php" class="button15">uitloggen</a>

      </div>
      </div>
    </header>

            <div class="header-542">
                <h1 class="short-heading-here4">Product Beheer</h1>
                <div class="lorem-ipsum-dolor10">Bekijk hier de planning van Hyperlight & Sound</div>
            </div>
            <div class="product-header-8">
                <div class="content56">
                    <div class="column15">
                        <div class="product-description1">
                            <h1 class="heading34">Voeg een nieuw product toe</h1>
                            <div class="tabs-menu">
                                <div class="tabs">
                                    <div class="tab">
                                        <div class="details">Details</div>
                                    </div>
                                </div>
                                <div class="details">
                                    Vul de onderstaande informatie in om een nieuw product toe te voegen.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column16">
                        <div class="container8">
                            <!-- Formulier om een nieuw product toe te voegen -->
                            <form method="POST" action="add-products.php" enctype="multipart/form-data">
                                <input type="hidden" name="urlid" value="<?php echo htmlspecialchars($UrlId); ?>">
                                <input type="text" id="product_naam" name="product_naam" placeholder="Productnaam" required>
                                <input type="text" id="product_categorie" name="product_categorie" placeholder="Categorie" required>
                                <input type="number" id="product_aantal" name="product_aantal" placeholder="Aantal" required>
                                <input type="file" id="product_afbeelding" name="product_afbeelding" accept=".pdf,.jpg,.jpeg,.webp" required>
                                <div class="form-submit">
                                    <button type="submit" name="add_product" class="styleprimary-smallfalse-al3">Voeg toe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-11">
            <div class="title11">
                <div class="section-title9">
                    <div class="content57">
                        <h1 class="heading35">Producten</h1>
                        <div class="limitation-items">Bekijk de beschikbare producten hieronder.</div>
                    </div>
                    <!-- Categorie Selectie -->
                    <form method="GET" class="category-selector" action="">
                        <input type="hidden" name="urlid" value="<?php echo htmlspecialchars($UrlId); ?>">
                        <label for="categorie">Kies een categorie:</label>
                        <select name="categorie" id="categorie" onchange="this.form.submit()">
                            <option value="">Alle categorieën</option> <!-- Default optie -->
                            <?php foreach ($Categorieen as $Categorie): ?>
                                <option value="<?php echo htmlspecialchars($Categorie['categorie']); ?>" <?php echo ($Categorie['categorie'] == $GekozenCategorie) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($Categorie['categorie']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            </div>
            <div class="content58">
    <?php if (count($Producten) > 0): ?>
        <?php foreach ($Producten as $Product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img
                        class="product-photo"
                        loading="lazy"
                        alt="<?php echo htmlspecialchars($Product['naam']); ?>"
                        src="uploads/<?php echo htmlspecialchars($Product['foto']); ?>"
                    />
                </div>
                <div class="product-info">
                    <h2 class="product-name"><?php echo htmlspecialchars($Product['naam']); ?></h2>
                    <p class="product-stock"><?php echo htmlspecialchars($Product['aantal']); ?> in voorraad</p>
                </div>
                <!-- Verwijder formulier -->
                <form method="POST" action="add-products.php" class="delete-form">
                    <input type="hidden" name="urlid" value="<?php echo htmlspecialchars($UrlId); ?>">
                    <input type="hidden" name="product_naam" value="<?php echo htmlspecialchars($Product['naam']); ?>">
                    <button type="submit" name="verwijder_product" class="delete-button">Verwijder</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Geen producten beschikbaar in deze categorie.</p>
    <?php endif; ?>
</div>

        </section>
       
        <section class="footer-77">
            <div class="content67">
                <div class="logo7">
                    <img class="color-dark16" loading="lazy" alt="" src="./public/color--dark.svg" />
                </div>
                <div class="links7">
                    <div class="link-one7">Over ons</div>
                    <div class="link-one7">Diensten</div>
                    <div class="link-one7">Projecten</div>
                    <div class="link-four7">Contact</div>
                    <div class="link-one7">Blog</div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
