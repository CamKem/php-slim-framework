<?php

namespace App\Controllers;

use App\Core\Controller;

class About extends Controller
{

    public function __invoke(): string
    {
        return view("about", [
            'heading' => 'About Us',
        ]);
    }

}