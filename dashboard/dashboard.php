<?php
require_once 'action.php';

$objct = new Graph();

$data = $objct->getPeminjam();

?>
<style>
    @media(max-width: 720px) { 
        .chart-container  {
            min-height: 100vh; 
        };
    };
</style>
<div class="x_panel">
    <div class="x_title">
        <h2>Grafik Peminjaman</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li>
                <a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content d-flex justify-content-center">
        <div class="chart-container row justify-content-center" style="position: relative; height:40vh; width:80vw">
            <canvas id="myChart"></canvas>
            <canvas id="myPie"></canvas>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    const cty = document.getElementById('myPie');
    const data = <?php echo json_encode(array_values($data)); ?>;

// Chart
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: '# Jumlah Peminjam',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                beginAtZero: false
                }
            }
        }
    });
// \Chart

//  Pie
new Chart(cty, {
    type : 'doughnut',
    data : {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
            label: 'Jumlah Peminjam',
            data: data,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
            hoverOffset: 4
        }]
        }
    });
</script>