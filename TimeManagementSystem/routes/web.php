<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\OKRController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\HOPController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Auth */
Route::get('/login', function () {return view('login');})->name('login');
Route::post('/login', [LoginController::class, 'validateLogin']);
Route::get('/logout', [LoginController::class, 'logout']);

/* General Tools */
Route::get('/sidebar', function () {
    return view('sidebar');
});

/* Admin */
Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', function () {return view('admin');});

    Route::get('/manageusers', [AdminController::class, 'getUsers'])->middleware(Authenticate::class)->name('manageusers');
    Route::post('/insertuser', [AdminController::class, 'insertUser'])->middleware(Authenticate::class)->name('insertuser');

    Route::get('/managestudents', [AdminController::class, 'getStudents'])->middleware(Authenticate::class)->name('managestudents');
    Route::post('/insertstudent', [AdminController::class, 'insertStudent'])->middleware(Authenticate::class)->name('insertstudent');
    Route::post('/editstudent', [AdminController::class, 'editStudent'])->middleware(Authenticate::class)->name('editstudent');

    Route::get('/managefaculty', [AdminController::class, 'getFaculty'])->middleware(Authenticate::class)->name('managefaculty');
    Route::post('/insertfaculty', [AdminController::class, 'insertFaculty'])->middleware(Authenticate::class)->name('insertfaculty');
    Route::post('/editfaculty', [AdminController::class, 'editFaculty'])->middleware(Authenticate::class)->name('editfaculty');

    Route::get('/managecourses', [AdminController::class, 'getCourses'])->middleware(Authenticate::class)->name('managecourses');
    Route::post('/insertcourse', [AdminController::class, 'insertCourse'])->middleware(Authenticate::class)->name('insertcourse');
    Route::post('/editcourse', [AdminController::class, 'editCourse'])->middleware(Authenticate::class)->name('editcourse');

    Route::get('/manageprograms', [AdminController::class, 'getPrograms'])->middleware(Authenticate::class)->name('manageprograms');
    Route::post('/insertprogram', [AdminController::class, 'insertProgram'])->middleware(Authenticate::class)->name('insertprogram');
    Route::post('/assignprogram', [AdminController::class, 'assignProgram'])->middleware(Authenticate::class)->name('assignprogram');

    Route::get('/manageclasstypes', [AdminController::class, 'getClassType'])->middleware(Authenticate::class)->name('manageclasstypes');
    Route::post('/insertclasstype', [AdminController::class, 'insertClassType'])->middleware(Authenticate::class)->name('insertclasstype');
    Route::post('/editclasstype', [AdminController::class, 'editClassType'])->middleware(Authenticate::class)->name('editclasstype');
    Route::post('/deleteclasstype', [AdminController::class, 'deleteClassType'])->middleware(Authenticate::class)->name('deleteclasstype');

    Route::get('/managesemesters', [AdminController::class, 'getSemesters'])->middleware(Authenticate::class)->name('managesemesters');
    Route::post('/insertsemester', [AdminController::class, 'insertSemester'])->middleware(Authenticate::class)->name('insertsemester');
    Route::post('/editsemester', [AdminController::class, 'editSemester'])->middleware(Authenticate::class)->name('editsemester');
    Route::post('/deletesemester', [AdminController::class, 'deleteSemester'])->middleware(Authenticate::class)->name('deletesemester');
 });

 /* Head of Program */
Route::group(['middleware' => ['hop']], function () {
    Route::get('/classlist', [HOPController::class, 'getClassList'])->middleware(Authenticate::class)->name('classlist');
    Route::post('/insertclass', [HOPController::class, 'insertClassList'])->middleware(Authenticate::class)->name('insertclass');

    Route::get('/assignclass', [HOPController::class, 'getAssign'])->middleware(Authenticate::class)->name('assignclass');
    Route::post('/assignstudents', [HOPController::class, 'assignStudents'])->middleware(Authenticate::class)->name('assignstudents');

    Route::get('/leaveapprovallist', [HOPController::class, 'getLeaves'])->middleware(Authenticate::class)->name('leaveapprovallist');
    Route::post('/leaveapproval', [HOPController::class, 'getLeaveApproval'])->middleware(Authenticate::class)->name('leaveapproval');
});

/* Lecturer */
Route::group(['middleware' => ['lecturer']], function () {
    Route::get('/leavecourselist', [LecturerController::class, 'getRelatedLeaves'])->middleware(Authenticate::class)->name('leavecourselist');
    Route::post('/leavecourseapproval', [LecturerController::class, 'getLeaveCourseApproval'])->middleware(Authenticate::class)->name('leavecourseapproval');
    Route::post('/approveleavecourse', [LecturerController::class, 'approveLeaveCourse'])->middleware(Authenticate::class)->name('approveleavecourse');
});

/* User */
Route::group(['middleware' => ['login']], function () {

    Route::get('/', function () {return view('dashboard');})->name('dashboard');
    /* Kanban */
    Route::get('/workspace', [KanbanController::class, 'getWorkspace'])->middleware(Authenticate::class)->name('workspace');
    Route::get('/kanban', [KanbanController::class, 'getKanbanBoard'])->middleware(Authenticate::class);
    Route::post('/insertkanbanboard', [KanbanController::class, 'insertKanbanBoard'])->middleware(Authenticate::class)->name('insertkanbanboard');
    Route::post('/insertkanbancard', [KanbanController::class, 'insertKanbanCard'])->middleware(Authenticate::class)->name('insertkanbancard');
    Route::post('/insertkanbancategory', [KanbanController::class, 'insertKanbanCategory'])->middleware(Authenticate::class)->name('insertkanbancategory');
    Route::post('/updatekanbancategory', [KanbanController::class, 'updateKanbanCategory'])->middleware(Authenticate::class)->name('updatekanbancategory');
    Route::post('/insertcomment', [KanbanController::class, 'insertComment'])->middleware(Authenticate::class)->name('insertcomment');
    /* Objectives */
    Route::get('/objectives', [OKRController::class, 'getObjectives'])->middleware(Authenticate::class)->name('objectives');
    Route::post('/objectives', [OKRController::class, 'insertObjectives'])->middleware(Authenticate::class)->name('objectives');

    /* OKR */
    Route::get('/okr', [OKRController::class, 'getOKR'])->middleware(Authenticate::class)->name('okr');
    Route::post('/okr', [OKRController::class, 'insertOKR'])->middleware(Authenticate::class)->name('okr');
    Route::post('/editkr', [OKRController::class, 'editKR'])->middleware(Authenticate::class)->name('editkr');
    Route::post('/deletekr', [OKRController::class, 'deleteKR'])->middleware(Authenticate::class)->name('deletekr');

    /* Calendar */
    Route::get('/calendar', [CalendarController::class, 'getCalendar'])->middleware(Authenticate::class);

    /* Leave */
    Route::get('/leaveapplication', [LeaveController::class, 'getLeaveApplication'])->middleware(Authenticate::class)->name('leaveapplication');
});

/* Attendance Leave */
Route::get('/attendanceleave', [LecturerController::class, 'getAttendanceLeave'])->middleware(Authenticate::class)->name('attendanceleave');
Route::get('/attendance', [LecturerController::class, 'getAttendance'])->middleware(Authenticate::class)->name('attendance');
Route::post('/insertattendance', [LecturerController::class, 'insertAttendance'])->middleware(Authenticate::class)->name('insertattendance');

Route::get('/attendancelist', [LecturerController::class, 'getAttendanceList'])->middleware(Authenticate::class)->name('attendancelist');
Route::post('/attendancelist', [LecturerController::class, 'getAttendanceList'])->middleware(Authenticate::class)->name('attendancelist');
Route::post('/updateattendancelist', [LecturerController::class, 'updateAttendanceList'])->middleware(Authenticate::class)->name('updateattendancelist');

Route::get('/checkattendance', [LeaveController::class, 'checkAttendance'])->middleware(Authenticate::class)->name('checkAttendance');

Route::get('/applyleave', [LeaveController::class, 'applyLeave'])->middleware(Authenticate::class)->name('applyleave');
Route::post('/insertleave', [LeaveController::class, 'insertLeave'])->middleware(Authenticate::class)->name('insertleave');

Route::get('/leaveapplication', [LeaveController::class, 'getLeaveApplication'])->middleware(Authenticate::class)->name('leaveapplication');
Route::get('/leavelist', [LeaveController::class, 'getLeavesList'])->middleware(Authenticate::class)->name('leavelist');

Route::post('/addselclass', [LeaveController::class, 'addSelClass'])->middleware(Authenticate::class)->name('addselclass');

Route::get('/debug', [HOPController::class, 'getLeaves'])->name('debug');
Route::post('/debug', [LecturerController::class, 'debug'])->name('debug');


Route::get('/mailtest', function() {Mail::to('bonjour@mailtrap.io’')->send(new MailTest());});