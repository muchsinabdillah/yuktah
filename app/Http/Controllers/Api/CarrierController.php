<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CarrierRepositoryInterface;


class CarrierController extends Controller
{
    use ResponseAPI;
    private $repository;
    public function __construct(CarrierRepositoryInterface $repository)
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
                return $this->success('Carriers retrieved successfully', $data);
            }else{
                return $this->error('Carriers Not Found.', [],400);
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
            'carriergroupuuid' => 'required',
            'industrialuuid' => 'required',
            'educationuuid' => 'required',
            'requirmentuuid' => 'required',
            'companyuuid' => 'required',
            'provinceuuid' => 'required',
            'regencyuuid' => 'required',
            'title' => 'required',
            'personrequirment' => 'required',
            'duedate' => 'required',
            'description' => 'required',
            'qualification' => 'required',
            'status' => 'required'


        ]);
        try { 
            DB::beginTransaction();  
            $uuid = Uuid::uuid4();
            
             
            $data = [
                'uuid' => $uuid,                 
                'useruuid' => $request->useruuid,  
                'carriergroupuuid' => $request->carriergroupuuid, 
                'industrialuuid'=> $industrialuuid,
                'educationuuid'=> $educationuuid,
                'requirmentuuid'=> $requirmentuuid,
                'companyuuid'=> $companyuuid,
                'provinceuuid'=> $provinceuuid,
                'regencyuuid'=> $regencyuuid,
                'title'=> $title,
                'personrequirment'=> $personrequirment,
                'duedate'=> $duedate,
                'description'=> $description,
                'qualification'=> $qualification,
                'status'=> $status
            ];

            $execute = $this->repository->store($data);
            DB::commit();
            
            if($execute){
                return $this->success('Carriers retrieved successfully', $data, 201);
            }else{
                return $this->error('Carriers retrieved failure', 400);
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
                    'carriergroupuuid' => $execute->carriergroupuuid,
                    'industrialuuid'=> $execute->industrialuuid,
                    'educationuuid'=> $execute->educationuuid,
                    'requirmentuuid'=> $execute->requirmentuuid,
                    'companyuuid'=> $execute->companyuuid,
                    'provinceuuid'=> $execute->provinceuuid,
                    'regencyuuid'=> $execute->regencyuuid,
                    'title'=> $execute->title,
                    'personrequirment'=> $execute->personrequirment,
                    'duedate'=> $execute->duedate,
                    'description'=> $execute->description,
                    'qualification'=> $execute->qualification,
                    'status' => $execute->status
                ];
                return $this->success('Carriers retrieved successfully', $data);
            }else{
                return $this->error('Carriers Not Found.', [],400);
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
            'carriergroupuuid' => 'required',
            'industrialuuid' => 'required',
            'educationuuid' => 'required',
            'requirmentuuid' => 'required',
            'companyuuid' => 'required',
            'provinceuuid' => 'required',
            'regencyuuid' => 'required',
            'title' => 'required',
            'personrequirment' => 'required',
            'duedate' => 'required',
            'description' => 'required',
            'qualification' => 'required',
            'status' => 'required'
        ]);
        //validate
        $execute = $this->repository->findbyid($request->uuid);  
            if($execute->count() < 1){  
                return $this->error('Carrier Not Found.', [],400);
            } 

        try {
            DB::beginTransaction();  
             
            $data = [                
                'uuid' => $request->uuid,  
                'useruuid' => $request->useruuid,  
                'carriergroupuuid' => $request->carriergroupuuid,
                'industrialuuid'=> $request->industrialuuid, 
                'educationuuid' => $request->educationuuid,
                'requirmentuuid'=> $request->requirmentuuid, 
                'companyuuid' => $request->companyuuid,
                'provinceuuid' => $request->provinceuuid,
                'regencyuuid' => $request->regencyuuid,
                'title' => $request->title,
                'personrequirment'=> $request->personrequirment, 
                'duedate' => $request->duedate,
                'description' => $request->description,
                'qualification' => $request->qualification,
                'status'  => $request->status
            ];
 
                $executes = $this->repository->update($data);
           
            DB::commit(); 
            if($executes){
                return $this->success('Carriers updated successfully', []);
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
