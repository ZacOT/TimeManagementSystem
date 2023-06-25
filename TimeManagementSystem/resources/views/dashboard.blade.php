@include('header')
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css')?>" type="text/css">
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<script src="<?php echo asset('js\chart.js-4.3.0\package\dist\chart.umd.js') ?>" type="text/javascript"></script>

<body>
    <div class="wraper">
        @include('sidebar')
        <div class="dashboard">
            <div style="text-align:center">Welcome, {{ Auth::user()->f_name; }} to your Dashboard</div>
            <div class="progress_graphs">
            PROGRESS
                <div class="graph_div">
                    <canvas id="graphChart" height="300" width="300"></canvas>
                </div>
                <div class="graph_div">
                    <canvas id="graphChart2" height="300" width="300"></canvas>
                </div>
                <div class="graph_div">
                    <canvas id="graphChart3" height="300" width="300"></canvas>
                </div>
            </div>
            <div class="notifications">
                Notications
            </div>
            <div class="notes">
                Notes
            </div>
        </div>
    </div>
    

</body>

<script>
    var ctx = document.getElementById("graphChart");
    var ctx2 = document.getElementById("graphChart2");
    var ctx3 = document.getElementById("graphChart3");
    var dashboardChart = new Chart(ctx, {
        type: 'doughnut',
    data: {
        labels: ["Complete", "Incomplete"],
        datasets: [{
            label: '%',
            data: [50,50],
            backgroundColor: [
                'blue','red'
            ],
            borderwidth:1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        rotation: 270,
        circumference: 180
    }
    });


    var dashboardChart = new Chart(ctx2, {
        type: 'doughnut',
    data: {
        labels: ["Complete", "Incomplete"],
        datasets: [{
            label: '%',
            data: [50,50],
            backgroundColor: [
                'blue','red'
            ],
            borderwidth:1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        rotation: 270,
        circumference: 180
    }
    });

    var dashboardChart = new Chart(ctx3, {
        type: 'doughnut',
    data: {
        labels: ["Complete", "Incomplete"],
        datasets: [{
            label: '%',
            data: [50,50],
            backgroundColor: [
                'blue','red'
            ],
            borderwidth:1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        rotation: 270,
        circumference: 180
    }
    });
</script>
