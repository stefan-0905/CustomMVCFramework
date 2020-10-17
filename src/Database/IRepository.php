<?php

namespace GradeSystem\Database;

use GradeSystem\Models\AbstractModel;

interface IRepository
{
    public function findById(int $id) : AbstractModel;
}
