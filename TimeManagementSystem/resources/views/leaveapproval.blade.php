<!DOCTYPE html>
<html lang="en">

@include('header')

<title>TMS - Kanban Board</title>
<link href="<?php echo asset('css/okr.css') ?>" rel="stylesheet">
<link href="<?php echo asset('css/popup.css') ?>" rel="stylesheet">
<script defer src="<?php echo asset('js/popup.js') ?>"></script>
<script src="<?php echo asset('js\jquery-3.7.0.js') ?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
</head>

<body>
    <link rel="stylesheet" href="<?php echo asset('css/dashboard.css') ?>" type="text/css">


        <div class="wraper">
            @include('sidebar')
            <div class="dashboard">
                <div class="objective" style="background-color:peachpuff;">
                    <p style="text-align:center; font-size:18px;">Student's Leave Application Form</p>
                </div>
                <div class="objective" style="background-color:bisque; margin-top:0px;">
                    <p>Student: {{$student->f_name}} {{$student->l_name}}</p>
                    <p>Matriculation No: {{$student->matrics}}</p>
                    <p>Email: {{$student->email}}</p>
                    <p>Contact: {{$student->contact_no}}</p>
                    <p>From: @php echo date("d-m-Y",strtotime($leave->leave_startdate));@endphp To: @php echo date("d-m-Y",strtotime($leave->leave_enddate));@endphp</p>
                    <p>Reason: {{ $leave->reason }}</p>
                    <p>Supporting Document:</p>
                    <img src="/images/documents/{{ $leave->document }}" width="200px" height="200px"/>

                </div>

                <div class="objective" style="background-color:peachpuff;">
                    <p style="font-size:18px;">Courses Class</p>
                    <p style="font-size:14px;">AFFECTED COURSES</p>
                </div>
                <div class="objective" style="background-color:bisque; margin-top:0px;">

                    <table id="att_table"style="border: solid 1px black; width:100%; margin-top:50px">
                        <tr>
                            <td style="border:solid 1px black; font-weight: bolder;">Course Class</td>
                            <td style="border:solid 1px black; font-weight: bolder;">Lecturer</td>
                            <td style="border:solid 1px black; font-weight: bolder;">Day</td>
                            <td style="border:solid 1px black; font-weight: bolder;">Time</td>
                            <td style="border:solid 1px black; font-weight: bolder;">Status</td>
                        </tr>
                        @foreach ($leaveapprovals as $leaveapproval)
                        <tr>
                           
                        <td style="border:solid 1px black;">{{$leaveapproval->course_code}} - {{$leaveapproval->course_name}} - {{$leaveapproval->class_name}}</td>
                            <td style="border:solid 1px black;">{{$leaveapproval->f_name}} {{$leaveapproval->l_name}}</td>
                            <td style="border:solid 1px black;">@php echo date("l",strtotime($leaveapproval->class_firstdate)); @endphp </td>
                            <td style="border:solid 1px black;">@php echo date("h:ia", strtotime($leaveapproval->class_starttime)); echo " - "; echo date("h:ia",strtotime($leaveapproval->class_endtime));@endphp</td>
                            @if ($leaveapproval->status == 0)
                            <td style="border:solid 1px black;">Unapproved</td>
                            @elseif ($leaveapproval->status == 1)
                            <td style="border:solid 1px black;">Approved</td>
                            @endif
                            
                        </tr>
                        @endforeach
                    </table>

                    @if ($leave->status == 0)
                    <div style="text-align:center; margin-top:50px; margin-bottom:50px;">
                    <form action="{{ Route('approveleavecourse') }}" method="post" id="approveform">
                        @csrf
                        <input type="hidden" name="approval_id" value="{{$leave->leave_id}}">
                        <input type="submit" style="height:40px;width:100px;" value="APPROVE"></button>
                    </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $('select').selectize({
                sortField: 'text'
            });
        });

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

        function addAffectedCourse(classid,classcode,classname,classtype,lecturer,day,starttime,endtime){

            sel_class = getElementById('sel_class').value;
            var table = document.getElementById("att_table");

            var row = table.insertRow(-1);

            var cell1 = row.insertCell(0);
            cell1.innerHTML = classcode +" " +classname + "" + classtype;
            cell1.style.border = '1px solid black';

            var cell2 = row.insertCell(1);
            cell2.innerHTML = lecturer;

            var cell3 = row.insertCell(2);
            cell3.innerHTML = day;

            var cell4 = row.insertCell(3);
            cell4.innerHTML = starttime;

            var cell5 = row.insertCell(4);
            cell5.innerHTML = endtime;
        }

        function removeRow(){

        }
    </script>
</html>