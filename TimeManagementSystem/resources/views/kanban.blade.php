<!DOCTYPE html>
<html lang="en">

    @include('header')

    <title>TMS - Kanban Board</title>
    <link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
    <link href="<?php echo asset('css/kanban.css') ?>" rel="stylesheet">
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
                    <button data-modal-target="#modal">Add Category</button>
                    <button data-modal-target="#emodal">Create Card</button>
                </div>


                <div class="drag-container">
                    <ul class="drag-list">

                        <li class="drag-column drag-column-on-hold">
                            <span class="drag-column-header">
                                <h2>To Do</h2>
                                <div>
                                <button class="btn_option"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="drag-header-more" viewBox="0 0 24 24" fill="#FFFFFF">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" fill="black"></path> 
                                    </svg>
                                </button>
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
                                <li class="drag-item" draggable="true">TEST</li>
                                <li class="drag-item" draggable="true"></li>
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
                                <li class="drag-item" draggable="true"></li>
                                <li class="drag-item" draggable="true"></li>
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
                                <li class="drag-item" draggable="true"></li>
                                <li class="drag-item" draggable="true"></li>
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
                                <li class="drag-item" draggable="true"></li>
                                <li class="drag-item" draggable="true"></li>
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
                                <li class="drag-item" draggable="true"></li>
                                <li class="drag-item" draggable="true"></li>
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
                                    <input type="text" placeholder="Title"></input><br>
                                    <input type="text" placeholder="Description"></input><br>
                                    Due: <input type="datetime-local" placeholder="Due"></input><br>
                                    <button type="submit">Edit</button>
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
                                    <input type="text" placeholder="Description"></input><br>
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