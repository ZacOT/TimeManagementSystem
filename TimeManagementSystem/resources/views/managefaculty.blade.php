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
                <a href="/manageusers"><- BACK </a>
            </div>
            @error('username'){{ $message }}@enderror
            @error('password'){{ $message }}@enderror
            @error('f_name'){{ $message }}@enderror
            @error('l_name'){{ $message }}@enderror
            @error('email'){{ $message }}@enderror
            @error('contact_no'){{ $message }}@enderror
            @error('matrics'){{ $message }}@enderror

            <div class="container">
                <div class="attendancelist">
                    <table id="att-table">
                        <thead>
                            <th>Faculty</th>
                            <th>Matrics</th>
                            <th>E-mail</th>
                            <th>Contact No.</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($facultys as $faculty)
                            <tr>
                                <td>{{ $faculty->f_name }} {{ $faculty->l_name }}</td>
                                <td>{{ $faculty->matrics }}</td>
                                <td>{{ $faculty->email }}</td>
                                <td>{{ $faculty->contact_no }}</td>
                                <td style="text-align:center;">
                                <button class="addbutton" data-modal-target="#emodal" onclick="editStudent('{{$faculty->id}}', '{{$faculty->username}}', '{{$faculty->password}}', '{{$faculty->password}}', '{{$faculty->email}}', '{{$faculty->contact_no}}', '{{$faculty->f_name}}', '{{$faculty->l_name}}', '{{$faculty->matrics}}', '{{$faculty->role}}')">EDIT</button></td>
                            </tr>
                            @endforeach
                        <tfoot>
                            <tr>
                                <td><button class="addbutton" data-modal-target="#modal">Add User</button></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>

        <!-- Add User Modal -->
        <div class="modal" id="modal">
            <div class="modal-header">
                <div class="title">Add Faculty</div>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('insertfaculty') }}" method="post">
                    @csrf
                    <input type="text" name="username" placeholder="Username" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="password" placeholder="Password" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="password_confirmation" placeholder="Confirm password" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="email" placeholder="E-mail" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="contact_no" placeholder="Contact No." style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="f_name" placeholder="First Name" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="l_name" placeholder="Last Name" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" name="matrics" placeholder="Matrics" style="width:200px; margin-bottom:10px"></input><br>
                    <select name="role" style="width:200px">
                        <option value="1">Lecturer</option>
                        <option value="2">Head of Program</option>
                    </select><Br>
                    <input class="editbutton" type="submit" value="Add Faculty">
                </form>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal" id="emodal">
            <div class="modal-header">
                <div class="title">Edit User</div>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editfaculty') }}" method="post" id="editfaculty">
                    @csrf
                    <input type="hidden" id="editFacultyID" name="faculty_id" value="">
                    <input type="text" id="editUsername" name="username" placeholder="Username" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editPassword" name="password" placeholder="New Password" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editCfmPassword" name="password_confirmation" placeholder="Confirm password" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editEmail" name="email" placeholder="E-mail" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editContact" name="contact_no" placeholder="Contact No." style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editFname" name="f_name" placeholder="First Name" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editLname" name="l_name" placeholder="Last Name" style="width:200px; margin-bottom:10px"></input><br>
                    <input type="text" id="editMatrics" name="matrics" placeholder="Matrics" style="width:200px; margin-bottom:10px"></input><br>
                    <select id="editRole" name="role" style="width:200px">
                        <option value="1">Lecturer</option>
                        <option value="2">Head of Program</option>
                    </select><Br>
                    
                    <input class="editbutton" type="submit" value="Edit Student">
                </form>
            </div>
        </div>
        <div id="overlay"></div>
    </div></div>
</body>

<script>

    function editStudent(faculty_id, username, password, cfmpassword, email, contact, fname, lname, matrics, role){
        console.log('clicked');
        document.getElementById("editFacultyID").value = faculty_id;
        document.getElementById("editUsername").value = username;
        document.getElementById("editPassword").innerHTML = password;
        document.getElementById("editCfmPassword").innerHTML = cfmpassword;
        document.getElementById("editEmail").value = email;
        document.getElementById("editContact").value  = contact;
        document.getElementById("editFname").value  = fname;
        document.getElementById("editLname").value  = lname;
        document.getElementById("editMatrics").value = matrics;
        document.getElementById("editRole").value = role;
    }

    function clearEditForm(){
        document.getElementById("editUsername").innerHTML = "";
        document.getElementById("editPassword").innerHTML = ""
        document.getElementById("editCfmPassword").innerHTML = "";
        document.getElementById("editEmail").innerHTML = "";
        document.getElementById("editContact").innerHTML = "";
        document.getElementById("editFname").innerHTML = "";
        document.getElementById("editLname").innerHTML = "";
        document.getElementById("editMatrics").innerHTML = "";
    }

    $(document).ready(function() {
        $('#att-table').DataTable({
            fixedHeader: {
                header: true,
                footer: true
            }
        });
    });

    
</script>