<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";
?>

<?php
header('Content-Type: application/json');


$query = "
WITH monthly_data AS (
    SELECT 
        DATE_FORMAT(updated_date, '%Y-%m') AS bulan,
        SUM(qty) AS total_qty,
        SUM(nominal) AS total_nominal,
        status
    FROM (
        SELECT 
            qty, 
            nominal, 
            status, 
            updated_date
        FROM transaction 
        WHERE keterangan != 'DP' 
            AND updated_date >= '2025-03-07 00:00:00'

        UNION ALL 

        SELECT 
            dd.qty AS qty, 
            dd.nominal AS nominal, 
            'IN' AS status, 
            d.updated_date
        FROM data_qr_detail dd 
        LEFT JOIN data_qr d ON dd.transaction_id = d.transaction_id 
        WHERE item != 'DP' 
            AND d.updated_date >= '2025-03-07 00:00:00'
    ) AS combined_data
    GROUP BY bulan, status
)
SELECT 
    bulan,
    SUM(CASE WHEN status = 'IN' THEN total_qty ELSE 0 END) AS total_qty_IN,
    SUM(CASE WHEN status = 'OUT' THEN total_qty ELSE 0 END) AS total_qty_OUT,
    SUM(CASE WHEN status = 'IN' THEN total_nominal ELSE 0 END) AS total_nominal_IN,
    SUM(CASE WHEN status = 'OUT' THEN total_nominal ELSE 0 END) AS total_nominal_OUT,
    SUM(CASE WHEN status = 'IN' THEN total_nominal ELSE 0 END) 
      - SUM(CASE WHEN status = 'OUT' THEN total_nominal ELSE 0 END) AS selisih_nominal
FROM monthly_data
GROUP BY bulan
ORDER BY bulan;
";

$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();
// echo json_encode($data);
?>
   
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart dengan 3 Baris</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                datasets: [
                    {
                        label: 'Data 1',
                        data: [10, 20, 15, 25, 30, 40],
                        borderColor: 'red',
                        fill: false
                    },
                    {
                        label: 'Data 2',
                        data: [5, 15, 10, 20, 25, 35],
                        borderColor: 'blue',
                        fill: false
                    },
                    {
                        label: 'Data 3',
                        data: [8, 18, 12, 22, 28, 38],
                        borderColor: 'green',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>
</html>
        