<?php

namespace GradeSystem\Database;

use GradeSystem\Models\Student;
use GradeSystem\Services\Parser;

class StudentRepository implements IRepository
{
    public function findById(int $id) : Student
    {
        try
        {
            $db = Database::connect();

            $sql = "SELECT id, name, grades FROM students WHERE id = :id LIMIT 1;";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch();

            return Parser::parse($result);
        } catch (\Exception $exception)
        {
            echo $exception->getMessage();
        }
        return NULL;
    }
}