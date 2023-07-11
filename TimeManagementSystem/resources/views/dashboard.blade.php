@include('header')
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css')?>" type="text/css">
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<script src="<?php echo asset('js\chart.js-4.3.0\package\dist\chart.umd.js') ?>" type="text/javascript"></script>

<body>
    <div class="wraper">
        @include('sidebar')
        <div class="dashboard">
            <div style="text-align:center">Welcome, {{ Auth::user()->f_name; }} to your Dashboard</div>
            <div style="background-color:black; color:white; margin-top:50px">Notifications</div>
            <div class="notification_container">
                <div class="noti_div">
                    <a href="" style="text-decoration:none; color:blue">Class Absent Notice</a>
                    <p>You were marked absent for Course1 Lab CS4 on the 27-06-2023</p>
                </div>
            </div>
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
        plugins:{
        title:{
            display:true,
            text: 'OKR',
        }
    },
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
