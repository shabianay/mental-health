<?php
// Check if a session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}

// Perform logout logic here, such as unsetting session variables and destroying the session

// Redirect to the login page after logout
header("Location: login.php");
exit();
?>
