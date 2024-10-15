<?php
// Include de database connectie
include("B_add-products.php");
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
                            <form method="POST" action="" enctype="multipart/form-data">
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
            </div>
            <div class="content58">
                <?php if (count($producten) > 0): ?>
                    <?php foreach ($producten as $product): ?>
                        <div class="product9">
                            <img
                                class="placeholder-image-icon14"
                                loading="lazy"
                                alt="<?php echo htmlspecialchars($product['naam']); ?>"
                                src="uploads/<?php echo htmlspecialchars($product['foto']); ?>"
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

</body>
</html>
