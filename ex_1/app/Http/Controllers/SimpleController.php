<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpleController extends Controller
{
    public function greet()
    {
        return "Hello, welcome to Laravel!";
    }
}
