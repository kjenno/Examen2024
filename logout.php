<?php
// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page (or homepage)
header("Location: login.php"); // replace 'login.php' with the appropriate page
exit();
?>
