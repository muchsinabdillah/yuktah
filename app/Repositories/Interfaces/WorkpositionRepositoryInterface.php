<?php
namespace App\Repositories\Interfaces;

Interface WorkpositionRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyid($id);
    public function update($data);   
    
    
}