<?php
use App\Http\Controllers\Authorization\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/schools', [SchoolController::class, 'index']);
Route::get('/schools/pg', [SchoolController::class, 'indexPg']);
Route::get('/schools/{id}', [SchoolController::class, 'show']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/pg', [CourseController::class, 'indexPg']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
