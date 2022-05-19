<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskDetail;
use Redirect;

class RiskDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RiskDetail::insert($request->except('_token'));
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil dibuat!']);
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
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $risk_detail->update($request->except('_token'));
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RiskDetail::destroy($id);
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil dihapus!']);
    }
}
