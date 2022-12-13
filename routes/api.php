<?php

use App\Http\Controllers\Auth\Api\AddressController;
use App\Http\Controllers\Auth\Api\CepController as ApiCepController;
use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\Auth\Api\UserController;
use App\Http\Controllers\CepController;
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

Route::get('get-cep', [ApiCepController::class, 'getCep']);
Route::prefix('auth')->group(function(){
    Route::group(['middleware' => 'auth:sanctum'], function (){
        Route::post('logout', [LoginController::class, 'logout']);
        Route::get('users', [UserController::class, 'getAllUsers']);
    });
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('register-address', [AddressController::class, 'registerAddress']);
});
Route::post('password', [UserController::class, 'updatePassword']);
Route::post('login', [LoginController::class, 'authenticate'])->name('login');