<?php
include("DatabaseConnection.php");

// Controleer of er een categorie is geselecteerd
$gekozenCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';

// maakt array voor producten
$producten = [];

// Haal  categorieën op uit de database
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

    // Controleer of er een bestand is geüpload
    if (isset($_FILES['product_afbeelding']) && $_FILES['product_afbeelding']['error'] == 0) {
        $allowed = ['pdf', 'jpg', 'jpeg', 'webp'];  // Toegestane bestandstypen
        $fileInfo = pathinfo($_FILES['product_afbeelding']['name']);
        $fileExt = strtolower($fileInfo['extension']);

        if (in_array($fileExt, $allowed)) {
            // Definieer de directory om bestanden op te slaan
            $uploadDir = 'uploads/';
            // Creëer een unieke naam voor het bestand om naamconflicten te vermijden
            $uploadFile = $uploadDir . uniqid() . '.' . $fileExt;

            // Verplaats het bestand naar de servermap
            if (move_uploaded_file($_FILES['product_afbeelding']['tmp_name'], $uploadFile)) {
                echo "Bestand is succesvol geüpload.";
                $productAfbeelding = basename($uploadFile);  // Alleen de bestandsnaam opslaan in de database
            } else {
                echo "Fout bij het uploaden van het bestand.";
                $productAfbeelding = null;
            }
        } else {
            echo "Ongeldig bestandstype. Alleen PDF, JPG, JPEG en WEBP zijn toegestaan.";
            $productAfbeelding = null;
        }
    } else {
        echo "Geen bestand geüpload of er is een fout opgetreden.";
        $productAfbeelding = null;
    }

    // Voeg het product toe aan de database
    if ($productAfbeelding) {
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
