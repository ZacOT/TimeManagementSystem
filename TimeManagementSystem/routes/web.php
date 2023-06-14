<?php

use App\Http\Controllers\KanbanController;
use App\Http\Controllers\OKRController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;

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

//Dashboard
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/sidebar', function () {
    return view('sidebar');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/kanban', [KanbanController::class, 'getKanbanBoard']);

Route::post('/insertKanbanCategory', [KanbanController::class, 'insertKanbanCategory']);

Route::get('/objectives', [OKRController::class, 'getObjectives']);
Route::get('/okr', [OKRController::class, 'getOKR']);

Route::get('/calendar', [CalendarController::class, 'getCalendar']);

//Login Register
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'validateLogin']);
Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/register', function () {
    return view('register');
});