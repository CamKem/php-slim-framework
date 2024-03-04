<?php

use App\Controllers\Auth\PasswordResetController;
use App\Controllers\Auth\RegistrationController;
use App\Controllers\Auth\SessionController;
use App\Core\Routing\RouteProxy as Route;

// Exception handling
Route::get('/error')
    ->controller(fn() => view('error.exception'))
    ->name('exception.handle');
