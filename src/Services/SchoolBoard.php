<?php

namespace GradeSystem\Services;

use GradeSystem\Database\IRepository;
use GradeSystem\Models\Exceptions\RecordNotFoundException;
use GradeSystem\Models\Student;

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