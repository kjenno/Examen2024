
<?php
// toevoegen van de pagina's 
include("DatabaseConnection.php");
include("Logincheck.php");
include("admincheck.php");

// Filteren van evenementen op datum
$SelectedDate = null;
if (isset($_GET['date'])) {
    $SelectedDate = $_GET['date'];
    $Sql = "SELECT * FROM events WHERE event_date='$SelectedDate' ORDER BY event_time";
} else {
    $Sql = "SELECT * FROM events ORDER BY event_date, event_time";
}

$Result = $Conn->query($Sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./admin-agenda.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" />
    <title>Planning Beheer</title>
</head>
<body>
    <div class="admin-agenda">
        <main class="afpraak">
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
            <section class="header-47">
                <div class="content70">
                    <div class="column18">
                        <h1 class="short-heading-here5">Beheer uw evenementen</h1>
                    </div>
                </div>
            </section>
                <section class="event-32">
                    <div class="content72">
                        <form method="POST" action="B_admin-agenda.php?id=<?php echo urlencode($UrlId); ?>">
                            <input type="hidden" name="id" value="<?php echo isset($EditData) ? $EditData['id'] : ''; ?>">
                            
                            <label for="event_date">Datum:</label>
                            <input type="date" name="event_date" id="event_date" value="<?php echo isset($EditData) ? $EditData['event_date'] : ''; ?>" required>

                            <label for="event_time">Tijd:</label>
                            <input type="time" name="event_time" id="event_time" value="<?php echo isset($EditData) ? $EditData['event_time'] : ''; ?>" required>
                            <br><br>
                            <label for="event_name">Naam van evenement:</label>
                            <input type="text" name="event_name" id="event_name" value="<?php echo isset($EditData) ? $EditData['event_name'] : ''; ?>" required>

                            <label for="event_type">Type (Fysiek/Online):</label>
                            <input type="text" name="event_type" id="event_type" value="<?php echo isset($EditData) ? $EditData['event_type'] : ''; ?>">

                            <label for="location">Locatie:</label>
                            <input type="text" name="location" id="location" value="<?php echo isset($EditData) ? $EditData['location'] : ''; ?>">

                            <button type="submit" name="add">Toevoegen</button>
                        </form>
                    </div>
                </section>
            <!-- Lijst van evenementen -->
            <section class="event-32">
                <div class="content72">
                    <?php
                    if ($Result->num_rows > 0) {
                        while($Row = $Result->fetch_assoc()) {
                            echo '<div class="card10">';
                            echo '<div>' . htmlspecialchars($Row['event_time']) . ' uur</div>';
                            echo '<div class="event-details10">';
                            echo '<h3>' . htmlspecialchars($Row['event_name']) . '</h3>';
                            echo '<div>' . htmlspecialchars($Row['event_type']) . '</div>';
                            echo '<div>' . htmlspecialchars($Row['location']) . '</div>';
                            echo '</div>';

                           
                            echo '<form method="POST" action="B_admin-agenda.php?id=' . urlencode($UrlId) . '" onsubmit="return confirm(\'Weet je zeker dat je dit evenement wilt verwijderen?\')">';
                            echo '<input type="hidden" name="delete_id" value="' . $Row['id'] . '">';
                            echo '<button type="submit" name="delete">Verwijderen</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                    } else {
                        echo "Geen evenementen beschikbaar.";
                    }
                    ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

<?php
$Conn->close();
?>


 


