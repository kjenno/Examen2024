<?php
include("DatabaseConnection.php");

//haalt Uuid uit URL met GET    
$UrlId = isset($_GET['id']) ? $_GET['id'] : null;

//haalt admin id uit de database
$Stmt = $Conn->prepare("SELECT Admin FROM user WHERE uuid = ?");
$Stmt->bind_param("s", $UrlId);
$Stmt->execute();
$Stmt->store_result();

if ($Stmt->num_rows > 0) 
{
    $Stmt->bind_result($Admin);
    $Stmt->fetch();

    //controleert of het admin id juist is
    if($Admin != 1)
    {
        
        header("location: geentoegang.php");

    }
}
else
{
    header("location: geentoegang.php");
}



?>