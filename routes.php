<?php

use \App\Framework\Route;

Route::get("/", "\App\Controllers\HomeController@Index");
Route::get("/Student/Edit", "\App\Controllers\StudentController@Edit");
Route::get("/Student/{id}/Delete", "\App\Controllers\StudentController@Delete");
Route::get("/Student/{id}", "\App\Controllers\StudentController@show");
Route::get("/Student", "\App\Controllers\StudentController@index");
