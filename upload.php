<?php
include("DatabaseConnection.php");
include("mail.php");


if (isset($_POST['submit'])) 
{

    $File = $_FILES['file'];
    $Uuid = $_POST['user'];
    $FileName = $File['name'];
    $FileTmpName = $File['tmp_name'];
    $FileSize = $File['size'];
    $FileError = $File['error'];
    $FileType = $File['type'];


    $FileExt = explode('.', $FileName);
    $FileActualExt = strtolower(end($FileExt));


    $Allowed = array('pdf', 'jpg', 'jpeg', 'png');


    if (in_array($FileActualExt, $Allowed)) {
        if ($FileError === 0) {
            if ($FileSize < 1000000) {
                $NewFileName = uniqid('', true) . "." . $FileActualExt;
                $FileDestination = 'Uploads/' . $NewFileName;
                move_uploaded_File($FileTmpName, $FileDestination);
                $Stmt = $Conn->prepare("INSERT INTO bills (uuid, PDFId, PDFName) VALUES (?, ?, ?)");
                $Stmt->bind_param("sss", $Uuid, $NewFileName, $FileName);
                $Stmt->execute();

                $Stmt = $Conn->prepare("SELECT Email FROM User WHERE Uuid = ?");
                $Stmt->bind_param("s", $Uuid); // Assuming $uuid is a string
                $Stmt->execute();
                $Result = $Stmt->get_result();
                $row = $Result->fetch_assoc();
                $ReceiverMail = $row['Email'];
                $MSubject = "Factuur";
                $MText = ".";
                MailSender($ReceiverMail,$MSubject,$MText,$FileDestination);

                header("Location: factuur.php");
                exit();
            }   
            else 
            {
                echo "The File size was too big.";
            }
        } 
        else 
        {
            echo "There was an error when uploading the File.";
        }
    } 
    else 
    {
        echo "You cannot upload Files of this type.";
    }
} 
else 
{
    echo "Form not submitted.";
}
?>
