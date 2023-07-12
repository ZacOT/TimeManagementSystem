<!DOCTYPE html>
<html lang="en">

    @include('header')

    <title>TMS - Kanban Board</title>
    <link href="<?php echo asset('css/attendance.css') ?>" rel="stylesheet">
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">

    <body>
        <div class="wraper">
            @include('sidebar')

            <div class="dashboard">
                <div class="container">
                <div class="attcontainer">
                    <a href="/checkattendance">ATTENDANCE</a>
                </div>
                <div class="leavecontainer">
                    <a href="/applyleave">APPLY FOR LEAVE </a>
                </div>
                <div class="leavecontainer">
                    <a href="/leavelist">CHECK LEAVE APPLICATION</a>
                </div>
            </div>
            </div>
        </div>
    </body>


</body>

</html>