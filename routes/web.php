<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('api/match/{propertyId}', [ApiController::class, 'match']);
Route::get('/', function () {
    return view('welcome');
});
