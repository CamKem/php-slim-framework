<?php

use App\Controllers\AboutController;
use App\Controllers\ChallengesController;
use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\InfoController;
use App\Controllers\NotesController;
use App\Core\Routing\RouteProxy as Route;

include base_path('routes/error.php');
include base_path('routes/auth.php');

Route::get('/')
    ->controller(HomeController::class)
    ->name('home');

Route::get('/info')
    ->controller(InfoController::class)
    ->name('info');

Route::get('/challenges')
    ->controller(ChallengesController::class)
    ->name('challenges');

Route::get('/about')
    ->controller(AboutController::class)
    ->name('about');

Route::get('/contact')
    ->controller([ContactController::class, 'index'])
    ->name('contact.index');

Route::post('/contact')
    ->controller([ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/notes')
    ->middleware('auth')
    ->controller([NotesController::class, 'index'])
    ->name('notes.index');

Route::get('/note')
    ->middleware('auth')
    ->controller([NotesController::class, 'show'])
    ->name('notes.show');

Route::delete('/note')
    ->middleware('auth')
    ->controller([NotesController::class, 'destroy'])
    ->name('notes.destroy');

Route::get('/notes/create')
    ->middleware('auth')
    ->controller([NotesController::class, 'create'])
    ->name('notes.create');

Route::post('/notes')
    ->middleware('auth')
    ->controller([NotesController::class, 'store'])
    ->name('notes.store');
