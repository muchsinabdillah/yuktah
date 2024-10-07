<?php

use App\Http\Controllers\Api\CarrierGroupController;
use App\Http\Controllers\Api\LearningDataController;
use App\Http\Controllers\Api\LearningDetailListController;
use App\Http\Controllers\Api\LearningEventGroupController;
use App\Http\Controllers\Api\LearningGroupController;
use App\Http\Controllers\Api\MentorController;
use App\Http\Controllers\Api\WorkPositionController;
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
    Route::group(['prefix' => 'learning/'], function () {
        Route::group(['prefix' => 'groups/'], function () {
            Route::get("show/all", [LearningGroupController::class, "index"]);
            Route::post("create", [LearningGroupController::class, "store"]);
            Route::post("update", [LearningGroupController::class, "update"]);
            Route::get("show/id/{id}", [LearningGroupController::class, "show"]);
        });
        Route::group(['prefix' => 'eventgroups/'], function () {
            Route::get("show/all", [LearningEventGroupController::class, "index"]);
            Route::post("create", [LearningEventGroupController::class, "store"]);
            Route::post("update", [LearningEventGroupController::class, "update"]);
            Route::get("show/id/{id}", [LearningEventGroupController::class, "show"]);
        });
        Route::group(['prefix' => 'dataleanings/'], function () {
            Route::get("show/all", [LearningDataController::class, "index"]);
            Route::post("create", [LearningDataController::class, "store"]);
            Route::post("update", [LearningDataController::class, "update"]);
            Route::get("show/id/{id}", [LearningDataController::class, "show"]);
        });
        Route::group(['prefix' => 'dataleaningdetails/'], function () {
            Route::get("show/all", [LearningDetailListController::class, "index"]);
            Route::post("create", [LearningDetailListController::class, "store"]);
            Route::post("update", [LearningDetailListController::class, "update"]);
            Route::get("show/id/{id}", [LearningDetailListController::class, "show"]);
        });
    });

    Route::group(['prefix' => 'workpositions/'], function () {
        Route::get("show/all", [WorkPositionController::class, "index"]);
        Route::post("create", [WorkPositionController::class, "store"]);
        Route::post("update", [WorkPositionController::class, "update"]);
        Route::get("show/id/{id}", [WorkPositionController::class, "show"]);
    });

    Route::group(['prefix' => 'mentors/'], function () {
        Route::get("show/all", [MentorController::class, "index"]);
        Route::post("create", [MentorController::class, "store"]);
        Route::post("update", [MentorController::class, "update"]);
        Route::get("show/id/{id}", [MentorController::class, "show"]);
    });

});