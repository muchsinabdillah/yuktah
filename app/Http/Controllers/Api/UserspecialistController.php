<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserspecialistRepositoryInterface;


class UserspecialistController extends Controller
{
    use ResponseAPI;
    private $repository;
    public function __construct(UserspecialistRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $data =  $this->repository->all(); 
            if($data->count() > 0){ 
                return $this->success('User specialists retrieved successfully', $data);
            }else{
                return $this->error('User specialists Not Found.', [],400);
            } 
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //+
        $data = $request->validate([ 
            'specialistuuid' =>  'required|string|max:150',
            'useruuid' => 'required'
        ]);
        try { 
            DB::beginTransaction();  
            $uuid = Uuid::uuid4();
            
             
            $data = [
                'uuid' => $uuid,                 
                'specialistuuid' => $request->specialistuuid,  
                'useruuid' => $request->useruuid 
            ];

            $execute = $this->repository->store($data);
            DB::commit();
            
            if($execute){
                return $this->success('User specialists retrieved successfully', $data, 201);
            }else{
                return $this->error('User specialists retrieved failure', 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {  
            $execute = $this->repository->findbyid($id)->first();
             
            if($execute){
                $data = [
                    'id' => $execute->id,                 
                    'uuid' => $execute->uuid, 
                    'specialistuuid' => $execute->specialistuuid,  
                    'useruuid' => $execute->useruuid 
                ];
                return $this->success('User specialists retrieved successfully', $data);
            }else{
                return $this->error('User specialists Not Found.', [],400);
            } 
        } catch (\Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $data = $request->validate([ 
            'uuid' =>  'required|string|max:150',
            'specialistuuid' =>  'required|string|max:150',
            'useruuid' => 'required'
        ]);
        //validate
        $execute = $this->repository->findbyid($request->uuid);  
            if($execute->count() < 1){  
                return $this->error('User specialist Not Found.', [],400);
            } 

        try {
            DB::beginTransaction();  
             
            $data = [                
                'uuid' => $request->uuid,  
                'specialistuuid' => $request->specialistuuid,  
                'useruuid' => $request->useruuid 
            ];
 
                $executes = $this->repository->update($data);
           
            DB::commit(); 
            if($executes){
                return $this->success('User specialists updated successfully', []);
            } 
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        
    }
    //
}
