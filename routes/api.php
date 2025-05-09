<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;


Route::apiResource('students', StudentController::class);
Route::apiResource('teachers', TeacherController::class);

