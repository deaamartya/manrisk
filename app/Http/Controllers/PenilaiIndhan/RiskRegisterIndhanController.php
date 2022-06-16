<?php

namespace App\Http\Controllers\PenilaiIndhan;

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

class RiskRegisterIndhanController extends Controller
{
    public function index()
    {
        $headers = RiskHeaderIndhan::all();
        $jml_risk = [];
        foreach($headers as $h) {
            $jml_risk[] = RiskDetail::where('tahun', '=', $h->tahun)
                ->where('status_korporasi', '=', 1)
                ->count();
        }
        return view('penilai-indhan.risk-register-indhan', compact('headers', 'jml_risk'));
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
            'penyusun' => Auth::user()->name,
        ]);
        return redirect()->route('penilai-indhan.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil disimpan!']);
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
            'pemeriksa' => $request->pemeriksa
        ]);
        return redirect()->route('penilai-indhan.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil diubah!']);
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
        return redirect()->route('penilai-indhan.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil dihapus!']);
    }


    public function show($id)
    {
        $headers = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        // dd($headers);
        $detail_risk = RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                ->join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )     
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->where('risk_detail.status_korporasi', '=', 1)
                ->where('risk_header.tahun', '=', $headers->tahun)
                ->get();
        $mitigasi = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
        ->join('pengajuan_mitigasi', 'risk_detail.id_riskd', 'pengajuan_mitigasi.id_riskd' )
                ->where('risk_detail.status_korporasi', '=', 1)
                ->where('risk_header.tahun', '=', $headers->tahun)
                ->count();
            // dd($detail_risk);
        return view('penilai-indhan.detail-risk-register-indhan', compact('headers', 'detail_risk', 'mitigasi'));
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
        return redirect()->route('penilai-indhan.risk-register-indhan.show', $id)->with(['success-swal' => 'Lampiran berhasil diupload!', 'headers' => $headers,  'detail_risk' => $detail_risk, 'mitigasi' => $mitigasi]);
    }

    public function print($id) {
        $header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $detail_risk = RiskHeader::join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh')
                ->join('s_risiko', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                ->where('risk_detail.status_korporasi', '=', 1)
                ->where('risk_header.tahun', '=', $header->tahun)
                ->get();
        $user = DefendidUser::where('id_user', '=', $header->id_user)->first();
        $encrypted = url('document/verify/').'/'.Crypt::encryptString("url='penilai-indhan/print-risk-register-indhan/".$header->id_riskh."';signed_by=[".$header->pemeriksa."]");
        $qrcode = DNS2D::getBarcodePNG($encrypted, 'QRCODE');
        $pdf = PDF::loadView('penilai-indhan.pdf-risk-register-indhan', compact('header', 'user', 'qrcode', 'detail_risk'))->setPaper('a4', 'landscape');
        Session::forget('is_bypass');
        return $pdf->stream('Laporan Manajemen Risiko INDHAN Tahun '.$header->tahun.'.pdf');
    }

    public function approval($id)
    {
        $risk_header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $risk_header->update([
            'status_h' => 1
        ]);
        // dd($risk_header);
        return Redirect::back()->with(['success-swal' => 'Risk Header INDHAN berhasil disetujui.']);
    }
}
