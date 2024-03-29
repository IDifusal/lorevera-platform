<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\DeploymentController;
use App\Http\Controllers\LimitationController;
use App\Http\Controllers\ProgressImageController;

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
//webs routes add premix and middleware
Route::group(['prefix' => 'web', 'middleware' => ['auth:sanctum']],
function () {
    Route::get('me', [AuthController::class, 'me']);  
    Route::get('list-users', [WebController::class, 'listUsers']);  
    Route::get('list-equipment',[EquipmentController::class,'list']);
    Route::post('store-equipment',[EquipmentController::class,'store']);
    Route::delete('delete-equipment/{id}',[EquipmentController::class,'delete']);
    Route::post('update-equipment/{id}',[EquipmentController::class,'update']);

    //Warmup routes
    Route::get('list-warmup',[WorkoutController::class,'list']);
    Route::get('list-workout',[WorkoutController::class,'listWorkout']);
    Route::get('list-warmup/{id}',[WorkoutController::class,'details']);
    Route::post('store-warmup',[WorkoutController::class,'store']);
    Route::delete('delete-warmup/{id}',[WorkoutController::class,'delete']);
    Route::post('update-warmup/{id}',[WorkoutController::class,'update']);
    //Workout routesps
    //Days (Warmup and workouyt agrupation)
    Route::get('list-days',[DaysController::class,'list']);
    Route::post('store-day',[DaysController::class,'store']);
    Route::get('get-day/{id}',[DaysController::class,'details']);
    Route::delete('delete-day/{id}',[DaysController::class,'delete']);
    Route::post('update-day/{id}',[DaysController::class,'update']);
    //Packages
    Route::get('list-packages',[ProgramController::class,'listPackages']);
    Route::post('store-package',[ProgramController::class,'storePackage']);
});

Route::post('/git-pull', [DeploymentController::class, 'gitPull']);
Route::post('/clear-cache', [DeploymentController::class, 'clearCache']);
Route::post('/run-migrate', [DeploymentController::class, 'runMigrate']);
Route::post('/optimize-router', [DeploymentController::class, 'optimizeRouter']);
Route::post('/brd-calculator', [ServicesController::class, 'bdrcalculator']);

//mobile routes add prefix
Route::post('/mobile/login', [AuthController::class, 'loginUser']);
Route::post('/web/login', [AuthController::class, 'loginUser'])->name('login');
Route::post('/mobile/register', [AuthController::class, 'createUser']);
Route::post('/mobile/reset/request', [AuthController::class,'requestReset']);
Route::post('/mobile/reset/validate', [AuthController::class,'validateReset']);
Route::post('/mobile/reset/change', [AuthController::class,'changePassword']);

Route::get('/mobile/getPackages', [ServicesController::class, 'getPackages']);
Route::get('/mobile/getAnalyticsInfo',[ServicesController::class,'getAnalyticsInfo']);


Route::group(['prefix' => 'mobile', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/complete-profile', [AuthController::class, 'completeProfile']);
    //Add new charge weight
    Route::get('/get-analytics-weigth',[ServicesController::class,'getUserWeightsBy']);    
    Route::post('/add-charge-weight', [AuthController::class, 'addChargeWeight']);    

    //Images    
    Route::post('/store-image',[ProgressImageController::class,'storeImage']);
    Route::get('/list-images',[ProgressImageController::class,'listImages']);    
    //Goals
    Route::get('/list-goal',[GoalController::class,'listGoal']);
    Route::post('/store-goal',[GoalController::class,'storeGoal']);
    Route::delete('/remove-goal/{id}',[GoalController::class,'removeGoal']);
    //Limitations
    Route::get('/default-limitations-goals',[LimitationController::class,'defaultValues']);
    Route::get('/list-limitation',[LimitationController::class,'listGoal']);
    Route::post('/store-limitation',[LimitationController::class,'storeGoal']);
    Route::delete('/remove-limitation/{id}',[LimitationController::class,'removeGoal']);    
    //Info for modules
    Route::get('/get-info-modules',[ServicesController::class,'getInfoModules']);
});

