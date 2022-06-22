<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefendidUser;
use Illuminate\Http\Request;
use App\Models\SRisiko;
use App\Models\Risk;
use Auth;
use Illuminate\Support\Facades\Redirect;

class SumberRisikoIndhanController extends Controller
{
    public function index()
    {
      $perusahaan = DefendidUser::join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')->where('is_admin', 0)->groupBy('defendid_user.company_id')->orderBy('company_code')->get();
      $sumber_risiko = null;
      $perusahaan_filter = null;
      return view('admin.sumber-risiko-indhan', compact('perusahaan','sumber_risiko', 'perusahaan_filter'));
    }

    public function searchRisiko(Request $request)
    {
        $request->validate([
        'id_user' => 'required',
        'tahun' => 'required',
        ]);
        $sumber_risiko = SRisiko::join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                    ->join('defendid_user', 's_risiko.id_user', 'defendid_user.id_user')
                    ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                    ->where('s_risiko.id_user',  $request->id_user) // perusahaan yg dipilih
                    ->where('s_risiko.tahun', $request->tahun)
                    ->orderBy('s_risiko.id_s_risiko')
                    ->get();
        $perusahaan_filter = $request->id_user;
        $perusahaan = DefendidUser::join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')->where('is_admin', 0)->groupBy('defendid_user.company_id')->orderBy('company_code')->get();
        return view('admin.sumber-risiko-indhan', compact('perusahaan','sumber_risiko', 'perusahaan_filter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approvalRisiko(Request $request, $id) {
        $request->validate([
            'status_verifikasi' => 'required',
        ]);

        SRisiko::find($id)->update([
            'status_s_risiko' => $request->status_verifikasi,
            'catatan' => $request->catatan,
        ]);

        // return redirect()->route('admin.sumber-risiko-indhan')->with('updated-alert', 'Status verifikasi sumber risiko berhasil diubah.');

        return Redirect::back()->with('updated-alert', 'Status verifikasi sumber risiko berhasil diubah.');

        
    }
}
