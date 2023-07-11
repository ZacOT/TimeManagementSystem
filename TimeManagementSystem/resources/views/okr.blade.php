<!DOCTYPE html>
<html lang="en">

@include('header')

<title>TMS - Kanban Board</title>
<link href="<?php echo asset('css/okr.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/kanban.js') ?>"></script>
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">

    <body>
        <div class="wraper">
            @include('sidebar')
            <div class="dashboard">
                @if (session('status'))
                <p style="text-align:center;">{{ session('status') }}</p>
                @endif
                <div class="objective">
                    @foreach($objectives as $objective)
                    <p>Objective: {{ $objective->title}} <button class="editbutton" data-modal-target="#emodal" style="float:right;">EDIT</button></p>
                    <p>Description: {{ $objective->description}}</p>
                    <p>Semester: {{ $objective->sem_name}}</p>
                    @endforeach

                </div>
                @foreach($keyresults as $keyresult)
                <div class="krcontainer">
                    <div class="krtitle">
                        <p>Key Result: {{ $keyresult->title }}</p>
                    </div>
                    <div class="krcontent">
                        <p>Description: {{ $keyresult->description }}</p>
                        <p>Due: {{ $keyresult->due_date }}</p>

                        @if ($keyresult->status == 0)
                        <p>Status: In Progress</p>
                        @endif
                        @if ($keyresult->status == 1)
                        <p>Status: Exceed Expectations</p>
                        @endif
                        @if ($keyresult->status == 2)
                        <p>Status: Met Key Result</p>
                        @endif
                        @if ($keyresult->status == 3)
                        <p>Status: Missed Key Result</p>
                        @endif
                        @if ($keyresult->status == 4)
                        <p>Status: Canceled</p>
                        @endif

                        <!-- Delete and Edit Buttons -->
                        <div style="float:right; display:flex; width:100px; margin-right:50px">
                            <div style="flex:1" data-modal-target="#emodal">
                                <button class="editbutton">EDIT</button>
                            </div>
                            <div style="flex:1" data-modal-target="#modaldelete">
                                <input type="hidden">
                                <input type="submit" class="editbutton" onClick="deleteBtn('{{ $keyresult->title }}' , {{ $keyresult->kr_id }})" value="DELETE">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <button class="blackbutton" data-modal-target="#modal">ADD</button>
                @error('title'){{ $message }}@enderror
                @error('description'){{ $message }}@enderror
                @error('status'){{ $message }}@enderror
                @error('due_date'){{ $message }}@enderror
                @error('obj'){{ $message }}@enderror

                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title">Add Objective</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('okr') }}" method="post" id="okrform">
                            @csrf
                            <input type="text" name="title" placeholder="Key Result" style="width:200px; margin-bottom:10px"></input><br>
                            <textarea name="description" placeholder="Description" form="okrform" style="width:200px; height:70px"></textarea><br>
                            <label for="status">Status:</label>
                            <select id="status" name="status">
                                <option value="0">In Progress</option>
                                <option value="1">Exceeded Expectations</option>
                                <option value="2">Met Key Result</option>
                                <option value="3">Missed Key Result</option>
                                <option value="4">Canceled</option>
                            </select><br>
                            <label>Due:</label><input type="date" name="due_date"><br>
                            <input type="hidden" name="obj_id" value="{{$objective->obj_id}}" />
                            <input class="editbutton" type="submit" value="Add Key Result">
                        </form>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal" id="emodal">
                    <div class="modal-header">
                        <div class="title">Add Objective</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('okr') }}" method="post" id="eokrform">
                            @csrf
                            <input type="text" name="title" placeholder="Key Result" style="width:200px; margin-bottom:10px"></input><br>
                            <textarea name="description" placeholder="Description" form="eokrform" style="width:200px; height:70px"></textarea><br>
                            <label for="status">Status:</label>
                            <select id="status" name="status">
                                <option value="0">In Progress</option>
                                <option value="1">Exceeded Expectations</option>
                                <option value="2">Met Key Result</option>
                                <option value="3">Missed Key Result</option>
                                <option value="4">Canceled</option>
                            </select><br>
                            <label>Due:</label><input type="date" name="due_date"><br>
                            <input type="hidden" name="obj_id" value="{{$objective->obj_id}}" />
                            <input class="editbutton" type="submit" value="Add Key Result">
                        </form>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal" id="modaldelete">
                    <div class="modal-header">
                        <div class="title" style="color:red;">ARE YOU SURE YOU WANT TO DELETE?</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('deletekr') }}" method="post" id="formkrdelete">
                            @csrf
                            <input type="submit" id="delkrbtn" value="DELETE" class="editbutton">
                            <input type="hidden" name="obj_id" value="{{$objective->obj_id}}" />
                        </form>
                    </div>
                </div>
            </div>
            <div id="overlay"></div>
        </div>
        </div>
    </body>


</body>

<script>
    function editBtn(title, id) {
        console.log("Test");
        form = document.getElementById("formkrdelete");
        delbtn = document.getElementById("delkrbtn");

        if (document.getElementById("krdel_title")) {
            document.getElementById("krdel_title").remove();
        }

        var target = document.createElement("p");
        target.id = "krdel_title";
        target.innerText = "KEY RESULT: " + String(title);

        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "kr_id";
        input.value = String(id);

        form.insertBefore(target, delbtn);
        form.appendChild(input);
    }

    function deleteBtn(title, id) {
        console.log("Test");
        form = document.getElementById("formkrdelete");
        delbtn = document.getElementById("delkrbtn");

        if (document.getElementById("krdel_title")) {
            document.getElementById("krdel_title").remove();
        }

        var target = document.createElement("p");
        target.id = "krdel_title";
        target.innerText = "KEY RESULT: " + String(title);

        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "kr_id";
        input.value = String(id);

        form.insertBefore(target, delbtn);
        form.appendChild(input);
    }
</script>

</html>