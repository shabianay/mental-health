<?php
// Start or resume the session
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Start the session if it's not already started
    }

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}

// Include database connection
include "koneksi.php";

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $query = "DELETE FROM `soal_group` WHERE id = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If the deletion was successful, redirect to the appropriate page with a success message
            header("Location: soal_group.php?success=delete");
            exit();
        } else {
            // If there was an error with the deletion, display an error message
            echo "Error deleting Soal Group: " . mysqli_error($koneksi);
        }
    } else {
        // If there was an error with the prepared statement, display an error message
        echo "Error preparing statement: " . mysqli_error($koneksi);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If the ID parameter is not provided in the URL, redirect to the appropriate page
    header("Location: soal_group.php");
    exit();
}

// Close the connection
mysqli_close($koneksi);
?>
