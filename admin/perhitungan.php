<?php

require_once "../include/koneksi.php";
$sql = "SELECT name FROM soal_group";
$result = mysqli_query($koneksi, $sql); // Menggunakan $sql bukan $query

if (!$result) {
    // Error saat mengambil data dari database
    die("Query error: " . mysqli_error($koneksi));
}
mysqli_fetch_assoc($result);
// Tampilkan data dalam tabel
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Kriteria</th>
            </tr>";
    // Output data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
// Matriks kriteria
$matrix_criteria = [
    [1, 1 / 2, 1 / 3, 1 / 4],    // Kriteria 1
    [2, 1, 1 / 2, 1 / 3],      // Kriteria 2
    [3, 2, 1, 1 / 2],        // Kriteria 3
    [4, 3, 2, 1]           // Kriteria 4
];

// Bobot kriteria
$criteria_weights = [0.4, 0.3, 0.2, 0.1];


// Hitung total bobot kriteria
$total_criteria_weight = array_sum($criteria_weights);

// Normalisasi matriks keputusan
$normalized_matrix = [];
foreach ($matrix_criteria as $row) {
    $normalized_row = [];
    foreach ($row as $value) {
        $normalized_row[] = $value / array_sum($row);
    }
    $normalized_matrix[] = $normalized_row;
}

// Hitung nilai kriteria
$criteria_values = [];
foreach ($normalized_matrix as $row) {
    $sum = 0;
    foreach ($row as $key => $value) {
        $sum += $value * $criteria_weights[$key];
    }
    $criteria_values[] = $sum;
}

// Hitung eigen vektor
$eigen_vector = [];
foreach ($matrix_criteria as $key => $row) {
    $sum = 0;
    foreach ($row as $inner_key => $value) {
        $sum += $value * $criteria_values[$inner_key];
    }
    $eigen_vector[] = $sum;
}

// Hitung nilai konsistensi
$lambda_max = array_sum($eigen_vector) / 3;
$consistency_index = ($lambda_max - 3) / 2;
$random_index = 0.58; // Nilai ini bisa dilihat dari tabel referensi AHP
$consistency_ratio = $consistency_index / $random_index;

// Hitung perankingan
$ranking = [];
foreach ($normalized_matrix as $key => $row) {
    $sum = 0;
    foreach ($row as $inner_key => $value) {
        $sum += $value * $criteria_values[$inner_key];
    }
    $ranking[] = $sum;
}

// Tampilkan hasil
echo "<h2>Matriks Keputusan</h2>";
echo "<table border='1'>";
foreach ($matrix_criteria as $row) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "<h2>Matriks Keputusan yang Dinormalisasi</h2>";
echo "<table border='1'>";
foreach ($normalized_matrix as $row) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "<h2>Nilai Kriteria</h2>";
echo "<table border='1'>";
echo "<tr>";
foreach ($criteria_values as $value) {
    echo "<td>$value</td>";
}
echo "</tr>";
echo "</table>";

echo "<h2>Eigen Vektor</h2>";
echo "<table border='1'>";
echo "<tr>";
foreach ($eigen_vector as $value) {
    echo "<td>$value</td>";
}
echo "</tr>";
echo "</table>";

echo "<h2>Perankingan</h2>";
echo "<table border='1'>";
echo "<tr>";
foreach ($ranking as $value) {
    echo "<td>$value</td>";
}
echo "</tr>";
echo "</table>";
