<?php
namespace App\Repositories\Interfaces;

Interface LearningRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function updatemodule($data);
    public function findbyid($id);
    public function findbyUuidGroupid($uuid);
    public function update($data);   
    
    
}