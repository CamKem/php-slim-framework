<?php

use app\Controllers\About;
use app\Controllers\ContactController;
use app\Controllers\HomeController;
use app\Controllers\Notes\NotesController;
use app\Core\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/contact', ContactController::class)->name('contact');

Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');
Route::get('/note', [NotesController::class, 'show'])->name('notes.show');
Route::delete('/note', [NotesController::class, 'destroy'])->name('notes.destroy');
Route::get('/notes/create', [NotesController::class, 'create'])->name('notes.create');
Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');

// TODO: make the calls static, so that the router is a singleton.
// so we don't have multiple instances of the router.
// maybe we should make a Route class that stores the routes in a static array.
// but each route is an instance of the Route class.
// then the Router class can have a static method to get the routes.
//Router::get('/Notes', [NotesController::class, 'index']);

