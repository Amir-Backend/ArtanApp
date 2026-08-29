<?php

use App\Http\Controllers\Api\InstrumentApiController;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\TeacherApiController;
use App\Http\Controllers\Api\TeacherSkillApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', StudentApiController::class)->names('api.students');
Route::apiResource('teachers', TeacherApiController::class)->names('api.teachers');
Route::apiResource('instruments', InstrumentApiController::class)->names('api.instruments');
Route::apiResource('teacher-skills', TeacherSkillApiController::class)
    ->parameter('teacher-skills', 'teacherSkill')
    ->names('api.teacher-skills');
