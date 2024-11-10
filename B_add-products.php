<?php
include("DatabaseConnection.php");

$GekozenCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';

$Producten = [];

$CategorieQuery = "SELECT DISTINCT categorie FROM products";
$CategorieResult = $Conn->query($CategorieQuery);
$Categorieen = [];

if ($CategorieResult) {
    while ($Row = $CategorieResult->fetch_assoc()) {
        $Categorieen[] = $Row; 
    }
}


if (isset($_POST['verwijder_product'])) {
    $ProductNaam = $_POST['product_naam']; 
    $DeleteQuery = "DELETE FROM products WHERE naam = ?";
    $StmtDelete = $Conn->prepare($DeleteQuery);
    if ($StmtDelete) {
        $StmtDelete->bind_param("s", $ProductNaam);
        $StmtDelete->execute();
        $StmtDelete->close();
    } else {
        echo "Fout bij het voorbereiden van de verwijderquery: " . $Conn->error;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
   
    $ProductNaam = $_POST['product_naam'];
    $ProductCategorie = $_POST['product_categorie'];
    $ProductAantal = $_POST['product_aantal']; 

  
    if (isset($_FILES['product_afbeelding']) && $_FILES['product_afbeelding']['error'] == 0) {
        $Allowed = ['pdf', 'jpg', 'jpeg', 'webp'];  
        $FileInfo = pathinfo($_FILES['product_afbeelding']['name']);
        $FileExt = strtolower($FileInfo['extension']);

        if (in_array($FileExt, $Allowed)) {
            // Definieer de directory om bestanden op te slaan
            $UploadDir = 'uploads/';
            // Creëer een unieke naam voor het bestand om naamconflicten te vermijden
            $UploadFile = $UploadDir . uniqid() . '.' . $FileExt;

            // Verplaats het bestand naar de servermap
            if (move_uploaded_file($_FILES['product_afbeelding']['tmp_name'], $UploadFile)) {
                echo "Bestand is succesvol geüpload.";
                $ProductAfbeelding = basename($UploadFile);  // Alleen de bestandsnaam opslaan in de database
            } else {
                echo "Fout bij het uploaden van het bestand.";
                $ProductAfbeelding = null;
            }
        } else {
            echo "Ongeldig bestandstype. Alleen PDF, JPG, JPEG en WEBP zijn toegestaan.";
            $ProductAfbeelding = null;
        }
    } else {
        echo "Geen bestand geüpload of er is een fout opgetreden.";
        $ProductAfbeelding = null;
    }

    // Controleer of het product al bestaat in de database
    $CheckQuery = "SELECT naam FROM products WHERE naam = ?";
    $StmtCheck = $Conn->prepare($CheckQuery);
    if ($StmtCheck) {
        $StmtCheck->bind_param("s", $ProductNaam);
        $StmtCheck->execute();
        $StmtCheck->store_result();
        if ($StmtCheck->num_rows > 0) {
            echo "Dit product bestaat al.";
        } else {
            // Voeg het product toe aan de database
            if ($ProductAfbeelding) {
                $Query = "INSERT INTO products (naam, categorie, aantal, foto) VALUES (?, ?, ?, ?)";
                $Stmt = $Conn->prepare($Query);
                if ($Stmt) {
                    $Stmt->bind_param("ssis", $ProductNaam, $ProductCategorie, $ProductAantal, $ProductAfbeelding);
                    $Stmt->execute();
                    $Stmt->close();
                    echo "<p>Product succesvol toegevoegd!</p>";

                    // Redirect naar dezelfde pagina om dubbele indiening te voorkomen
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit(); // Stop verdere uitvoering om dubbele invoeging te voorkomen
                } else {
                    echo "Fout bij het voorbereiden van de invoegquery: " . $Conn->error;
                }
            }
        }
        $StmtCheck->close();
    }
}

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
