<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TicketController;


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/admin/settings', [UserController::class, 'showSettings'])->name('admin_settings');
    Route::get('/admin/settings/edit/{id}', [UserController::class, 'editUser'])->name('admin.settings.edit');
    Route::post('/admin/settings/update/{id}', [UserController::class, 'updateUser'])->name('admin.settings.update');
});

Route::get('/', [WelcomeController::class, 'index']);
Route::post('/send-message', [WelcomeController::class, 'sendMessage'])->name('sendMessage');
Route::post('/save-category', [WelcomeController::class, 'saveCategory'])->name('save-category');
//Route::post('/create-ticket', [TicketController::class, 'createTicket']);

//Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('ticket.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');















