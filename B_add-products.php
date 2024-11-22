<?php
//incluide database connectie
include("DatabaseConnection.php");

//haalt de gegevens uit de URL met GET
$UrlId = isset($_GET['id']) ? $_GET['id'] : null;
$GekozenCategorie = isset($_GET['categorie']) ? $_GET['categorie'] : null;

//kijkt of er een post aanvraag is voor een product te verwijderen
if (isset($_POST['verwijder_product'])) {
    //haalt de gegevens op met POST
    $UrlId = $_POST['urlid'];
    $ProductNaam = $_POST['product_naam']; 
    //verrwijderd het product dat aangegeven is
    $DeleteQuery = "DELETE FROM products WHERE naam = ?";
    $StmtDelete = $Conn->prepare($DeleteQuery);
    if ($StmtDelete) {
        $StmtDelete->bind_param("s", $ProductNaam);
        $StmtDelete->execute();
        $StmtDelete->close();
        header("Location: add-products.php?id=$UrlId");
    } else {
        echo "Fout bij het voorbereiden van de verwijderquery: " . $Conn->error;
    }
}

//kijkt of er een post aanvraag is om een porduct toe te voegen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    //haalt de gegevens op van post
    $ProductNaam = $_POST['product_naam'];
    $ProductCategorie = $_POST['product_categorie'];
    $ProductAantal = $_POST['product_aantal']; 
    $UrlId = $_POST['urlid'];

    //kijkt of er een foto geupload
    if (isset($_FILES['product_afbeelding']) && $_FILES['product_afbeelding']['error'] == 0) {
        $Allowed = ['pdf', 'jpg', 'jpeg', 'webp'];  
        $FileInfo = pathinfo($_FILES['product_afbeelding']['name']);
        $FileExt = strtolower($FileInfo['extension']);
        //kijkt of het bestant mag geupload worden
        if (in_array($FileExt, $Allowed)) {
            // Definieer de map om bestanden op te slaan
            $UploadDir = 'uploads/';
            // Creëer een unieke naam voor het bestand om dubble namen te voorkomen
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
                    header("Location: add-products.php?id=$UrlId");
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
    if ($GekozenCategorie && $GekozenCategorie !== 'all') {
        // haalt producten op van de gekozen categorie
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
    } elseif ($GekozenCategorie == 'all' || $GekozenCategorie == '') {
        //haalt alle producten op
        $Query = "SELECT naam, aantal, foto FROM products";
        $Result = $Conn->query($Query);
    } else {
        //haalt alle producten op als backup
        $Query = "SELECT naam, aantal, foto FROM products";
        $Result = $Conn->query($Query);
    }

    //verwerkt de data uit de database  
    if ($Result) {
        $Producten = [];
        // stopt de data van de database in de array
        while ($Row = $Result->fetch_assoc()) {
            $Producten[] = $Row;
        }
        //stopt de array in een session
        session_start();
        $_SESSION['producten'] = $Producten;
        //zet p_check op true om zodat de pagina niet herlaad
        $_SESSION['p_check'] = true;
        header("Location: add-products.php?id=$UrlId&category=" . urlencode($GekozenCategorie));
        exit;
    } else {
        echo "Fout bij het ophalen van de producten: " . $Conn->error;
        exit;
    }


// sluit verbinding
$Conn->close();

?>
