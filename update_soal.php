<?php
require_once "./include/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_soal'])) {
    $id_soal = $_POST['id_soal'];
    $questionText = $_POST['questionText'];
    $nilaiA = $_POST['nilaiA'];
    $nilaiB = $_POST['nilaiB'];
    $nilaiC = $_POST['nilaiC'];
    $opsiA = $_POST['opsiA'];
    $opsiB = $_POST['opsiB'];
    $opsiC = $_POST['opsiC'];

    // Update the question data in the database
    $query = "UPDATE questions SET question_text = ?, nilai_a = ?, nilai_b = ?, nilai_c = ?, opsi_a = ?, opsi_b = ?, opsi_c = ? WHERE id_soal = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "siiisssi", $questionText, $nilaiA, $nilaiB, $nilaiC, $opsiA, $opsiB, $opsiC, $id_soal);
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
} else {
    echo "Invalid request!";
}
