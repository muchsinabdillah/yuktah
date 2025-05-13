<?php

namespace App\Http\Controllers\Api;
use Ramsey\Uuid\Uuid;
use App\Traits\AwsTrait;
 
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Interfaces\MentorRepositoryInterface;
use App\Repositories\Interfaces\LearningRepositoryInterface;

class LearningController extends Controller
{
    use ResponseAPI;
    use AwsTrait;
    private $repository;
    private $mentorRepsitory;
    private $userRepository;
    public function __construct(LearningRepositoryInterface $repository,
                                MentorRepositoryInterface $mentorRepsitory)
    {
        $this->repository = $repository;
        $this->mentorRepsitory = $mentorRepsitory;
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
    public function create($uuid)
    {
        //
        try {
            $data =  $this->repository->findbyUuidGroupid($uuid); 
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //+
        $data = $request->validate([  
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
            'learninglevel' => 'required',
            'learningdate' => 'required',
            'learningeventuuid' => 'required',
            'learninggroupuuid' => 'required',
            'file' => 'required',
            'status' => 'required'

        ]);

        // $mentor = $this->mentorRepsitory->findbyUseruuid($request->mentoruuid);  
        // if($mentor->count() < 1){  
        //     return $this->error('Mentor Not Found.', [],400);
        // }

        try { 
            DB::beginTransaction();  
            $uuid = Uuid::uuid4(); 
            $dataArray = []; 
            $dataArray = $request->toArray();
            $dataArray['uuid'] = $uuid;  

            $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
            $fileaws = '';
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                // Upload ke S3
                $path = $image->store('learning', 's3'); // 'images' adalah folder di dalam bucket S3
                // URL file yang sudah di-upload
                $url = Storage::disk('s3')->url($path);     
                $fileaws ='https://rsuyarsibucket.s3.ap-southeast-1.amazonaws.com/'.$path;     
            }
            $dataArray['cover'] = $fileaws; 
            $execute = $this->repository->store($dataArray);
            DB::commit();
            
            if($execute){
                return $this->success('Learnings retrieved successfully', $dataArray, 201);
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
                return $this->success('Learnings retrieved successfully', $execute);
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
        $request->validate([ 
            'uuid' =>  'required|string|max:150', 
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
            'learninglevel' => 'required',
            'price' => 'required',
            'file' => 'required',
            'learningdate' => 'required',
            'status' => 'required'
        ]);
        //validate
        $execute = $this->repository->findbyid($request->uuid);  
            if($execute->count() < 1){  
                return $this->error('Learning Not Found.', [],400);
            } 

        // $mentor = $this->mentorRepsitory->findbyUseruuid($request->mentoruuid);  
        //     if($mentor->count() < 1){  
        //         return $this->error('Mentor Not Found.', [],400);
        //     }

        try {
            DB::beginTransaction();  
             
            $dataArray = []; 
            $dataArray = $request->toArray();

            $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
            $fileaws = '';
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                // Upload ke S3
                $path = $image->store('learning', 's3'); // 'images' adalah folder di dalam bucket S3
                // URL file yang sudah di-upload
                $url = Storage::disk('s3')->url($path);     
                $fileaws =$url.$path;     
            }
            $dataArray['cover'] = $fileaws; 

            $executes = $this->repository->update($dataArray);
           
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
