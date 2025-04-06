<?php

use App\Http\Controllers\admin\Authorization\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SkillController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['can:publish articles', 'auth:sanctum']);

Route::get('categories', [CatController::class, 'index']);
Route::get('categories/show/{id}', [CatController::class, 'show']);

Route::get('skills', [SkillController::class, 'index']);
Route::get('skills/show/{id}', [SkillController::class, 'show']);

Route::get('exams/show/{id}', [ExamController::class, 'show']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('exams/show-questions/{id}', [ExamController::class, 'showQuestions']);
    Route::post('exams/start/{id}', [ExamController::class, 'start']);
    Route::post('exams/submit/{id}', [ExamController::class, 'submit']);
});

Route::get('roles', [RoleController::class, 'index']);
