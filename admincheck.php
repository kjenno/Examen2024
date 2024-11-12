<?php
include("DatabaseConnection.php");

$UrlId = isset($_GET['id']) ? $_GET['id'] : null;

$Stmt = $Conn->prepare("SELECT Admin FROM user WHERE uuid = ?");
$Stmt->bind_param("s", $UrlId);
$Stmt->execute();
$Stmt->store_result();

if ($Stmt->num_rows > 0) 
{
    $Stmt->bind_result($Admin);
    $Stmt->fetch();
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