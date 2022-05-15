<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeader;
use App\Models\RiskDetail;
use App\Models\DefendidUser;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use App\Models\SRisiko;

class RiskRegisterIndhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_headers = null;
        $tahun = RiskHeader::select('tahun')->orderBy('tahun')->distinct()->get();
        $tahun_filter = null;
        return view('admin.risk-register-indhan', compact('data_headers', 'tahun', 'tahun_filter'));
    }

    public function allRiskHeader()
    {
        $data_headers= RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                        ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                        ->orderBy('risk_header.id_riskh')
                        ->get();
        $tahun = RiskHeader::select('tahun')->orderBy('tahun')->distinct()->get();
        $tahun_filter = null;
        return view('admin.risk-register-indhan', compact('data_headers', 'tahun', 'tahun_filter'));
    }

    

    public function searchRiskHeader(Request $request)
    {
        $data_headers= RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                    ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                    ->where('risk_header.tahun', $request->tahun)
                    ->orderBy('risk_header.id_riskh')
                    ->get();
        $tahun = RiskHeader::select('tahun')->orderBy('tahun')->distinct()->get();
        $tahun_filter = $request->tahun;
        return view('admin.risk-register-indhan', compact('data_headers', 'tahun', 'tahun_filter'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headers = RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                    ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                    ->where('id_riskh', '=', $id)->first();
        return view('admin.detail-risk-register', compact('headers'));
    }

    public function destroy($id)
    {
        RiskDetail::destroy($id);
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil dihapus!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $riskheader = RiskHeader::where('id_riskh', '=', $id)->first();
        $riskheader->update([
            'tahun' => $request->tahun,
            'target' => $request->target
        ]);
        return redirect()->route('risk-officer.risiko.index')->with(['success-swal' => 'Risk Header berhasil diubah!']);
    }

    public function print($id) {
        $header = RiskHeader::where('id_riskh', '=', $id)->first();
        $user = Auth::user();
        // return view('risk-officer.risk-header-pdf', compact('header', 'user'));
        $pdf = PDF::loadView('risk-officer.risk-header-pdf', compact('header', 'user'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Manajemen Risiko '.$user->instansi.' Tahun '.$header->tahun.'.pdf');
    }

    public function uploadLampiran(Request $request) {
        $id = $request->id;
        $riskheader = RiskHeader::where('id_riskh', '=', $id)->first();
        $filename = $request->file('lampiran')->getClientOriginalName();
        $folder = '/document/lampiran/';
        $request->file('lampiran')->storeAs($folder, $filename, 'public');
        $riskheader->update([
            'lampiran' => $filename,
        ]);
        return redirect()->route('risk-officer.risiko.show', $id)->with(['success-swal' => 'Lampiran berhasil diupload!']);
    }
}
