<?php
session_start();
$_SESSION['loggedin'];
$_SESSION['id'];
$UrlId = isset($_GET['id']) ? $_GET['id'] : null;
$Loggedin = $_SESSION['loggedin'];
$Id = $_SESSION['id'];
if($Loggedin != true || $Id != $UrlId)
{
    header("location: login.php");
}











































?>