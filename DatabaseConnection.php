<?php
        $ServerName = "localhost";
        $UserName = "root";
        $Password = "";
        $DatabaseName = "hyperlightandsound";
        $Conn = new mysqli($ServerName, $UserName, $Password, $DatabaseName);
        if ($Conn->connect_error) {
            die("Connection failed: " . $Conn->connect_error);
        }


        // Database verbinding
        $host = 'localhost'; // je database host
        $db = 'hyperlightandsound'; // je database naam
        $user = 'root'; // je database gebruikersnaam
        $pass = ''; // je database wachtwoord

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Verbinding mislukt: " . $e->getMessage();
        }
?>