<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Models\Proyecto;
use App\Models\User;

Route::get('/', function () {
    $totalUsers = User::count();
    $totalProjects = Proyecto::count();
    $recentProjects = Proyecto::where('created_at', '>=', now()->subMonth())->count();

    return view('landing.index', [
        'totalUsers' => $totalUsers,
        'totalProjects' => $totalProjects,
        'recentProjects' => $recentProjects,
    ]);
})->name('raiz');


Route::get('/login',
    [UserController::class, 'formLogin']
)->name('formLogin');

Route::post('/login',
    [UserController::class, 'validateLogin']
)->name('validateLogin');

Route::post('logout', [UserController::class, 'logout']
)->name('logout');


Route::get('/register',
    [UserController::class, 'newUser']
)->name('newUser');

Route::post('/register',
    [UserController::class, 'register']
)->name('validateRegister');


Route::get('/backoffice/dashboard', function () {
    $user = Auth::user();
    if($user == null){
        return redirect()->route('formLogin')->withErrors([
            'email' => 'Usuario no autenticado'
        ]);
    }
    $proyectos = Proyecto::query()->where('created_by', $user->id)->get();
    return view('backoffice.dashboard', ['user' => $user, 'proyectos' => $proyectos]);
})->name('backoffice.dashboard');

