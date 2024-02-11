<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";



// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if (isset($_GET['id'])) {

    # CEK DATA AMBIL NAMA LAMA NYA

    $mySqlCek  = "SELECT jenis FROM master_jenis_head WHERE  id ='" . $_GET['id'] . "'";
    $myQryCek  = mysqli_query($koneksidb, $mySqlCek)  or die("Query ambil data salah : " . mysqli_error());
    $DataCek = mysqli_fetch_array($myQryCek);

    $dataJenisOld = $DataCek['jenis'];

    // Delete data sesuai Code yang didapat di URL
    $mySql1 = "INSERT INTO log_deleted  (table_name, table_id, deleted_by, deleted_date) 
	VALUES ('master_jenis_head','" . $_GET['id'] . "','" . $_SESSION['SES_NAMA'] . "', NOW())";
    $myQry1 = mysqli_query($koneksidb, $mySql1) or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));

    $mySql = "DELETE FROM master_jenis_head WHERE id='" . $_GET['id'] . "'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));

    // delete anak anak nya
    $mySql = "DELETE FROM master_jenis WHERE jenis='$dataJenisOld'";
    $myQry = mysqli_query($koneksidb, $mySql) or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
    if ($myQry) {
        // Refresh halaman
        echo "<meta http-equiv='refresh' content='0; url=?page=Master-Jenis&s=deleted'>";
    }
} else {
    // Jika tidak ada data Code ditemukan di URL
    echo "<b>Data does not exist!</b>";
}
