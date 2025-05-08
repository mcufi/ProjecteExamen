<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Users', [UserController::class, 'ShowUsers'])->name('users.show');
Route::get('/AddUser', function(){return Inertia::render('CreateUser');});
Route::post('/AddUser', [UserController::class, 'AddUsers'])->name('UserId.add');
Route::get('/EditUser/{id}', [UserController::class, 'ShowEditUsers'])->name('UserId.edit');
Route::post('/EditUser/{id}', [UserController::class, 'EditUsers'])->name('UserId.update');
Route::get('/DeleteUser/{id}', [UserController::class, 'DeleteUser'])->name('UserId.delete');

Route::get('/SearchUser', [UserController::class, 'SearchUser']);
Route::get('/Users/Filter{category}', [UserController::class, 'filter']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
