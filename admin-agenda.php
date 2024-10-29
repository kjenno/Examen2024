
<?php
include("DatabaseConnection.php");
include("Logincheck.php");

// Toevoegen van evenement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $EventDate = $_POST['event_date'];
    $EventTime = $_POST['event_time'];
    $EventName = $_POST['event_name'];
    $EventType = $_POST['event_type'];
    $Location = $_POST['location'];

    $Sql = "INSERT INTO events (event_date, event_time, event_name, event_type, location) 
            VALUES ('$EventDate', '$EventTime', '$EventName', '$EventType', '$Location')";
    
    if ($Conn->query($Sql) === TRUE) {
        echo "Nieuw evenement succesvol toegevoegd!";
    } else {
        echo "Error: " . $Sql . "<br>" . $Conn->error;
    }
}

// Bewerken van evenement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $Id = $_POST['id'];
    $EventDate = $_POST['event_date'];
    $EventTime = $_POST['event_time'];
    $EventName = $_POST['event_name'];
    $EventType = $_POST['event_type'];
    $Location = $_POST['location'];

    $sql = "UPDATE events SET event_date='$EventDate', event_time='$EventTime', event_name='$EventName', event_type='$EventType', location='$Location' WHERE id=$Id";
    
    if ($Conn->query($Sql) === TRUE) {
        echo "Evenement succesvol gewijzigd!";
    } else {
        echo "Error: " . $Sql . "<br>" . $Conn->error;
    }
}

// Verwijderen van evenement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $DeleteId = $_POST['delete_id'];

    // Zorg ervoor dat de delete_id goed wordt doorgegeven
    if (!empty($DeleteId)) {
        $Stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
        $Stmt->bind_param("i", $DeleteId);
        
        if ($Stmt->execute()) {
            echo "Evenement succesvol verwijderd!";
        } else {
            echo "Error bij het verwijderen: " . $Stmt->error;
        }
        $Stmt->close();
    } else {
        echo "Geen ID gevonden om te verwijderen!";
    }
}

// Ophalen van evenementen voor bewerken
$EditId = null;
$EditData = null;
if (isset($_GET['edit_id'])) {
    $EditId = $_GET['edit_id'];
    $Sql = "SELECT * FROM events WHERE id=$EditId";
    $Result = $Conn->query($sql);
    if ($Result->num_rows > 0) {
        $EditData = $Result->fetch_assoc();
    }
}

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
            <header class="navbar-66">
                <div class="content68">
                    <!-- Navbar content -->
                </div>
            </header>

            <section class="header-47">
                <div class="content70">
                    <div class="column18">
                        <h1 class="short-heading-here5">Beheer uw evenementen</h1>
                    </div>
                </div>
            </section>

            <!-- Formulier voor het toevoegen/bewerken van evenementen -->
            <section class="event-32">
                <div class="content72">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo isset($EditData) ? $EditData['id'] : ''; ?>">
                        
                        <label for="event_date">Datum:</label>
                        <input type="date" name="event_date" id="event_date" value="<?php echo isset($EditData) ? $EditData['event_date'] : ''; ?>" required>

                        <label for="event_time">Tijd:</label>
                        <input type="time" name="event_time" id="event_time" value="<?php echo isset($EditData) ? $EditData['event_time'] : ''; ?>" required>

                        <label for="event_name">Naam van evenement:</label>
                        <input type="text" name="event_name" id="event_name" value="<?php echo isset($EditData) ? $EditData['event_name'] : ''; ?>" required>

                        <label for="event_type">Type (Fysiek/Online):</label>
                        <input type="text" name="event_type" id="event_type" value="<?php echo isset($EditData) ? $EditData['event_type'] : ''; ?>">

                        <label for="location">Locatie:</label>
                        <input type="text" name="location" id="location" value="<?php echo isset($EditData) ? $EditData['location'] : ''; ?>">

                        <?php if ($EditData): ?>
                            <button type="submit" name="edit">Wijzigen</button>
                        <?php else: ?>
                            <button type="submit" name="add">Toevoegen</button>
                        <?php endif; ?>
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

                           
                            echo '<form method="POST" action="admin-agenda.php" onsubmit="return confirm(\'Weet je zeker dat je dit evenement wilt verwijderen?\')">';
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


 


