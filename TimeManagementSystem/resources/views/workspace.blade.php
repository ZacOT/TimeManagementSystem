<!DOCTYPE html>
<html lang="en">

@include('header')

<title>TMS - Kanban Board</title>
<link href="<?php echo asset('css/workspace.css') ?>" rel="stylesheet">
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">

    <body>
        <div class="wraper">
            @include('sidebar')

            <div class="dashboard">
                <div class="workspace-header">
                    <text><b>Welcome, {{ Auth::user()->f_name; }} {{ Auth::user()->l_name; }} to your Workspace</b></text>
                </div>
                <div class="workspace-container">
                    @foreach($kboards as $kboard)
                    <div class="kanban-container" onclick="location.href='/kanban?kboard_id={{ $kboard->kboard_id }}';" style="cursor: pointer;">
                        <div class="kanban-content">
                            <div class="tcell"><a class="nostyle">{{ $kboard->name }}</div>
                            <div class="tcell">{{ $kboard->description }}</div>
                        </div>
                    </div>
                    @endforeach

                    <div class="create-board" style="cursor: pointer;" data-modal-target="#modal">
                        <div class="create-content">+ Create new Board</div>
                    </div>
                </div>
                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title">Create Board</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('insertkanbanboard') }}" method="post" id="objform">
                            @csrf
                            <input type="text" name="kbname" placeholder="Title" style="width:200px; margin-bottom:10px"></input><br>
                            <textarea name="description" placeholder="Description" form="objform" style="width:200px; height:70px"></textarea><br>
                            <input class="editbutton" type="submit" value="Create Board" />
                        </form>
                    </div>
                </div>
                <div id="overlay"></div>
            </div>
        </div>
    </body>


</body>

</html>