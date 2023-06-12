<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//register
Route::post('register', [UserController::class, 'store']);
//login
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware'=>['jwt.auth', 'role:super-admin']], function (){
    //all operations
    Route::apiResource('users', UserController::class);
    Route::apiResource('blogs', BlogPostController::class);
    Route::apiResource('categories', BlogCategoryController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
});

Route::group(['middleware'=>['jwt.auth', 'role:admin']], function (){
    // Users routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    //other full operations
    Route::apiResource('blogs', BlogPostController::class);
    Route::apiResource('categories', BlogCategoryController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
});

Route::group(['middleware'=>['jwt.auth', 'role:editor']], function (){
    //blogs and categories operation
    Route::apiResource('blogs', BlogPostController::class);
    Route::apiResource('categories', BlogCategoryController::class);
});

Route::group(['middleware'=>['jwt.auth', 'role:contributor']], function (){
    //blogs operation
    Route::apiResource('blogs', BlogPostController::class);
});

Route::group(['middleware'=>'role:subscriber'], function (){
    //only view blogs and users
    Route::get('/blogs', [BlogPostController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/{id}', [BlogPostController::class, 'show'])->name('blogs.show');
});
