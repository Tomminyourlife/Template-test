<?php

use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/admin/settings', [UserController::class, 'showSettings'])->name('admin_settings');
    Route::get('/admin/settings/edit/{id}', [UserController::class, 'editUser'])->name('admin.settings.edit');
    Route::post('/admin/settings/update/{id}', [UserController::class, 'updateUser'])->name('admin.settings.update');
    Route::get('/admin/pages/alltickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticketId}/addComment', [TicketController::class, 'addComment'])->name('tickets.addComment');
    Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
});

Route::get('/', [WelcomeController::class, 'index']);
Route::post('/', [WelcomeController::class, 'sendMessage'])->name('sendMessage');
Route::post('/complete-email', [WelcomeController::class, 'completeEmail'])->name('completeEmail');
Route::post('/save-category', [WelcomeController::class, 'saveCategory'])->name('save-category');
Route::get('/show-summary/{ticketId}', [WelcomeController::class, 'showSummary'])->name('show-summary');


Auth::routes();
Route::get('/customer/login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/dashboard', [CustomerLoginController::class, 'attemptLogin'])->name('customer.login.submit');
Route::get('/customer/dashboard', [CustomerLoginController::class, 'dashboard'])->name('dashboard');

Route::middleware(['web', 'customer.auth'])->group(function () {
    Route::post('/customer/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');
    Route::get('/admin/pages/ticket', [TicketingController::class, 'index'])->name('ticketing.index');
    Route::get('/tickets/{ticket}/comments', [TicketingController::class, 'showComments'])->name('ticket.comments');
    Route::post('/comments/store', [TicketingController::class, 'store'])->name('comment.store');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');















