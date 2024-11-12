<?php
session_start();
include("mail.php");
include("DatabaseConnection.php");

if (isset($_POST['submit'])) {
    $Action = $_POST['action'];

    if ($Action == 'request_code') {
        $Email = $_POST['email'];
        $MSubject = "Wachtwoord Vergeten";
        $_SESSION['code'] = mt_rand(100000, 999999);
        $_SESSION['email'] = $Email;
        $MText = $_SESSION['code'];
        $File = "";
        MailSender($Email, $MSubject, $MText, $File);
        header("Location: wachtwoord-instellen.php");

    } elseif ($Action == 'reset_password') {
        // Handle password reset
        $Code = $_POST['code'];
        $Password = $_POST['password'];
        $PasswordConfirm = $_POST['password_confirm'];

        // Verify the code matches the one stored in session
        if ($Code == $_SESSION['code']) {
            if ($Password == $PasswordConfirm) {
                $Password = password_hash($Password, PASSWORD_DEFAULT);
                $Email = $_SESSION['email'];
                $Stmt = $Conn->prepare("UPDATE user SET Password = ? WHERE email = ?");
                $Stmt->bind_param("ss", $Password, $Email); // "ss" means both parameters are strings
                $Stmt->execute();
                $Stmt->close();
                $Conn->close();
                session_unset();
                header("Location: login.php");
            } else {
                $Message = "Wachtwoorden komen niet overeen.";
                header("Location: wachtwoord-instellen.php?var1=" . urlencode($Message));
            }
        } else {
            $Message = "Code onjuist.";
            header("Location: wachtwoord-instellen.php?var1=" . urlencode($Message));
        }
    }
}
?>
