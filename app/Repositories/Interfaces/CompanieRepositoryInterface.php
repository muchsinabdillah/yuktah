<?php
namespace App\Repositories\Interfaces;

Interface CompanieRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyid($id);
    public function update($data);   
    
    
}