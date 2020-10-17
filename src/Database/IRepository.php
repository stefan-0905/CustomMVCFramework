<?php

namespace GradeSystem\Database;

use GradeSystem\Models\Student;

interface IRepository
{
    public function findById(int $id) : Student;
}
