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
                            <th>Course</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>First Last</td>
                                <td>P00000001</td>
                                <td>20-06-2023 ---> 23-06-2023</td>
                                <td>18-06-2023</td>
                                <td style="color:red;">Unapproved</td>
                                <td style="text-align:center;"><button class="addbutton" data-modal-target="#editmodal">VIEW</button></td>
                            </tr>
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