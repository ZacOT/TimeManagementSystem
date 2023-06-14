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
                <div class="objective">
                    <p>Objective:</p>
                    <p>Description:</p>
                    <p>Semester:</p>
                </div>
                <div class="krcontainer">
                    <div class="krtitle">
                        <p>Key Result:</p>
                    </div>
                    <div class="krcontent">
                        <p>Description:</p>
                        <p>Due:</p>
                        <p>Status:</p>
                    </div>
                </div>

            </div>
        </div>
    </body>


</body>

</html>