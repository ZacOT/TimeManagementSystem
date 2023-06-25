@include('header')
<link rel="stylesheet" href="<?php echo asset('css/admin.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">
<link href="<?php echo asset('css/attendance.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('js\DataTables\DataTables-1.13.4\css\jquery.dataTables.css') ?>" type="text/css">
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<script src="<?php echo asset('js\DataTables\DataTables-1.13.4\js\jquery.dataTables.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo asset('js\chart.js-4.3.0\package\dist\chart.umd.js') ?>" type="text/javascript"></script>

<body>
    <div class="wraper">
        @include('sidebar')
        <div class="dashboard">
            <p style="text-align:center">Welcome, {{ Auth::user()->f_name}}. These are your classes attendance lists.</p>
            <div class="container">
                <div class="attendancelist">
                    <button class="editbutton" data-modal-target="#modal">New Attendance List (Single)</button>
                    <button class="editbutton">New Attendance List (Series)</button>
                    <table id="att-table">
                        <thead>
                            <th>Course</th>
                            <th>Type</th>
                            <th>Class</th>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->course_name }}</td>
                                <td>{{ $attendance->classtype_name }}</td>
                                <td>{{ $attendance->class_name }}</td>
                                <td>@php echo date("l", strtotime($attendance->class_firstdate ));@endphp</td>
                                <td>@php echo date("d-m-Y",strtotime($attendance->class_firstdate)); @endphp</td>
                                <td>@php echo date("h:ia",strtotime($attendance->class_starttime)); echo" - ";echo date("h:ia",strtotime($attendance->class_endtime)); @endphp</td>
                                <td style="text-align:right">
                                    <form action="/attendancelist" method="post">
                                        @csrf
                                        <input type="hidden" name="att_id" value="{{ $attendance->att_id}}">
                                        <button class="editbutton">VIEW</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <!-- Add Program Modal -->
                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title">New Attendance List (Single)</div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('insertattendance') }}" method="post" id="addcourse">
                            @csrf
                            <br><label for="class">Class: </label>
                            <select id="class" name="class_id" onchange="myFunction()">
                                @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->course_name }} [{{ $class->course_code }}] [{{ $class->classtype_name }}] - {{ $class->class_name }}</option>
                                @endforeach
                            </select><br><br>
                            <label>Date: </label><input type="date" /><br><br>
                            <label>From: </label><input type="time" /><br>
                            <label>To: </label><input type="time" /><br><br>
                            <input class="editbutton" type="submit" value="Add Attendance">
                        </form>
                    </div>
                </div>
                <div id="overlay"></div>
            </div>
        </div>
    </div>


</body>

<script>
    $(document).ready(function() {
        $('#att-table').DataTable();
    });



    function getCourseInfo() {
        class_id = document.getElementById('class');

    }
</script>