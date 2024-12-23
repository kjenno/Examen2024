<?php
    $UrlId = isset($_GET['id']) ? $_GET['id'] : null;
    include("admincheck.php");
    include("Logincheck.php");
    include("DatabaseConnection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
    <link rel="stylesheet" href="factuur.css" />
    <title>Facturen Pagina</title>
</head>
<body>
    <main>
    <header class="navbar-65">
        <div class="content54">
            <div class="content55">
             <img class="color-dark15" loading="lazy" alt="" src="./public/logo.png" id="colorDark" />
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
        <section class="form-container">
            <h2>Upload een Factuur</h2>
            <form action="B_factuur.php<?php echo $UrlId ? '?id=' . $UrlId : ''; ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="file" required><br>

                <label for="user">Kies een gebruiker:</label>
                <select name="user" id="user" required>
                    <?php

                        // Fetch users from the database
                        $Sql = "SELECT uuid, name FROM user";
                        $Result = $Conn->query($Sql);

                        if ($Result->num_rows > 0) 
                        {
                            while ($Row = $Result->fetch_assoc()) 
                            {
                                echo '<option value="' . htmlspecialchars($Row['uuid']) . '">' . htmlspecialchars($Row['name']) . '</option>';
                            }
                        } 
                        else 
                        {
                            echo '<option value="">Geen gebruikers beschikbaar</option>';
                        }
                    ?>
                </select><br>
                
                <button type="submit" name="submit">Upload</button>
            </form>
            <?php
                $Message = $_GET['message'] ?? null;
                if (!empty($Message)) 
                {
                    echo "<p style='color: red; text-align: center;'>$Message</p>";
                }

            ?>
        </section>

        <section class="scrollable-container">
            <div class="pdf-container">
                <?php
                    $Sql = "SELECT PDFName, PDFId, BillDate FROM bills";
                    $Result = $Conn->query($Sql);

                    if ($Result) 
                    {
                        if ($Result->num_rows > 0) 
                        {
                            while ($Row = $Result->fetch_assoc()) 
                            {
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
                        } 
                        else 
                        {
                            echo '<p>No PDFs found.</p>';
                        }
                    }
                     else 
                    {
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

    <script>
      // JavaScript voor navigatie kan hier indien nodig worden toegevoegd.
    </script>
</body>
</html>
