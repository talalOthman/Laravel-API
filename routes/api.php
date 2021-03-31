<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\CsvController;

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
    
    // Get all Users
    Route::get('getAllUsers', [CrudController::class, 'getAllUsers']);
    
    // Create a User
    Route::post('createUser', [CrudController::class, 'createUser']);
    
    // Get Specific User
    Route::get('getUser/{id}', [CrudController::class, 'getUserById']);

    // Update a Specifc User
    Route::put('updateUser/{id}', [CrudController::class, 'updateUser']);

    // Delete a Specific User
    Route::delete('deleteUser/{id}', [CrudController::class, 'deleteUser']);

    
    
    
    Route::get('importForm', [CsvController::class, 'importUploadForm']);

    Route::post('importForm', [CsvController::class, 'import'])->name('import.file');

});


