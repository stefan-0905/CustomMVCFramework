<?php

require_once realpath("vendor/autoload.php");

require_once "project_params.php";

if(!empty($_GET["student"]))
{
    $schoolBoard = \GradeSystem\Services\SchoolBoardFactory::getSchoolBoard(SCHOOL_BOARD_TYPE);

    try {
        echo $schoolBoard->findStudent($_GET["student"]);
    } catch (Exception $exception)
    {
        echo $exception->getMessage();
    }
}