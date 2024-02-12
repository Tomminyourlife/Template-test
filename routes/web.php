<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatbotController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/settings', [UserController::class, 'showSettings'])->name('admin_settings');
Route::get('/admin/settings/edit/{id}', [UserController::class, 'editUser'])->name('admin.settings.edit');
Route::post('/admin/settings/update/{id}', [UserController::class, 'updateUser'])->name('admin.settings.update');


Route::get('/admin/pages/about', [ChatbotController::class, 'showChat'])->name('chat.show');
Route::post('/admin/pages/about', [ChatbotController::class, 'handleChat'])->name('chat.handle');













