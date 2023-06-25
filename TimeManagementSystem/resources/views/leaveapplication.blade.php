<!DOCTYPE html>
<html lang="en">

@include('header')

<title>TMS - Kanban Board</title>
<link href="<?php echo asset('css/okr.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/kanban.js') ?>"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">

    <body>
        <div class="wraper">
            @include('sidebar')
            <div class="dashboard">
                <div class="objective" style="background-color:peachpuff;">
                    <p style="text-align:center;">Student Leave Application Form</p>
                </div>
                <div class="objective" style="background-color:bisque; margin-top:0px;">
                    <p>Student: First, Last</p>
                    <p>Matriculation No: P00000001</p>
                    <p>Email: firstlast@test.com</p>
                    <p>Contact: 0123456789</p>
                    <p>From: 03-07-2023 To: 05-07-2023</p>
                    <p>Reason: Sick Leave</p>
                    <p>Supporting Documents: <input type="file" onchange="loadFile(event)" ></p>
                    <img id="output" width="200px" height="200px"/>

                </div>
                <div class="objective" style="background-color:peachpuff;">
                    <p>Affected Course's Lecturers Approval</p>
</div>
                <div class="objective" style="background-color:bisque; margin-top:0px;">

                    <table style="border: solid 1px black; width:100%;">
                        <tr>
                            <td style="border:solid 1px black; font-weight: bolder;">Course</td>
                            <td style="border:solid 1px black; font-weight: bolder;">Lecturer</td>
                            <td style="border:solid 1px black; font-weight: bolder;">Status</td>
                        </tr>
                        <tr>
                        <td style="border:solid 1px black;">C01 - Course1 [CS1]</td>
                        <td style="border:solid 1px black;">Lecturer</td>
                        <td style="border:solid 1px black;">Unapproved</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script>
        var output = document.getElementById('output');
            output.style.display = 'none';

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.style.removeProperty('display');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

</html>