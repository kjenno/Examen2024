<?php
session_start();
include("mail.php");
include("DatabaseConnection.php");

if (isset($_POST['submit'])) {
    $action = $_POST['action'];

    if ($action == 'request_code') {
        // Handle code request
        $email = $_POST['email'];
        $MSubject = "Wachtwoord Vergeten";
        $_SESSION['code'] = mt_rand(100000, 999999);
        $_SESSION['email'] = $email;
        $MText = $_SESSION['code'];
        $File = "";
        MailSender($email, $MSubject, $MText, $File);
        header("Location: wachtwoord-vergeten2.php");

    } elseif ($action == 'reset_password') {
        // Handle password reset
        $code = $_POST['code'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        // Verify the code matches the one stored in session
        if ($code == $_SESSION['code']) {
            if ($password == $password_confirm) {
                $Password = password_hash($password, PASSWORD_DEFAULT);
                $email = $_SESSION['email'];
                $stmt = $conn->prepare("UPDATE user SET Password = ? WHERE email = ?");
                $stmt->bind_param("ss", $Password, $email); // "ss" means both parameters are strings
                $stmt->execute();
                $stmt->close();
                $conn->close();
                session_unset();
                echo "Wachtwoord succesvol gewijzigd.";
            } else {
                echo "Wachtwoorden komen niet overeen.";
            }
        } else {
            echo "Verkeerde code.";
        }
    }
}
?>
