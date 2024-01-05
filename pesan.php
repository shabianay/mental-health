<?php
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the 'isi_pesan' key exists in the $_POST array
    if (isset($_POST['isi_pesan'])) {
        // Sanitize the input to prevent SQL injection
        $pesan = mysqli_real_escape_string($koneksi, $_POST['isi_pesan']);

        // Query the database to find the response based on the input
        $cek_data = mysqli_query($koneksi, "SELECT jawaban FROM chatbot WHERE pertanyaan LIKE '%$pesan%' ");

        // If a response is found, echo it back
        if (mysqli_num_rows($cek_data) > 0) {
            $data = mysqli_fetch_assoc($cek_data);
            $balasan = $data['jawaban'];
            echo $balasan;
        } else {
            echo "Maaf, aku nggak paham yang kamu maksud :(";
        }
    } else {
        echo "Maaf, tidak ada pesan yang diterima.";
    }
} else {
    echo "Invalid request method.";
}
