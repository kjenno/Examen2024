<?php
// Controleer of het formulier is ingediend en verwerk de gegevens
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database verbindingsgegevens
    include("DatabaseConnection.php");

    // Ontvang de gegevens van het formulier
    $Name = trim($_POST['name']);
    $Email = trim($_POST['email']);
    $Password = trim($_POST['password']);
    $Admin = '2'; // Standaardwaarde voor Admin

    // Hash het wachtwoord voor veilige opslag
    $HashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Genereer een unieke UUID voor de gebruiker
    $Uuid = uniqid('', true);

    // Controleer of het e-mailadres al bestaat
    $stmt = $Conn->prepare("SELECT * FROM user WHERE Email = ?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $Message = "Het e-mailadres is al geregistreerd.";
        header("Location: registreren.php?message=" . urlencode($Message));
    } else {
        // Voeg de nieuwe gebruiker toe aan de database
        $stmt = $Conn->prepare("INSERT INTO user (Uuid, Admin, Name, Email, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $Uuid, $Admin, $Name, $Email, $HashedPassword);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $Message = "Fout bij het registreren: " . $stmt->error;
            header("Location: registreren.php?message=" . urlencode($Message));
        }
    }

    // Sluit de statements en de verbinding
    $stmt->close();
    $conn->close();
}
?>