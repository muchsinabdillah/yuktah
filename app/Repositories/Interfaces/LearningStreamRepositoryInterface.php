<?php
namespace App\Repositories\Interfaces;

Interface LearningStreamRepositoryInterface{
    
    public function all($data);
    public function finddetailstreamModulbyUserid($useruuid);
    public function StoreDetail($uuid,$learningtrsuuid,$learninguuid,$minutesprogress,$isfinish,$minutesstart,$learningdetailuuid,$streamuuid);
    public function Store($uuid,$learningtrsuuid,$certprogress,$totalmodul,$totalfinish, $isFinish,$useruuid,$learninguuid);  
    public function updateStream($data);  
    public function updateStreamHeader($data);  
    public function findbyLearningAndUserid($data);  
    public function findbyLearningStreamId($uuid);
    public function findbyLearningStreambyDetailUuid($uuid);
    public function findbyLearningModuleListbyId($data);  
    
    
}