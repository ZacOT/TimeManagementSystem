<!DOCTYPE html>
<html lang="en">

@include('header')

<title>TMS - Kanban Board</title>
<link href="<?php echo asset('css/okr.css') ?>" rel="stylesheet">
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">


        <div class="wraper">
            @include('sidebar')
            <div class="dashboard">
                <form action="/insertLeave" method="post">
                <div class="objective" style="background-color:peachpuff;">
                    <p style="text-align:center;">Student Leave Application Form</p>
                </div>
                <div class="objective" style="background-color:bisque; margin-top:0px;">
                    <p>Student: {{$student->f_name}} {{$student->l_name}}</p>
                    <p>Matriculation No: {{$student->matrics}}</p>
                    <p>Email: {{$student->email}}</p>
                    <p>Contact: {{$student->contact_no}}</p>
                    <p>From: <input type="date"> To: <input type="date"></p>
                    <p>Reason:</p><textarea></textarea>
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
                        <tr>
                            <td colspan="3"style="border:solid 1px black;">
                                <button data-modal-target="#modal">Add Class</button> 
                            </td>
                        </tr>
                    </table>
                </div>
                </form>
                <!-- Modal -->
                <div class="modal" id="modal">
                            <div class="modal-header" style="background-color:peachpuff;">
                                <div class="title" style="text-align:center">Add Affected Course</div>
                                <button data-close-button class="close-button">&times;</button>
                            </div>
                            <div class="modal-body" style="background-color:bisque;">
                                <form action="" method="post">
                                    <select>
                                        @foreach ($classes as $class)
                                            <option>[{{  $class->course_code }}]{{  $class->course_name }} | {{ $class->classtype_name }} |  {{ $class->class_name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div id="overlay"></div>
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