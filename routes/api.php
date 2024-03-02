<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\DeploymentController;

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

Route::post('/git-pull', [DeploymentController::class, 'gitPull']);
Route::post('/clear-cache', [DeploymentController::class, 'clearCache']);
Route::post('/run-migrate', [DeploymentController::class, 'runMigrate']);
Route::post('/brd-calculator', [ServicesController::class, 'bdrcalculator']);

//mobile routes add prefix
Route::post('/mobile/login', [AuthController::class, 'loginUser']);
Route::post('/web/login', [AuthController::class, 'loginUser'])->name('login');
Route::post('/mobile/register', [AuthController::class, 'createUser']);
Route::post('/mobile/forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('/mobile/getPackages', [ServicesController::class, 'getPackages']);
Route::get('/mobile/get-analytics-weigth',[ServicesController::class,'getUserWeightsBy']);
Route::group(['prefix' => 'mobile', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
});


//webs routes add premix and middleware
Route::group(['prefix' => 'web', 'middleware' => ['auth:sanctum']],
function () {
    Route::get('me', [AuthController::class, 'me']);  
    Route::get('list-users', [WebController::class, 'listUsers']);  
});