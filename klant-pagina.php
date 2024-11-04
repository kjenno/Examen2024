<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
    <link rel="stylesheet" href="klant-pagina.css" />
    <title>Facturen Pagina</title>
</head>
<body>
    <main>
        <!-- Navigatie met logo -->

        <!-- Header -->
        <header class="header-651">
            <h1>Bekijk hier uw facturen</h1> 
            <p>Beheer eenvoudig uw facturen</p>
            
        </header>

        <!-- Facturen sectie met scrollbare PDF-container -->
        <section class="scrollable-container">
            <div class="pdf-container">
                <?php
                include("DatabaseConnection.php");
                $Uuid = isset($_GET['id']) ? $_GET['id'] : null;
                $Stmt = $Conn->prepare("SELECT PDFName, PDFId, BillDate FROM bills WHERE Uuid = ?");
                $Stmt->bind_param("s", $Uuid);
                $Stmt->execute();
                $Result = $Stmt->get_result();

                if ($Result) {
                    if ($Result->num_rows > 0) {
                        while ($Row = $Result->fetch_assoc()) {
                            $OldName = $Row['PDFName'];
                            $NewName = $Row['PDFId'];
                            $Date = $Row['BillDate'];
                            echo '<div class="pdf-item">';
                            echo '<a href="Uploads/' . htmlspecialchars($NewName) . '" target="_blank">' . htmlspecialchars($OldName) . '</a>';
                            echo '<hr>';
                            echo '<div class="pdf-date">' . htmlspecialchars($Date) . '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="no-pdfs">Geen facturen gevonden.</p>';
                    }
                } else {
                    echo "<p class='error'>Error: " . htmlspecialchars($Conn->error) . "</p>";
                }
                $Conn->close();
                ?>
            </div>
        </section>
    </main>

    <!-- Footer sectie -->
    <footer>
        &copy; 2024 Facturen Pagina. Alle rechten voorbehouden.
    </footer>
</body>
