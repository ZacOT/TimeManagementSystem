@include('header')
<link rel="stylesheet" href="<?php echo asset('css/admin.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<link href="<?php echo asset('css/attendance.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('js\DataTables\DataTables-1.13.4\css\jquery.dataTables.css') ?>" type="text/css">
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<script src="<?php echo asset('js\DataTables\DataTables-1.13.4\js\jquery.dataTables.js') ?>" type="text/javascript"></script>
<script src="<?php echo asset('js\chart.js-4.3.0\package\dist\chart.umd.js') ?>" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>


<body>
    <div class="wraper">
        @include('sidebar')
        <div class="dashboard">
            <p style="text-align:center"></p>
            @error('program'){{ $message }}@enderror
            @error('course'){{ $message }}@enderror
            @error('class_type'){{ $message }}@enderror
            @error('class_name'){{ $message }}@enderror
            @error('lecturer'){{ $message }}@enderror
            @error('semester'){{ $message }}@enderror
            @error('first_date'){{ $message }}@enderror
            @error('start_time'){{ $message }}@enderror
            @error('end_time'){{ $message }}@enderror

            <div class="container">
                <div class="attendancelist">
                    @csrf
                    <p>Classes under the Program of <b>{{$program->program_name}}</b></p>
                    <table id="classlist-table">
                        <thead>
                            <th>Course</th>
                            <th>Type</th>
                            <th>Class</th>
                            <th>Assigned Lecturer</th>
                            <th>Day</th>
                            <th>First Class Date</th>
                            <th>Time</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                            <tr>
                            <td>{{ $class->course_name }}</td>
                            <td>{{ $class->classtype_name }}</td>
                            <td>{{ $class->class_name }}</td>
                            <td>{{ $class->f_name }} {{ $class->l_name }}</td>
                            <td>@php echo date("l", strtotime($class->class_firstdate ));@endphp</td>
                            <td>@php echo date("d-m-Y",strtotime($class->class_firstdate)); @endphp</td>
                            <td>@php echo date("h:ia", strtotime($class->class_starttime)); echo " - "; echo date("h:ia",strtotime($class->class_endtime));@endphp</td>
                            <td style="text-align:right"><button class="editbutton">EDIT</button></td>
</tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr><td><input type="submit" data-modal-target="#modal" class="editbutton" value="Add Class"></td>
                            <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                        </tfoot>
                    </table>



                </div>

            </div>
            <!-- Add Class -->
            <div class="modal" id="modal">
                <div class="modal-header">
                    <div class="title">Add Class</div>
                    <button data-close-button class="close-button">&times;</button>
                </div>
                <div class="modal-body" style="text-align:center; align-content:center;">
                    <form action="{{ route('insertclass') }}" method="post">
                        @csrf
                        <input type="hidden" name="program" value="{{$program->program_id}}">
                        <select name="course" placeholder="Course">
                            <option></option>
                            @foreach ($courses as $course)
                            <option value="{{$course->course_id}}">{{$course->course_name}} [{{$course->course_code}}]</option>
                            @endforeach
                        </select><br>
                        <select name="class_type" placeholder="Class Type">
                            <option></option>
                            @foreach ($classtypes as $classtype)
                            <option value="{{$classtype->classtype_id}}">{{$classtype->classtype_name}}</option>
                            @endforeach
                        </select><br>
                        <input type="text" name="class_name" placeholder="Class Name" style="width:470px; height:35px; text-align:center;"><br><br>
                        <select name="lecturer" placeholder="Assign Lecturer">
                            <option></option>
                            @foreach ($lecturers as $lecturer)
                            <option value="{{$lecturer->id}}">{{$lecturer->f_name}} {{$lecturer->l_name}} [{{$lecturer->matrics}}]</option>
                            @endforeach
                        </select><br>
                        <select name="semester" placeholder="Semester">
                            <option></option>
                            @foreach ($semesters as $semester)
                            <option value="{{$semester->sem_id}}">{{$semester->sem_name}}</option>
                            @endforeach
                        </select><br>
                        <label for="firstdate">First Date: </label><input type="date" name="first_date" id="firstdate"></input><br> 
                        <label for="starttime">Start Time: </label><input type="time" name="start_time" id="starttime"></input><br> 
                        <label for="endtime">End Time: </label><input type="time" name="end_time" id="endtime"></input><br><br>
                        <input class="editbutton" type="submit" value="Add Class">
                    </form>
                </div>
            </div>
            <div id="overlay"></div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#classlist-table').DataTable({
            fixedHeader: {
                header: true,
                footer: true
            }
        });
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>

</body>