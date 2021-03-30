<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ApiAuthController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/



Route::post('register', [ApiAuthController::class, 'register']);

Route::post('login', [ApiAuthController::class, 'login']);


Route::group(['middleware' => 'auth:api'], function(){ // routes that needs authentication

    Route::get('getAllUsers', [CrudController::class, 'getAllUsers']);
    Route::post('createUser', [CrudController::class, 'createUser']);

});


