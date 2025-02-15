<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReportController;
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
Route::post('/courses', [CourseController::class, 'store'])->middleware('auth:sanctum', 'ability:Dosen');
Route::put('/courses/{id}', [CourseController::class, 'update'])->middleware('auth:sanctum', 'ability:Dosen');
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->middleware('auth:sanctum', 'ability:Dosen');
Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->middleware('auth:sanctum', 'ability:Mahasiswa');

// Manajemen Upload & Unduh Materi Perkuliahan
Route::post('/materials', [MaterialController::class, 'store'])->middleware('auth:sanctum', 'ability:Dosen');
Route::get('/materials/{id}/download', [MaterialController::class, 'download'])->middleware('auth:sanctum', 'ability:Mahasiswa');

// Manajemen Tugas & Penilaian
Route::post('/assignments', [AssignmentController::class, 'store'])->middleware('auth:sanctum', 'ability:Dosen');
Route::post('/submissions', [AssignmentController::class, 'submit'])->middleware('auth:sanctum', 'ability:Mahasiswa');
Route::post('/submissions/{id}/grade', [AssignmentController::class, 'grade'])->middleware('auth:sanctum', 'ability:Dosen');

// Manajemen Forum Diskusi
Route::post('/discussions', [DiscussionController::class, 'store'])->middleware('auth:sanctum');
Route::post('/discussions/{id}/replies', [DiscussionController::class, 'reply'])->middleware('auth:sanctum');

// Statistik
Route::get('/reports/courses', [ReportController::class, 'courses'])->middleware('auth:sanctum', 'ability:Dosen');
Route::get('/reports/assignments', [ReportController::class, 'assignments'])->middleware('auth:sanctum', 'ability:Dosen');
Route::get('/reports/students/{id}', [ReportController::class, 'students'])->middleware('auth:sanctum', 'ability:Dosen');