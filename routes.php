<?php

use GradeSystem\Framework\Route;

Route::set("/", "\GradeSystem\Controllers\HomeController@Index");
Route::set("/Student/Edit", "\GradeSystem\Controllers\StudentController@Edit");
Route::set("/Student/{id}/Delete", "\GradeSystem\Controllers\StudentController@Delete");
Route::set("/Student/{id}", "\GradeSystem\Controllers\StudentController@show");
Route::set("/Student", "\GradeSystem\Controllers\StudentController@index");
