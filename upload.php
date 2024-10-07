<?php
include("DatabaseConnection.php");
include("mail.php");


if (isset($_POST['submit'])) 
{

    $file = $_FILES['file'];
    $uuid = $_POST['user'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));


    $allowed = array('pdf', 'jpg', 'jpeg', 'png');


    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $newFileName = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'Uploads/' . $newFileName;
                move_uploaded_file($fileTmpName, $fileDestination);
                $stmt = $conn->prepare("INSERT INTO bills (uuid, PDFId, PDFName) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $uuid, $newFileName, $fileName);
                $stmt->execute();

                $stmt = $conn->prepare("SELECT Email FROM User WHERE Uuid = ?");
                $stmt->bind_param("s", $uuid); // Assuming $uuid is a string
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $ReceiverMail = $row['Email'];
                $MSubject = "Factuur";
                $MText = ".";
                MailSender($ReceiverMail,$fileDestination,$MSubject,$MText);

                header("Location: denis-pagina.php");
                exit();
            }   
            else 
            {
                echo "The file size was too big.";
            }
        } 
        else 
        {
            echo "There was an error when uploading the file.";
        }
    } 
    else 
    {
        echo "You cannot upload files of this type.";
    }
} 
else 
{
    echo "Form not submitted.";
}
?>
