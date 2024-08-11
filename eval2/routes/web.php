<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('landing.index');
})->name('raiz');


Route::get('/login',
    [UserController::class, 'formLogin']
)->name('formLogin');

Route::post('/login',
    [UserController::class, 'validateLogin']
)->name('validateLogin');



Route::get('/register',
    [UserController::class, 'newUser']
)->name('newUser');

Route::post('/register',
    [UserController::class, 'register']
)->name('validateRegister');


Route::get('/backoffice/dashboard', function () {
    return view('backoffice.dashboard');
})->name('backoffice.dashboard');
