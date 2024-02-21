<?php

namespace Controllers;

use Core\Controller;

class Contact extends Controller
{

    public function __invoke(): string
    {
        return view("contact", [
            'heading' => 'Contact Us'
        ]);
    }

}