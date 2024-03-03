<?php

namespace App\Controllers;

use App\Core\Controller;

class InfoController extends Controller
{

    public function __invoke(): string
    {
        return view("info", [
            'heading' => 'PHP InfoController',
        ]);
    }

}