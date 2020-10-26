<?php

namespace GradeSystem\Services;

use GradeSystem\Models\Student;

class CSMBCalculator implements IStudentResultCalculator
{
    public function calculate(Student $student) : void
    {
        $this->calculateAverage($student);
        $this->calculateResult($student);
        $student->setSchoolBoard("CSMB");
    }

    private function calculateAverage(Student $student) : void
    {
        if(count($student->grades) > 2)
        {
            sort($student->grades);

            $sum = 0;
            for($i = 1; $i < count($student->grades); $i++)
            {
                $sum += $student->grades[$i];
            }

            $student->average = $sum / (count($student->grades) - 1);

            return;
        }

        $student->average = array_sum($student->grades) / count($student->grades);
    }

    private function calculateResult(Student $student) : void
    {
        $student->result = ($student->grades[count($student->grades) - 1] > 8) ? "PASS" : "FAIL";
    }
}