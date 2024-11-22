<?php
        $ServerName = "localhost";
        $UserName = "root";
        $Password = "";
        $DatabaseName = "hyperlightandsound";
        $Conn = new mysqli($ServerName, $UserName, $Password, $DatabaseName);
        if ($Conn->connect_error) {
            die("Connection failed: " . $Conn->connect_error);
        }
?>