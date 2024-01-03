<?php
// Include database connection
include "koneksi.php";

// Check if the HTTP POST request method is used
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $normalWeight = $_POST['normal_weight'];
    $perbatasanWeight = $_POST['perbatasan_weight'];
    $abnormalWeight = $_POST['abnormal_weight'];

    // Update the Soal Group in the database
    $query = "UPDATE `soal_group` SET name = ?, normal_weight = ?, perbatasan_weight = ?, abnormal_weight = ? WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sdddi", $name, $normlaWeight, $perbatasanWeight, $abnormalWeight, $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If the update was successful, redirect to the appropriate page with a success message
            header("Location: soal_group.php?success=update");
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
    header("Location: soal_group.php");
    exit();
}

// Close the connection
mysqli_close($koneksi);
