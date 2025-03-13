<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";
?>
        <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart dari Database</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="transaksiChart"></canvas>


<?php
    $sql = "SELECT 
                MONTH(tanggal) AS bulan, 
                YEAR(tanggal) AS tahun,
                COUNT(id) AS total_transaksi
            FROM booking
            GROUP BY YEAR(tanggal), MONTH(tanggal)
            ORDER BY tahun DESC, bulan DESC;";
    
    $result = $conn->query($sql);
    
    $labels = [];
    $data = [];
    
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row["bulan"] . "-" . $row["tahun"];
        $data[] = $row["total_transaksi"];
    }
    
    $conn->close();
    ?>

    <script>
        const ctx = document.getElementById('transaksiChart').getContext('2d');
        const transaksiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total Transaksi',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

        