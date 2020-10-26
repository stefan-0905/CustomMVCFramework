<?php

namespace GradeSystem\Database;

interface IRepository
{
    public function findById(int $id) : array;
}
