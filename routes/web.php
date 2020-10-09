<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/admin/login', [Admin::class, 'view_login']);
Route::get('/admin/dashboard', [Admin::class, 'view_dashboard']);
Route::get('/admin/logout', [Admin::class, 'view_logout']);
Route::get('/admin/bypass', [Admin::class, 'login_bypass']);
//Route::get('/forgot', 'User@forgot');

//Route::post('/user/forgot', 'UserAct@forgot');
Route::get('/login', [User::class, 'view_login']);
Route::get('/dashboard', [User::class, 'view_dashboard']);
Route::get('/preview/{id}', [User::class, 'view_game']);
Route::get('/logout', [User::class, 'view_logout']);

Route::get('/edit/{id}', [User::class, 'view_edit']);


//free view
//Route::get('/view/{id}', [User::class, 'view_game']);

