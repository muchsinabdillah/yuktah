<?php
namespace App\Repositories\Interfaces;

Interface LearningRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyid($id);
    public function update($data);   
    
    
}