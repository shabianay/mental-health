<?php
require_once "./include/koneksi.php";

// Check if the HTTP POST request method is used
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sehat = $_POST['sehat'];
    $perlu_perhatian = $_POST['perlu_perhatian'];
    $butuh_penanganan = $_POST['butuh_penanganan'];

    // Update the Soal Group in the database
    $query = "UPDATE `soal_group` SET name = ?, sehat = ?, perlu_perhatian = ?, butuh_penanganan = ? WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sdddi", $name, $sehat, $perlu_perhatian, $butuh_penanganan, $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If the update was successful, redirect to the appropriate page with a success message
            header("Location: ./admin/soal_group.php?success=update");
            exit();
        } else {
            // If there was an error with the update, display an error message
            echo "Error updating Soal Group: " . mysqli_error($koneksi);
        }
    } else {
        // If there was an error with the prepared statement, display an error message
        echo "Error preparing statement: " . mysqli_error($koneksi);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If the request method is not POST, redirect to the appropriate page
    header("Location: ./admin/soal_group.php");
    exit();
}

// Close the connection
mysqli_close($koneksi);
