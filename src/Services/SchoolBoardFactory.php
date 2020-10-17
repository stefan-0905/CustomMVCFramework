<?php

namespace GradeSystem\Services;

class SchoolBoardFactory
{
    public static function getSchoolBoard($schoolBoard) : ISchoolBoard
    {
        if($schoolBoard == "CSM")
        {
            return new CSM();
        }
        else if($schoolBoard == "CSMB")
        {
            return new CSMB();
        }

        return NULL;
    }
}