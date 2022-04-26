<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use App\Models\DefendidPengukur;
use App\Models\Pengukuran;
use Illuminate\Http\Request;
use App\Models\SRisiko;
use App\Models\Risk;
use PDF;

class PengukuranRisikoController extends Controller
{
    public function index()
    {
        //ID USER GANTI PAKE AUTH SESSION LOGIN !!!!!!!!
        // $user =  Auth::user()->id_user
        $user = 1;
        $jml_risk = Srisiko::where('id_user', $user)->where('tahun', '2022')->where('status_s_risiko', 1)->count();
        $data_sr = Srisiko::where('id_user', $user)->where('tahun', '2022')
                            ->where('status_s_risiko', 1)->limit(1)->get();
                            
        // dd($data_sr);
        foreach($data_sr as $d){
            $pengukuran = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                                        ->where('pengukuran.id_s_risiko', $d->id_s_risiko)->get();
                // dd($pengukuran);
            //Company ID GANTI PAKE AUTH SESSION LOGIN !!!!!!!!
            $company_id = 'PI';
            $jabatan = DefendidPengukur::where('company_id', $company_id)->get();

            $arr_pengukur = [];
            foreach($jabatan as $i=>$j){
                $pengukur_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                ->where('pengukuran.id_s_risiko', $d->id_s_risiko)
                ->where('pengukuran.nama_responden', $j->jabatan)
                ->get();  

                if(count($pengukur_risk) == 0){
                        $arr_pengukur[] = $j;
                }
                    
            }
        // dd(count($arr_pengukur));
        }
        $sumber_risiko = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
            ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
            ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
            ->join('defendid_user', 'defendid_pengukur.company_id','defendid_user.company_id')
            ->where('defendid_user.id_user', $user)
            ->where('pengukuran.tahun_p', '2022')
            ->where('s_risiko.status_s_risiko', 1)
            ->get();

        return view('risk-officer.pengukuran-risiko', compact('jml_risk','data_sr','jabatan','pengukuran','arr_pengukur','sumber_risiko'));
    }


    public function generatePDF()
    {
        // $data = [
        //     'title' => 'Cetak Penilaian',
        //     'date' => date('d/m/Y')
        // ];
          
        // $pdf = PDF::loadView('risk-officer.form_kompilasi', $data);
    
        // return $pdf->download('cetak penilaian.pdf');
        
        // if(isset($_GET['id'])){
        //     $id = $_GET['id'];
        
        //     $query1 = "SELECT * FROM risk_header r INNER JOIN divisi d WHERE d.id_divisi = r.id_divisi AND r.id_riskh='$id'";
        //     // echo $query1;
        //     $sql1 = mysqli_query($connect, $query1);
        //     if ($sql1 && mysqli_num_rows($sql1) > 0) {
        //         $datarh = mysqli_fetch_assoc($sql1);
        //     }
            
        //     $query2 = "SELECT * FROM risk_detail d INNER JOIN s_risiko s INNER JOIN divisi di INNER JOIN risk_header h INNER JOIN konteks k WHERE d.id_s_risiko=s.id_s_risiko AND d.id_riskh=h.id_riskh AND s.id_divisi=di.id_divisi AND s.id_konteks=k.id_konteks AND d.id_riskh='$id' ORDER BY d.id_riskd";
            
        //     $query3 = "SELECT C.id_risk, C.konteks, B.s_risiko, AVG(A.nilai_L) AS l, AVG(A.nilai_C) AS c, AVG(A.nilai_L)*AVG(A.nilai_C) AS r, count(A.nama_responden)
        //     FROM PENGUKURAN A 
        //     INNER JOIN s_risiko B ON A.id_s_risiko=B.id_s_risiko 
        //     INNER JOIN konteks C ON B.id_konteks=C.id_konteks 
        //     INNER JOIN defendid_pengukur D ON A.id_pengukur=D.id_pengukur
        //     WHERE A.tahun_p='2022'
        //     AND B.status_s_risiko=1
        //     group by C.id_risk, C.konteks, B.s_risiko, B.id_s_risiko";
        //     $sql3 = mysqli_query($connect, $query3);
        
        //     $sql2 = mysqli_query($connect, $query2);
        
        //     include(dirname(__FILE__).'/form_kompilasi.php');
        
        //     $content = ob_get_clean();
        
        //     // conversion HTML => PDF
        //     require_once('../html2pdf/html2pdf.class.php');
        //     try
        //     {
        //         $html2pdf = new HTML2PDF('L','A4', 'En', false, 'ISO-8859-15');
        //         $html2pdf->setTestTdInOnePage(false);
        //         $html2pdf->setDefaultFont('Arial');	
        //         $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        //         $html2pdf->Output('Wifi_'.$area.'_Sesi'.$sesi.'.pdf');//output laporan setelah di download
        //     }
        //     catch(HTML2PDF_exception $e) { echo $e; }
        // }
    }

}
