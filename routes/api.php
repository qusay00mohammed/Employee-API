<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\GovernorateController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ContractController;
use App\Http\Controllers\API\JoptitleController;
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

// Route login
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:api'], function () {
    // Route Country
    // Route::apiResource('countries', CountryController::class);
    Route::post('addCountry', [CountryController::class, 'store']);
    Route::get('getCountries', [CountryController::class, 'index']);

    // Route City
    Route::get('getCities', [CityController::class, 'index']);
    Route::post('addCity', [CityController::class, 'store']);
    Route::get('city/{id}/country', [CityController::class, 'show']);

    // Route Governorate
    Route::get('getGovernorates', [GovernorateController::class, 'index']);
    Route::post('addGovernorate', [GovernorateController::class, 'store']);
    Route::get('governorate/{id}/city', [GovernorateController::class, 'show']);

    // // Route JopTitle
    Route::get('getJoptitles', [JoptitleController::class, 'index']);
    Route::post('addJoptitle', [JoptitleController::class, 'store']);

    // Route Contract
    Route::get('getContracts', [ContractController::class, 'index']);
    Route::post('addContract', [ContractController::class, 'store']);

    // // Route Employee
    Route::post('addEmployee', [EmployeeController::class, 'store']);
    Route::get('getEmployees', [EmployeeController::class, 'index']);
    Route::patch('editEmployee/{id}', [EmployeeController::class, 'update']);

    // Route Auth Logout
    Route::post('logout', [AuthController::class, 'logout']);
});
