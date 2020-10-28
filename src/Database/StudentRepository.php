<?php

namespace App\Database;

class StudentRepository extends Repository implements IRepository
{
    public function findAll() : array
    {
        $sql = "SELECT id, name, grades FROM students;";
        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    public function findById(int $id) : array
    {
        try
        {
            $sql = "SELECT id, name, grades FROM students WHERE id = :id LIMIT 1;";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $result = $stmt->fetch();

            if($result == NULL) return array();

            return $result;
        } catch (\Exception $exception)
        {
            echo $exception->getMessage();
            return array();
        }
    }
}