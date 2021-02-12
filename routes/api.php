<?php

use App\Http\Controllers\ResultController;
use App\Http\Controllers\SurveyController;
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


Route::get('/survey', [SurveyController::class,'getSurveys']);
Route::get('/dev', [SurveyController::class,'createSurvey']);

Route::get('/survey/{uuid}/result', [ResultController::class,'showResult']);
Route::get('/survey/{uuid}', [SurveyController::class,'searchFromId']);
Route::post('/survey/{uuid}', [ResultController::class,'storeResult']);
