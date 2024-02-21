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
