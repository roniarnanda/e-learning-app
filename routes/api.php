<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DiscussionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Autentikasi Pengguna
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Manajemen Mata Kuliah & Kelas Online
Route::get('/courses', [CourseController::class, 'index'])->middleware('auth:sanctum');
Route::post('/courses', [CourseController::class, 'store'])->middleware('auth:sanctum');
Route::put('/courses/{id}', [CourseController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->middleware('auth:sanctum');

// Manajemen Upload & Unduh Materi Perkuliahan
Route::post('/materials', [MaterialController::class, 'store'])->middleware('auth:sanctum');
Route::get('/materials/{id}/download', [MaterialController::class, 'download'])->middleware('auth:sanctum');

// Manajemen Tugas & Penilaian
Route::post('/assignments', [AssignmentController::class, 'store'])->middleware('auth:sanctum');
Route::post('/submissions', [AssignmentController::class, 'submit'])->middleware('auth:sanctum');
Route::post('/submissions/{id}/grade', [AssignmentController::class, 'grade'])->middleware('auth:sanctum');

// Manajemen Forum Diskusi
Route::post('/discussions', [DiscussionController::class, 'store'])->middleware('auth:sanctum');
Route::post('/discussions/{id}/replies', [DiscussionController::class, 'reply'])->middleware('auth:sanctum');
