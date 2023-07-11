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
                        @foreach ($categories as $category)
                        <li class="drag-column drag-column-on-hold">
                            <span class="drag-column-header">
                                <h2>{{$category->name}}</h2>
                                <div style="display:flex;">
                                    <div>
                                        <button class="btn_add" data-modal-target="#ccmodal" style="cursor: pointer;" onclick="cardBtn({{ $category->kcat_id }})">+</button>
                                    </div>
                                    <button class="btn_option">
                                        <svg class="drag-header-more" data-modal-target="#ecatmodal" onclick="editCatBtn({{ $category->kcat_id }})" fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24">
                                            <path d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </span>
                            <div class="drag-options" id="options1"></div>
                            <ul class="drag-inner-list" id="1">
                                @foreach ($cards as $card)
                                @if ($card->kcat_id === $category->kcat_id)
                                <a data-modal-target="#emodal" style="text-decoration:none; color:black;" onclick="editCardBtn({{$card->kcard_id}}, '{{$card->title}}', '{{$card->description}}')">
                                    <li class="drag-item">
                                        <b>{{ $card->title }}</b> 
                                        <br>{{ $card->description }}
                                        <br><br>Due: {{ date("d-m-Y @ h:ia", strtotime($card->end_date)); }}</li>
                                </a>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!--Create Category Popup-->
                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title">Add A Category</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ Route('insertkanbancategory') }}" method="post">
                            @csrf
                            <input type="hidden" name="kboard_id" value="{{ $kboard_id }}"></input>
                            <input type="text" name="name" placeholder="Category"></input><br>
                            <button type="submit">Add</button>
                        </form>
                    </div>
                </div>

                <!--Create Card Popup-->
                <div class="modal" id="ccmodal">
                    <div class="modal-header">
                        <div class="title">Create Card</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ Route('insertkanbancard') }}" method="post" id="ccform">
                            @csrf
                            <input type="hidden" name="kboard_id" value="{{ $kboard_id }}"></input>
                            <input type="hidden" name="kcat_id" id="cc_kcat_id" value=""></input>
                            <input type="text" name="title" placeholder="Title"></input><br>
                            <textarea name="description" form="ccform" placeholder="Description"></textarea><br>
                            Due: <input name="due" type="datetime-local" placeholder="Due"></input><br>
                            <button type="submit">Create Card</button>
                        </form>
                    </div>
                </div>

                <!-- Edit Category  -->
                <div class="modal" id="ecatmodal">
                    <div class="modal-header">
                        <div class="title">Edit Category</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ Route('updatekanbancategory') }}" method="post">
                            @csrf
                            <input type="hidden" name="kboard_id" value="{{ $kboard_id }}"></input>
                            <input type="hidden" name="kcat_id" id="ecat_kcat_id" value=""></input>
                            <input type="text" name="name" placeholder="Category"></input><br>
                            <button type="submit">Edit</button>
                        </form>
                    </div>
                </div>
                <!--Edit Card Popup-->
                <div class="modal" id="emodal">
                    <div class="modal-header">
                        <div class="title">Card</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="text" placeholder="Title" value="Complete Kanban"></input><br>
                            <textarea name="description" placeholder="Description" value="Complete the kanban add edit functions" form="okrform" style="width:200px; height:70px">Complete the kanban add edit functions</textarea><br>
                            Due: <input type="datetime-local" placeholder="Due" value="2023-07-03T10:00:00.00"></input><br>
                            Category:<select>
                                <option>To Do</option>
                                <option>On Hold</option>
                                <option>Completed</option>
                            </select><br>
                            <button type="submit" class="editbutton">Edit Card</button>
                        </form>

                        <div class="comment-container" id="commentbox">
                            Comments
                        </div>
                        <form action="{{ Route('insertcomment') }}" method="post">
                            <div class="comment-input">
                                <div>
                                    @csrf
                                    <input type=hidden name="kboard_id" value="{{ $kboard_id }}"></input>
                                    <input type=hidden name="kcard_id" id="comment_kcard_id" value=""></input>
                                    <textarea name="description" id="comment_description" style="margin-top:10px; width:380px; height:40px" placeholder="Add a comment"></textarea>
                                    <input type="submit" value="COMMENT">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="overlay"></div>
        </div>


    </body>
    <script>
        var comments = {!!json_encode($comments -> toArray()) !!};
        console.log(comments);

        function cardBtn(kcat_id) {
            input = document.getElementById("cc_kcat_id");
            input.value = "";
            input.value = kcat_id;
        }

        function editCatBtn(kcat_id) {
            input = document.getElementById("ecat_kcat_id");
            input.value = "";
            input.value = kcat_id;
        }

        function editCardBtn(kcard_id) {
            input = document.getElementById("comment_kcard_id");
            input.value = "";
            input.value = kcard_id;

            commentbox = document.getElementById("commentbox");
            commentbox.replaceChildren();

            for (var i = 0; i<comments.length; i++){
               if (comments[i].kcard_id == kcard_id){
                    appendComment(commentbox, comments[i].f_name, comments[i].l_name,comments[i].description)
               }
            }
        }

        function appendComment(target,author_fname,author_lname,description){
            newdiv = document.createElement('div');
            newdiv.className = "comment";
            newdiv.innerHTML =  author_fname + " " + author_lname + "<text style='font-size:11px'> commented: </text><br> " + description;

            target.appendChild(newdiv);
        }
    </script>

</html>