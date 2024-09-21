<?php
namespace App\Repositories\Interfaces;

Interface MemberworkhistorieRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyid($id);
    public function update($data);   
    
    
}