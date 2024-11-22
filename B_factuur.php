<?php
//voegt database connectie toe en de mail pagina
include("DatabaseConnection.php");
include("mail.php");

//haalt uuid op uit url met GET
$UrlId = isset($_GET['id']) ? $_GET['id'] : null;

//kijkt of er een post request is
if (isset($_POST['submit'])) 
{
    //haalt alle bestant gegevens en uuid op
    $File = $_FILES['file'];
    $Uuid = $_POST['user'];
    $FileName = $File['name'];
    $FileTmpName = $File['tmp_name'];
    $FileSize = $File['size'];
    $FileError = $File['error'];
    $FileType = $File['type'];


    $FileExt = explode('.', $FileName);
    $FileActualExt = strtolower(end($FileExt));

    //maakt array aan met toegelate bestandtype
    $Allowed = array('pdf', 'jpg', 'jpeg', 'png');

    //kijkt of het bestand toegestaan is
    if (in_array($FileActualExt, $Allowed)) 
    {
        //controleert op file erorrs
        if ($FileError === 0) 
        {
            //controleert file grote
            if ($FileSize < 1000000)
            {   
                //veranderd de bestandnaam en stopt alles in database
                $NewFileName = uniqid('', true) . "." . $FileActualExt;
                $FileDestination = 'Uploads/' . $NewFileName;
                move_uploaded_File($FileTmpName, $FileDestination);
                $Stmt = $Conn->prepare("INSERT INTO bills (uuid, PDFId, PDFName) VALUES (?, ?, ?)");
                $Stmt->bind_param("sss", $Uuid, $NewFileName, $FileName);
                $Stmt->execute();
                
                // haalt email op van uuid
                $Stmt = $Conn->prepare("SELECT Email FROM User WHERE Uuid = ?");
                $Stmt->bind_param("s", $Uuid);
                $Stmt->execute();
                $Result = $Stmt->get_result();
                $row = $Result->fetch_assoc();
                $ReceiverMail = $row['Email'];
                $MSubject = "Factuur";
                $MText = ".";
                //verstuurt mail met de factuur
                MailSender($ReceiverMail,$MSubject,$MText,$FileDestination);
                header("Location: factuur.php?id=$UrlId");
                exit();
            }   
            else 
            {   
                $Message = "The File size was too big.";
            }
        } 
        else 
        {
            $Message = "There was an error when uploading the File.";
        }
    } 
    else 
    {
        $Message =  "You cannot upload Files of this type.";
    }
} 
else 
{
    $Message =  "Form not submitted.";
}

header("Location: factuur.php?id=$UrlId&message=" . urlencode($Message));
?>
