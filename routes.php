<?php

use GradeSystem\Route;

Route::set("/", "\GradeSystem\Controllers\HomeController@Index");
Route::set("/Student/Edit", "\GradeSystem\Controllers\StudentController@Edit");
Route::set("/Student/Delete", "\GradeSystem\Controllers\StudentController@Delete");
Route::set("/Student", "\GradeSystem\Controllers\StudentController@Index");