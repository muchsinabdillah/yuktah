<?php

namespace App\Http\Controllers\Api;
use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MentorRepositoryInterface;

class MentorController extends Controller
{
    use ResponseAPI;
    private $repository;
    public function __construct(MentorRepositoryInterface $repository)
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
                return $this->success('Mentors retrieved successfully', $data);
            }else{
                return $this->error('Mentors Not Found.', [],400);
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
            'useruuid' =>  'required|string|max:150',
            'name' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'companyname' => 'required',
            'workpositionuuid' => 'required',
            'dateofbirth' => 'required',
            'ratingcount' => 'required',
            'rating' => 'required'

        ]);
        try { 
            DB::beginTransaction();  
            $uuid = Uuid::uuid4();
            
             
            $data = [
                'uuid' => $uuid,                 
                'useruuid' => $request->useruuid,  
                'name' => $request->name,
                'sex' => $request->sex,
                'address' => $request->address,
                'companyname' => $request->companyname,
                'workpositionuuid' => $request->workpositionuuid,
                'dateofbirth' => $request->dateofbirth,
                'ratingcount' => $request->ratingcount,
                'rating' => $request->rating
            ];

            $execute = $this->repository->store($data);
            DB::commit();
            
            if($execute){
                return $this->success('Mentors retrieved successfully', $data, 201);
            }else{
                return $this->error('Mentors retrieved failure', 400);
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
                    'useruuid' => $execute->useruuid,  
                    'name' => $execute->name, 
                    'sex'=> $execute->sex,
                    'address'=> $execute->address,
                    'companyname'=> $execute->companyname,
                    'workpositionuuid'=> $execute->workpositionuuid,
                    'dateofbirth'=> $execute->dateofbirth,
                    'ratingcount'=> $execute->ratingcount,
                    'rating'=> $execute->rating
                ];
                return $this->success('Mentors retrieved successfully', $data);
            }else{
                return $this->error('Mentors Not Found.', [],400);
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
            'useruuid' =>  'required|string|max:150',
            'name' => 'required',
            'sex'=> 'required',
            'address'=> 'required',
            'companyname'=> 'required',
            'workpositionuuid'=> 'required',
            'dateofbirth'=> 'required',
            'ratingcount'=> 'required',
            'rating'=> 'required'
        ]);
        //validate
        $execute = $this->repository->findbyid($request->uuid);  
            if($execute->count() < 1){  
                return $this->error('Learning Group Not Found.', [],400);
            } 

        try {
            DB::beginTransaction();  
             
            $data = [                
                'uuid' => $request->uuid,  
                'useruuid' => $request->useruuid,  
                'name' => $request->name,
                'sex'=> $request->sex,
                'address'=> $request->address,
                'companyname'=> $request->companyname,
                'workpositionuuid'=> $request->workpositionuuid,
                'dateofbirth'=> $request->dateofbirth,
                'ratingcount'=> $request->ratingcount,
                'rating' => $request->rating
            ];
 
                $executes = $this->repository->update($data);
           
            DB::commit(); 
            if($executes){
                return $this->success('Mentors updated successfully', []);
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
