<!DOCTYPE html>
<html lang="en">

    @include('header')

    <title>TMS - Kanban Board</title>
    <link href="<?php echo asset('css/okr.css') ?>" rel="stylesheet">
    <script defer src="<?php echo asset('js/kanban.js') ?>"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">

    <body>
        <div class="wraper">
            @include('sidebar')

            <div class="dashboard">
                <div>
                    ATTENDANCE
                </div>
                <div>
                    LEAVE APPLICATION
                </div>
            </div>
        </div>
    </body>


</body>

</html>