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
            <p style="text-align:center">Welcome, {{ Auth::user()->f_name}}. These are your leave application.</p>
            <div class="container">
                <div class="attendancelist">

                    <table id="att-table">
                        <thead>
                            <th>Applicant</th>
                            <th>Application Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Reason</th>
                            <th>STATUS</th>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->f_name }} {{ $leave->l_name }}</td>
                                <td>{{ $leave->application_date }}</td>
                                <td>@php echo date("d-m-Y",strtotime($leave->leave_startdate)); @endphp</td>
                                <td>@php echo date("d-m-Y",strtotime($leave->leave_enddate)); @endphp</td>
                                <td>{{ $leave->reason }}</td>
                                @if ($leave->status == 0) 
                                <td style="color:red;">Unapproved</td>
                                @elseif ($leave->status == 1) 
                                <td style="color:green;">Approved</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
</div>
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