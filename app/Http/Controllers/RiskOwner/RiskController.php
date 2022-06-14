<?php

namespace App\Http\Controllers\RiskOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeader;
use App\Models\DefendidUser;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use App\Models\SRisiko;
use App\Models\RiskDetail;

class RiskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = RiskHeader::where('company_id', '=', Auth::user()->company_id)->get();
        return view('risk-owner.risk', compact("headers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RiskHeader::insert([
            'id_user' => Auth::user()->id_user,
            'tahun' => $request->tahun,
            'target' => $request->target,
            'penyusun' => Auth::user()->nama,
        ]);
        return redirect()->route('risk-owner.risiko.index')->with(['success-swal' => 'Risk Header berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headers = RiskHeader::where('id_riskh', '=', $id)->first();
        $pilihan_s_risiko = SRisiko::where([
            ['id_user', '=', Auth::user()->id_user],
            ['tahun', '=', date('Y')],
            ['status_s_risiko', '=', 1],
            ['company_id', '=', Auth::user()->company_id],
        ])->orderBy('id_s_risiko')->get();
        return view('risk-owner.risk-detail', compact("headers", 'pilihan_s_risiko'));
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
        return redirect()->route('risk-owner.risiko.index')->with(['success-swal' => 'Risk Header berhasil diubah!']);
    }

    public function print($id) {
        $header = RiskHeader::where('id_riskh', '=', $id)->first();
        $pdf = PDF::loadView('risk-owner.risk-header-pdf', compact('header'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Manajemen Risiko '.$header->perusahaan->instansi.' Tahun '.$header->tahun.'.pdf');
    }

    public function toggleIndhan($id) {
        $detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $riskh = $detail->id_riskh;
        if ($detail->status_korporasi === 0) {
            $detail->update([
                'status_korporasi' => 1,
            ]);
        } else {
            $detail->update([
                'status_korporasi' => 0,
            ]);
        }
        return redirect()->route('risk-owner.risiko.show', $riskh)->with(['success-swal' => 'Detail risiko berhasil diupdate!']);
    }

    public function approve($id) {
        $header = RiskHeader::where('id_riskh', '=', $id)->first();
        if ($header->status_h === 0) {
            $header->update([
                'pemeriksa' => Auth::user()->name,
                'status_h' => 1,
            ]);
        } else {
            $header->update([
                'pemeriksa' => Auth::user()->name,
                'status_h' => 0,
            ]);
        }
        return redirect()->route('risk-owner.risiko.index')->with(['success-swal' => 'Risiko berhasil disetujui!']);
    }
}
