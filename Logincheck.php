<?php
session_start(); // Start de sessie

// Haal de benodigde gegevens op uit de sessie en de URL.
$_SESSION['loggedin']; // Ingelogde status
$_SESSION['id']; // ID van de ingelogde gebruiker
$UrlId = isset($_GET['id']) ? $_GET['id'] : null; // ID uit de URL

// Controleer of de gebruiker is ingelogd en of de sessie-ID overeenkomt met de URL-ID.
$Loggedin = $_SESSION['loggedin'];
$Id = $_SESSION['id'];

if ($Loggedin != true || $Id != $UrlId) {
    header("location: login.php"); // Redirect naar loginpagina als controle faalt
}
?>
