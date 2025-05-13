<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LearningChartRepositoryInterface;

class TransactionChartController extends Controller
{
    use ResponseAPI;
    private $repository; 
    public function __construct(LearningChartRepositoryInterface $repository )
    {
        $this->repository = $repository; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            $data =  $this->repository->all($request->useruuid); 
            if($data->count() > 0){ 
                return $this->success('Charts Transaction retrieved successfully', $data);
            }else{
                return $this->error('Charts Transaction Not Found.', [],400);
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
        //
        $data = $request->validate([ 
            'useruuid' =>  'required|string|max:150',
            'learninguuid' => 'required',
            'price' => 'required'
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
                return $this->success('Charts add successfully', $dataArray, 201);
            }else{
                return $this->error('Charts add failure', 400);
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
    public function destroyuuid(Request $request )
    {
        $data = $request->validate([ 
            'uuid' =>  'required|string|max:150' 
        ]);
        try { 
            DB::beginTransaction();  
     
            $execute = $this->repository->deleteuuid($request);
            DB::commit();
            
            if($execute){
                $data =  $this->repository->all($request->useruuid); 
                return $this->success('Charts delete successfully.', $data, 201);
            }else{
                return $this->error('Charts delete failure', 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->validate([ 
            'useruuid' =>  'required|string|max:150' 
        ]);
        try { 
            DB::beginTransaction();  
     
            $execute = $this->repository->delete($request);
            $data =  $this->repository->all($request->useruuid); 
            DB::commit();
            
            if($execute){
                return $this->success('Charts delete successfully.', $data , 201);
            }else{
                return $this->error('Charts delete failure', 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }
}
