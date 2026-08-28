<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);
