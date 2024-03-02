<?php

use app\Controllers\About;
use app\Controllers\ContactController;
use app\Controllers\HomeController;
use app\Controllers\Notes\NotesController;
use app\Core\Routing\Route;

$router = app('router');

Route::get('/')
    ->controller(HomeController::class)
    ->name('home');

Route::get('/about')
    ->controller(About::class)
    ->name('about');

Route::get('/contact')
    ->controller(ContactController::class)
    ->name('contact');

Route::get('/notes')
    ->controller([NotesController::class, 'index'])
    ->name('notes.index');

Route::get('/note')
    ->controller([NotesController::class, 'show'])
    ->name('notes.show');

Route::delete('/note')
    ->controller([NotesController::class, 'destroy'])
    ->name('notes.destroy');

Route::get('/notes/create')
    ->controller([NotesController::class, 'create'])
    ->name('notes.create');

Route::post('/notes')
    ->controller([NotesController::class, 'store'])
    ->name('notes.store');
