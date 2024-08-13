<?php

use App\Http\Controllers\Api\CarrierGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['prefix' => 'masterdata/'], function () {
    Route::group(['prefix' => 'carriergroups/'], function () {
        Route::get("show/all", [CarrierGroupController::class, "index"]);
        Route::post("create", [CarrierGroupController::class, "store"]);
        Route::post("update", [CarrierGroupController::class, "update"]);
        Route::get("show/id/{id}", [CarrierGroupController::class, "show"]);
    });

});