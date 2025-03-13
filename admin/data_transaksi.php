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
  

    // Query untuk bar pertama (Booking)
    $sql1 = "SELECT 
                DATE_FORMAT(tanggal, '%Y-%m-%d') AS `date`,
                COUNT(id) AS total_transaksi
            FROM booking
            GROUP BY `date`
            ORDER BY `date` DESC;";
    
    $result1 = $conn->query($sql1);
    
    $labels = [];
    $bookingData = [];
    
    while ($row = $result1->fetch_assoc()) {
        $labels[] = $row["date"];
        $bookingData[] = $row["total_transaksi"];
    }
    
    // Query untuk bar kedua (Inventory)
    $sql2 = "SELECT 
                DATE(t.updated_date) AS tanggal, 
                SUM(t.qty) AS total_qty
            FROM transaction t
            LEFT JOIN master_product mp ON t.keterangan = mp.name
            WHERE mp.type = 'inventory'
            GROUP BY DATE(t.updated_date)
            ORDER BY tanggal;";
    
    $result2 = $conn->query($sql2);
    
    $inventoryData = [];
    
    while ($row = $result2->fetch_assoc()) {
        $inventoryData[] = $row["total_qty"];
    }
    
    $conn->close();
    ?>

    <script>
        const ctx = document.getElementById('transaksiChart').getContext('2d');
        const transaksiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [
                    {
                        label: 'Booking',
                        data: <?php echo json_encode($bookingData); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Inventory',
                        data: <?php echo json_encode($inventoryData); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
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

        