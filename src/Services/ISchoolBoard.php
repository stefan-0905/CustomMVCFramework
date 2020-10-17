<?php

namespace GradeSystem\Services;

use GradeSystem\Models\Student;

interface ISchoolBoard
{
        public function findStudent(int $id) : Student;
}