<?php

use App\Http\Controllers\Api\CarrierGroupController;
use App\Http\Controllers\Api\CarrierRequirementController;

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
    Route::group(['prefix' => 'carrierrequirements/'], function () {
        Route::get("show/all", [CarrierRequirementController::class, "index"]);
        Route::post("create", [CarrierRequirementController::class, "store"]);
        Route::post("update", [CarrierRequirementController::class, "update"]);
        Route::get("show/id/{id}", [CarrierRequirementController::class, "show"]);
    });
    Route::group(['prefix' => 'carriereducations/'], function () {
        Route::get("show/all", [CarrierEducationController::class, "index"]);
        Route::post("create", [CarrierEducationController::class, "store"]);
        Route::post("update", [CarrierEducationController::class, "update"]);
        Route::get("show/id/{id}", [CarrierEducationController::class, "show"]);
    });
    Route::group(['prefix' => 'carrierindustrialsectors/'], function () {
        Route::get("show/all", [CarrierIndustrialsectorController::class, "index"]);
        Route::post("create", [CarrierIndustrialsectorController::class, "store"]);
        Route::post("update", [CarrierIndustrialsectorController::class, "update"]);
        Route::get("show/id/{id}", [CarrierIndustrialsectorController::class, "show"]);
    });
    Route::group(['prefix' => 'carrierspecialists/'], function () {
        Route::get("show/all", [CarrierSpecialistController::class, "index"]);
        Route::post("create", [CarrierSpecialistController::class, "store"]);
        Route::post("update", [CarrierSpecialistController::class, "update"]);
        Route::get("show/id/{id}", [CarrierSpecialistController::class, "show"]);
    });
    Route::group(['prefix' => 'carrierskills/'], function () {
        Route::get("show/all", [CarrierSkillController::class, "index"]);
        Route::post("create", [CarrierSkillController::class, "store"]);
        Route::post("update", [CarrierSkillController::class, "update"]);
        Route::get("show/id/{id}", [CarrierSkillController::class, "show"]);
    });
    Route::group(['prefix' => 'carriers/'], function () {
        Route::get("show/all", [CarrierController::class, "index"]);
        Route::post("create", [CarrierController::class, "store"]);
        Route::post("update", [CarrierController::class, "update"]);
        Route::get("show/id/{id}", [CarrierController::class, "show"]);
    });
    Route::group(['prefix' => 'companies/'], function () {
        Route::get("show/all", [CompanieController::class, "index"]);
        Route::post("create", [CompanieController::class, "store"]);
        Route::post("update", [CompanieController::class, "update"]);
        Route::get("show/id/{id}", [CompanieController::class, "show"]);
    });
    Route::group(['prefix' => 'carrierdetailspecialists/'], function () {
        Route::get("show/all", [CarrierdetailspecialistController::class, "index"]);
        Route::post("create", [CarrierdetailspecialistController::class, "store"]);
        Route::post("update", [CarrierdetailspecialistController::class, "update"]);
        Route::get("show/id/{id}", [CarrierdetailspecialistController::class, "show"]);
    });
    Route::group(['prefix' => 'regencies/'], function () {
        Route::get("show/all", [RegencieController::class, "index"]);
        Route::post("create", [RegencieController::class, "store"]);
        Route::post("update", [RegencieController::class, "update"]);
        Route::get("show/id/{id}", [RegencieController::class, "show"]);
    });
    Route::group(['prefix' => 'provinces/'], function () {
        Route::get("show/all", [ProvinceController::class, "index"]);
        Route::post("create", [ProvinceController::class, "store"]);
        Route::post("update", [ProvinceController::class, "update"]);
        Route::get("show/id/{id}", [ProvinceController::class, "show"]);
    });
    Route::group(['prefix' => 'carrierdetailskills/'], function () {
        Route::get("show/all", [CarrierdetailskillController::class, "index"]);
        Route::post("create", [CarrierdetailskillController::class, "store"]);
        Route::post("update", [CarrierdetailskillController::class, "update"]);
        Route::get("show/id/{id}", [CarrierdetailskillController::class, "show"]);
    });
    Route::group(['prefix' => 'userspecialists/'], function () {
        Route::get("show/all", [UserspecialistController::class, "index"]);
        Route::post("create", [UserspecialistController::class, "store"]);
        Route::post("update", [UserspecialistController::class, "update"]);
        Route::get("show/id/{id}", [UserspecialistController::class, "show"]);
    });
    Route::group(['prefix' => 'userskills/'], function () {
        Route::get("show/all", [UserskillController::class, "index"]);
        Route::post("create", [UserskillController::class, "store"]);
        Route::post("update", [UserskillController::class, "update"]);
        Route::get("show/id/{id}", [UserskillController::class, "show"]);
    });
    Route::group(['prefix' => 'userworkexperiences/'], function () {
        Route::get("show/all", [UserworkexperienceController::class, "index"]);
        Route::post("create", [UserworkexperienceController::class, "store"]);
        Route::post("update", [UserworkexperienceController::class, "update"]);
        Route::get("show/id/{id}", [UserworkexperienceController::class, "show"]);
    });
    Route::group(['prefix' => 'learninggroups/'], function () {
        Route::get("show/all", [LearniggroupController::class, "index"]);
        Route::post("create", [LearniggroupController::class, "store"]);
        Route::post("update", [LearniggroupController::class, "update"]);
        Route::get("show/id/{id}", [LearniggroupController::class, "show"]);
    });
    Route::group(['prefix' => 'learningeventgroups/'], function () {
        Route::get("show/all", [LearnigeventgroupController::class, "index"]);
        Route::post("create", [LearnigeventgroupController::class, "store"]);
        Route::post("update", [LearnigeventgroupController::class, "update"]);
        Route::get("show/id/{id}", [LearnigeventgroupController::class, "show"]);
    });
    Route::group(['prefix' => 'workpositions/'], function () {
        Route::get("show/all", [WorkpositionController::class, "index"]);
        Route::post("create", [WorkpositionController::class, "store"]);
        Route::post("update", [WorkpositionController::class, "update"]);
        Route::get("show/id/{id}", [WorkpositionController::class, "show"]);
    });
    Route::group(['prefix' => 'mentors/'], function () {
        Route::get("show/all", [MentorController::class, "index"]);
        Route::post("create", [MentorController::class, "store"]);
        Route::post("update", [MentorController::class, "update"]);
        Route::get("show/id/{id}", [MentorController::class, "show"]);
    });
    Route::group(['prefix' => 'learnings/'], function () {
        Route::get("show/all", [LearningController::class, "index"]);
        Route::post("create", [LearningController::class, "store"]);
        Route::post("update", [LearningController::class, "update"]);
        Route::get("show/id/{id}", [LearningController::class, "show"]);
    });
    Route::group(['prefix' => 'learningdetailss/'], function () {
        Route::get("show/all", [LearningdetailController::class, "index"]);
        Route::post("create", [LearningdetailController::class, "store"]);
        Route::post("update", [LearningdetailController::class, "update"]);
        Route::get("show/id/{id}", [LearningdetailController::class, "show"]);
    });
});