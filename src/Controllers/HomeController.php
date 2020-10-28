<?php

namespace App\Controllers;

use App\Framework\Page;

class HomeController extends Controller
{
    public static function index() : Page
    {
        return new Page("Index", ["title" => "Home"]);
    }
}