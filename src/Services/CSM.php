<?php

namespace GradeSystem\Services;

use GradeSystem\Database\StudentRepository;
use GradeSystem\Models\Exceptions\NotFoundException;
use GradeSystem\Models\Student;

class CSM implements ISchoolBoard
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
        $student->setSchoolBoard("CSM");

        return $student;
    }

    private function calculateAverage(Student $student) : float
    {
        return array_sum($student->grades) / count($student->grades);
    }

    private function calculateResult(Student $student) : string
    {
        if($student->average >= 7) return "PASS";

        return "FAIL";
    }
}