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
                <p style="text-align:center;">List of Student Leave Applications</p>
                <div class="attendancelist">
                    <table id="att-table">
                        <thead>
                            <th>Student</th>
                            <th>Matrics</th>
                            <th>Leave Duration</th>
                            <th>Requested Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->f_name }} {{ $leave->l_name }}</td>
                                <td>{{ $leave->matrics }} </td>
                                <td>@php echo date("d-m-Y",strtotime($leave->leave_startdate)); @endphp ----> @php echo date("d-m-Y",strtotime($leave->leave_enddate)); @endphp</td>
                                <td>@php echo date("d-m-Y",strtotime($leave->application_date)); @endphp</td>
                                <td>{{ $leave->reason }}</td>
                                @if ($leave->status == 0) 
                                <td style="color:red;">Unapproved</td>
                                @elseif ($leave->status == 1) 
                                <td style="color:green;">Approved</td>
                                @endif
                                <td style="text-align:center;">
                                <form action="{{ route('leavecourseapproval') }}" method=post>
                                    @csrf
                                    <input type="hidden" name="leave_id" value="{{ $leave->leave_id }}">
                                    <input type="hidden" name="approval_id" value="{{ $leave->approval_id }}">
                                    <button class="addbutton" data-modal-target="#editmodal">VIEW</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


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


</script>