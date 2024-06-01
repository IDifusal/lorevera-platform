<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\DeploymentController;
use App\Http\Controllers\LimitationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CircumferenceController;
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
    Route::get('list-days',[DaysController::class,'listDaysPackages']);
    Route::get('list-days-cardio',[DaysController::class,'listDaysCardio']);
    Route::post('store-day',[DaysController::class,'store']);
    Route::get('get-day/{id}',[DaysController::class,'details']);
    Route::delete('delete-day/{id}',[DaysController::class,'delete']);
    Route::post('update-day/{id}',[DaysController::class,'update']);
    //Packages
    Route::get('list-packages',[ProgramController::class,'listPackages']);
    Route::post('store-package',[ProgramController::class,'storePackage']);
    Route::get('get-package/{id}',[ProgramController::class,'detailsPackage']);
    Route::delete('delete-package/{id}',[ProgramController::class,'deletePackage']);
    Route::post('update-package/{id}',[ProgramController::class,'updatePackage']);  

    //Recipes
    Route::get('list-recipes-meat',[RecipeController::class,'listRecipesMeat']);
    Route::get('list-recipes-vegetarian',[RecipeController::class,'listRecipesVegetarian']);
    Route::post('store-recipe',[RecipeController::class,'storeRecipe']);
    Route::get('get-recipe/{id}',[RecipeController::class,'detailsRecipe']);
    Route::delete('delete-recipe/{id}',[RecipeController::class,'deleteRecipe']);
    Route::post('update-recipe/{id}',[RecipeController::class,'updateRecipe']);
    //Tickets
    Route::get('list-tickets',[TicketController::class,'index']);
    //Notificaations

});

Route::post('/git-pull', [DeploymentController::class, 'gitPull']);
Route::post('/clear-cache', [DeploymentController::class, 'clearCache']);
Route::post('/run-migrate', [DeploymentController::class, 'runMigrate']);
Route::post('/run-migrate-fresh', [DeploymentController::class, 'runMigrateFresh']);
Route::post('/optimize-router', [DeploymentController::class, 'optimizeRouter']);
Route::post('/brd-calculator', [ServicesController::class, 'bdrcalculator']);

//mobile routes add prefix
Route::post('/mobile/login', [AuthController::class, 'loginUser']);
Route::post('/web/login', [AuthController::class, 'loginUser'])->name('login');
Route::post('/mobile/register', [AuthController::class, 'createUser']);
Route::post('/mobile/reset/request', [AuthController::class,'requestReset']);
Route::post('/mobile/reset/validate', [AuthController::class,'validateReset']);
Route::post('/mobile/reset/change', [AuthController::class,'changePassword']);
Route::get('/test-notification', [NotificationController::class, 'sendTestNotification']);  

Route::get('/mobile/getAnalyticsInfo',[ServicesController::class,'getAnalyticsInfo']);
Route::post('/macros-calculator', [ServicesController::class, 'calculateMacros']);


Route::group(['prefix' => 'mobile', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/complete-profile', [AuthController::class, 'completeProfile']);
    Route::post('/update-name', [AuthController::class, 'updateName']);   
    //Add new charge weight
    Route::get('/get-analytics-weigth',[ServicesController::class,'getUserWeightsBy']);    
    Route::post('/add-charge-weight', [AuthController::class, 'addChargeWeight']);    

    //Images    
    Route::post('/store-image',[ProgressImageController::class,'storeImage']);
    Route::get('/list-images',[ProgressImageController::class,'listImages']);    
    Route::delete('/remove-image/{id}',[ProgressImageController::class,'removeImage']);
    //Goals
    Route::get('/list-goal',[GoalController::class,'listGoal']);
    Route::post('/store-goal',[GoalController::class,'storeGoal']);
    Route::delete('/remove-goal/{id}',[GoalController::class,'removeGoal']);
    //Limitations
    Route::get('/default-limitations-goals',[LimitationController::class,'defaultValues']);
    Route::get('/list-limitation',[LimitationController::class,'listGoal']);
    Route::post('/store-limitation',[LimitationController::class,'storeGoal']);
    Route::delete('/remove-limitation/{id}',[LimitationController::class,'removeGoal']);    

    //Circumferences
    Route::get('/list-circumferences',[CircumferenceController::class,'listCircumferences']);
    Route::post('/store-circumference',[CircumferenceController::class,'storeCircumference']);
    //Info for modules
    Route::get('/get-info-modules',[ServicesController::class,'getInfoModules']);
    //Help module
    Route::post('/store-ticket',[TicketController::class,'store']);
    //Packages
    Route::get('/getPackages', [ProgramController::class, 'listPackages']);
    Route::get('/package-details/{id}',[ProgramController::class,'detailsPackageMobile']);
    //Recipes
    Route::get('/list-recipes',[RecipeController::class,'listRecipesMobile']);

    Route::post('/schedule-notification', [NotificationController::class, 'schedule']);

    Route::get('/list-days',[DaysController::class,'listDaysCardio']);

    Route::post('notifications/store-token',[NotificationController::class,'storeToken']);
    Route::post('notifications/schedule',[NotificationController::class,'schedule']);

    //favorites

    Route::post('favorites/add',[FavoriteController::class,'addFavorite']);
    Route::delete('favorites/remove/{id}',[FavoriteController::class,'removeFavorite']);
});

