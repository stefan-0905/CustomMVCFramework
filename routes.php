<?php

use GradeSystem\Framework\Route;

Route::get("/", "\GradeSystem\Controllers\HomeController@Index");
Route::get("/Student/Edit", "\GradeSystem\Controllers\StudentController@Edit");
Route::get("/Student/{id}/Delete", "\GradeSystem\Controllers\StudentController@Delete");
Route::get("/Student/{id}", "\GradeSystem\Controllers\StudentController@show");
Route::get("/Student", "\GradeSystem\Controllers\StudentController@index");
