<?php
namespace App\Repositories\Interfaces;

Interface TrsLearningKuisionerRepositoryInterface{
    
    public function all($useruuid);
    public function alldetail($uuid);
    public function Store($data);
    public function StoreDetail($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion); 
    public function findbyid($uuid);  
    public function findbyUuidDetail($uuid);  
    public function updateItemDetailAnswer($dataArray);  
    public function updateGlobal($id);  
    public function findbyUuid($uuid);
    public function sumkuisionerfinal($uuid);
    public function findNullDatabyUuidDetail($uuid);
    public function  updateFinalScoreStreamDetail($streamuuid,$score);
    public function updateFinalScoreKuisioner($uuid,$score);
}