<?php
namespace App\Repositories\Interfaces;

Interface TrsLearningObservationRepositoryInterface{
    
    public function all($useruuid);
    public function alldetail($uuid); 
    public function Store($data); 
    public function StoreDetail($uuid,$uuidheader,$answer,$istrue,$score,$uuidquestion);  
    public function findbyid($uuid);   
    public function findbyUuidDetail($uuid);   
    public function updateItemDetailAnswer($dataArray);   
    public function updateGlobal($id);  
    public function findbyUuid($uuid); 
    public function sumTotalfinal($uuid); 
    public function findNullDatabyUuidDetail($uuid); 
    public function updateFinalScoreStreamDetail($streamuuid,$score); 
    public function updateFinalScore($uuid,$score); 
    public function updateFinalResultStreamDetail($streamuuid,$score); 
}