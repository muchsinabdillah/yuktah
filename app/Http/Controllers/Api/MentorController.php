<?php

namespace App\Http\Controllers\Api;
use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\MentorRepositoryInterface;
use App\Repositories\Interfaces\WorkpositionRepositoryInterface;

class MentorController extends Controller
{
    use ResponseAPI;
    private $repository;
    private $workpositionRepository;
    private $userRepository;
    public function __construct(MentorRepositoryInterface $repository,
                                WorkpositionRepositoryInterface $workpositionRepository,
                                MemberRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->workpositionRepository = $workpositionRepository;
        $this->userRepository = $userRepository;
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
        $request->validate([ 
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

        $workpos = $this->workpositionRepository->findbyid($request->workpositionuuid);  
        if($workpos->count() < 1){  
            return $this->error('Work Position Not Found.', [],400);
        } 

        $user = $this->userRepository->findbyid($request->useruuid);  
        if($user->count() < 1){  
            return $this->error('User Not Found.', [],400);
        } 
        $user = $this->repository->findbyUseruuid($request->useruuid);  
        if($user->count() >0 ){  
            return $this->error('Nama ini sudah terdaftar sebagai Mentor.', [],400);
        } 


        try { 
            DB::beginTransaction();  
            $uuid = Uuid::uuid4();
            
             
            $dataArray = []; 
            $dataArray = $request->toArray();
            $dataArray['uuid'] = $uuid; 
            $execute = $this->repository->store($dataArray);
            $execute = $this->userRepository->updatesprivillageMentor($dataArray);
            DB::commit();
            
            if($execute){
                return $this->success('Mentors retrieved successfully', $dataArray, 201);
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
                return $this->success('Mentors retrieved successfully', $execute);
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
                return $this->error('Mentor Not Found.', [],400);
            }

        $workpos = $this->workpositionRepository->findbyid($request->workpositionuuid);  
            if($workpos->count() < 1){  
                return $this->error('Work Position Not Found.', [],400);
            } 
    
        $user = $this->userRepository->findbyid($request->useruuid);  
            if($user->count() < 1){  
                return $this->error('User Not Found.', [],400);
            } 
            
        try {
            DB::beginTransaction();  
             
            $dataArray = []; 
            $dataArray = $request->toArray();
                $executes = $this->repository->update($dataArray);
           
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
