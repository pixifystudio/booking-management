<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";



// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if (isset($_GET['id'])) {
    $Code  = isset($_GET['id']) ?  str_replace(['_'], ' ',  $_GET['id']) : '';

    // Delete data sesuai Code yang didapat di URL
    $mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
	VALUES ('master_background','$Code','" . $_SESSION['SES_NAMA'] . "', NOW())";
    $myQry1 = mysqli_query($koneksidb, $mySql1) or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));

    $mySql = "DELETE FROM master_background WHERE background='$Code'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));

    if ($myQry) {
        // Refresh halaman
        echo "<meta http-equiv='refresh' content='0; url=?page=Master-Background&s=deleted'>";
    }
} else {
    // Jika tidak ada data Code ditemukan di URL
    echo "<b>Data does not exist!</b>";
}
