<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\MeeraController;

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
//authentication
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// login and registration common for both admin and guest user 
    Route::post('/register', [UserController::class,'createUser']);
    Route::post('/login', [UserController::class,'loginUser']);
// guest user can view - with out login
    Route::get('/categories', [CategoryController::class, 'index']);

// logined guest user - (job apply, profile creation,job search)

// admin can save
Route::middleware(['auth:sanctum',EnsureTokenIsValid::class])->group(function () {
    // Route::get('/test-middleware', function () {
    //     // This code will only be executed if the middleware passes
    //     logger('Middleware is working!');
    //     return 'Middleware is working!';
    // });
    // category crud api
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categorypagination', [CategoryController::class, 'pagination']);
    Route::post('/categorysave', [CategoryController::class,'store']);
    Route::put('/categoriesupdate/{category}', [CategoryController::class, 'update']);
    Route::delete('/categorydestroy/{category}', [CategoryController::class,'destroy']);
    Route::get('/categoriesshow/{category}', [CategoryController::class, 'show']);
    //end
    //company crud api
    Route::post('/companysave', [CompanyController::class,'store']);
    //end
});