<?php
include_once "library/inc.seslogin.php";

// Periksa ada atau tidak variabel Code pada URL (alamat browser)
if(isset($_GET['id'])){
	
	$mySql = "DELETE FROM master_racking WHERE racking_id='".$_GET['id']."'";
	$myQry = mysqli_query($koneksidb,$mySql) or die ("Eror hapus data".mysqli_error($koneksidb));
	
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=?page=Bookshelf'>";
	}
}
else {
	// Jika tidak ada data Code ditemukan di URL
	echo "<b>Data does not exist!</b>";
}
?>