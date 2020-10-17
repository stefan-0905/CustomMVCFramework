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
        $studentXML->addChild("id", $student->id);
        $studentXML->addChild("name", $student->name);
        $gradesXML = $studentXML->addChild("grades");
        foreach($student->grades as $grade)
            $gradesXML->addChild("grade", $grade);
        $studentXML->addChild("average", $student->average);
        $studentXML->addChild("result", $student->result);

        return $studentXML->asXML();

    }
}