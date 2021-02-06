<?php

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

Route::get('/survey/dev', [SurveyController::class,'storeResult']);
Route::get('/survey/{uuid}', [SurveyController::class,'searchFromId']);
//開発終了後メソッド、ルートを直しておく
