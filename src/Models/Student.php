<?php

namespace GradeSystem\Models;

use GradeSystem\Services\TextFormatter;

class Student extends AbstractModel
{
    public int $id;
    public string $name;
    public array $grades;
    public float $average;
    public string $result;

    private $schoolBoard;

    public function __construct($id, $name, $grades)
    {
        $this->id = $id;
        $this->name = $name;
        $this->grades = $grades;
    }

    public function setSchoolBoard(string $schoolBoard)
    {
        $this->schoolBoard = $schoolBoard;
    }

    public function __toString()
    {
        if($this->schoolBoard == "CSM")
            return TextFormatter::json($this);

        return TextFormatter::xml($this);
    }
}