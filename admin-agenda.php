
<?php
include("DatabaseConnection.php");
include("Logincheck.php");

// Toevoegen van evenement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $location = $_POST['location'];

    $sql = "INSERT INTO events (event_date, event_time, event_name, event_type, location) 
            VALUES ('$event_date', '$event_time', '$event_name', '$event_type', '$location')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nieuw evenement succesvol toegevoegd!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Bewerken van evenement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $location = $_POST['location'];

    $sql = "UPDATE events SET event_date='$event_date', event_time='$event_time', event_name='$event_name', event_type='$event_type', location='$location' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Evenement succesvol gewijzigd!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Verwijderen van evenement
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    // Zorg ervoor dat de delete_id goed wordt doorgegeven
    if (!empty($delete_id)) {
        $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        
        if ($stmt->execute()) {
            echo "Evenement succesvol verwijderd!";
        } else {
            echo "Error bij het verwijderen: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Geen ID gevonden om te verwijderen!";
    }
}

// Ophalen van evenementen voor bewerken
$edit_id = null;
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $sql = "SELECT * FROM events WHERE id=$edit_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $edit_data = $result->fetch_assoc();
    }
}

// Filteren van evenementen op datum
$selected_date = null;
if (isset($_GET['date'])) {
    $selected_date = $_GET['date'];
    $sql = "SELECT * FROM events WHERE event_date='$selected_date' ORDER BY event_time";
} else {
    $sql = "SELECT * FROM events ORDER BY event_date, event_time";
}

$result = $conn->query($sql);
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
                        <input type="hidden" name="id" value="<?php echo isset($edit_data) ? $edit_data['id'] : ''; ?>">
                        
                        <label for="event_date">Datum:</label>
                        <input type="date" name="event_date" id="event_date" value="<?php echo isset($edit_data) ? $edit_data['event_date'] : ''; ?>" required>

                        <label for="event_time">Tijd:</label>
                        <input type="time" name="event_time" id="event_time" value="<?php echo isset($edit_data) ? $edit_data['event_time'] : ''; ?>" required>

                        <label for="event_name">Naam van evenement:</label>
                        <input type="text" name="event_name" id="event_name" value="<?php echo isset($edit_data) ? $edit_data['event_name'] : ''; ?>" required>

                        <label for="event_type">Type (Fysiek/Online):</label>
                        <input type="text" name="event_type" id="event_type" value="<?php echo isset($edit_data) ? $edit_data['event_type'] : ''; ?>">

                        <label for="location">Locatie:</label>
                        <input type="text" name="location" id="location" value="<?php echo isset($edit_data) ? $edit_data['location'] : ''; ?>">

                        <?php if ($edit_data): ?>
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
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="card10">';
                            echo '<div>' . htmlspecialchars($row['event_time']) . ' uur</div>';
                            echo '<div class="event-details10">';
                            echo '<h3>' . htmlspecialchars($row['event_name']) . '</h3>';
                            echo '<div>' . htmlspecialchars($row['event_type']) . '</div>';
                            echo '<div>' . htmlspecialchars($row['location']) . '</div>';
                            echo '</div>';

                           
                            echo '<form method="POST" action="admin-agenda.php" onsubmit="return confirm(\'Weet je zeker dat je dit evenement wilt verwijderen?\')">';
                            echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
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
$conn->close();
?>


 


