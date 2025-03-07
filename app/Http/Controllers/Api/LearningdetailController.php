<?php

namespace App\Http\Controllers\Api;
use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LearningdetailRepositoryInterface;
use App\Repositories\Interfaces\LearningRepositoryInterface;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class LearningdetailController extends Controller
{
    use ResponseAPI;
    private $repository;
    private $learningRepository;
    private $memberRepository;
    public function __construct(
            LearningdetailRepositoryInterface $repository,
            LearningRepositoryInterface $learningRepository,
            MemberRepositoryInterface $memberRepository
        )
    {
        $this->repository = $repository;
        $this->learningRepository = $learningRepository;
        $this->memberRepository = $memberRepository;
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
                return $this->success('Learning details retrieved successfully', $data);
            }else{
                return $this->error('Learning details Not Found.', [],400);
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
            'description' => 'required',
            'type' => 'required',
            'urldocument' => 'required',
            'learninguuid' => 'required'
            
        ]);

        $user = $this->memberRepository->findbyid($request->useruuid);  
        if($user->count() < 1){  
            return $this->error('User Not Found.', [],400);
        }

        $learning = $this->learningRepository->findbyid($request->learninguuid);  
        if($learning->count() < 1){  
            return $this->error('Learning Not Found.', [],400);
        }

        try { 
            
            DB::beginTransaction();  
            $uuid = Uuid::uuid4(); 
            $dataArray = []; 
            $dataArray = $request->toArray();
            $dataArray['uuid'] = $uuid;   
            $execute = $this->repository->store($dataArray);
            DB::commit();
            
            if($execute){
                return $this->success('Learning details retrieved successfully', $dataArray, 201);
            }else{
                return $this->error('Learning details retrieved failure', 400);
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
                return $this->success('Learning details retrieved successfully', $execute);
            }else{
                return $this->error('Learning details Not Found.', [],400);
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
        $request->validate([ 
            'uuid' =>  'required|string|max:150',
            'useruuid' =>  'required|string|max:150',
            'description' => 'required',
            'type' => 'required',
            'urldocument' => 'required',
            'learninguuid' => 'required'
        ]);
        //validate
        $learningdetail = $this->repository->findbyid($request->uuid);  
        if($learningdetail->count() < 1){  
            return $this->error('Learning detail Not Found.', [],400);
        }

        $user = $this->memberRepository->findbyid($request->useruuid);  
        if($user->count() < 1){  
            return $this->error('User Not Found.', [],400);
        }

        $learning = $this->learningRepository->findbyid($request->learninguuid);  
        if($learning->count() < 1){  
            return $this->error('Learning Not Found.', [],400);
        }

        try {
            DB::beginTransaction();  
             
            $dataArray = []; 
            $dataArray = $request->toArray();
            $executes = $this->repository->update($dataArray);
           
            DB::commit(); 
            if($executes){
                return $this->success('Learning details updated successfully', []);
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
