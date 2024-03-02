<?php

namespace App\Controllers;

use App\Core\Controller;

class ContactController extends Controller
{

    public function __invoke(): string
    {
        return view("contact", [
            'heading' => 'Contact Us'
        ]);
    }

}