<?php
//voegt de database connectie toe
include("DatabaseConnection.php");
//haalt het Uuid uit de url
$UrlId = isset($_GET['id']) ? $_GET['id'] : null;
//kijkt of er een post request is
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    //haalt het delete id op met post
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
//kijkt of er een post request is
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    //haalt de data op met post
    $EventDate = $_POST['event_date'];
    $EventTime = $_POST['event_time'];
    $EventName = $_POST['event_name'];
    $EventType = $_POST['event_type'];
    $Location = $_POST['location'];
    
    //stopt de opgehalde data in de database
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