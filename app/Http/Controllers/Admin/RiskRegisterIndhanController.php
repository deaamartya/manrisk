<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RiskHeader;
use App\Models\DefendidUser;
use App\Models\RiskHeaderKorporasi;
use App\Models\RiskDetail;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use App\Models\SRisiko;

class RiskRegisterIndhanController extends Controller
{
    public function index()
    {
        $headers = RiskHeaderKorporasi::all();
        $jml_risk = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh')
        ->where('tahun', '=', date('Y'))
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
        RiskHeaderKorporasi::insert([
            'tahun' => $request->tahun,
            'target' => $request->target,
            'penyusun' => Auth::user()->name,
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
        $riskheader = RiskHeaderKorporasi::where('id_riskh', '=', $id)->first();
        $riskheader->update([
            'tahun' => $request->tahun,
            'target' => $request->target,
            'pemeriksa' => $request->pemeriksa
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
        RiskHeaderKorporasi::destroy($id);
        return redirect()->route('admin.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil dihapus!']);
    }


    public function show($id, Request $request)
    {
        $headers = RiskHeaderKorporasi::where('id_riskh', '=', $id)->first();
        // dd($headers);
        $detail_risk = RiskDetail::join('risk_header', 'risk_detail.id_riskh', 'risk_header.id_riskh' )
                ->join('s_risiko', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko' )
                ->join('konteks', 'konteks.id_konteks', 's_risiko.id_konteks' )
                ->where('status_korporasi', '=', 1)
                ->where('risk_header.tahun', '=', $request->tahun)
                ->first();
            // dd($detail_risk);
        return view('admin.detail-risk-register-indhan', compact('headers', 'detail_risk'));
    }

    public function uploadLampiran(Request $request) {
        $id = $request->id;
        $riskheader = RiskHeaderKorporasi::where('id_riskh', '=', $id)->first();
        $filename = $request->file('lampiran')->getClientOriginalName();
        $folder = '/document/lampiran/';
        $request->file('lampiran')->storeAs($folder, $filename, 'public');
        $riskheader->update([
            'lampiran' => $filename,
        ]);
        
        return redirect()->route('admin.risk-register-indhan', $id)->with(['success-swal' => 'Lampiran berhasil diupload!']);
    }

    public function print($id) {
        $header = RiskHeaderKorporasi::where('id_riskh', '=', $id)->first();
        $user = Auth::user();
        // return view('risk-officer.risk-header-pdf', compact('header', 'user'));
        $pdf = PDF::loadView('admin.pdf-risk-register-indhan', compact('header', 'user'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Manajemen Risiko '.$user->instansi.' Tahun '.$header->tahun.'.pdf');
    }

    public function approval($id)
    {
        $risk_header = RiskHeaderKorporasi::where('id_riskh', '=', $id)->first();
        $risk_header->update([
            'status_h' => 1
        ]);
        // dd($risk_header);
        return Redirect::back()->with(['success-swal' => 'Risk Header INDHAN berhasil disetujui.']);
    }
}
