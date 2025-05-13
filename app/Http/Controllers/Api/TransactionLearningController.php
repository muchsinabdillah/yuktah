<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LearningChartRepositoryInterface;
use App\Repositories\Interfaces\LearningdetailRepositoryInterface;
use App\Repositories\Interfaces\LearningRepositoryInterface;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;
use App\Repositories\Interfaces\LearningTransactionRepositoryInterface;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\LearningTransactionRepository;
 

class TransactionLearningController extends Controller
{
    use ResponseAPI;
    private $repositoryChart;
    private $repositoryCheckout;
    private $repositoryLearning;
    private $repositoryUser;
    private $repositoryStreaming;
    private $repositoryLearningDetail;
    public function __construct( 
        LearningChartRepositoryInterface $repositoryChart,
        LearningTransactionRepositoryInterface $repositoryCheckout,
        LearningRepositoryInterface $repositoryLearning,
        LearningStreamRepositoryInterface $repositoryStreaming,
        LearningdetailRepositoryInterface $repositoryLearningDetail,
        MemberRepositoryInterface $repositoryUser)
    {
        $this->repositoryChart = $repositoryChart;
        $this->repositoryCheckout = $repositoryCheckout;
        $this->repositoryLearning = $repositoryLearning;
        $this->repositoryUser = $repositoryUser;
        $this->repositoryStreaming = $repositoryStreaming;
        $this->repositoryLearningDetail = $repositoryLearningDetail;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data =  $this->repositoryCheckout->all($request->useruuid); 
            if($data->count() > 0){ 
                return $this->success('Learning Transaction retrieved successfully', $data);
            }else{
                return $this->error('Learning Transaction Not Found.', [],400);
            } 
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        try {
            $data =  $this->repositoryCheckout->alldetail($request->uuid); 
            if($data->count() > 0){ 
                return $this->success('Learning Detail Transaction retrieved successfully', $data);
            }else{
                return $this->error('Learning Detail Transaction Not Found.', [],400);
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
        //
        $data = $request->validate([ 
            'useruuid' =>  'required|string|max:150',
            'qty' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'applicationfee' => 'required',
            'paymentfee' => 'required',
            'total' => 'required',
            'promocode' => 'required' 
        ]);

        try { 
            DB::beginTransaction();   
            
            // validasi user

            // validasi learning id
             
            $dataArray = []; 
            $dataArray = $request->toArray();  
            // Generate random string of 6 uppercase letters
            $letters = strtoupper(Str::random(10));
            
            // Generate random number between 100 and 999 (inclusive)
            $numbers = rand(1000, 9999);

            // Combine the letters and numbers with a dash in between
            $uuids = Uuid::uuid4();
            $invoiceNumber = $letters . '-' . $numbers;
            $dataArray['invoucenumber'] = $invoiceNumber; 
            $dataArray['paymentid'] = $invoiceNumber; 
            $dataArray['active'] = '1'; 
            $dataArray['uuid'] = $uuids; 
            $dataArray['date_void'] = '3000-01-01'; 
            
            $getChart = $this->repositoryChart->allwithoutPaging($request->useruuid); 
            
            foreach($getChart as $item){
                $uuidLearning = Uuid::uuid4(); 
                $execute = $this->repositoryCheckout->StoreDetail($uuidLearning,$uuids,$item->price,'3000-01-01');  
              
                $learningdatadetail = $this->repositoryLearningDetail->findbyid($item->learninguuid);
                $uuidHdrStream = Uuid::uuid4(); 
                foreach($learningdatadetail as $itemdetail){
                    $uuidStream = Uuid::uuid4(); 
                    $execute = $this->repositoryStreaming->StoreDetail($uuidStream,$uuidLearning ,$item->learninguuid,'0','0','0',$itemdetail->uuid,$uuidHdrStream); 
                } 
                $learningdata = $this->repositoryLearning->findbyid($item->learninguuid)->first();
               
                $execute = $this->repositoryStreaming->store($uuidHdrStream,$uuidLearning,'0',$learningdata->totalmodul,'0','0',$request->useruuid , $item->learninguuid);
            } 
            
            if($getChart->count() > 0){
                $execute = $this->repositoryCheckout->store($dataArray);
                
            }else{
                return $this->error('Charts empty.', 400);
            }

            $execute = $this->repositoryChart->delete($request);
            
            DB::commit();
            
            if($execute){
                return $this->success('Learning transaction successfully', $dataArray, 201);
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
