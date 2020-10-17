<?php

namespace GradeSystem\Database;

class StudentRepository implements IRepository
{
    public function findAll()
    {
        $db = Database::connect();

        $sql = "SELECT id, name, grades FROM students;";

        $stmt = $db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();

    }

    public function findById($id)
    {
        $db = Database::connect();

        $sql = "SELECT id, name, grades FROM students WHERE id = :id LIMIT 1;";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }
}