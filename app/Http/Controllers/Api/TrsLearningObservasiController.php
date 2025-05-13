<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LearningObservationRepositoryInterface;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningObservationRepositoryInterface;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TrsLearningObservasiController extends Controller
{
    use ResponseAPI;
    private $repository; 
    private $repositoryObservation; 
    private $repositoryUser; 
    private $repositoryLearningStream; 
    public function __construct(  
        TrsLearningObservationRepositoryInterface $repository,
        LearningObservationRepositoryInterface $repositoryObservation,
        MemberRepositoryInterface $repositoryUser,
        LearningStreamRepositoryInterface $repositoryLearningStream
        
        )
    {
        $this->repository = $repository; 
        $this->repositoryObservation = $repositoryObservation; 
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
            $kuisionerdata = $this->repositoryObservation->allPerLearningUuid($request->learningdetailuuid);  
            if($kuisionerdata->count() < 1){  
                return $this->error('Data Observasi di tahun ini tidak ditemukan.', [],400);
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
            $validatedatakuis = $this->repository->findbyid($request->uuid);  
           
            if($validatedatakuis->count() < 1){  
                // add detail
                foreach($kuisionerdata as $item){
                    $uuidLearning = Uuid::uuid4(); 
                    $this->repository->StoreDetail($uuidLearning,$uuids,0,0,0,$item['uuid']);  
                   
                }
                // add header
                $this->repository->Store($dataArray);
            } 
            
            $validatedatakuis = $this->repository->alldetail($request->uuid); 
            $header = $this->repository->findbyid($request->uuid)->first(); 
            $metadata = array(
                'header' => $header, // Set array nama dengan isi kolom nama pada tabel siswa 
                'detail' => $validatedatakuis, // Set array status dengan success      
            );
            DB::commit();
           
            
            return $this->success('Observasi Berhasil di buat.', $metadata, 201);

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
            $user = $this->repository->findbyUuid($request->uuid);  
            if($user->count() < 1){  
                return $this->error('Data Transaksi Observasi tidak ditemukan.', [],400);
            } 

            $valnull = $this->repository->findNullDatabyUuidDetail($request->uuid);  
         
            if($valnull->count() > 0){  
                return $this->error('Terdapat Data Observasi Masih Kosong, Silahkan isi Semua Data.', [],400);
            } 
            // validasi learning id detail
            $streamdata = $this->repositoryLearningStream->findbyLearningStreambyDetailUuid($request->streamuuiddetail);  
            if($streamdata->count() < 1){  
                return $this->error('Data Pemebelajaran tidak ditemukan.', [],400);
            } 
            $valdatastream = $streamdata->first();
          
            $sumkuisionerScore = $this->repository->sumTotalfinal($request->uuid)->first();
 
            $this->repository->updateFinalScoreStreamDetail($request->streamuuiddetail,$sumkuisionerScore->total*10); 
            $this->repository->updateFinalScore($request->uuid,$sumkuisionerScore->total*10); 
            $average = ($valdatastream->kuisionerscore+$valdatastream->pretestscore+$valdatastream->posttestscore+$valdatastream->examscore+$sumkuisionerScore->total*10)/5;

            $this->repository->updateFinalResultStreamDetail($request->streamuuiddetail,$average);
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
            $user = $this->repository->findbyUuidDetail($request->uuid);  
            if($user->count() < 1){  
                return $this->error('Data Observasi tidak ditemukan.', [],400);
            } 
             $question = $this->repositoryObservation->findbyid($request->uuidquestion); 
              
            if($question->count() < 1){  
                return $this->error('Data Soal Observasi tidak ditemukan.', [],400);
            } 
            $dataquestion = $question->first();
           
            $dataArray = []; 
            $dataArray = $request->toArray();  
            
            if($request->answer === "1"){
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
           
           $this->repository->updateItemDetailAnswer($dataArray); 

            DB::commit();
            
            return $this->success('Data Observasi berhasil diinsput.',[], 201);

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
