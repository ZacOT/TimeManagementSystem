<?php
$firstname = Auth::user()->f_name;
$lastname = Auth::user()->l_name;
if (Auth::user()->role == 0) {
    echo "<div class='sidebar'>
                <div class='user'>
                    <img src='/images/defaultprofile.png' height='50' width='50'>
                    <p>$firstname, $lastname</p>
                </div>
                <div class='sidebar-button'>
                    <a class='active' href='/'><img src='/images/dashboard.png' height='25' width='25'>Dashboard</a>
                </div>
                <div class='sidebar-button'>
                    <a class='active' href='/calendar'><img src='/images/calendar.png' height='25' width='25'>Calendar</a>
                </div>
                <div class='sidebar-button'>
                    <a class='active' href='/workspace'><img src='/images/kanban.png' height='25' width='25'>Kanban Board</a>
                </div>
                <div class='sidebar-button'>
                    <a class='active' href='/attendanceleave'><img src='/images/attendance.png' height='25' width='25'>Attendance & Leave</a>
                </div>
                <div class='sidebar-button'>
                    <a class='active' href='/objectives'><img src='/images/okr.png' height='25' width='25'>Objective Key Results</a>
                </div>
                <div class='sidebar-button'>
                    <a class='active' href='/logout'><img src='/images/logout.png' height='25' width='25'>Logout</a>
                </div>
            </div>";
} else if (Auth::user()->role == 1) {
    echo "<div class='sidebar'>
    <div class='user'>
        <img src='/images/defaultprofile.png' height='50' width='50'>
        <p>$firstname</p>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/attendance'><img src='/images/attendance.png' height='25' width='25'>Attendance</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/leavecourselist'><img src='/images/approval.png' height='25' width='25'>Leave Course Approval</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/workspace'><img src='/images/kanban.png' height='25' width='25'>Kanban Board</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/objectives'><img src='/images/okr.png' height='25' width='25'>Objective Key Results</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/logout'><img src='/images/logout.png' height='25' width='25'>Logout</a>
    </div>
    </div>";
} else if (Auth::user()->role == 2) {
    echo "<div class='sidebar'>
    <div class='user'>
        <img src='/images/defaultprofile.png' height='50' width='50'>
        <p>$firstname</p>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/classlist'><img src='/images/classassign.png' height='25' width='25'>Assign Class</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/attendance'><img src='/images/attendance.png' height='25' width='25'>Attendance</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/leaveapprovallist'><img src='/images/approval.png' height='25' width='25'>Leave Management</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/leavecourselist'><img src='/images/approval.png' height='25' width='25'>Leave Course Approval</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/workspace'><img src='/images/kanban.png' height='25' width='25'>Kanban Board</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/objectives'><img src='/images/okr.png' height='25' width='25'>Objective Key Results</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/logout'><img src='/images/logout.png' height='25' width='25'>Logout</a>
    </div>
    </div>";
} else if (Auth::user()->role == 3) {
    echo "<div class='sidebar'>
    <div class='user'>
        <img src='/images/defaultprofile.png' height='50' width='50'>
        <p>$firstname</p>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/admin'><img src='/images/dashboard.png' height='25' width='25'>Admin Panel</a>
    </div>
    <div class='sidebar-button'>
        <a class='active' href='/logout'><img src='/images/dashboard.png' height='25' width='25'>Logout</a>
    </div>
    </div>";
} else {
    echo "<div class='sidebar'>
                    <div class='user'>
                            <img src='/images/defaultprofile.png' height='50' width='50'>
                            <p>GUEST</p>
                    </div>
                    <div class='sidebar-button'>
                        <a class='active' href='/login'><img src='/images/dashboard.png' height='25' width='25'>Login</a>
                    </div>
                </div>";
}
