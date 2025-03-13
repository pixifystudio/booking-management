<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";

        $sql = "SELECT 
                        MONTH(tanggal) AS bulan, 
                        YEAR(tanggal) AS tahun,
                        COUNT(id) AS total_transaksi
                    FROM booking
                    GROUP BY YEAR(tanggal), MONTH(tanggal)
                    ORDER BY tahun DESC, bulan DESC;";
        $result = $conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
        $conn->close();

        ?>

        