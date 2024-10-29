<?php
session_start();
$_SESSION['loggedin'];
$_SESSION['id'];
$urlid = isset($_GET['id']) ? $_GET['id'] : null;
$loggedin = $_SESSION['loggedin'];
$id = $_SESSION['id'];
if($loggedin != true || $id != $urlid)
{
    header("location: login.php");
}











































?>