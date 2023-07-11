<!DOCTYPE html>
<html lang="en">

    @include('header')

    <title>TMS - Kanban Board</title>
    <link href="<?php echo asset('css/admin.css') ?>" rel="stylesheet">
    <script defer src="<?php echo asset('js/kanban.js') ?>"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">

    <body>
        <div class="wraper">
            @include('sidebar')
            
                <div class="dashboard">
                <div class="container">
                    <div style="text-align:center;">Admin Control Panel</div>
                    <div style="text-align:center ;display:flex; width:1000px; margin-left:auto; margin-right:auto; margin-top:50px">
                        <div style="flex:1"><a href="manageusers"><img src="images/manageuser.png"/><br>Manage Users</a></div>
                        <div style="flex:1"><a href="managecourses"><img src="images/managecourse.png"><br>Manage Courses</a></div>
                        <div style="flex:1"><a href="managesemesters"><img src="images/managesemester.png"><br>Manage Semesters</a></div>
                        <div style="flex:1"><a href="manageclasstypes"><img src="images/class.png"><br>Manage Class Types</a></div>
                        <div style="flex:1"><a href="manageprograms"><img src="images/program.png"><br>Manage Programs</a></div>
                    </div>
                </div>
            </div>
        </div>
    </body>


</body>

</html>