<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppoinmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrainerMiddleware;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/seminars', [UserController::class, 'seminar']);

    Route::post('/appointments', [AppoinmentController::class, 'book']);
    Route::post('/seminar/store', [SeminarController::class, 'book']);
});

Route::middleware('auth:sanctum', TrainerMiddleware::class)->group(function () {
    Route::get('/trainer/dashboard', function () {
        return response()->json(['message' => 'Trainer Dashboard']);
    });
    Route::get('/trainer/seminar/index', [SeminarController::class, 'trainer_index']);
    Route::get('/trainer/seminar/{id}', [SeminarController::class, 'show']);
    Route::post('/trainer/seminar/approve/{id}', [SeminarController::class, 'seminar_accept']);
    Route::get('/seminar/pending', [TrainerController::class, 'seminar_is_pending']);
});

Route::middleware('auth:sanctum', AdminMiddleware::class)->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Admin Dashboard']);
    });
    Route::get('/admin/count/user', [AdminController::class, 'user_count']);
    Route::get('/admin/count/trainer', [AdminController::class, 'trainer_count']);
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/user/{id}', [UserController::class, 'show']);
    Route::put('/admin/user/{id}', [UserController::class, 'update']);
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy']);

    Route::get('/pending/trainers', [TrainerController::class, 'pending_trainer']);
    Route::post('/approve/trainer/{id}', [TrainerController::class, 'trainer_approve']);
    Route::get('/admin/trainer/{id}', [TrainerController::class, 'show']);
    Route::put('/admin/trainer/{id}', [TrainerController::class, 'update']);
    Route::delete('/admin/trainer/{id}', [TrainerController::class, 'destroy']);


    Route::get('admin/trainer/seminar', [SeminarController::class, 'trainer_index']);
});

Route::post('/find_nearest_gyms', [GymController::class, 'findNearestGyms']);
Route::get('/trainers', [TrainerController::class, 'index']);




// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
