<?php
// Lakukan koneksi ke database
require_once '../include/koneksi.php';

// Array untuk nama-nama bulan
$months = array(
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
);

// Query untuk mengambil data dari tabel skrining
$query = "SELECT DATE_FORMAT(waktu, '%m') AS bulan, hasil, COUNT(*) AS total FROM skrining GROUP BY bulan, hasil";
$result = mysqli_query($koneksi, $query);

$data = array();

if ($result) {
    // Jika query berhasil, ambil data
    while ($row = mysqli_fetch_assoc($result)) {
        $bulan = $row['bulan'];
        $hasil = $row['hasil'];
        $total = $row['total'];

        // Tambahkan data ke array
        if (!isset($data[$bulan])) {
            $data[$bulan] = array(
                'bulan' => $bulan,
                'sehat' => 0,
                'butuh_penanganan' => 0,
                'perlu_perhatian' => 0,
            );
        }

        if ($hasil == 'Sehat') {
            $data[$bulan]['sehat'] += $total;
        } else if ($hasil == 'Butuh Penanganan') {
            $data[$bulan]['butuh_penanganan'] += $total;
        } else if ($hasil == 'Perlu Perhatian') {
            $data[$bulan]['perlu_perhatian'] += $total;
        }
    }

    // Urutkan data berdasarkan bulan
    ksort($data);

    // Ubah format bulan menjadi nama bulan dalam bahasa Indonesia
    foreach ($data as $key => $value) {
        $data[$key]['bulan'] = $months[intval($value['bulan']) - 1];
    }
} else {
    // Jika query gagal, tampilkan pesan error
    echo "Error: " . mysqli_error($koneksi);
}

// Mengembalikan data dalam format JSON
echo json_encode(array_values($data));

// Menutup koneksi database
mysqli_close($koneksi);
