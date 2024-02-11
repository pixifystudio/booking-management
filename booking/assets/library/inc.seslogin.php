<?php

if(empty($_SESSION['SES_LOGIN'])) {
	echo "<div class='panel-body'><div class='alert alert-warning ' align='center'>";
	echo "<b>Maaf Akses Anda Ditolak!</b> <br>
		  Silahkan masukkan Data Login Anda dengan benar untuk bisa mengakses aplikasi ini.";
	echo "</div>";
	include_once "login.php";
	exit;
}
$formattedMonthArray = array(
                    "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                    "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                    "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                );
$monthArray = range(1, 12);
$yearArray = range(2017, 2023);
?>