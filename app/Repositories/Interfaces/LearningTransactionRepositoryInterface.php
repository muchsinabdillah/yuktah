<?php
namespace App\Repositories\Interfaces;

Interface LearningTransactionRepositoryInterface{
    
    public function all($useruuid);
    public function alldetail($uuid);
    public function Store($data);
    public function StoreDetail($uuid,$learninguuid,$price,$date_void);
    public function delete($id);  
    public function findbyid($id);  
    
    
}