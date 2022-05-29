<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeader;
use Auth;
use Illuminate\Support\Arr;
use App\Models\RiskDetail;

class MitigasiPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = RiskHeader::where('id_user', '=', Auth::user()->id_user)->get();
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
        $headers = RiskHeader::where('id_riskh', '=', $id)->first();
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
        $detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $id_header = $detail->id_riskh;
        $data = Arr::except($request->toArray(), ['_token', 'u_file']);
        $detail->update($data);
        if ($request->u_file) {
            $filename = $request->file('u_file')->getClientOriginalName();
            $folder = '/document/lampiran-mitigasi/';
            $request->file('u_file')->storeAs($folder, $filename, 'public');
            $detail->update([
                'u_file' => $filename,
            ]);
        }
        return redirect()->route('risk-officer.mitigasi-plan.show', $id_header);
    }
}
