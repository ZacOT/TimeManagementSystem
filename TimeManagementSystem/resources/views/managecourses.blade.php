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
            @error('course_name'){{ $message }}@enderror
            @error('course_code'){{ $message }}@enderror

            <div class="container">
                <div class="attendancelist">
                    <table id="att-table">
                        <thead>
                            <th>Course</th>
                            <th>Code</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td style="text-align:center;"><button class="addbutton" data-modal-target="#editmodal" onclick="editCourse('{{ $course->course_id }}','{{ $course->course_name }}','{{ $course->course_code }}')">EDIT</button></td>
                            </tr>
                            @endforeach
                        <tfoot>
                            <tr>
                                <td><button class="addbutton" data-modal-target="#modal">Add Course</button></td>
                                <td></td>
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
                <div class="title">Add Course</div>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('insertcourse') }}" method="post" id="okrform">
                    @csrf
                    <input type="text" name="course_name" placeholder="Course Name" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="course_code" placeholder="Code" style="width:200px; margin-bottom:10px"></input><br>
                    <input class="editbutton" type="submit" value="Add Course">
                </form>
            </div>
        </div>
        <!-- Add Course Modal -->
        <div class="modal" id="editmodal">
            <div class="modal-header">
                <div class="title">Edit Course</div>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editcourse') }}" method="post" id="editcourse">
                    @csrf
                    <input type="hidden" id="editCourseID" name="course_id" value="">
                    <input type="text" id="editCourseName" name="course_name" placeholder="Course Name" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editCourseCode" name="course_code" placeholder="Code" style="width:200px; margin-bottom:10px"></input><br>
                    <input class="editbutton" type="submit" value="Add Course">
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

    function editCourse(courseid, coursename, coursecode){
        clearEditForm();
        document.getElementById("editCourseID").value = courseid;
        document.getElementById("editCourseName").value = coursename;
        document.getElementById("editCourseCode").value = coursecode;
    }

    function clearEditForm(){
        document.getElementById("editCourseName").innerHTML = "";
        document.getElementById("editCourseCode").innerHTML = "";
    }
</script>