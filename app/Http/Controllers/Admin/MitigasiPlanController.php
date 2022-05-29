<?php

namespace App\Http\Controllers\Admin;

use App\Abstracts\AbsMitigasiPlan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MitigasiPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = AbsMitigasiPlan::getAllData();
        return view('risk-officer.mitigasi-plan', compact("headers"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headers = AbsMitigasiPlan::getDataByIdRiskh($id);
        // dd($headers);
        return view('risk-officer.mitigasi-detail', compact("headers"));
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
        $query = AbsMitigasiPlan::updateRiskDetail($request, $id);
        $id_header = $query['id_header'];

        return redirect()->route('risk-officer.mitigasi-plan.show', $id_header);
    }

    public function progressMitigasi($id)
    {
        $data = AbsMitigasiPlan::showApprovalHasilMitigasi($id);

        return view('admin.approval-hasil-mitigasi', compact('data'));
    }

    public function approvalHasilMitigasi(Request $request, $id){
        $result = AbsMitigasiPlan::updateRealisasiApprovalHasilMitigasi($request, $id);

        return response()->json($result);
    }
}
