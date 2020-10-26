<?php

namespace GradeSystem\Services;

use GradeSystem\Models\Student;
use GradeSystem\Database\IRepository;

/**
 * Class StudentFactory - Intermediate service for parsing db result
 * @package GradeSystem\Services
 */
class StudentFactory implements IStudentFactory
{
    private IRepository $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Find student by id
     *
     * @param int $id
     * @return Student|null
     */
    public function findById(int $id) : ?Student
    {
        return Parser::parse($this->repository->findById($id));
    }
}