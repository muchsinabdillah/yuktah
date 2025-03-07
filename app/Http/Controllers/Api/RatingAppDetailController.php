<?php

namespace App\Http\Controllers\api;

use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\RatingAppDetailRepositoryInterface;

class RatingAppDetailController extends Controller
{
    use ResponseAPI;
    private $ratingAppRepository;
    private $memberRepository;
    public function __construct(RatingAppDetailRepositoryInterface $ratingAppRepository,
                                MemberRepositoryInterface $memberRepository )
    {
        $this->ratingAppRepository = $ratingAppRepository; 
        $this->memberRepository = $memberRepository; 
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data =  $this->ratingAppRepository->all(); 
            if($data->count() > 0){ 
                return $this->success('Rating App retrieved successfully', $data);
            }else{
                return $this->error('Rating App Not Found.', [],400);
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
        $request->validate([ 
            'memberuuid' =>  'required|string|max:150',
            'ratingvalue' => 'required',
            'Comment' => 'required' 

        ]);

        if($request['ratingvalue'] > "5"){
            return $this->error('Number of Maximum Rating is 5.', [],400);
        }

        // $workpos = $this->memberRepository->findbyid($request->memberuuid);  
        // if($workpos->count() < 1){  
        //     return $this->error('Member Not Found.', [],400);
        // } 
 
        try { 
            DB::beginTransaction();  
            $uuid = Uuid::uuid4();
            
            $dataArray = []; 
            $dataArray = $request->toArray(); 
            $dataArray['uuid'] = $uuid; 
            $execute = $this->ratingAppRepository->store($dataArray);
            DB::commit();
            
            if($execute){
                return $this->success('Rating App retrieved successfully', $dataArray, 201);
            }else{
                return $this->error('Rating App retrieved failure', 400);
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
        try {  
            $execute = $this->ratingAppRepository->findbyid($id)->first();
             
            if($execute){ 
                return $this->success('Rating App retrieved successfully', $execute);
            }else{
                return $this->error('Rating App Not Found.', [],400);
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
        $request->validate([ 
            'memberuuid' =>  'required|string|max:150',
            'ratingvalue' => 'required',
            'uuid' => 'required',
            'Comment' => 'required' 

        ]);
        //validate
        if($request['ratingvalue'] > "5"){
            return $this->error('Number of Maximum Rating is 5.', [],400);
        }

        $user = $this->ratingAppRepository->findbyid($request->uuid);  
            if($user->count() < 1){  
                return $this->error('ID Not Found.', [],400);
            } 
            
        try {
            DB::beginTransaction();  
             
            $dataArray = []; 
            $dataArray = $request->toArray();
                $executes = $this->ratingAppRepository->update($dataArray);
           
            DB::commit(); 
            if($executes){
                return $this->success('Rating App updated successfully', []);
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
