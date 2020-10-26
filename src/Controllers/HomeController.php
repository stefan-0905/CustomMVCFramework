<?php

namespace GradeSystem\Controllers;

use GradeSystem\Framework\Page;

class HomeController extends Controller
{
    public static function index() : Page
    {
        return new Page("Index", ["title" => "Home"]);
    }
}