<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\Admin;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::post('admin/login', [Admin::class, 'api_login']);
Route::post('admin/create', [Admin::class, 'api_create']);
Route::get('admin/delete/{Publisher_Id}', [Admin::class, 'api_delete']);
Route::get('admin/data', [Admin::class, 'api_getdata']);

/*
Route::get('/api/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('login', [User::class, 'api_login']);
Route::get('getGame', [User::class, 'api_getGame']);
Route::post('create', [User::class, 'api_createGame']);
Route::get('getGame/{id}',[User::class, 'api_getGameByid']);
Route::put('update', [User::class, 'api_update']);
Route::delete('delete', [User::class, 'api_delete']);



//Route::get('view/{id}', [View::class, 'api_view']);

