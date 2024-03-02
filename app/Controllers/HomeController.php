<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function __invoke(): string
    {

        return view("index", [
            'heading' => 'Home',
        ]);
    }

}