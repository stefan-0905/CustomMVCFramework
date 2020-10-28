<?php

namespace App\Services;

use App\Models\Student;

interface IStudentResultCalculator
{
    /**
     * Calculate grades average and if the student has passed or failed
     * @param Student $student
     */
    public function calculate(Student $student) : void;
}