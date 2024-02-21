<?php

namespace app\Controllers;

use app\Core\Controller;

class HomeController extends Controller
{
    public function __invoke(): string
    {

        return view("index", [
            'heading' => 'Home',
        ]);
    }

}