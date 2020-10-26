<?php

namespace GradeSystem\Services;

use GradeSystem\Models\Student;

interface IStudentFactory
{
    public function findById(int $id) : ?Student;
}