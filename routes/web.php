<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NinjaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', \App\Http\Middleware\EnsureProfileComplete::class])->name('dashboard');


// https://laraveldaily.com/post/middleware-laravel-main-things-to-know
Route::middleware('auth')->group(function () { // 'auth' group is users that are logged in

    // User Profile routes 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
    // Ninja routes
    Route::get('/ninjas', [NinjaController::class, 'index'])->name('ninjas.index');
    Route::get('/ninjas/create', [NinjaController::class, 'create'])->name('ninjas.create');
    Route::get('/ninjas/{ninja}', [NinjaController::class, 'show'])->name('ninjas.show');
    Route::post('/ninjas', [NinjaController::class, 'store'])->name('ninjas.store');
    Route::delete('/ninjas/{ninja}', [NinjaController::class, 'destroy'])->name('ninjas.destroy');

    // Vote route
    Route::post('/ninjas/{ninja}/vote', [NinjaController::class, 'vote'])->name('ninjas.vote');
});

require __DIR__.'/auth.php';

