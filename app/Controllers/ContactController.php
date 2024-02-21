<?php

namespace app\Controllers;

use app\Core\Controller;

class ContactController extends Controller
{

    public function __invoke(): string
    {
        return view("contact", [
            'heading' => 'Contact Us'
        ]);
    }

}