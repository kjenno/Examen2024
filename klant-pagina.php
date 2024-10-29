<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
    <link rel="stylesheet" href="klant-pagina.css" />
    <title>Facturen Pagina</title>
  </head>
  <body>
    <main>
      <header class="header-651">
        <h1>Bekijk hier uw facturen</h1>
        <p>Beheer eenvoudig uw facturen</p>
      </header>

      <section class="scrollable-container">
        <div class="pdf-container">
          <?php
            include("DatabaseConnection.php");
            include("Logincheck.php");
            $Uuid = isset($_GET['id']) ? $_GET['id'] : null;
            $Stmt = $Conn->prepare("SELECT PDFName, PDFId, BillDate FROM bills WHERE Uuid = ?");
            $Stmt->bind_param("s", $uuid);  // Bind the user ID to the query
            $Stmt->execute();
            $Result = $Stmt->get_result();

            if ($Result) {
                if ($Result->num_rows > 0) {
                    while ($Row = $result->fetch_assoc()) {
                        $OldName = $Row['PDFName']; // Display name for the link
                        $NewName = $Row['PDFId'];    // This is the actual filename to open
                        $Date = $Row['BillDate'];
                        // Create the button-style link
                        echo '<div class="pdf-item">';
                        echo '<a href="Uploads/' . htmlspecialchars($NewName) . '" target="_blank">' . htmlspecialchars($OldName) . '</a>';
                        echo '<hr>';
                        echo '<div>' . $Date . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No PDFs found.</p>';
                }
            } else {
                echo "Error: " . $Conn->error;
            }
            $Conn->close();
          ?>
        </div>
      </section>
    </main>

    <footer>
      &copy; 2024 Facturen Pagina. Alle rechten voorbehouden.
    </footer>
  </body>
</html>
