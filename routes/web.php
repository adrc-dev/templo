<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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



Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
