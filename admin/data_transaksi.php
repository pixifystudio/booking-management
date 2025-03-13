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
   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart with Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="lineChart"></canvas>
    <script>
        document.addEventListener("DOMContentLoaded", async function () {
            try {
                const response = await fetch(window.location.href);
                const data = await response.json();
                
                const labels = data.map(d => d.bulan);
                const totalNominalIN = data.map(d => d.total_nominal_IN);
                const totalNominalOUT = data.map(d => d.total_nominal_OUT);
                const selisihNominal = data.map(d => d.selisih_nominal);
                
                const ctx = document.getElementById("lineChart").getContext("2d");
                new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "Total Nominal IN",
                                data: totalNominalIN,
                                borderColor: "green",
                                fill: false
                            },
                            {
                                label: "Total Nominal OUT",
                                data: totalNominalOUT,
                                borderColor: "red",
                                fill: false
                            },
                            {
                                label: "Selisih Nominal",
                                data: selisihNominal,
                                borderColor: "blue",
                                fill: false
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Trend Transaksi 5 Bulan Terakhir'
                            }
                        }
                    }
                });
            } catch (error) {
                console.error("Error fetching chart data:", error);
            }
        });
    </script>
</body>
        