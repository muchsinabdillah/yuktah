<?php
namespace App\Repositories\Interfaces;

Interface LearningGroupRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyid($id);
    public function update($data);   
    
    
}