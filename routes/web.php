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
Route::middleware('auth')->group(function () { // 'auth' User has to be logged in

    // User Profile routes 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Profile Complete routes:
    // (Future options: 1.Apply ProfileComplete middleware to ALL auth routes 2.Apply to specific routes 3.Exclude routes)
    Route::get('/profile/complete-profile', [\App\Http\Controllers\ProfileCompleteController::class, 'show'])->name('profile.complete');
    Route::post('/profile/complete-profile', [\App\Http\Controllers\ProfileCompleteController::class, 'update'])->name('profile.complete-profile.update');

    // Ninja routes
    Route::get('/ninjas', [NinjaController::class, 'index'])->name('ninjas.index');
    Route::get('/ninjas/create', [NinjaController::class, 'create'])->name('ninjas.create');
    
    // Because route parameter is named {ninja} and your controller method variable is named $ninja, Laravel knows they belong together.

    // Laravel defaults to the primary key (id) of the model as the route parameter.

    Route::get('/ninjas/{ninja}', [NinjaController::class, 'show'])->name('ninjas.show');
    
    // Change slug to name - NEW
    //Route::get('/ninjas/{ninja:name}', [NinjaController::class, 'show'])->name('ninjas.show');

    Route::post('/ninjas', [NinjaController::class, 'store'])->name('ninjas.store');
    Route::delete('/ninjas/{ninja}', [NinjaController::class, 'destroy'])->name('ninjas.destroy');

    // Vote route
    Route::post('/ninjas/{ninja}/vote', [NinjaController::class, 'vote'])->name('ninjas.vote');
});

require __DIR__.'/auth.php';

