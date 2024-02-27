<?php
require_once "./include/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_soal'])) {
    $id_soal = $_POST['id_soal'];
    $questionText = $_POST['questionText'];
    $questionGroup = $_POST['questionGroup'];
    $nilaiA = $_POST['nilaiA'];
    $nilaiB = $_POST['nilaiB'];

    // Update the question data in the database
    $query = "UPDATE questions SET question_text = ?, question_group = ?, nilai_a = ?, nilai_b = ? WHERE id_soal = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "siiii", $questionText, $questionGroup, $nilaiA, $nilaiB, $id_soal);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            // Redirect to the question list page with a success message
            header("Location: ./admin/soal.php?success=update");
            exit();
        } else {
            echo "Error updating question: " . mysqli_error($koneksi);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
