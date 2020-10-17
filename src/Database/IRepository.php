<?php

namespace GradeSystem\Database;

interface IRepository
{
    public function findAll();
    public function findById($id);
}
