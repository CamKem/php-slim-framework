<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class ContactController extends Controller
{

    public function index(): View
    {
        return view("contact", [
            'heading' => 'Contact Us'
        ]);
    }

    public function store()
    {
        // validate the request
    }

}