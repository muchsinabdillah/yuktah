<?php
namespace App\Repositories\Interfaces;

Interface CarrierdetailskillRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyid($id);
    public function update($data);   
    
    
}