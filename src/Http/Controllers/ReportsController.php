<?php

namespace Bishopm\Lightworx\Http\Controllers;

use Bishopm\Lightworx\Models\Client;
use Bishopm\Lightworx\Models\Invoice;
use Illuminate\Support\Str;
use Bishopm\Lightworx\Classes\tFPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use stdClass;

class ReportsController extends Controller
{
    public $pdf, $title, $subtitle, $page, $logo, $hublogo, $widelogo;

    public function __construct(){
        $this->pdf = new tFPDF();
        $this->pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
        $this->pdf->AddFont('DejaVu', 'B', 'DejaVuSans-Bold.ttf', true);
        $this->pdf->AddFont('DejaVu', 'I', 'DejaVuSans-Oblique.ttf', true);
        $this->pdf->AddFont('DejaVuCond','','DejaVuSansCondensed.ttf',true);
        $this->pdf->AddFont('DejaVuCond', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $this->title="";
        $this->subtitle="";
        $this->page=0;
        $this->logo=url('/') . "/lightworx/images/lightworx.png";
    }

    public function invoice ($id){
        $inv=Invoice::with('hours','disbursements','client')->where('id',$id)->first();
        $this->pdf->AddPage('P');
        $this->title="Light worx Invoice " . $inv->id . " - " . date("j M Y");
        $this->pdf->SetTitle($this->title);
        $this->pdf->SetAutoPageBreak(true, 0);
        $this->pdf->SetFont('DejaVu', 'B', 12);
        $this->pdf->Image($this->logo,168,8,45);
        $this->pdf->text(15, 10, "Invoice");
        $this->pdf->SetTextColor(100,100,100);
        $this->pdf->text(15, 25, "Lightworx");
        $this->pdf->SetFont('DejaVu', '', 10);
        $this->pdf->text(15, 30, "Open source systems and solutions");
        $this->pdf->text(15, 34, "www.lightworx.co.za");
        $this->pdf->text(15, 38, setting('email_address'));
        $this->pdf->SetTextColor(0,0,0);
        $filename=$this->title;
        $this->pdf->SetFont('DejaVu', 'B', 10);
        $this->pdf->text(15,70,$inv->client->client);
        $this->pdf->SetFont('DejaVu', '', 10);
        $this->pdf->text(15,75,"Attention: " . $inv->client->contact_firstname . " " . $inv->client->contact_surname);
        $this->pdf->text(15,80,$inv->client->contact_email);
        $this->pdf->text(145,70,"Invoice No:");
        $this->pdf->setxy(150,68.8);
        $this->pdf->cell(52,0,$inv->id,0,0,'R');
        $this->pdf->text(145,75,"Date:");
        $this->pdf->setxy(150,73.8);
        $this->pdf->cell(52,0,date('d M Y'),0,0,'R');
        $this->pdf->text(145,80,"Reference:");
        $this->pdf->setxy(150,78.8);
        $this->pdf->cell(52,0,"Inv " . $inv->id,0,0,'R');
        $yy=117;
        $total=0;
        if (count($inv->hours)){
            $this->pdf->SetFont('DejaVu', 'B', 10);
            $this->pdf->text(15,$yy,"Date");
            $this->pdf->text(35,$yy,"Description");
            $this->pdf->text(140,$yy,"Hours");
            $this->pdf->text(160,$yy,"Rate (R)");
            $this->pdf->text(185,$yy,"Amount");
            $this->pdf->SetFont('DejaVu', '', 10);
            $yy=$yy+6;
            foreach ($inv->hours as $hour){
                $this->pdf->text(15,$yy,date('d M',strtotime($hour->hourdate)));
                $this->pdf->text(35,$yy,$hour->details);
                $this->pdf->setxy(140,$yy-1.2);
                $this->pdf->cell(12,0,$hour->hours,0,0,'C');
                $this->pdf->setxy(160,$yy-1.2);
                $this->pdf->cell(16,0,$inv->rate,0,0,'C');
                $this->pdf->setxy(185,$yy-1.2);
                $this->pdf->cell(17,0,number_format($hour->hours * $inv->rate,2),0,0,'R');
                $total=$total + ($hour->hours *$inv->rate);
                $yy=$yy+5;
            }
        }
        if (count($inv->disbursements)){
            $yy=$yy+1;
            $this->pdf->SetFont('DejaVu', 'B', 10);
            $this->pdf->text(15,$yy,"Disbursements");
            $this->pdf->SetFont('DejaVu', '', 10);
            $yy=$yy+6;
            foreach ($inv->disbursements as $disbursement){
                $this->pdf->text(15,$yy,$disbursement->details);
                $this->pdf->setxy(185,$yy-1.2);
                $this->pdf->cell(17,0,number_format($disbursement->disbursement,2),0,0,'R');
                $total=$total + $disbursement->disbursement;
                $yy=$yy+5;
            }
        }
        $yy = $yy + 2;
        $this->pdf->SetFont('DejaVu', 'B', 10);
        $this->pdf->text(15,$yy,"Total");
        $this->pdf->setxy(185,$yy-1.2);
        $this->pdf->cell(17,0,"R " . number_format($total,2),0,0,'R');
        $this->pdf->text(17,269,"Bank details");
        $this->pdf->SetFont('DejaVu', '', 10);
        $banklines=explode(',',setting('bank_details'));
        foreach ($banklines as $i=>$bank){
            $this->pdf->text(17,274+$i*4,$bank);
        }

        $this->pdf->RoundedRect(15,90,186,15,1,'1234','F');
        $this->pdf->SetTextColor(255,255,255);
        $this->pdf->SetFont('DejaVu', '', 9);
        $this->pdf->text(17,95,"Invoice number");
        $this->pdf->text(92,95,"Date");
        $this->pdf->text(167,95,"Total");
        $this->pdf->SetFont('DejaVu', 'B', 11);
        $this->pdf->text(17,101,$inv->id);
        $this->pdf->text(92,101,date('d M Y'));
        $this->pdf->text(167,101,"R " . number_format($total,2));

        $this->pdf->Output('I',$filename);
        exit;
    }
}