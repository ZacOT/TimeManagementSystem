<?php

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
Route::get('/kanban', function () {
    return view('kanban');
});


//Login Register
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'validateLogin']);
Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/register', function () {
    return view('register');
});