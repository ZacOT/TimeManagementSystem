<!DOCTYPE html>
<html lang="en">

@include('header')

<title>TMS - Kanban Board</title>
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<link href="<?php echo asset('css/kanban.css') ?>" rel="stylesheet">
<link href="<?php echo asset('css/okr.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
<script defer src="<?php echo asset('js/kanban.js') ?>"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">

    <body>
        <div class="wraper">
            @include('sidebar')
            <div class="dashboard">
                <div>
                    <button class="editbutton" data-modal-target="#modal" style="margin-top:25px;margin-left:110px;">Add Category</button>
                </div>


                <div class="drag-container">
                    <ul class="drag-list">

                        <li class="drag-column drag-column-on-hold">
                            <span class="drag-column-header">
                                <h2>To Do</h2>
                                <div style="display:flex;">
                                    <div>
                                        <button class="btn_add">+</button>
                                    </div>
                                    <button class="btn_option" data-modal-target="#ccmodal">
                                        <svg class="drag-header-more" data-target="options1" fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24">
                                            <path d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </span>
                            <div class="drag-options" id="options1"></div>
                            <ul class="drag-inner-list" id="1">
                                <a href="#" style="text-decoration:none; color:black;">
                                    <li class="drag-item"><b>To Do Many Things</b> <br><br><br>Due: 03-07-2023</li>
                                </a>
                            </ul>
                        </li>

                        <li class="drag-column drag-column-on-hold">
                            <span class="drag-column-header">
                                <h2>On Hold</h2>
                                <button class="btn_option" data-modal-target="#modal">
                                    <svg class="drag-header-more" data-target="options1" fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                    </svg></button>
                            </span>
                            <div class="drag-options" id="options1"></div>
                            <ul class="drag-inner-list" id="1">
                            </ul>
                        </li>

                        <li class="drag-column drag-column-on-hold">
                            <span class="drag-column-header">
                                <h2>Completed</h2>
                                <button class="btn_option" data-modal-target="#modal">
                                    <svg class="drag-header-more" data-target="options1" fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                    </svg></button>

                            </span>
                            <div class="drag-options" id="options1"></div>
                            <ul class="drag-inner-list" id="1">
                            <a data-modal-target="#emodal" style="text-decoration:none; color:black;"><li class="drag-item"><b>Complete Kanban</b><br>Complete the kanban add edit functions <br><br>Due: 03-07-2023 <text style="float:right">DONE</text></li></a>
                            </ul>
                        </li>



                        <!--Create Category Popup-->
                        <div class="modal" id="modal">
                            <div class="modal-header">
                                <div class="title">Add A Category</div>
                                <button data-close-button class="close-button">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="text" placeholder="Category"></input><br>
                                    <button type="submit">Add</button>
                                </form>
                            </div>
                        </div>
                        <!--Create Category Popup-->
                        <div class="modal" id="emodal">
                            <div class="modal-header">
                                <div class="title">Edit Card</div>
                                <button data-close-button class="close-button">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="text" placeholder="Title" value="Complete Kanban"></input><br>
                                    <textarea name="description" placeholder="Description" value="Complete the kanban add edit functions" form="okrform" style="width:200px; height:70px">Complete the kanban add edit functions</textarea><br>
                                    Due: <input type="datetime-local" placeholder="Due" value="2023-07-03T10:00:00.00"></input><br>
                                    Category:<select><option>To Do</option><option>On Hold</option><option>Completed</option></select><br>
                                    <button type="submit" class="editbutton">Edit Card</button>
                                </form>
                            </div>
                        </div>
                        <div id="overlay"></div>


                        <!--Edit Popup-->
                        <div class="modal" id="ccmodal">
                            <div class="modal-header">
                                <div class="title">Create Card</div>
                                <button data-close-button class="close-button">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <input type="text" placeholder="Title"></input><br>
                                    <textarea for="description" placeholder="Description"><br>
                                    Due: <input type="datetime-local" placeholder="Due"></input><br>
                                    <button type="submit">Create Card</button>
                                </form>
                            </div>
                        </div>

                        <div class="modal" id="modal">
                            <div class="modal-header">
                                <div class="title">Edit Card</div>
                                <button data-close-button class="close-button">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <input type="text" placeholder="Title"></input><br>
                                    <input type="text" placeholder="Description"></input><br>
                                    Due: <input type="datetime-local" placeholder="Due"></input><br>
                                </form>
                            </div>
                        </div>
                        <div id="overlay"></div>
                </div>
            </div>


    </body>


</body>

</html>