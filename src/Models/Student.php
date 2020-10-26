<?php

namespace GradeSystem\Models;

use GradeSystem\Services\TextFormatter;

class Student
{
    public int $id;
    public string $name;
    public array $grades;
    public float $average;
    public string $result;

    private string $schoolBoard;

    public function __construct(int $id, string $name,  array $grades)
    {
        $this->id = $id;
        $this->name = $name;
        $this->grades = $grades;
        $this->average = 0;
        $this->result = "FAIL";
        $this->schoolBoard = "";
    }

    public function setSchoolBoard(string $schoolBoard) : void
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