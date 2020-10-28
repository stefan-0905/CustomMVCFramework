<?php

namespace App\Services;

use App\Models\Student;

class Parser
{
    public static function parse(array $student) : ?Student
    {
        if(empty($student)) return NULL;

        $id = $student["id"];
        $name = $student["name"];

        $stringGrades = $student["grades"];
        $grades = explode(",", $stringGrades);

        return new Student($id, $name, $grades);
    }
}