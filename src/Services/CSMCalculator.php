<?php
 namespace GradeSystem\Services;

 use GradeSystem\Models\Student;

 class CSMCalculator implements IStudentResultCalculator
 {
     public function calculate(Student $student) : void
     {
         $this->calculateAverage($student);
         $this->calculateResult($student);
         $student->setSchoolBoard("CSM");
     }

     private function calculateAverage(Student $student) : void
     {
         $student->average = array_sum($student->grades) / count($student->grades);
     }

     private function calculateResult(Student $student) : void
     {
         $student->result = ($student->average >= 7) ? "PASS" : "FAIL";
     }
 }