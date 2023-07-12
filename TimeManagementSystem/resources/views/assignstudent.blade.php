@include('header')
<link rel="stylesheet" href="<?php echo asset('css/admin.css') ?>" type="text/css">
<link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">
<link href="<?php echo asset('css/attendance.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('js\DataTables\DataTables-1.13.4\css\jquery.dataTables.css') ?>" type="text/css">
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<script src="<?php echo asset('js\DataTables\DataTables-1.13.4\js\jquery.dataTables.js') ?>" type="text/javascript"></script>
<script src="<?php echo asset('js\chart.js-4.3.0\package\dist\chart.umd.js') ?>" type="text/javascript"></script>

<body>
    <div class="wraper">
        @include('sidebar')
        <div class="dashboard">
            <p><a href="/classlist"><-BACK</a></p>
            <p style="text-align:center">Class of {{$class->course_name}} {{$class->classtype_name}} {{$class->class_name}} <br>
                @php echo date("d-m-Y",strtotime($class->class_firstdate)); echo " ["; echo date("l", strtotime($class->class_firstdate )); echo "]<br>"; echo date("h:ia", strtotime($class->class_starttime)); echo " - "; echo date("h:ia",strtotime($class->class_endtime));@endphp</p>
            <div class="container">
                <div class="attendancelist">
                <form action="{{Route('assignstudents')}}" method="post">
                 @csrf
                 <input type="hidden" id="class_id" name="class_id" value="{{ $class->class_id }}">
                        <table id="att-table">
                            <thead>
                                <th>Student</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @php $counter=0; @endphp
                                @foreach ($students as $student)
                                <tr>
                                    <td>
                                        {{ $student->f_name }} {{ $student->l_name }}
                                        <input type="hidden" id="student_id" name="assign[{{$counter}}][student]" value="{{ $student->id }}">
                                    </td>
                                    <td style="display:flex; width:500px">
                                        @if(in_array($student->id, $assignedstudents))
                                            <div style="flex:1">
                                            <input type="radio" id="unassign_stu{{$student->id}}" name="assign[{{$counter}}][status]" value="0" >
                                            <label for="unassign_stu{{$student->id}}">UNASSIGNED</label><br>
                                            </div><div style="flex:1">
                                            <input type="radio" id="assign_stu{{$student->id}}" name="assign[{{$counter}}][status]" value="1" checked>
                                            <label for="assign_stu{{$student->id}}">ASSIGNED</label><br>
                                            </div>
                                        @else
                                        <div style="flex:1">
                                            <input type="radio" id="unassign_stu{{$student->id}}" name="assign[{{$counter}}][status]" value="0"checked >
                                            <label for="unassign_stu{{$student->id}}">UNASSIGNED</label><br>
                                            </div><div style="flex:1">
                                            <input type="radio" id="assign_stu{{$student->id}}" name="assign[{{$counter}}][status]" value="1" >
                                            <label for="assign_stu{{$student->id}}">ASSIGNED</label><br>
                                            </div>
                                        @endif
                                
                                    </td>
                                </tr>
                                @php $counter++ @endphp
                                @endforeach
                            </tbody>

                        </table>
                        <input type="submit" class="editbutton" value="Assign Students">
                    </form>
                </div>


                <!-- Add Program Modal -->
                <div class="modal" id="modal">
                    <div class="modal-header">
                        <div class="title"></div>
                        <button data-close-button class="close-button">&times;</button>
                    </div>
                    <div class="modal-body">

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
</script>