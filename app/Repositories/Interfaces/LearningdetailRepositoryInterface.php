<?php
namespace App\Repositories\Interfaces;

Interface LearningdetailRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyid($id);
    public function findbyUuid($id);
    public function findDataLearningCertbyUuid($id);
    public function showdetailbylearningid($id);
    public function update($data);   
    
    
}