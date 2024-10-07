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
            $sql = "SELECT PDFName, PDFId, BillDate FROM bills";
            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $OldName = $row['PDFName']; // Display name for the link
                        $NewName = $row['PDFId'];    // This is the actual filename to open
                        $Date = $row['BillDate'];
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
                echo "Error: " . $conn->error;
            }
            $conn->close();
          ?>
        </div>
      </section>
    </main>

    <footer>
      &copy; 2024 Facturen Pagina. Alle rechten voorbehouden.
    </footer>

    <script>
      var colorDark = document.getElementById("colorDark");
      if (colorDark) {
        colorDark.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }

      var linkText1 = document.getElementById("linkText1");
      if (linkText1) {
        linkText1.addEventListener("click", function (e) {
          window.location.href = "./diensten.html";
        });
      }

      var linkText2 = document.getElementById("linkText2");
      if (linkText2) {
        linkText2.addEventListener("click", function (e) {
          window.location.href = "./projecten.html";
        });
      }

      var navLinkDropdown = document.getElementById("navLinkDropdown");
      if (navLinkDropdown) {
        navLinkDropdown.addEventListener("click", function (e) {
          window.location.href = "./planning.html";
        });
      }

      var styleSecondarySmallTrueA = document.getElementById(
        "styleSecondarySmallTrueA"
      );
      if (styleSecondarySmallTrueA) {
        styleSecondarySmallTrueA.addEventListener("click", function (e) {
          window.location.href = "./login.html";
        });
      }
    </script>
  </body>
</html>
