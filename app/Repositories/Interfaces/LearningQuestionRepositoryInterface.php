<?php
namespace App\Repositories\Interfaces;

Interface LearningQuestionRepositoryInterface{
    
    public function all($learninguuid);
    public function allPerLearningUuid($learninguuid,$type);
    public function Store($data); 
    public function findbyid($id);
    public function update($data);   
    
    
}