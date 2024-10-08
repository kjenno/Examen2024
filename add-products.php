<?php
// Include de database connectie
include("DatabaseConnection.php");

// Controleer of er een categorie is geselecteerd
$gekozenCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';

// Initialiseer producten array
$producten = [];

// Haal beschikbare categorieën op uit de database
$categorieQuery = "SELECT DISTINCT categorie FROM products";
$categorieResult = $conn->query($categorieQuery);
$categorieen = [];

if ($categorieResult) {
    while ($row = $categorieResult->fetch_assoc()) {
        $categorieen[] = $row; // Voeg categorieën toe aan de array
    }
}

// Verwijder een product als er een verwijderverzoek is
if (isset($_POST['verwijder_product'])) {
    $productNaam = $_POST['product_naam']; // Verkrijg de naam van het product
    $deleteQuery = "DELETE FROM products WHERE naam = ?";
    $stmtDelete = $conn->prepare($deleteQuery);
    if ($stmtDelete) {
        $stmtDelete->bind_param("s", $productNaam);
        $stmtDelete->execute();
        $stmtDelete->close();
    } else {
        echo "Fout bij het voorbereiden van de verwijderquery: " . $conn->error;
    }
}

// Voeg een nieuw product toe als het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    // Verkrijg de productgegevens uit het formulier
    $productNaam = $_POST['product_naam'];
    $productCategorie = $_POST['product_categorie'];
    $productAantal = $_POST['product_aantal']; // Dit is nu het aantal
    $productAfbeelding = $_POST['product_afbeelding']; // Dit zou een URL of pad moeten zijn

    // Voeg het product toe aan de database
    $query = "INSERT INTO products (naam, categorie, aantal, foto) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ssis", $productNaam, $productCategorie, $productAantal, $productAfbeelding);
        $stmt->execute();
        $stmt->close();
        echo "<p>Product succesvol toegevoegd!</p>";
    } else {
        echo "Fout bij het voorbereiden van de invoegquery: " . $conn->error;
    }
}

// Als er een categorie is geselecteerd, haal de producten in die categorie op
if ($gekozenCategorie) {
    $query = "SELECT naam, aantal, foto FROM products WHERE categorie = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $gekozenCategorie);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        echo "Fout bij het voorbereiden van de query: " . $conn->error;
        exit;
    }
} else {
    // Als er geen categorie is geselecteerd, haal alle producten op
    $query = "SELECT naam, aantal, foto FROM products";
    $result = $conn->query($query);
}

// Controleer of de query succesvol is uitgevoerd
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $producten[] = $row; // Voeg producten toe aan de array
    }
} else {
    echo "Fout bij het ophalen van de producten: " . $conn->error;
    exit;
}

// Sluit de verbinding
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./add-products.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
    <style>
        .container8 {
            padding: 20px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-submit {
            margin-top: 10px;
        }

        .styleprimary-smallfalse-al3 {
            background-color: #4CAF50; /* Groene achtergrond */
            color: white; /* Witte tekst */
            border: none; /* Geen rand */
            padding: 10px 15px; /* Wat padding */
            cursor: pointer; /* Cursor naar pointer veranderen */
            border-radius: 5px; /* Afgeronde hoeken */
        }

        .styleprimary-smallfalse-al3:hover {
            background-color: #45a049; /* Donkergroen bij hover */
        }

        .delete-button {
            background-color: #f44336; /* Rood voor de verwijderknop */
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-button:hover {
            background-color: #c62828; /* Donkerder rood bij hover */
        }
    </style>
</head>
<body>
    <div class="add-products">
        <section class="navbar-6-parent">
            <header class="navbar-65">
                <div class="content54">
                    <div class="content55">
                        <img class="color-dark15" loading="lazy" alt="" src="./public/color--dark.svg" id="colorDark" />
                        <nav class="column14">
                            <div class="details">Over Ons</div>
                            <div class="link-text29">Diensten</div>
                            <div class="link-text30" id="linkText2">Projecten</div>
                            <div class="nav-link-dropdown7">
                                <div class="link-text29">Planning</div>
                            </div>
                        </nav>
                    </div>
                    <div class="stylesecondary-smalltrue-a7">
                        <div class="button15">uitloggen</div>
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
                            <div class="breadcrumbs">
                                <img class="icon-chevron-right3" loading="lazy" alt="" />
                                <img class="icon-chevron-right3" loading="lazy" alt="" />
                            </div>
                            <h1 class="heading34">Voeg een nieuw product toe</h1>
                            <div class="tabs-menu">
                                <div class="tabs">
                                    <div class="tab">
                                        <div class="details">Details</div>
                                        <img class="divider-icon" loading="lazy" alt="" src="./public/divider.svg" />
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
                            <form method="POST" action="">
                                <input type="text" id="product_naam" name="product_naam" placeholder="Productnaam" required>
                                <input type="text" id="product_categorie" name="product_categorie" placeholder="Categorie" required>
                                <input type="number" id="product_aantal" name="product_aantal" placeholder="Aantal" required>
                                <input type="text" id="product_afbeelding" name="product_afbeelding" placeholder="Afbeeldings-URL" required>
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
                    <form method="GET" class="category-selector">
                        <label for="categorie">Kies een categorie:</label>
                        <select name="categorie" id="categorie" onchange="this.form.submit()">
                            <option value="">Selecteer een categorie</option> <!-- Default optie -->
                            <?php foreach ($categorieen as $categorie): ?>
                                <option value="<?php echo htmlspecialchars($categorie['categorie']); ?>" <?php echo ($categorie['categorie'] == $gekozenCategorie) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($categorie['categorie']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                <div class="actions1"></div>
            </div>
            <div class="content58">
                <?php if (count($producten) > 0): ?>
                    <?php foreach ($producten as $product): ?>
                        <div class="product9">
                            <img
                                class="placeholder-image-icon14"
                                loading="lazy"
                                alt="<?php echo htmlspecialchars($product['naam']); ?>"
                                src="<?php echo htmlspecialchars($product['foto']); ?>"
                            />
                            <div class="container8">
                                <div class="heading36"><?php echo htmlspecialchars($product['naam']); ?></div>
                                <div class="product-descriptions"><?php echo htmlspecialchars($product['aantal']); ?> in voorraad</div>
                                <!-- Verwijder formulier -->
                                <form method="POST" action="">
                                    <input type="hidden" name="product_naam" value="<?php echo htmlspecialchars($product['naam']); ?>">
                                    <button type="submit" name="verwijder_product" class="delete-button">Verwijder</button>
                                </form>
                            </div>
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

    <script>
        var colorDark = document.getElementById("colorDark");
        if (colorDark) {
            colorDark.addEventListener("click", function (e) {
                window.location.href = "./index.html";
            });
        }
        
        var linkText2 = document.getElementById("linkText2");
        if (linkText2) {
            linkText2.addEventListener("click", function (e) {
                window.location.href = "./projecten.html";
            });
        }
    </script>
</body>
</html>
