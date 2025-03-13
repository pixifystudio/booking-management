<?php
# Konek ke Web Server Lokal
$myHost	= "127.0.0.1";
$myUser	= "u480352240_pixify";
$myPass	= "ForwardDigiCraft@123";
$myDbs	= "u480352240_pixify"; // nama database, disesuaikan dengan database di MySQL

# Konek ke Web Server Lokal
$koneksidb	= mysqli_connect($myHost, $myUser, $myPass);
if (! $koneksidb) {
  echo "Failed Connection !";
}

$conn = new mysqli($myHost, $myUser, $myPass, $myDbs);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set("Asia/Bangkok");


# Memilih database pd MySQL Server
mysqli_select_db($koneksidb, "u480352240_pixify") or die ("Database not Found !");

$link ="https://sf-selfstudio.com/";

?>
