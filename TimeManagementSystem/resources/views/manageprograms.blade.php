@include('header')
<link rel="stylesheet" href="<?php echo asset('css/admin.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('js\DataTables\DataTables-1.13.4\css\jquery.dataTables.css') ?>" type="text/css">
<link href="<?php echo asset('css/attendance.css') ?>" rel="stylesheet">
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<script src="<?php echo asset('js\DataTables\DataTables-1.13.4\js\jquery.dataTables.js') ?>" type="text/javascript"></script>
<body>
    <div class="wraper">
        @include('sidebar')
        <div class="dashboard">
            <div style="margin-left:20px; margin-top:20px; margin-bottom:50px;">
                <a href="/admin"><- BACK </a>
            </div>
            <div class="container">
                @error('program_name'){{ $message }}@enderror
                @error('program_code'){{ $message }}@enderror
                @error('hop_id'){{ $message }}@enderror

                <div class="attendancelist">
                    <table id="att-table">
                        <thead>
                            <th>Program</th>
                            <th>Program Code</th>
                            <th>Head of Program</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($programs as $program)
                            <tr>
                                <td>{{ $program->program_name }}</td>
                                <td>{{ $program->program_code }}</td>
                                <td>{{ $program->f_name }}</td>
                                <form action="{{ route('assignprogram') }}" method="post">
                                @csrf
                                <td style="text-align:right;">
                                    <input type="hidden" name="program_id" value="{{ $program->program_id }}">
                                </form>
                                    <button class="addbutton" onclick="editBtn('{{ $program->program_name }}','{{ $program->program_code }}','{{ $program->f_name }}','{{ $program->hop_id }}')" data-modal-target="#editmodal">EDIT</button>
                                </td>
                            </tr>
                            @endforeach
                        <tfoot>
                            <tr>
                                <td><button class="addbutton" data-modal-target="#modal">Add Program</button></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>

        <!-- Add Program Modal -->
        <div class="modal" id="modal">
            <div class="modal-header">
                <div class="title">Add Program</div>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('insertprogram') }}" method="post" id="okrform">
                    @csrf
                    <input type="text" name="program_name" placeholder="Program Name" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="program_code" placeholder="Program Code" style="width:200px; margin-bottom:10px"></input><br>
                    <label for="hop">Head of Program: </label>
                    <select id="hop" name="hop_id">
                        @foreach ($hops as $hop)
                        <option value="{{ $hop->id }}">{{ $hop->f_name }}</option>
                        @endforeach
                    </select><br>
                    <input class="editbutton" type="submit" value="Add Program">
                </form>
            </div>
        </div>
        <!-- Edit Program Modal -->
        <div class="modal" id="editmodal">
            <div class="modal-header">
                <div class="title" id="editprogramtitle">Edit Program</div>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('insertprogram') }}" method="post" id="editprogram">
                    @csrf
                    <input type="text" id="editprogramname" name="program_name" placeholder="Program Name" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editprogramcode" name="program_code" placeholder="Program Code" style="width:200px; margin-bottom:10px"></input><br>
                    <label for="hop">Head of Program: </label>
                    <select id="hop" name="hop_id">
                        @foreach ($hops as $hop)
                        <option value="{{ $hop->id }}">{{ $hop->f_name }}</option>
                        @endforeach
                    </select><br>
                </form>
            </div>
        </div>
        <div id="overlay"></div>
    </div></div>
</body>

<script>
    $(document).ready(function() {
        $('#att-table').DataTable({
            fixedHeader: {
                header: true,
                footer: true
            }
        });
    });
    function editBtn(name,code,hopname,hopid) {
        form = document.getElementById("editprogram");
        editprogramname = document.getElementById("editprogramname")
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