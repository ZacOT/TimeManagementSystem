<!DOCTYPE html>
<html lang="en">

    @include('header')

    <title>TMS - Kanban Board</title>
    <link href="<?php echo asset('css/okr.css') ?>" rel="stylesheet">
    <link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
    <script defer src="<?php echo asset('js/popup.js') ?>"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">

    <body>
        <div class="wraper">
            @include('sidebar')

            <div class="dashboard">
                    <div class="theader">
                        <div class="thcell">Objective:</div>
                        <div class="thcell">Description:</div>
                        <div class="thcell">Semester:</div>
                    </div>
                    <div class="tbody">
                    @foreach($objectives as $objective)
                    <div class="trow">
                        <div class="tcell"><a class="nostyle" href="/okr?id={{$objective->obj_id}}">{{ $objective->title }}</a></div>
                        <div class="tcell">{{ $objective->description }}</div>
                        <div class="tcell">{{ $objective->sem_name }}</div>
                    </div>
                    @endforeach
                    <div class="trow">
                        <div class="tcell" style="background-color:palegreen;"><a class="add" data-modal-target="#modal">+ ADD AN OBJECTIVE</a></div>
                    </div>
                </div>
                <div class="modal" id="modal">
                            <div class="modal-header">
                                <div class="title">Add Objective</div>
                                <button data-close-button class="close-button">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('objectives') }}" method="post" id="objform">
                                    @csrf
                                    <input type="text" name="title" placeholder="Title" style="width:200px; margin-bottom:10px"></input><br>
                                    <textarea name="description" placeholder="Description" form="objform" style="width:200px; height:70px"></textarea><br>
                                    <label for="semester">Semester:</label>
                                    <select id="semester" name="semester">
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->sem_id}}">{{ $semester->sem_name }}</option>
                                        @endforeach
                                    </select><br>
                                    <input class="editbutton" type="submit" value="Add Objective"/>
                                </form>
                            </div>
                        </div>
                        <div id="overlay"></div>
            </div>
        </div>
    </body>


</body>

</html>