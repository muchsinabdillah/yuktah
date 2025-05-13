<?php
namespace App\Repositories\Interfaces;

Interface LearningPracticeRepositoryInterface{
    
    public function all($learninguuid);
    public function allPerLearningUuid($learninguuid);
    public function Store($data);
    public function findbyid($id);
    public function update($data);   
    
    
}