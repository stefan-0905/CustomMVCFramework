<?php

namespace GradeSystem\Controllers;

use Exception;
use GradeSystem\Database\StudentRepository;
use GradeSystem\Models\Exceptions\RecordNotFoundException;
use GradeSystem\Framework\Page;
use GradeSystem\Framework\Response;
use GradeSystem\Services\StudentFactory;
use InvalidArgumentException;

use GradeSystem\Models\Student;
use GradeSystem\Services\SchoolBoardFactory;

class StudentController extends Controller
{
    public const SCHOOL_BOARD_TYPE = "CSM";

    public function index() : string
    {
        $studentFactory = new StudentFactory(new StudentRepository());

        $students = $studentFactory->findAll();

        return json_encode($students);
    }

    public function show(int $id) : ?Student
    {
        try {
            $schoolBoard = SchoolBoardFactory::getSchoolBoard(self::SCHOOL_BOARD_TYPE);

            return $schoolBoard->findStudent($id);
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

    public function edit() : Page
    {
        return new Page("Edit");
    }

    public function delete(int $id) : Page
    {
        return new Page("delete", ["title" => "Delete Page"]);
    }
}