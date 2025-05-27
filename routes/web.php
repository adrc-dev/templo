<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;

// home
Route::get('/', [HomeController::class, 'index'])->name('home');

// quienes somos
Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');

// eventos admin
Route::middleware(['auth', RoleMiddleware::class . ':admin,operator'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event:slug}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event:slug}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event:slug}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('events/{event:slug}/attendees', [EventController::class, 'attendees'])
        ->name('admin.events.attendees');
    Route::get('events/admin', [EventController::class, 'adminEvents'])
        ->name('admin.events');
    Route::put('/events/{event:slug}/toggle', [EventController::class, 'toggleStatus']);
});

// eventos
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

// eventos inscripciones
Route::post('/events/{event:slug}/register', [EventRegistrationController::class, 'store'])
    ->middleware(['auth'])
    ->name('event.register');

// eventos desinscripciones
Route::delete('/events/{event:slug}/unsubscribe', [EventRegistrationController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('event.unsubscribe');

//contacto
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

// hacerse socio
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/hazte-socio', [MemberController::class, 'create'])->name('member.create');
    Route::post('/hazte-socio', [MemberController::class, 'store'])->name('member.store');
});

// Lets see later TODOOOOOO
// Route::resource('posts', PostController::class);

// dashboard
Route::middleware(['auth', RoleMiddleware::class . ':admin,operator'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// cambiar rol de usuario
Route::middleware(['auth', RoleMiddleware::class . ':admin,operator'])
    ->patch('/users/{user}/role', [UserController::class, 'updateRole']);

// borrar usuarios
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('can:delete,user');

// activar socio
Route::post('/admin/users/{user}/activate-membership', [UserController::class, 'activateMembership'])->middleware('auth');

// aulas
Route::middleware(['auth'])->group(function () {
    Route::get('/aulas', [AulaController::class, 'index'])->name('aulas.index');
});
// administrador videos
Route::middleware(['auth', RoleMiddleware::class . ':admin,operator'])->group(function () {
    Route::resource('videos', \App\Http\Controllers\VideoController::class)->except(['show']);
});

// tienda
Route::get('/shop', function () {
    return Inertia::render('Shop');
})->name('shop');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
