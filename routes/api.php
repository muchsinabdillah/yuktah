<?php

use App\Http\Controllers\Api\Auth\RegisterController as AuthRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\MentorController;

use App\Http\Controllers\Api\CarrierController;
use App\Http\Controllers\Api\CompanieController;
use App\Http\Controllers\Api\LearningController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\RegencieController;  
use App\Http\Controllers\Api\UserskillController;  
use App\Http\Controllers\Api\CarrierGroupController;
use App\Http\Controllers\Api\CarrierSkillController;
use App\Http\Controllers\Api\LearninggroupController;
use App\Http\Controllers\Api\WorkpositionController; 
use App\Http\Controllers\Api\LearningdetailController;
use App\Http\Controllers\Api\UserspecialistController;
use App\Http\Controllers\Api\AuthToken\LoginController;
use App\Http\Controllers\Api\MembereducationController;
use App\Http\Controllers\api\RatingAppDetailController;
use App\Http\Controllers\Api\AuthToken\LogoutController;
use App\Http\Controllers\Api\CarrierEducationController;
use App\Http\Controllers\Api\CarrierSpecialistController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CarrierdetailskillController;
use App\Http\Controllers\Api\CarrierRequirementController;
use App\Http\Controllers\Api\LearningeventgroupController;
use App\Http\Controllers\Api\MemberworkhistorieController;
use App\Http\Controllers\api\RatingLessonDetailController;
use App\Http\Controllers\api\RatingMentorDetailController;
use App\Http\Controllers\Api\UserworkexperienceController;
use App\Http\Controllers\Api\CarrierdetailspecialistController;
use App\Http\Controllers\Api\CarrierIndustrialsectorController;
use App\Http\Controllers\Api\LearningObservationController;
use App\Http\Controllers\Api\LearningPracticeController;
use App\Http\Controllers\Api\LearningQuestionController;
use App\Http\Controllers\Api\LearningQuestionNairController;
use App\Http\Controllers\Api\TransactionChartController;
use App\Http\Controllers\Api\TransactionLearningController;
use App\Http\Controllers\Api\TransactionLearningStreamController;
use App\Http\Controllers\Api\TrsLearningKuisionerController;
use App\Http\Controllers\Api\TrsLearningObservasiController;
use App\Http\Controllers\Api\TrsLearningPosttestController;
use App\Http\Controllers\Api\TrsLearningPretestController;
use App\Http\Controllers\Api\TrsLearningUjiKompetensiController;
 

Route::prefix('auth')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::post('/register', RegisterController::class);
});
Route::get('user', function(Request $request) {
    return [
        'user' => $request->user(),
        'currentToken' => $request->bearerToken()
    ];
});

Route::post('/email/verify/{id}/{hash}', [RegisterController::class,'emailVerify'])->name('verification.verify');
Route::post('/resend-email-verify', [RegisterController::class,'resendEmailVerificationMail'])->middleware('auth:sanctum');
Route::post('/forgot-password', [RegisterController::class,'forgotPassword']);
Route::post('/reset-password', [RegisterController::class,'resetPassword'])->name('password.reset');
// Route::post('/reset-password', [RegisterController::class,'resetPassword'])->middleware('web')->name('password.reset');

 
Route::middleware('auth:sanctum')->prefix('masterdata')->group(function (){
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
    
    Route::group(['prefix' => 'learninggroups/'], function () {
        Route::get("show/all",[LearninggroupController::class, "index"]);
        Route::post("create", [LearninggroupController::class, "store"]);
        Route::post("update", [LearninggroupController::class, "update"]);
        Route::get("show/id/{id}", [LearninggroupController::class, "show"]);
    });
    Route::group(['prefix' => 'learningeventgroups/'], function () {
        Route::get("show/all", [LearningeventgroupController::class, "index"]);
        Route::post("create", [LearningeventgroupController::class, "store"]);
        Route::post("update", [LearningeventgroupController::class, "update"]);
        Route::get("show/id/{id}", [LearningeventgroupController::class, "show"]);
    });
    
    Route::group(['prefix' => 'workpositions/'], function () {
        Route::get("show/all", [WorkpositionController::class, "index"]);
        Route::post("create", [WorkpositionController::class, "store"]);
        Route::post("update", [WorkpositionController::class, "update"]);
        Route::get("show/id/{id}", [WorkpositionController::class, "show"]);
    });

    Route::group(['prefix' => 'learningquestions/'], function () {
        Route::post("show/all",[LearningQuestionController::class, "index"]);
        Route::post("create", [LearningQuestionController::class, "store"]);
        Route::post("update", [LearningQuestionController::class, "update"]);
        Route::get("show/id/{id}", [LearningQuestionController::class, "show"]);
    });
    Route::group(['prefix' => 'learningquestionnairs/'], function () {
        Route::post("show/all",[LearningQuestionNairController::class, "index"]);
        Route::post("create", [LearningQuestionNairController::class, "store"]);
        Route::post("update", [LearningQuestionNairController::class, "update"]);
        Route::get("show/id/{id}", [LearningQuestionNairController::class, "show"]);
    });
    Route::group(['prefix' => 'learningobservations/'], function () {
        Route::post("show/all",[LearningObservationController::class, "index"]);
        Route::post("create", [LearningObservationController::class, "store"]);
        Route::post("update", [LearningObservationController::class, "update"]);
        Route::get("show/id/{id}", [LearningObservationController::class, "show"]);
    });
    Route::group(['prefix' => 'learningpractices/'], function () {
        Route::post("show/all",[LearningPracticeController::class, "index"]);
        Route::post("create", [LearningPracticeController::class, "store"]);
        Route::post("update", [LearningPracticeController::class, "update"]);
        Route::get("show/id/{id}", [LearningPracticeController::class, "show"]);
    });
});
   
Route::group(['prefix' => 'mentors/'], function () {
    Route::get("show/all", [MentorController::class, "index"]);
    Route::post("create", [MentorController::class, "store"]);
    Route::post("update", [MentorController::class, "update"]);
    Route::get("show/id/{id}", [MentorController::class, "show"]);
});

Route::group(['prefix' => 'learnings/'], function () {
    Route::get("show/all", [LearningController::class, "index"]);
    Route::get("show/group/uuid/{uuid}", [LearningController::class, "create"]);
    Route::post("create", [LearningController::class, "store"]);
    Route::post("update", [LearningController::class, "update"]);
    Route::get("show/id/{id}", [LearningController::class, "show"]);
  
    
});

Route::group(['prefix' => 'learningdetails/'], function () {
    Route::get("show/all", [LearningdetailController::class, "index"]);
    Route::post("create", [LearningdetailController::class, "store"]);
    Route::post("update", [LearningdetailController::class, "update"]);
    Route::get("show/id/{id}", [LearningdetailController::class, "show"]);
    Route::get("show/uuid/{id}", [LearningdetailController::class, "showuuid"]);
    Route::get("show/learningid/{id}", [LearningdetailController::class, "showdetailbylearningid"]);
    Route::get("file/download/{uuid}", [LearningdetailController::class, "create"]);
});

// sini
Route::group(['prefix' => 'carriers/'], function () {
    Route::get("show/all", [CarrierController::class, "index"]);
    Route::post("create", [CarrierController::class, "store"]);
    Route::post("update", [CarrierController::class, "update"]);
    Route::get("show/id/{id}", [CarrierController::class, "show"]);
});

Route::middleware('auth:sanctum')->prefix('membership')->group(function (){  
   Route::group(['prefix' => 'users/'], function () {
        Route::get("show/all", [MemberController::class, "index"]);
        Route::post("create", [MemberController::class, "store"]); 
        Route::post("update", [MemberController::class, "edit"]);   
        Route::get("show/id/{id}", [MemberController::class, "show"]);
        Route::group(['prefix' => 'personal/'], function () {
            Route::post("update", [MemberController::class, "personal"]); 
            Route::post("show/id", [MemberController::class, "showPersonalData"]); 
        });
        Route::group(['prefix' => 'socmed/'], function () {
            Route::post("update", [MemberController::class, "socmed"]); 
            Route::post("show/id", [MemberController::class, "showsocmed"]); 
        });
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

    Route::group(['prefix' => 'membereducations/'], function () {
        Route::get("show/all", [MembereducationController::class, "index"]);
        Route::post("create", [MembereducationController::class, "store"]);
        Route::post("update", [MembereducationController::class, "update"]);
        Route::get("show/id/{id}", [MembereducationController::class, "show"]);
    });
    Route::group(['prefix' => 'memberworkhistories/'], function () {
        Route::get("show/all", [MemberworkhistorieController::class, "index"]);
        Route::post("create", [MemberworkhistorieController::class, "store"]);
        Route::post("update", [MemberworkhistorieController::class, "update"]);
        Route::get("show/id/{id}", [MemberworkhistorieController::class, "show"]);
    });
});
// belum jadi
Route::group(['prefix' => 'rating/'], function () {

    Route::group(['prefix' => 'app/'], function () { 
            Route::get("show/all", [RatingAppDetailController::class, "index"]);
            Route::post("create", [RatingAppDetailController::class, "store"]);
            Route::post("update", [RatingAppDetailController::class, "update"]);
            Route::get("show/id/{id}", [RatingAppDetailController::class, "show"]);
    });

    Route::group(['prefix' => 'mentor/'], function () { 
            Route::get("show/all", [RatingMentorDetailController::class, "index"]);
            Route::post("create", [RatingMentorDetailController::class, "store"]);
            Route::post("update", [RatingMentorDetailController::class, "update"]);
            Route::get("show/id/{id}", [RatingMentorDetailController::class, "show"]);
    });

    Route::group(['prefix' => 'lesson/'], function () { 
            Route::get("show/all", [RatingLessonDetailController::class, "index"]);
            Route::post("create", [RatingLessonDetailController::class, "store"]);
            Route::post("update", [RatingLessonDetailController::class, "update"]);
            Route::get("show/id/{id}", [RatingLessonDetailController::class, "show"]);
    });
    
});

Route::middleware('auth:sanctum')->prefix('transaction')->group(function (){
    Route::group(['prefix' => 'charts/'], function () {
        Route::post("show/all", [TransactionChartController::class, "index"]); 
        Route::post("create", [TransactionChartController::class, "store"]);
        Route::post("delete/user", [TransactionChartController::class, "destroy"]); 
        Route::post("delete/id", [TransactionChartController::class, "destroyuuid"]); 
    });
    Route::group(['prefix' => 'checkout/'], function () { 
        Route::post("create", [TransactionLearningController::class, "store"]); 
    }); 
    Route::post("show/user/list/detail", [TransactionLearningController::class, "create"]); 

    // kuisioner, pre,post, uji kompetensi, observasi, result
    Route::group(['prefix' => 'learningkuisioner/'], function () {
        Route::post("show/all", [TrsLearningKuisionerController::class, "index"]); 
        Route::post("create", [TrsLearningKuisionerController::class, "store"]);
        Route::post("answer", [TrsLearningKuisionerController::class, "update"]);
        Route::post("final", [TrsLearningKuisionerController::class, "edit"]);
        Route::post("delete/user", [TrsLearningKuisionerController::class, "destroy"]); 
        Route::post("delete/id", [TrsLearningKuisionerController::class, "destroyuuid"]); 
    });

    Route::group(['prefix' => 'pretest/'], function () {
        Route::post("show/all", [TrsLearningPretestController::class, "index"]); 
        Route::post("create", [TrsLearningPretestController::class, "store"]);
        Route::post("answer", [TrsLearningPretestController::class, "update"]);
        Route::post("final", [TrsLearningPretestController::class, "edit"]);
        Route::post("delete/user", [TrsLearningPretestController::class, "destroy"]); 
        Route::post("delete/id", [TrsLearningPretestController::class, "destroyuuid"]); 
    });

    Route::group(['prefix' => 'posttest/'], function () {
        Route::post("show/all", [TrsLearningPosttestController::class, "index"]); 
        Route::post("create", [TrsLearningPosttestController::class, "store"]);
        Route::post("answer", [TrsLearningPosttestController::class, "update"]);
        Route::post("final", [TrsLearningPosttestController::class, "edit"]);
        Route::post("delete/user", [TrsLearningPosttestController::class, "destroy"]); 
        Route::post("delete/id", [TrsLearningPosttestController::class, "destroyuuid"]); 
    });

    Route::group(['prefix' => 'ujikompetensi/'], function () {
        Route::post("show/all", [TrsLearningUjiKompetensiController::class, "index"]); 
        Route::post("create", [TrsLearningUjiKompetensiController::class, "store"]);
        Route::post("final", [TrsLearningUjiKompetensiController::class, "edit"]);
        Route::post("answer", [TrsLearningUjiKompetensiController::class, "update"]);
        Route::post("delete/user", [TrsLearningUjiKompetensiController::class, "destroy"]); 
        Route::post("delete/id", [TrsLearningUjiKompetensiController::class, "destroyuuid"]); 
    });

    Route::group(['prefix' => 'observasi/'], function () {
        Route::post("show/all", [TrsLearningObservasiController::class, "index"]); 
        Route::post("create", [TrsLearningObservasiController::class, "store"]);
        Route::post("final", [TrsLearningObservasiController::class, "edit"]);
        Route::post("answer", [TrsLearningObservasiController::class, "update"]);
        Route::post("delete/user", [TrsLearningObservasiController::class, "destroy"]); 
        Route::post("delete/id", [TrsLearningObservasiController::class, "destroyuuid"]); 
    });

});

Route::middleware('auth:sanctum')->prefix('stream')->group(function (){
     
    Route::post("learning", [TransactionLearningStreamController::class, "store"]); 
    Route::post("show/user/list", [TransactionLearningStreamController::class, "index"]); 
    Route::post("show/user/listmoduldetail", [TransactionLearningStreamController::class, "listmoduldetail"]); 
    Route::post("show/learningid", [TransactionLearningStreamController::class, "create"]);
    Route::post("show/module/user/list/id", [TransactionLearningStreamController::class, "show"]);
    Route::get("cert", [TransactionLearningStreamController::class, "update"]);
    Route::get("certificate/generate/{id}/{learninguuid}", [TransactionLearningStreamController::class, "update"]);
    // Route::post("show/user/list/detail", [TransactionLearningStreamController::class, "create"]); 

});

Route::get("cert/{aa}", [TransactionLearningStreamController::class, "update"]);
  