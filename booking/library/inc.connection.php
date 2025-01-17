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


# Memilih database pd MySQL Server
mysqli_select_db($koneksidb, "u480352240_pixify") or die ("Database not Found !");

$link ="https://pixify.id/";

?>
