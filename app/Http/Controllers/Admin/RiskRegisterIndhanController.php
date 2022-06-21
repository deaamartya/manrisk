<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RiskHeader;
use App\Models\DefendidUser;
use App\Models\PengukuranIndhan;
use App\Models\RiskHeaderIndhan;
use App\Models\RiskDetail;
use App\Models\SRisiko;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use DNS2D;
use Session;
use App\Imports\RiskDetailImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Carbon\Carbon;
use DB;
use App\Models\Pengukuran;

class RiskRegisterIndhanController extends Controller
{
    public function index()
    {
        $headers = RiskHeaderIndhan::all();
        // $jml_risk = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh')
        // ->where('risk_header.tahun', '=', date('Y'))
        // ->where('status_indhan', '=', 1)
        // ->count();

        $jml_risk = [];
        foreach($headers as $h) {
            $jml_risk[] = RiskDetail::where('tahun', '=', $h->tahun)
                ->where('status_indhan', '=', 1)
                ->count();
        }
        // dd($jml_risk);
        return view('admin.risk-register-indhan', compact('headers', 'jml_risk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RiskHeaderIndhan::insert([
            'tahun' => $request->tahun,
            'target' => $request->target,
            'penyusun' => $request->penyusun,
            'pemeriksa' => $request->pemeriksa,
        ]);
        return redirect()->route('admin.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $riskheader = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $riskheader->update([
            'tahun' => $request->tahun,
            'target' => $request->target,
            'penyusun' => $request->penyusun,
            'pemeriksa' => $request->pemeriksa,
        ]);
        return redirect()->route('admin.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RiskHeaderIndhan::destroy($id);
        return redirect()->route('admin.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil dihapus!']);
    }


    public function show($id)
    {
        $headers = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        // dd($headers);
        $detail_risk = RiskHeader::join('perusahaan', 'risk_header.company_id', 'perusahaan.company_id')
                ->join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )     
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->where('risk_detail.status_indhan', '=', 1)
                ->whereNull('risk_detail.deleted_at')
                ->where('risk_header.tahun', '=', $headers->tahun)
                ->whereNull('risk_header.deleted_at')
                ->get();
        
        $detail_risk_indhan = RiskDetail::join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('perusahaan as p', 'p.company_id', '=', 'risk_detail.company_id')
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->where('risk_detail.status_indhan', '=', 1)
                ->where('risk_detail.company_id', '=', 6)
                ->whereNull('risk_detail.deleted_at')
                ->where('risk_detail.tahun', '=', $headers->tahun)
                ->get();
        // $mitigasi = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
        // ->join('pengajuan_mitigasi', 'risk_detail.id_riskd', 'pengajuan_mitigasi.id_riskd' )
        //         ->where('risk_detail.status_indhan', '=', 1)
        //         ->whereNull('risk_detail.deleted_at')
        //         ->where('risk_header.tahun', '=', $headers->tahun)
        //         ->count();
            // dd($detail_risk);
        
        $pilihan_s_risiko = SRisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')->where([
                ['status_indhan', '=', 1],
            ])->orderBy('s_risiko.id_s_risiko')->get();

        return view('admin.detail-risk-register-indhan', compact('headers', 'detail_risk', 'pilihan_s_risiko', 'detail_risk_indhan'));
    }

    public function storeDetail(Request $request)
    {
        $data = $request->except('_token');
        $data['company_id'] = 6;
        $data['status_mitigasi'] = ($request->r_awal >= 12) ? 1 : 0;
        RiskDetail::insert($data);
        return Redirect::back()->with(['success-swal' => 'Risk INDHAN berhasil dibuat!']);
    }

    public function uploadLampiran(Request $request) {
        $id = $request->id;
        $riskheader = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $filename = $request->file('lampiran')->getClientOriginalName();
        $folder = '/document/lampiran/';
        $request->file('lampiran')->storeAs($folder, $filename, 'public');
        $riskheader->update([
            'lampiran' => $filename,
        ]);
        return redirect()->route('admin.risk-register-indhan.show', $id)->with(['success-swal' => 'Lampiran berhasil diupload!']);
    }

    public function print($id) {
        $header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        // dd($headers);
        $detail_risk = RiskHeader::join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->where('risk_detail.status_indhan', '=', 1)
                ->whereNull('risk_detail.deleted_at')
                ->where('risk_header.tahun', '=', $header->tahun)
                ->whereNull('risk_header.deleted_at')
                ->get();
            // dd($detail_risk);
        // $user = Auth::user();
        $encrypted = url('document/verify/').'/'.Crypt::encryptString(
            "url='admin/print-risk-register-indhan/".$header->id_riskh."';".
            "signed_by=".$header->pemeriksa.";".
            "instansi=".'Industri Pertahanan'.";".
            "tahun=".$header->tahun.";".
            "created_at=".$header->created_at.";".
            "penyusun=".$header->penyusun.";"
        );
        $qrcode = DNS2D::getBarcodePNG($encrypted, 'QRCODE');
        $pdf = PDF::loadView('admin.pdf-risk-register-indhan', compact('header', 'detail_risk', 'qrcode'))->setPaper('a4', 'landscape');
        Session::forget('is_bypass');
        // return $pdf->stream('Laporan Manajemen Risiko '.$user->instansi.' Tahun '.$header->tahun.'.pdf');
        return $pdf->stream('Laporan Manajemen Risiko INDHAN Tahun '.$header->tahun.'.pdf');
       
    }

    // public function approval($id)
    // {
    //     $risk_header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
    //     $risk_header->update([
    //         'status_h' => 1
    //     ]);
    //     // dd($risk_header);
    //     return Redirect::back()->with(['success-swal' => 'Risk Header INDHAN berhasil disetujui.']);
    // }

    public function import(Request $request)
    {
        $params = [];
        $risk_detail = Excel::toArray(new RiskDetailImport, $request->file('file'));
        for ($i=0; $i < count($risk_detail[0]); $i++) {
            $params[] = [
                'id_riskh' => null,
                'company_id' => 6,
                'tahun' => $risk_detail[0][$i]['tahun'],
                'id_s_risiko' => $risk_detail[0][$i]['id_s_risiko'],
                'ppkh' => $risk_detail[0][$i]['ppkh'],
                'indikator' => $risk_detail[0][$i]['indikator'],
                'sebab' => $risk_detail[0][$i]['sebab'],
                'dampak' => $risk_detail[0][$i]['dampak'],
                'uc' => $risk_detail[0][$i]['uc'],
                'pengendalian' => $risk_detail[0][$i]['pengendalian'],
                'l_awal' => $risk_detail[0][$i]['l_awal'],
                'c_awal' => $risk_detail[0][$i]['c_awal'],
                'r_awal' => $risk_detail[0][$i]['r_awal'],
                'peluang' => $risk_detail[0][$i]['peluang'],
                'tindak_lanjut' => $risk_detail[0][$i]['tindak_lanjut'],
                'jadwal' => $risk_detail[0][$i]['jadwal'],
                'pic' => $risk_detail[0][$i]['pic'],
                'mitigasi' => $risk_detail[0][$i]['mitigasi'],
                'jadwal_mitigasi' => $risk_detail[0][$i]['jadwal_mitigasi'],
                'realisasi' => $risk_detail[0][$i]['realisasi'],
                'keterangan' => $risk_detail[0][$i]['keterangan'],
                'l_akhir' => $risk_detail[0][$i]['l_akhir'],
                'c_akhir' => $risk_detail[0][$i]['c_akhir'],
                'r_akhir' => $risk_detail[0][$i]['r_akhir'],
                'status_indhan' => 1,
                'status_mitigasi' => ($risk_detail[0][$i]['r_awal'] >= 12 ? 1 : 0),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        DB::beginTransaction();
        RiskDetail::insert($params);
        DB::commit();

        return back()->with(['success-swal' => 'Risk Detail berhasil diimport!']);
    }

    public function getNilai(Request $request) {
        $nilai_l = PengukuranIndhan::where('id_s_risiko', '=', $request->id)->avg('nilai_L');
        $nilai_c = PengukuranIndhan::where('id_s_risiko', '=', $request->id)->avg('nilai_C');

        return response()->json(['success' => true, 'nilai_l' => $nilai_l, "nilai_c" => $nilai_c]);
    }
}
