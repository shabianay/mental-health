<?php
require_once "./include/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_alternatif = $_GET['id'];

    // Delete the question from the database
    $query = "DELETE FROM alternatif WHERE id_alternatif = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_alternatif);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Redirect to the list of questions with a success message
            header("Location: ./admin/alternatif.php?success=delete");
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
