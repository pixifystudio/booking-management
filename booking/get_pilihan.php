<?php
// Load file koneksi.php
include "library/inc.connection.php";


// Ambil data ID kategori yang dikirim via ajax post
// $part_number = $_POST['kategori'];
$Channel    = explode("|", $_POST['kategori']);
$jenis   = $Channel[0];
// 28250-K0J -N000

// defaul isi validasi
$validasi = 'NO';
$html = "";
// validasi apakah mempunya sub part atau tidak
$sql = mysqli_query($koneksidb, "SELECT * FROM master_jenis where jenis='$jenis' ORDER BY jenis asc");
// $cekQry = mysqli_query($koneksidb, $sql) or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
if (mysqli_num_rows($sql) >= 1) {
	$validasi = 'YES';
}


// end validasi
if ($validasi != 'YES') {
	$html .= "Jenis Foto belum ditentukan."; // Tambahkan tag option ke variabel $htm
} else {
	while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
		$html .= "<option value='" . $data['paket'] . "'>" . $data['paket'] . "    </option>"; // Tambahkan tag option ke variabel $html
	}
}
// // Buat query untuk menampilkan data sub part dengan part number alias tertentu(sesuai yang dipilih user pada form)
// $sql = mysqli_query($koneksidb, "SELECT * FROM master_material where product_id='$part_number' ORDER BY product_id");

$callback = array('data_subkategori' => $html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota

echo json_encode($callback); // konversi varibael $callback menjadi JSON


// Buat variabel untuk menampung tag-tag option nya
// Set defaultnya dengan tag option Pilih
// $html = "<option value=''>Pilih</option>";
