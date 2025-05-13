<?php
namespace App\Repositories\Interfaces;

Interface TrsLearningQuestionRepositoryInterface{
    
    public function all($useruuid);
    public function alldetail($uuid);
    public function alldetailPosttest($uuid);
    public function Store($data);
    public function StorePostTest($data);
    public function StoreDetail($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion); 
    public function StoreDetailPosttest($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion); 
    public function findbyid($uuid);  
    public function findposttestbyid($uuid);  
    public function findbyUuidDetail($uuid);  
    public function findbyUuidDetailPosttest($uuid);  
    public function updateItemDetailAnswer($dataArray);  
    public function updateItemDetailAnswerPosttest($dataArray);  
    public function updateGlobal($id);  
    public function findbyUuid($uuid);
    public function findbyUuidPosttest($uuid);
    public function sumTotalfinal($uuid);
    public function sumTotalfinalposttest($uuid);
    public function findNullDatabyUuidDetail($uuid);
    public function findNullDatabyUuidDetailPosttest($uuid);
    public function updateFinalScoreStreamDetail($streamuuid,$score);
    public function updateFinalScoreStreamDetailPost($streamuuid,$score);
    public function updateFinalScore($uuid,$score);
    public function updateFinalScorePosttest($uuid,$score);
}