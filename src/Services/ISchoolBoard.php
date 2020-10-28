<?php

namespace App\Services;

use App\Models\Exceptions\RecordNotFoundException;
use App\Models\Student;

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