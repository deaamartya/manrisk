<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SRisiko;
use App\Models\Risk;

class SumberRisikoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sumber_risiko = SRisiko::join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')->get();
      $risiko = Risk::join('konteks', 'risk.id_risk', 'konteks.id_risk')
        ->where('tahun_konteks', '=', '2021')
        ->orderBy('risk.id_risk')
        ->get();
      return view('users.sumber-risiko', compact('sumber_risiko', 'risiko'));
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

      return redirect()->route('user.sumber-risiko.index');
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
