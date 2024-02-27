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
Route::post('/check-vat', [WelcomeController::class, 'checkVat']);
Route::post('/save-category', [WelcomeController::class, 'saveCategory']);
Route::post('/create-ticket', [TicketController::class, 'createTicket']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');















