<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeader;
use App\Models\DefendidUser;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;

class RisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = RiskHeader::where('id_user', '=', Auth::user()->id_user)->get();
        return view('risk-officer.risiko', compact("headers"));
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
            'target' => $request->target
        ]);
        return redirect()->route('risk-officer.risiko.index')->with(['success-swal' => 'Risk Header berhasil disimpan!']);
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
        return view('risk-officer.detail-risiko', compact("headers"));
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
        dd($riskheader);
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
}
