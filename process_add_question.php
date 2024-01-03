<?php
include "koneksi.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $questionText = $_POST['questionText'];
    $questionGroupId = $_POST['questionGroup'];
    $nilaiA = $_POST['nilaiA'];
    $nilaiB = $_POST['nilaiB'];
    $nilaiC = $_POST['nilaiC'];
    $opsiA = $_POST['opsiA'];
    $opsiB = $_POST['opsiB'];
    $opsiC = $_POST['opsiC'];

    // Insert data into the database
    $insertQuery = "INSERT INTO questions (question_group_id, nilai_a, nilai_b, nilai_c, opsi_a, opsi_b, opsi_c, question_text) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $insertQuery);
    mysqli_stmt_bind_param($stmt, "iiisssss", $questionGroupId, $nilaiA, $nilaiB, $nilaiC, $opsiA, $opsiB, $opsiC, $questionText);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // If insertion is successful, redirect back to the form page with success message
        header("Location: soal.php?success=add");
        exit();
    } else {
        // If there was an error with the insertion, display an error message
        echo "Error: " . mysqli_error($koneksi);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
