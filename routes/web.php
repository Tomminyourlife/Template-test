<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Route::get('/inserimento-dati', [DataController::class, 'mostraForm']);
Route::post('/inserimento-dati', [DataController::class, 'inserisciDati']);

Route::get('/modifica-record/{id}', [DataController::class, 'mostraModifica'])->name('mostra-modifica');;
Route::put('/salva-modifica/{id}', [DataController::class, 'salvaModifica'])->name('salva-modifica');

Route::get('/visualizza-dati', [DataController::class, 'visualizzaDati'])->name('visualizza-dati');

Route::get('/elimina-record/{id}', [DataController::class, 'eliminaRecord'])->name('elimina-record');


use App\Http\Controllers\UserController;

Route::get('/admin/settings', [UserController::class, 'showSettings'])->name('admin_settings');
Route::get('/admin/settings/edit/{id}', [UserController::class, 'editUser'])->name('admin.settings.edit');
Route::post('/admin/settings/update/{id}', [UserController::class, 'updateUser'])->name('admin.settings.update');









