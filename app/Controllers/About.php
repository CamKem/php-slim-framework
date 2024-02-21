<?php

namespace app\Controllers;

use app\Core\Controller;

class About extends Controller
{

    public function __invoke(): string
    {
        return view("about", [
            'heading' => 'About Us',
        ]);
    }

}