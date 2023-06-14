@include('header')
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css')?>" type="text/css">
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<script src="<?php echo asset('js\chart.js-4.3.0\package\dist\chart.umd.js') ?>" type="text/javascript"></script>

<body>
    <div class="wraper">
        @include('sidebar')
        <div class="attendancelist">
            
        </div>
    </div>
    

</body>
