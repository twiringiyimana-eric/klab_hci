<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostControllers;
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

// public route for registering a new userex
Route::post('/register', [AuthController::class, 'register']);
Route::post('/test', [AuthController::class, 'test']);
// public route for logging in a user
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    // protected route for getting the authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // protected route for logging out a user
    Route::post('/logout', [AuthController::class, 'logout']);

    // protected route for creating a team member
    Route::post('/team', [PostControllers::class, 'team']);

     // protected route for creating a new post
     Route::post('/posts', [PostController::class, 'store']);


    // protected route for updating a post
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/post/{id}', [PostController::class, 'delete']);
    // protected route for deleting a post
    Route::delete('/post/{id}', [PostController::class, 'delete']);
});
 // protected route for getting all posts
 Route::get('/posts', [PostController::class, 'index']);

 // protected route for getting a single post
 Route::get('/posts/{id}', [PostController::class, 'posts']);
 Route::get('/team/{id}', [PostControllers::class, 'team']);
 Route::put('/posts/{id}', [PostController::class, 'update']);

 Route::get('/view-all-posts', [PostControllers::class, 'viewPosts']);
 Route::put('/team/{id}', [PostControllers::class, 'update']);
 Route::get('/view-all-teams', [PostControllers::class, 'viewTeams']);
 Route::delete('/delete-team/{id}', [PostControllers::class, 'deleteTeam']);
 Route::post('/posts', [PostController::class, 'store']);