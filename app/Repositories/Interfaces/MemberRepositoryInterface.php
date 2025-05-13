<?php
namespace App\Repositories\Interfaces;

Interface MemberRepositoryInterface{
    
    public function all();
    public function Store($data);
    public function findbyid($id);
    public function showsocmed($id);
    public function showPersonalData($id);
    public function update($data);     
    public function socmed($data);     
    public function personal($data);     
    public function updates($data);     
    public function updatesprivillageMentor($data);     
    
    
}