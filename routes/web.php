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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Workspace
Route::get('/index/workspace', [App\Http\Controllers\WorkspaceController::class, 'index'])->name('workspace:index');
Route::post('/store/workspace', [App\Http\Controllers\WorkspaceController::class, 'store'])->name('workspace:store');
Route::get('/show/workspace/{workspace}', [App\Http\Controllers\WorkspaceController::class, 'show'])->name('workspace:show');
Route::get('/delete/workspace/{workspace}', [App\Http\Controllers\WorkspaceController::class, 'destroy'])->name('workspace:delete');


//Task
Route::get('/index/task', [App\Http\Controllers\TaskController::class, 'index'])->name('task:index');
Route::post('/store/task/{workspace}', [App\Http\Controllers\TaskController::class, 'store'])->name('task:store');
Route::get('/show/task/{task}', [App\Http\Controllers\TaskController::class, 'show'])->name('task:show');
Route::get('/update/task/{task}', [App\Http\Controllers\TaskController::class, 'update'])->name('task:update');
Route::get('/delete/task/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('task:delete');

//Google Socialite
Route::get('auth/google', [App\Http\Controllers\SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\SocialiteController::class, 'handleGoogleCallback']);

