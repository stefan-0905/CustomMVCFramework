<?php

namespace GradeSystem\Services;

use GradeSystem\Database\StudentRepository;
use GradeSystem\Models\Exceptions\NotFoundException;
use GradeSystem\Models\Student;

class CSMB implements ISchoolBoard
{
    /**
     * @param $id
     * @return Student|null
     * @throws NotFoundException
     */
    public function findStudent(int $id) : Student
    {
        if(!is_numeric($id)) throw new \InvalidArgumentException("Parameter value needs to be an integer");

        $studentRepository = new StudentRepository();
        $student = $studentRepository->findById($id);

        if(!$student)
        {
            throw new NotFoundException("We couldn't find this record");
        }

        $student->average = $this->calculateAverage($student);
        $student->result = $this->calculateResult($student);
        $student->setSchoolBoard("CSMB");

        return $student;
    }

    private function calculateAverage(Student $student) : float
    {
        if(count($student->grades) > 2)
        {
            sort($student->grades);

            $sum = 0;
            for($i = 1; $i < count($student->grades); $i++)
            {
                $sum += $student->grades[$i];
            }

            return $sum / (count($student->grades) - 1);
        }

        return array_sum($student->grades) / count($student->grades);
    }

    private function calculateResult(Student $student) : string
    {
        if($student->grades[count($student->grades) - 1] > 8) return "PASS";

        return "FAIL";
    }
}