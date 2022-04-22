<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use App\Models\Pengukuran;
use Illuminate\Http\Request;
use App\Models\SRisiko;
use App\Models\Risk;

class PengukuranRisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $qcsrisk = "SELECT * FROM s_risiko WHERE id_user='$id_user' AND tahun='2022' AND status_s_risiko=1 ";
        // $csrisk = mysqli_query($connect, $qcsrisk);
        // $jris=mysqli_num_rows($csrisk);
        
        // $querysr = "SELECT * FROM s_risiko WHERE id_user='$id_user' AND tahun='2022' AND status_s_risiko=1 LIMIT 1";
        // $sqlsr = mysqli_query($connect, $querysr);
        // $datasr = mysqli_fetch_assoc($sqlsr);

        //ID USER GANTI PAKE AUTH SESSION LOGIN !!!!!!!!
        $user = 1;
        $jml_risk = Srisiko::where('id_user', $user)->where('tahun', '2022')->where('status_s_risiko', 1)->count();
        $data_sr = Srisiko::where('id_user', $user)->where('tahun', '2022')
                            ->where('status_s_risiko', 1)->pluck('id_s_risiko');

        // $queryn = "SELECT * FROM pengukuran p INNER JOIN s_risiko sr ON p.id_s_risiko=sr.id_s_risiko WHERE p.id_s_risiko = '$datasr[id_s_risiko]'";
        
        $pengukuran = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                                    ->where('pengukuran.id_s_risiko', $data_sr)->get();

        // $query2 = "SELECT *
        // FROM PENGUKURAN A 
        // INNER JOIN s_risiko B ON A.id_s_risiko=B.id_s_risiko 
        // INNER JOIN konteks C ON B.id_konteks=C.id_konteks 
        // INNER JOIN defendid_pengukur D ON A.id_pengukur=D.id_pengukur
        // INNER JOIN defendid_user E ON D.company_id=E.company_id
        // WHERE E.id_user=$id_user AND A.tahun_p='2022'
        // AND B.status_s_risiko=1";
        $sumber_risiko = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                                    ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                                    ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
                                    ->join('defendid_user', 'defendid_pengukur.company_id','defendid_user.company_id')
                                    ->where('defendid_user.id_user', $user)
                                    ->where('pengukuran.tahun_p', '2022')
                                    ->where('s_risiko.status_s_risiko', 1)
                                    ->get();

        return view('risk-officer.pengukuran-risiko', compact('jml_risk','data_sr','pengukuran', 'sumber_risiko'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

}
