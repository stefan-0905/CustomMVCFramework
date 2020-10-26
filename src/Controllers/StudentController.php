<?php

namespace GradeSystem\Controllers;

use Exception;
use GradeSystem\Models\Exceptions\RecordNotFoundException;
use GradeSystem\Models\Page;
use GradeSystem\Models\Response;
use InvalidArgumentException;

use GradeSystem\Models\Student;
use GradeSystem\Services\SchoolBoardFactory;

class StudentController extends Controller
{
    public const SCHOOL_BOARD_TYPE = "CSM";

    public static function Index() : ?Student
    {
        if(!empty($_GET["id"]))
        {
            try {
                if (!is_numeric($_GET["id"])) throw new InvalidArgumentException("InvalidArgumentException: Parameter value needs to be an integer");

                $schoolBoard = SchoolBoardFactory::getSchoolBoard(self::SCHOOL_BOARD_TYPE);

                header("Body: names");

                return $schoolBoard->findStudent((int)$_GET["id"]);
            } catch (Exception $exception)
            {
                if($exception instanceof RecordNotFoundException)
                {
                    Response::e404(["message" => $exception->getMessage()]);
                } else if( $exception instanceof InvalidArgumentException) {
                    Response::e400(["message" => $exception->getMessage()]);
                }
                return NULL;
            }
        }

        return NULL;
    }

    public static function Edit() : Page
    {
        return new Page("Edit");
    }

    public static function Delete() : Page
    {
        return new Page("delete", ["title" => "Delete Page"]);
    }
}