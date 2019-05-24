<?php

use Illuminate\Http\Request;

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

Route::Resource('group','Groups')->only(['index','store','show','destroy']);
Route::Resource('group.teams','TeamsController')->only(['store','destroy']);
Route::Resource('group.matches','MatchesController')->only(['store','update']);