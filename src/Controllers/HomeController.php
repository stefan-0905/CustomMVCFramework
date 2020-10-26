<?php

namespace GradeSystem\Controllers;

use GradeSystem\Models\Page;

class HomeController extends Controller
{
    public static function Index() : Page
    {
        return new Page("Index", ["title" => "Home"]);
    }
}