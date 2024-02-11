<?php
include "inc.connection.php";
// Query SQL untuk mendapatkan data
$mySql   = "SELECT * FROM booking order by tanggal desc";
$result = $conn->query($mySql);

// Inisialisasi array untuk menyimpan data
$data = array();

// Memeriksa hasil query
if ($result->num_rows > 0) {
// Menyusun data ke dalam array
while ($row = $result->fetch_assoc()) {
$data[] = $row;
}
}

// Menutup koneksi ke database
$conn->close();

// Mengonversi array ke dalam format JSON
$json_data = json_encode(["data" => $data], JSON_PRETTY_PRINT);

// Menampilkan JSON
echo $json_data;
?>