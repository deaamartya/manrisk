<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SRisiko;
use App\Models\Risk;
use Auth;

class SumberRisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sumber_risiko = SRisiko::join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                      ->join('defendid_user', 's_risiko.id_user', 'defendid_user.id_user')
                      ->join('risk','konteks.id_risk', 'risk.id_risk')
                      ->where('s_risiko.id_user',  Auth::user()->id_user) // user yg login
                      ->orderByDesc('s_risiko.tahun')
                      ->orderBy('s_risiko.id_s_risiko')
                      ->get();
      $risiko = Risk::join('konteks', 'risk.id_risk', 'konteks.id_risk')
        ->where('tahun_konteks', '=', '2021')
        ->orderBy('risk.id_risk')
        ->get();
      
      return view('risk-officer.sumber-risiko', compact('sumber_risiko', 'risiko'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $request->validate([
        'tahun' => 'required',
        'id_konteks' => 'required',
        's_risiko' => 'required',
      ]);

      SRisiko::insert([
        's_risiko' => $request->s_risiko,
        'id_konteks' => $request->id_konteks,
        'id_user' => 1,
        'tahun' => $request->tahun,
        'status_s_risiko' => 0
      ]);

      return redirect()->route('risk-officer.sumber-risiko.index')->with('created-alert', 'Data sumber risiko berhasil disimpan.');
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
      $request->validate([
        'id_konteks' => 'required',
        's_risiko' => 'required',
      ]);

      SRisiko::find($id)->update([
        's_risiko' => $request->s_risiko,
        'id_konteks' => $request->id_konteks,
      ]);

      return redirect()->route('risk-officer.sumber-risiko.index')->with('updated-alert', 'Data sumber risiko berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      SRisiko::find($id)->delete();
      return redirect()->route('risk-officer.sumber-risiko.index')->with('deleted-alert', 'Data sumber risiko telah dihapus.');
    }
}
