<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LearningQuestionNairRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class LearningQuestionNairController extends Controller
{
    use ResponseAPI;
    private $repository;
    public function __construct(LearningQuestionNairRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data =  $this->repository->all($request->learninguuid); 
             
            if($data->count() > 0){ 
                return $this->success('Data Master Kuisioner Berhasil ditemukan.', $data);
            }else{
                return $this->error('Data Master Kuisioner Gagal ditemukan.', [],400);
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
        $data = $request->validate([  
            'name' =>  'required',
            'year' =>  'required',
            'type' =>  'required',
            'learninguuid' =>  'required' 
        ]);
        try { 
            DB::beginTransaction();  
            $uuid = Uuid::uuid4();
            
             
            $dataArray = []; 
            $dataArray = $request->toArray();
            $dataArray['uuid'] = $uuid; 
 
            $execute = $this->repository->store($dataArray);
            DB::commit();
            
            if($execute){
                return $this->success('Data Master Kuisioner Berhasil ditambahkan.', $dataArray, 201);
            }else{
                return $this->error('Data Master Kuisioner Gagal ditambahkan.', 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e , $e->getCode());
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {  
            $execute = $this->repository->findbyid($id)->first();
            
            if($execute){
                $data = [
                    'id' => $execute->id,                 
                    'uuid' => $execute->uuid, 
                    'type' => $execute->type, 
                    'name' => $execute->name,   
                    'year' => $execute->year,   
                    'learninguuid' => $execute->learninguuid
                ];
                return $this->success('Data Master Kuisioner Berhasil ditemukan.', $data);
            }else{
                return $this->error('Data Master Kuisioner Gagal ditemukan.', [],400);
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
    public function update(Request $request )
    {
        $data = $request->validate([  
            'name' =>  'required',
            'year' =>  'required',
            'type' =>  'required',
            'learninguuid' =>  'required' 
        ]);
        //validate
        $execute = $this->repository->findbyid($request->uuid);  
            if($execute->count() < 1){  
                return $this->error('Data Master Kuisioner Tidak di temukan.', [],400);
            } 

        try {
            DB::beginTransaction();  
             
            $data = [                
                'uuid' => $request->uuid,  
                'name' => $request->name,   
                'year' => $request->year,   
                'type' => $request->type,   
                'learninguuid' => $request->learninguuid 
            ];
 
                $executes = $this->repository->update($data);
           
            DB::commit(); 
            if($executes){
                return $this->success('Data Master Kuisioner Berhasil dirubah.', []);
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
}
