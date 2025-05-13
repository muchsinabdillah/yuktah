<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LearningQuestionRepositoryInterface;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningQuestionRepositoryInterface;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TrsLearningPosttestController extends Controller
{
    use ResponseAPI;
    private $repository; 
    private $repositoryQuestion; 
    private $repositoryUser; 
    private $repositoryLearningStream; 
    public function __construct(  
        TrsLearningQuestionRepositoryInterface $repository,
        LearningQuestionRepositoryInterface $repositoryQuestion,
        MemberRepositoryInterface $repositoryUser,
        LearningStreamRepositoryInterface $repositoryLearningStream
        
        )
    {
        $this->repository = $repository; 
        $this->repositoryQuestion = $repositoryQuestion; 
        $this->repositoryUser = $repositoryUser; 
        $this->repositoryLearningStream = $repositoryLearningStream; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'uuid' => 'required', 
            'learningdetailuuid' => 'required', 
            'type' => 'required', 
            'user_created' => 'required' 
        ]);

        try { 
            DB::beginTransaction();   
           
            // // validasi user
            $user = $this->repositoryUser->findbyid($request->user_created);  
            if($user->count() < 1){  
                return $this->error('User yang ada masukan tidak ditemukan.', [],400);
            } 
            // validasi learning id detail
            $details = $this->repositoryLearningStream->findbyLearningStreambyDetailUuid($request->uuid);  
            if($details->count() < 1){  
                return $this->error('Data Pemebelajaran tidak ditemukan.', [],400);
            } 

           
            // validasi detail kuisoner per tahun sudah ada belum
            $kuisionerdata = $this->repositoryQuestion->allPerLearningUuid($request->learningdetailuuid,$request->type);  
            if($kuisionerdata->count() < 1){  
                return $this->error('Data Posttest di tahun ini tidak ditemukan.', [],400);
            } 
             
            $dataArray = []; 
            $dataArray = $request->toArray();  
            

            // Combine the letters and numbers with a dash in between
            $uuids = Uuid::uuid4();
            $now = Carbon::now();  
            // $invoiceNumber = $letters . '-' . $numbers; 
            $dataArray['learningdetailuuid'] = $request->uuid;  
            $dataArray['year'] = $now->year;  
            $dataArray['uuid'] = $uuids;   
            $dataArray['user_created'] = $request->user_created;  
             
            // validasi sudah ada belum, kalo belum insert dulu tong
            $validatedatakuis = $this->repository->findposttestbyid($request->uuid);  
           
            if($validatedatakuis->count() < 1){  
                // add detail
                foreach($kuisionerdata as $item){
                    $uuidLearning = Uuid::uuid4(); 
                    $this->repository->StoreDetailPosttest($uuidLearning,$uuids,0,0,0,$item['uuid']);  
                   
                }
                // add header
                $this->repository->StorePostTest($dataArray);
            } 
            
            $validatedatakuis = $this->repository->alldetailPosttest($request->uuid); 
            $header = $this->repository->findposttestbyid($request->uuid)->first(); 
            $metadata = array(
                'header' => $header, // Set array nama dengan isi kolom nama pada tabel siswa 
                'detail' => $validatedatakuis, // Set array status dengan success      
            );
            DB::commit();
           
            
            return $this->success('Posttest Berhasil di buat.', $metadata, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e, $e->getCode());
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
    public function edit(Request $request)
    {
        $data = $request->validate([  
            'uuid' => 'required' 
        ]);

        try { 
            DB::beginTransaction();   
           
            // // validasi  
            $user = $this->repository->findbyUuidPosttest($request->uuid);  
            if($user->count() < 1){  
                return $this->error('Data Transaksi Posttest tidak ditemukan.', [],400);
            } 

            $valnull = $this->repository->findNullDatabyUuidDetailPosttest($request->uuid);  
         
            if($valnull->count() > 0){  
                return $this->error('Terdapat Data Posttest Masih Kosong, Silahkan isi Semua Data.', [],400);
            } 

            $sumkuisionerScore = $this->repository->sumTotalfinalposttest($request->uuid)->first();
          
            $this->repository->updateFinalScoreStreamDetailPost($request->streamuuiddetail,$sumkuisionerScore->total*10); 
            $this->repository->updateFinalScorePosttest($request->uuid,$sumkuisionerScore->total*10); 

            DB::commit();
           
            
            return $this->success('Data Transaksi Selesai.', [], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e, $e->getCode());
        }  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request )
    {
        $data = $request->validate([  
            'uuid' => 'required', 
            'uuidquestion' => 'required', 
            'answer' => 'required' 
        ]);

        try { 
            DB::beginTransaction();   
           
            // // validasi user
            $user = $this->repository->findbyUuidDetailPosttest($request->uuid);  
            if($user->count() < 1){  
                return $this->error('Data Posttest tidak ditemukan.', [],400);
            } 
             $question = $this->repositoryQuestion->findbyid($request->uuidquestion); 
              
            if($question->count() < 1){  
                return $this->error('Data Soal Posttest tidak ditemukan.', [],400);
            } 
            $dataquestion = $question->first();
           
            $dataArray = []; 
            $dataArray = $request->toArray();  
            
            if($dataquestion->answer == $request->answer){
                $nilai = 1;
            }else{
                $nilai = 0;
            } 
            // Combine the letters and numbers with a dash in between
            $uuids = Uuid::uuid4();
            $now = Carbon::now();  
            // $invoiceNumber = $letters . '-' . $numbers; 
            $dataArray['uuid'] = $request->uuid; 
            $dataArray['answer'] = $request->answer;   
            $dataArray['score'] = $nilai;   
            $dataArray['isanswer'] = '1';   
           
           $this->repository->updateItemDetailAnswerPosttest($dataArray); 

            DB::commit();
            
            return $this->success('Data Posttest berhasil diinsput.',[], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e, $e->getCode());
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
