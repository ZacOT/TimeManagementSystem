@include('header')
<link rel="stylesheet" href="<?php echo asset('css/admin.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('js\DataTables\DataTables-1.13.4\css\jquery.dataTables.css') ?>" type="text/css">
<link href="<?php echo asset('css/attendance.css') ?>" rel="stylesheet">
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<script src="<?php echo asset('js\DataTables\DataTables-1.13.4\js\jquery.dataTables.js') ?>" type="text/javascript"></script>
<script src="<?php echo asset('js\chart.js-4.3.0\package\dist\chart.umd.js') ?>" type="text/javascript"></script>

<body>
    <div class="wraper">
        @include('sidebar')
        <div class="dashboard">
            <div style="margin-left:20px; margin-top:20px; margin-bottom:50px;">
                <a href="/admin"><- BACK </a>
            </div>
            @error('semester_name'){{ $message }}@enderror
            @error('start_date'){{ $message }}@enderror
            @error('end_date'){{ $message }}@enderror

            <div class="container">
                <div class="attendancelist">
                    <table id="att-table">
                        <thead>
                            <th>Class Type</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($classtypes as $classtype)
                            <tr>
                                <td>{{ $classtype->classtype_name }}</td>
                                <td style="text-align:right;"><button class="addbutton" data-modal-target="#editmodal" onclick="editSemester()">EDIT</button></td>
                            </tr>
                            @endforeach
                        <tfoot>
                            <tr>
                                <td><button class="addbutton" data-modal-target="#modal">Add Class Type</button></td>
                                <td></td>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Course Modal -->
            <div class="modal" id="modal">
                <div class="modal-header">
                    <div class="title">Add Class Type</div>
                    <button data-close-button class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('insertclasstype') }}" method="post" id="addclasstype">
                        @csrf
                        <input type="text" id="addSemesterName" name="classtype_name" placeholder="Class Type" style="width:200px; margin-bottom:10px"></input><br>
                        <input class="editbutton" type="submit" value="Add Class Type">
                    </form>
                </div>
            </div>
            <!-- Edit Course Modal -->
            <div class="modal" id="editmodal">
                <div class="modal-header">
                    <div class="title">Edit Class Type</div>
                    <button data-close-button class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('insertclasstype') }}" method="post" id="editcourse">
                        @csrf
                        <input type="hidden" id="editSemesterID" name="sem_id" value="">
                        <input type="text" id="editSemesterName" name="semester_name" placeholder="Semester Name" style="width:200px; margin-bottom:10px"></input><br>
                        <input class="editbutton" type="submit" value="Edit Class Type">
                    </form>

                    <button class="deletebutton" value="Delete Semester" id="dltBtn">Delete Semester</button>
                    <form action="{{ route('insertclasstype') }}" method="post" id="delete" style="display:none;">
                        @csrf
                        <input type="hidden" id="deleteSemesterID" name="sem_id" value="">
                        <text style="color:red;" id="dltText">ARE YOU SURE?</text><br>
                        <input class="deletebutton" id="cfmDelete" type="submit" value="DELETE"/>
                    </form>
                </div>
            </div>
            <div id="overlay"></div>
        </div>
    </div>
</body>

<script>
    const btn = document.getElementById('dltBtn');
    const form = document.getElementById('delete');

    $(document).ready(function() {
        $('#att-table').DataTable({
            fixedHeader: {
                header: true,
                footer: true
            }
        });
    });

    function editSemester(sem_id, name) {
        clearEditForm();
        document.getElementById("editSemesterID").value = sem_id;
        document.getElementById("editSemesterName").value = name;
        document.getElementById("deleteSemesterID").value = sem_id;
    }

    function clearEditForm() {
        btn.style.display = "";
        form.style.display = "none";
        document.getElementById("editSemesterName").innerHTML = "";
    }


    btn.addEventListener('click', () => {
    if (form.style.display === 'none') {
        btn.style.display = 'none';
        form.style.display = 'block';
    } else {
        btn.style.display = 'none';
        form.style.display = 'none';
    }
    });
</script>