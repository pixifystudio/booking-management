<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include_once "library/inc.seslogin.php";
include "library/inc.connection.php";
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
        