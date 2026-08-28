<?php

use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\TeacherApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', StudentApiController::class)->names('api.students');
Route::apiResource('teachers', TeacherApiController::class)->names('api.teachers');
