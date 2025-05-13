<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\LearningRepositoryInterface;
use App\Repositories\Interfaces\LearningChartRepositoryInterface;
use App\Repositories\Interfaces\LearningdetailRepositoryInterface;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;
use App\Repositories\Interfaces\LearningTransactionRepositoryInterface;
use setasign\Fpdi\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionLearningStreamController extends Controller
{
    use ResponseAPI;
    private $repositoryChart;
    private $repositoryCheckout;
    private $repositoryLearning;
    private $repositoryUser;
    private $repositoryStream;
    private $repositoryLearningDetail;
    public function __construct( 
        LearningChartRepositoryInterface $repositoryChart,
        LearningdetailRepositoryInterface $repositoryLearningDetail,
        LearningTransactionRepositoryInterface $repositoryCheckout,
        LearningRepositoryInterface $repositoryLearning,
        MemberRepositoryInterface $repositoryUser,
        LearningStreamRepositoryInterface $repositoryStream)
    {
        $this->repositoryChart = $repositoryChart;
        $this->repositoryCheckout = $repositoryCheckout;
        $this->repositoryLearning = $repositoryLearning;
        $this->repositoryUser = $repositoryUser;
        $this->repositoryStream = $repositoryStream;
        $this->repositoryLearningDetail = $repositoryLearningDetail;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data =  $this->repositoryStream->all($request->useruuid); 
            if($data->count() > 0){ 
                return $this->success('Data retrieved successfully', $data);
            }else{
                return $this->error('Data Transaction Not Found.', [],400);
            } 
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }
    public function listmoduldetail(Request $request)
    {
        try {
            $data =  $this->repositoryStream->finddetailstreamModulbyUserid($request->useruuid); 
            if($data->count() > 0){ 
                return $this->success('Data retrieved successfully', $data);
            }else{
                return $this->error('Data Transaction Not Found.', [],400);
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
        try {
            $data =  $this->repositoryStream->findbyLearningAndUserid($request); 
            if($data->count() > 0){ 
                return $this->success('Data retrieved successfully', $data->first());
            }else{
                return $this->error('Data Transaction Not Found.', [],400);
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
        $data = $request->validate([ 
            'uuid' =>  'required|string|max:150',
            'minutesstart' => 'required',  
            'minutesprogress' => 'required'
        ]);
        try { 
            DB::beginTransaction();   
            
             
            $dataArray = []; 
            $dataArray = $request->toArray(); 
            
            if($request->minutesprogress == $request->minutesstart){
                $gettotalmodul =  $this->repositoryStream->findbyLearningStreamId($request->uuid)->first();
                $totalmodul = $gettotalmodul->totalmodul; 
                $streamuuid = $gettotalmodul->streamuuid; 
                $certprogress = $gettotalmodul->certprogress; 
                $totalfinish = $gettotalmodul->totalfinish; 
                $finishstream = $gettotalmodul->finishstream; 
                $finishdetailstream = $gettotalmodul->finishdetailstream; 
                $dataArray['isfinish'] = '1'; 
                if($finishdetailstream == "0"){
                     $grandtotalfinishall = $totalfinish+1;
                    $prosencertProgress=round(($grandtotalfinishall/$totalmodul)*100,0) ;
                    if($totalmodul == $grandtotalfinishall){
                        $isfinishLEarning = "1";
                    }else{
                        $isfinishLEarning = "0";
                    } 
                    $dataArray['certprogress'] = $prosencertProgress;
                    $dataArray['streamuuid'] = $streamuuid;
                    $dataArray['totalfinish'] = $grandtotalfinishall;
                    $dataArray['isfinishheader'] = $isfinishLEarning;
                    $execute = $this->repositoryStream->updateStreamHeader($dataArray);
               }
                
            }else{
                $dataArray['isfinish'] = '0';
            }

            $execute = $this->repositoryStream->updateStream($dataArray);
            DB::commit();
            
            if($execute){
                return $this->success('Data Streamed.', $dataArray, 201);
            }else{
                return $this->error('Data Streamed failure.', 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        try {
            $data =  $this->repositoryStream->findbyLearningModuleListbyId($request->uuid); 
            if($data->count() > 0){ 
                return $this->success('Data retrieved successfully', $data);
            }else{
                return $this->error('Data Transaction Not Found.', [],400);
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
    public function update($uuid,$learninguuid)
    {
        //

        $record = $this->repositoryLearningDetail->findDataLearningCertbyUuid($learninguuid)->first();
        $stream = $this->repositoryStream->findbyLearningStreambyDetailUuid($uuid)->first();
    
         

        $name ="Mochamad Muchsin Abdillah"; 
        $credential =  "22";

        //generate qr code
        $qrCode = QrCode::format('png')->size(500)->generate($credential);
        $qrCodePath = public_path('qr/'.$credential.'.png'); 
        $logopathhub = public_path('img/hub.png');
        $signyarsi = public_path('img/ceoyarsi.png');
        $signhub = public_path('img/ceo360.png');
        file_put_contents($qrCodePath,$qrCode);

        // create instance PDF
        $pdf = new Fpdi();

        $pathTemplate = public_path().'/certificate/cert.pdf';
        $pdf->setSourceFile($pathTemplate);
        $template = $pdf->importPage(1);

        $size = $pdf->getTemplateSize($template);

        $pdf->AddPage($size['orientation'],[$size['width'],$size['height']]);
        $pdf->useTemplate($template,0,0,$size['width'], $size['height']);
 
 
        // Set posisi dan tulis 
        $pdf->SetFont('Helvetica', 'B', 25);
        $text = $name;
        $pageWidth = $pdf->GetPageWidth();
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetXY($x, 85); // Y tetap di 129
        $pdf->Write(0, $text);

  

        $pdf->SetFont('Helvetica', '', 10);
        $text = $record->modulname;
        $pageWidth = $pdf->GetPageWidth();
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetXY($x, 117); // Y tetap di 129
        $pdf->Write(0, $text);


        $pdf->SetFont('Helvetica', 'B', 15);
        $text = $record->partpembelajaran;
        $pageWidth = $pdf->GetPageWidth();
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetXY($x, 123); // Y tetap di 129
        $pdf->Write(0, $text);
 

        $pdf->SetFont('Helvetica', '', 10);
        $text = '( 8 Jam Pembelajaran )';
        $pageWidth = $pdf->GetPageWidth();
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetXY($x, 129); // Y tetap di 129
        $pdf->Write(0, $text);

        
        $pdf->SetFont('Helvetica', '', 10);
        $text = 'Tanggal :';
        $pageWidth = $pdf->GetPageWidth();
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetXY($x, 139); // Y tetap di 129
        $pdf->Write(0, $text);
 
        
        $pdf->SetFont('Helvetica', 'B', 10);
        $text = date("d-m-Y",strtotime($record->learningdate)) ;
        $pageWidth = $pdf->GetPageWidth();
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetXY($x, 144); // Y tetap di 129
        $pdf->Write(0, $text);

        $pdf->SetFont('Helvetica', '', 10);
        $text = 'Instructor / Lecturer';
        $pageWidth = $pdf->GetPageWidth();
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetXY($x, 154); // Y tetap di 129
        $pdf->Write(0, $text); 

        $pdf->SetFont('Helvetica', 'B', 10);
        $text = $record->mentorname;
        $pageWidth = $pdf->GetPageWidth();
        $textWidth = $pdf->GetStringWidth($text);
        $x = ($pageWidth - $textWidth) / 2;
        $pdf->SetXY($x, 159); // Y tetap di 129
        $pdf->Write(0, $text);  

        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->setXY(110,182);
        $pdf->Write(0,$stream->pretestscore); //  Pre Test Score

        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->setXY(110,188);
        $pdf->Write(0,$stream->posttestscore); //Post TestScore

        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->setXY(110,194);
        $pdf->Write(0,$stream->observasiscore); // FieldAssesmentScore

        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->setXY(110,200);
        $pdf->Write(0,$stream->examscore); // AssignmentScore

        $pdf->SetFont('Helvetica');
        $pdf->SetFontSize(10);
        $pdf->setXY(110,206);
        $pdf->Write(0,$stream->finalscore); // Avg. Score

        $pdf->Image($qrCodePath,140,30,30,30); 
        $pdf->Image($logopathhub,233,10,60,50); 
        $pdf->Image($signhub,100,210,40,40); 

        $fileName = 'Certificate - '.$name.'.pdf';
        // return response()->make($pdf->Output('S',$fileName),$fileName,[
        //     'Content-Type'=>'application/pdf',
        //     'Content-Disposition'=>'attachment; fileName="'.$fileName.'"'
        // ]);


        $pdfContent = $pdf->Output('S'); // 'S' = return as string, bukan langsung output

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
