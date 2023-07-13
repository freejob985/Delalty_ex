<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\AuthController;
use Illuminate\Auth\Events\Logout;

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


Route::get('user/all', [AuthController::class, 'user'])->name('user');




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class, 'loginUser'])->name('login_');
Route::post('register', [AuthController::class, 'register'])->name('register');



Route::group(['middleware' => 'auth:sanctum'], function () {


    
    Route::get('user/all', [AuthController::class, 'user'])->name('user');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('user/update/{id}', [AuthController::class, 'update'])->name('update');
    Route::get('user/delete/{id}', [AuthController::class, 'delete'])->name('delete');
    Route::get('user/roles', [AuthController::class, 'roles'])->name('roles');



    Route::get('login/google', [AuthController::class, 'redirectToGoogleProvider']);
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleProviderCallback']);


    Route::get('login/facebook', [AuthController::class, 'redirectToFacebookProvider']);
    Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookProviderCallback']);







});
