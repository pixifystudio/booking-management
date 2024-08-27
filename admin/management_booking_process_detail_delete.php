<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";



// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if (isset($_GET['id'])) {

    // ambil data stock order id untuk hapus stock order id

    $mySqlBooking = "SELECT * FROM `booking_detail` where id = '" . $_GET['id'] . "'";
    $myQryBooking = mysqli_query($koneksidb, $mySqlBooking) or die("Query Insert Salah : " . mysqli_error($koneksidb));
    $DataBooking = mysqli_fetch_array($myQryBooking);

    $stockorderid = $DataBooking['stock_order_id'];

    $mySql2 = "DELETE FROM master_product_stock WHERE id='$stockorderid'";
    $myQry2 = mysqli_query($koneksidb, $mySql2) or die("PIXIFY ERROR 1: " . mysqli_error($koneksidb));

    $id2 = $_GET['id2'];
    // Delete data sesuai Code yang didapat di URL
    $mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
	VALUES ('booking','" . $_GET['id'] . "','" . $_SESSION['SES_NAMA'] . "', NOW())";
    $myQry1 = mysqli_query($koneksidb, $mySql1) or die("PIXIFY ERROR 2: " . mysqli_error($koneksidb));

    $mySql = "DELETE FROM booking_detail WHERE id='" . $_GET['id'] . "'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("PIXIFY ERROR 3: " . mysqli_error($koneksidb));
    if ($myQry) {
        // Refresh halaman
        echo "<meta http-equiv='refresh' content='0; url=?page=Management-Booking-Process-Detail&id=$id2'>";
    }
} else {
    // Jika tidak ada data Code ditemukan di URL
    echo "<b>Data does not exist!</b>";
}
