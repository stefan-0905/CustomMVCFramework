<?php

namespace App\Services;

use App\Database\IRepository;
use App\Models\Exceptions\RecordNotFoundException;
use App\Models\Student;

class SchoolBoard implements ISchoolBoard
{
    private IStudentFactory $studentFactory;
    private IStudentResultCalculator $calculator;

    /**
     * CSM constructor.
     * @param IRepository $repository
     * @param IStudentResultCalculator $calculator
     */
    public function __construct(IRepository $repository, IStudentResultCalculator $calculator)
    {
        $this->studentFactory = new StudentFactory($repository);
        $this->calculator = $calculator;
    }

    public function findStudent(int $id): ?Student
    {
        $student = $this->studentFactory->findById($id);

        if(!$student) {
            throw new RecordNotFoundException("We couldn't find this record");
        }

        $this->calculator->calculate($student);

        return $student;
    }
}