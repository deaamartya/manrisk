<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMitigasi;
use Auth;

class PengajuanMitigasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuan = PengajuanMitigasi::where('id_user', '=', Auth::user()->id_user)->get();
        return view('risk-officer.pengajuan-mitigasi', compact('pengajuan'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PengajuanMitigasi::insert([
            'id_user' => Auth::user()->id_user,
            'id_riskd' => $request->id_risk_detail,
            'alasan' => $request->alasan,
            'is_approved' => false,
            'tipe_pengajuan' => $request->tipe_pengajuan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('risk-officer.risiko.index')->with(['success-swal' => 'Pengajuan berhasil diajukan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
