<?php

use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\PopulationController;
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

/* Country */
Route::get('sync-countries',[CountryController::class,'syncAllCountriesToDatabase']);
Route::get('countries',[CountryController::class,'getAllCountries']);
Route::get('countries/{pageSize}/{page}',[CountryController::class,'getAllCountriesPaging']);

/* Population */
Route::get('populations/',[PopulationController::class,'syncPopulationsToDataBase']);
Route::get('populations/{id}',[PopulationController::class,'getPopulationOfCountry']);
Route::get('populations-max',[PopulationController::class,'getCountryWithMaxPopulationLastYear']);
Route::get('populations-min',[PopulationController::class,'getCountryWithMinPopulationLastYear']);
Route::get('populations-max-min',[PopulationController::class,'getCountryWithMinAndMaxPopulationLastYear']);