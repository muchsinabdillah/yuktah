<?php
namespace App\Repositories\Interfaces;

Interface MentorRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyUseruuid($id);
    public function findbyid($id);
    public function update($data);   
    
    
}