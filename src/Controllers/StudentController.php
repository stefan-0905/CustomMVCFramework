<?php

namespace App\Controllers;

use Exception;
use App\Database\StudentRepository;
use App\Models\Exceptions\RecordNotFoundException;
use App\Framework\Page;
use App\Framework\Response;
use App\Services\StudentFactory;
use InvalidArgumentException;

use App\Models\Student;
use App\Services\SchoolBoardFactory;

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
                Response::e404();
            } else if( $exception instanceof InvalidArgumentException) {
                Response::e400();
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