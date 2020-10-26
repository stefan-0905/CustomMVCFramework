<?php

namespace GradeSystem\Services;

use GradeSystem\Models\Student;

class TextFormatter
{
    public static function json(Student $student) : string
    {
        return json_encode($student);
    }

    public static function xml(Student $student) : string
    {
        header('Content-Type: application/xml');

        $studentXML = new \SimpleXMLElement("<student></student>");
        $studentXML->addChild("id", (string)$student->id);
        $studentXML->addChild("name", $student->name);
        $gradesXML = $studentXML->addChild("grades");
        foreach($student->grades as $grade)
            $gradesXML->addChild("grade", (string)$grade);
        $studentXML->addChild("average", (string)$student->average);
        $studentXML->addChild("result", (string)$student->result);

        return (string)$studentXML->asXML();

    }
}