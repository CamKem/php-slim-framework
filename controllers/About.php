<?php

namespace Controllers;

use Core\Controller;

class About extends Controller
{

    public function __invoke(): string
    {
        return view("about", [
            'heading' => 'About Us',
        ]);
    }

}