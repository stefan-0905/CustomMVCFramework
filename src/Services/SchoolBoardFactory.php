<?php

namespace App\Services;

use App\Database\StudentRepository;

class SchoolBoardFactory
{

    public static function getSchoolBoard(string $schoolBoard) : ISchoolBoard
    {
        if($schoolBoard == "CSM")
        {
            return new SchoolBoard(new StudentRepository(), new CSMCalculator());
        }

        return new SchoolBoard(new StudentRepository(), new CSMBCalculator());

    }
}