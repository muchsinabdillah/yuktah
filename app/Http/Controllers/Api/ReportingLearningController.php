<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ReportingLearningRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class ReportingLearningController extends Controller
{
     use ResponseAPI;
    private $repository;
    public function __construct(ReportingLearningRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.a
     */
    public function index()
    {
         try {
            $data =  $this->repository->all(); 
            if($data->count() > 0){ 
                return $this->success('Regencies retrieved successfully', $data);
            }else{
                return $this->error('Regencies Not Found.', [],400);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
