<?php
include("DatabaseConnection.php");

$UrlId = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $DeleteId = $_POST['delete_id'];

    // Zorg ervoor dat de delete_id goed wordt doorgegeven
    if (!empty($DeleteId)) {
        $Stmt = $Conn->prepare("DELETE FROM events WHERE id = ?");
        $Stmt->bind_param("i", $DeleteId);
        
        if ($Stmt->execute()) {
            echo "Evenement succesvol verwijderd!";
            header("Location: admin-agenda.php?id=$UrlId");
        } else {
            echo "Error bij het verwijderen: " . $Stmt->error;
        }
        $Stmt->close();
    } else {
        echo "Geen ID gevonden om te verwijderen!";
    }
}

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
        header("Location: admin-agenda.php?id=$UrlId");
    } else {
        echo "Error: " . $Sql . "<br>" . $Conn->error;
    }
}







?>