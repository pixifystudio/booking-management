<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";



// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if (isset($_GET['id'])) {

    // cek sebelum di hapus
    $mySql3   = "SELECT * FROM data_qr_detail WHERE id='" . $_GET['id'] . "' ";
    $myQry3 = mysqli_query($koneksidb, $mySql3) or die("PIXIFY ERROR : " . mysqli_error($koneksidb));
    $myData3 = mysqli_fetch_array($myQry3);

    $stock_order_id = $myData3['stock_order_id'];

    // hapus stock order nya
    $mySql = "DELETE FROM master_product_stock WHERE id='$stock_order_id '";
    $myQry = mysqli_query($koneksidb, $mySql) or die("PIXIFY ERROR : " . mysqli_error($koneksidb));

    $id = $_GET['id2'];
    // Delete data sesuai Code yang didapat di URL
    $mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
	VALUES ('data_qr_detail','" . $_GET['id'] . "','" . $_SESSION['SES_NAMA'] . "', NOW())";
    $myQry1 = mysqli_query($koneksidb, $mySql1) or die("PIXIFY ERROR : " . mysqli_error($koneksidb));

    $mySql = "DELETE FROM data_qr_detail WHERE id='" . $_GET['id'] . "'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("PIXIFY ERROR : " . mysqli_error($koneksidb));

    // cek setelah di hapus
    $mySql2   = "SELECT * FROM data_qr_detail WHERE transaction_id ='" . $_GET['id2'] . "' ";
    $myQry2 = mysqli_query($koneksidb, $mySql2) or die("PIXIFY ERROR : " . mysqli_error($koneksidb));
    $jumlahdata = mysqli_num_rows($myQry2);

    // kalau data kosong, qr nya di hapus
        if ($jumlahdata < 1) {
        $mySql = "DELETE FROM data_qr WHERE transaction_id='" . $_GET['id2'] . "'";
        $myQry = mysqli_query($koneksidb, $mySql) or die("PIXIFY ERROR : " . mysqli_error($koneksidb));
        $id = '';
        }


    if ($myQry) {
        // Refresh halaman
        echo "<meta http-equiv='refresh' content='0; url=?page=Management-Booking-QR-Add&id=$id&s=deleted'>";
    }
} else {
    // Jika tidak ada data Code ditemukan di URL
    echo "<b>Data does not exist!</b>";
}
