<?php

namespace GradeSystem\Database;

interface IRepository
{
    public function findAll() : array;
    public function findById(int $id) : array;
}
