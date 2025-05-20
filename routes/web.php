<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

//home
Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

//about us
Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');

//events
Route::get('/events', function () {
    return Inertia::render('Events');
})->name('events');

//contact
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');



Route::resource('posts', PostController::class);

Route::middleware(['auth', RoleMiddleware::class . ':admin,operator'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin,operator'])
    ->patch('/users/{user}/role', [UserController::class, 'updateRole']);

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
