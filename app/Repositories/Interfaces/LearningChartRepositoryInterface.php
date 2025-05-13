<?php
namespace App\Repositories\Interfaces;

Interface LearningChartRepositoryInterface{
    
    public function all($useruuid);
    public function allwithoutPaging($useruuid);
    public function Store($data);
    public function delete($data);  
    public function deleteuuid($data);  
    
    
}