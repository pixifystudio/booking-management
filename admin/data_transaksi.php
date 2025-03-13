<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";

        $mySql   = "SELECT * FROM booking order by tanggal desc";
        $myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
        $nomor  = 0;
        $data = array();
        while ($myData = mysqli_fetch_array($myQry)) {
            $nomor++;
            $Code = $myData['id'];
            $nama[] = $myData['nama'];
            $tanggal[] = $myData['tanggal'];
            $jam[] = $myData['jam'];
            $no_wa[] = $myData['nama'];
            $paket[] = $myData['nama'];
            $background[] = $myData['background'];
            $status[] = $myData['status'];
        }
        ?>