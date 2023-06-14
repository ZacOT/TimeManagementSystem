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
                <input type="text" placeholder="Title"></text>
                <div class="theader">
                    <div class="thcell">Objective:</div>
                    <div class="thcell">Description:</div>
                    <div class="thcell">Semester:</div>
                </div>
                <div class="tbody">
                    <div class="tcell"><a class="nostyle" href="">Object</a></div>
                    <div class="tcell"></div>
                    <div class="tcell"></div>
                </div>
            </div>
        </div>
    </body>


</body>

</html>