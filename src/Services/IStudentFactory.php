<?php

namespace App\Services;

use App\Models\Student;

interface IStudentFactory
{
    public function findAll() : ?array;
    public function findById(int $id) : ?Student;
}