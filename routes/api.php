<?php
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentQuizController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Rute Publik untuk Registrasi & Login
Route::post('teacher/register', [TeacherAuthController::class, 'register']);
Route::post('teacher/login', [TeacherAuthController::class, 'login']);
Route::post('student/register', [StudentAuthController::class, 'register']);
Route::post('/student/login', [StudentAuthController::class, 'login']);
// Teacher profile and update routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('teacher/profile', [TeacherAuthController::class, 'profile']);
    Route::put('teacher/update', [TeacherAuthController::class, 'update']);
    Route::post('teacher/logout', [TeacherAuthController::class, 'logout']);
    Route::get('/materi/mine', [MateriController::class, 'myMateri']);      // Lihat semua materi milik guru
    Route::get('materi', [MateriController::class, 'index']);  
    Route::post('materi', [MateriController::class, 'store']);       // Tambah materi baru
    Route::get('materi/{id}', [MateriController::class, 'show']);    // Lihat detail materi
    Route::put('materi/{id}', [MateriController::class, 'update']);  // Update materi
    Route::delete('materi/{id}', [MateriController::class, 'destroy']); // Hapus materis
    Route::get('/student/profile', [StudentAuthController::class, 'profile']); // Get Data Siswa
    // Auth siswa

    Route::middleware('auth:sanctum')->post('/student/logout', [StudentAuthController::class, 'logout']);
    // Auth Kuis
    
    Route::middleware('auth:sanctum')->get('/quiz/mine', [QuizController::class, 'myQuizzes']);
}
);

Route::middleware('auth:sanctum')->group(function () {
     // QUIZ CRUD (pakai /quiz)
    Route::get('/quiz', [QuizController::class, 'index']);
    Route::post('/quiz', [QuizController::class, 'store']);
    Route::get('/quiz/{id}', [QuizController::class, 'show']);
    Route::put('/quiz/{id}', [QuizController::class, 'update']);
    Route::delete('/quiz/{id}', [QuizController::class, 'destroy']);

    // QUESTION CRUD (pakai /quiz/{quiz_id}/question)
    Route::get('/quiz/{quiz_id}/question', [QuestionController::class, 'index']);
    Route::post('/quiz/{quiz_id}/question', [QuestionController::class, 'store']);
    Route::get('/question/{id}', [QuestionController::class, 'show']);
    Route::put('/question/{id}', [QuestionController::class, 'update']);
    Route::delete('/question/{id}', [QuestionController::class, 'destroy']);
});
    //Route For Quiz
    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/quiz/{quizId}/questions', [StudentQuizController::class, 'getQuestions']);
    Route::post('/quiz/{quizId}/submit', [StudentQuizController::class, 'submit']);
    Route::get('/quiz/{quizId}/result', [StudentQuizController::class, 'getResult']);
    Route::get('/student/quiz/results', [StudentQuizController::class, 'results']);
});