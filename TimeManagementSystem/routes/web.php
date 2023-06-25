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

    Route::get('/manageclasses', [AdminController::class, 'getPrograms'])->middleware(Authenticate::class)->name('manageprograms');
    Route::post('/insertclass', [AdminController::class, 'insertProgram'])->middleware(Authenticate::class)->name('insertprogram');

    Route::get('/managesemesters', [AdminController::class, 'getSemesters'])->middleware(Authenticate::class)->name('managesemesters');
    Route::post('/insertsemester', [AdminController::class, 'insertProgram'])->middleware(Authenticate::class)->name('insertprogram');


 });

 /* Head of Program */
Route::group(['middleware' => ['hop']], function () {
    Route::get('/classlist', [HOPController::class, 'getClassList'])->middleware(Authenticate::class)->name('classlist');
    Route::post('/insertclass', [HOPController::class, 'insertClassList'])->middleware(Authenticate::class)->name('insertclass');
});

/* Lecturer */
Route::group(['middleware' => ['lecturer']], function () {

});

/* User */
Route::group(['middleware' => ['login']], function () {

    Route::get('/', function () {return view('dashboard');})->name('dashboard');
    /* Kanban */
    Route::get('/kanban', [KanbanController::class, 'getKanbanBoard'])->middleware(Authenticate::class);
    Route::get('/kanbancard', function () {return view('kanbancard');})->name('kanbancard');
    Route::post('/insertKanbanCategory', [KanbanController::class, 'insertKanbanCategory'])->middleware(Authenticate::class);

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

Route::get('/applyleave', [LeaveController::class, 'applyLeave'])->middleware(Authenticate::class)->name('applyleave');
Route::get('/debug', function () {return view('debug');})->name('debug');
Route::post('/debug', [LecturerController::class, 'debug'])->name('debug');

Route::get('/mails', function () {return view('mails');})->name('mails');

Route::get('/mailtest', function() {Mail::to('bonjour@mailtrap.io’')->send(new MailTest());});