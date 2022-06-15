<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RiskHeader;
use App\Models\DefendidUser;
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

class RiskRegisterIndhanController extends Controller
{
    public function index()
    {
        $headers = RiskHeaderIndhan::all();
        $jml_risk = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh')
        ->where('risk_detail.tahun', '=', date('Y'))
        ->where('status_korporasi', '=', 1)
        ->count();
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
        $detail_risk = RiskDetail::join('perusahaan', 'risk_detail.company_id', 'perusahaan.company_id')
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->where('risk_detail.status_korporasi', '=', 1)
                ->where('risk_detail.tahun', '=', $headers->tahun)
                ->get();
        $mitigasi = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
        ->join('pengajuan_mitigasi', 'risk_detail.id_riskd', 'pengajuan_mitigasi.id_riskd' )
                ->where('risk_detail.status_korporasi', '=', 1)
                ->where('risk_header.tahun', '=', $headers->tahun)
                ->count();
            // dd($detail_risk);
        return view('admin.detail-risk-register-indhan', compact('headers', 'detail_risk', 'mitigasi'));
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
        $headers = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        // dd($headers);
        $detail_risk = RiskHeader::join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->where('risk_detail.status_korporasi', '=', 1)
                ->where('risk_header.tahun', '=', $request->tahun)
                ->get();
        $mitigasi = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
        ->join('pengajuan_mitigasi', 'risk_detail.id_riskd', 'pengajuan_mitigasi.id_riskd' )
                ->where('risk_detail.status_korporasi', '=', 1)
                ->where('risk_header.tahun', '=', $request->tahun)
                ->count();
            // dd($detail_risk);
        return redirect()->route('admin.risk-register-indhan.show', $id)->with(['success-swal' => 'Lampiran berhasil diupload!', 'headers' => $headers,  'detail_risk' => $detail_risk, 'mitigasi' => $mitigasi]);
    }

    public function print($id) {
        $header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $detail_risk = RiskDetail::join('s_risiko', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                ->where('status_korporasi', '=', 1)
                ->where('risk_detail.tahun', '=', $header->tahun)
                ->get();
        $user = DefendidUser::where('id_user', '=', $header->id_user)->first();
        $encrypted = url('document/verify/').'/'.Crypt::encryptString("url='admin/print-risk-register-indhan/".$header->id_riskh."';signed_by=[".$header->pemeriksa."]");
        $qrcode = DNS2D::getBarcodePNG($encrypted, 'QRCODE');
        $pdf = PDF::loadView('admin.pdf-risk-register-indhan', compact('header', 'user', 'qrcode', 'detail_risk'))->setPaper('a4', 'landscape');
        Session::forget('is_bypass');
        return $pdf->stream('Laporan Manajemen Risiko INDHAN Tahun '.$header->tahun.'.pdf');
    }

    public function import(Request $request)
    {
        $params = [];
        $risk_detail = Excel::toArray(new RiskDetailImport, $request->file('file'));
        for ($i=0; $i < count($risk_detail[0]); $i++) {
            $params[] = [
                'id_riskh' => $request->id_header,
                'id_s_risiko' => $risk_detail[0][$i]['id_s_risiko'],
                'tahun' => date('Y'),
                'company_id' => 6,
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
                'status_korporasi' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        DB::beginTransaction();
        RiskDetail::insert($params);
        DB::commit();

        return back()->with(['success-swal' => 'Risk Detail berhasil diimport!']);
    }
}
