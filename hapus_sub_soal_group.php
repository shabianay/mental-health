<?php
require_once "./include/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_subkriteria = $_GET['id'];

    // Delete the question from the database
    $query = "DELETE FROM subkriteria WHERE id_subkriteria = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_subkriteria);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Redirect to the list of questions with a success message
            header("Location: ./admin/sub_soal_group.php?success=delete");
            exit();
        } else {
            echo "Error: Failed to delete the question!";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request!";
}
