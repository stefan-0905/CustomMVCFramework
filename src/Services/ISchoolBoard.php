<?php

namespace GradeSystem\Services;

use GradeSystem\Models\Exceptions\RecordNotFoundException;
use GradeSystem\Models\Student;

interface ISchoolBoard
{
    /**
     * Get the student with calculated result
     *
     * @param $id
     * @return Student|null
     * @throws RecordNotFoundException
     */
    public function findStudent(int $id) : ?Student;
}