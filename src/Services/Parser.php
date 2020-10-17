<?php

namespace GradeSystem\Services;

use GradeSystem\Models\Student;

class Parser
{
    public static function parse($student) : Student
    {
        if(empty($student)) return NULL;

        $id = $student["id"];
        $name = $student["name"];

        $stringGrades = $student["grades"];
        $grades = explode(",", $stringGrades);

        return new Student($id, $name, $grades);
    }
}