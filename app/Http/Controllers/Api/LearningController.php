<?php

namespace App\Http\Controllers\Api;
use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LearningRepositoryInterface;

class LearningController extends Controller
{
    use ResponseAPI;
    private $repository;
    public function __construct(LearningRepositoryInterface $repository)
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
                return $this->success('Learnings retrieved successfully', $data);
            }else{
                return $this->error('Learnings Not Found.', [],400);
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
            'title' => 'required',
            'shortdescription' => 'required',
            'studentcount' => 'required',
            'ratingcount' => 'required',
            'rating' => 'required',
            'mentoruuid' => 'required',
            'learndetail' => 'required',
            'benefitcourse' => 'required',
            'requirment' => 'required',
            'description' => 'required',
            'price' => 'required',
            'status' => 'required'

        ]);
        try { 
            DB::beginTransaction();  
            $uuid = Uuid::uuid4();
            
             
            $data = [
                'uuid' => $uuid,                 
                'useruuid' => $request->useruuid,  
                'title'=> $request->title,
                'shortdescription'=> $request->shortdescription,
                'studentcount'=> $request->studentcount,
                'ratingcount'=> $request->ratingcount,
                'rating'=> $request->rating,
                'mentoruuid'=> $request->mentoruuid,
                'learndetail'=> $request->learndetail,
                'benefitcourse'=> $request->benefitcourse,
                'requirment'=> $request->requirment,
                'description'=> $request->description,
                'price'=> $request->price,
                'status'=> $request->status
            ];

            $execute = $this->repository->store($data);
            DB::commit();
            
            if($execute){
                return $this->success('Learnings retrieved successfully', $data, 201);
            }else{
                return $this->error('Learnings retrieved failure', 400);
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
                    'title'=> $execute->title,
                    'shortdescription'=> $execute->shortdescription,
                    'studentcount'=> $execute->studentcount,
                    'ratingcount'=> $execute->ratingcount,
                    'rating'=> $execute->rating,
                    'mentoruuid'=> $execute->mentoruuid,
                    'learndetail'=> $execute->learndetail,
                    'benefitcourse'=> $execute->benefitcourse,
                    'requirment'=> $execute->requirment,
                    'description'=> $execute->description,
                    'price'=> $execute->price,
                    'status'=> $execute->status  
                    
                ];
                return $this->success('Learnings retrieved successfully', $data);
            }else{
                return $this->error('Learnings Not Found.', [],400);
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
            'title' => 'required',
            'shortdescription' => 'required',
            'studentcount' => 'required',
            'ratingcount' => 'required',
            'rating' => 'required',
            'mentoruuid' => 'required',
            'learndetail' => 'required',
            'benefitcourse' => 'required',
            'requirment' => 'required',
            'description' => 'required',
            'price' => 'required',
            'status' => 'required'
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
                'title'=> $request->title,
                'shortdescription'=> $request->shortdescription,
                'studentcount'=> $request->studentcount,
                'ratingcount'=> $request->ratingcount,
                'rating'=> $request->rating,
                'mentoruuid'=> $request->mentoruuid,
                'learndetail'=> $request->learndetail,
                'benefitcourse'=> $request->benefitcourse,
                'requirment'=> $request->requirment,
                'description'=> $request->description,
                'price'=> $request->price,
                'status'=> $request->status
            ];
 
                $executes = $this->repository->update($data);
           
            DB::commit(); 
            if($executes){
                return $this->success('Learnings updated successfully', []);
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
