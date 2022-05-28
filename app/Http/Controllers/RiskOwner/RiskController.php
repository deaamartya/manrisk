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
        return redirect()->route('risk-officer.risiko.index')->with(['success-swal' => 'Risk Header berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RiskHeader::destroy($id);
        return redirect()->route('risk-officer.risiko.index')->with(['success-swal' => 'Risk Header berhasil dihapus!']);
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
                'status_h' => 1,
            ]);
        } else {
            $header->update([
                'status_h' => 0,
            ]);
        }
        return redirect()->route('risk-owner.risiko.index')->with(['success-swal' => 'Risiko berhasil disetujui!']);
    }
}