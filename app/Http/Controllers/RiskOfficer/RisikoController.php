<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeader;
use App\Models\DefendidUser;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use App\Models\SRisiko;
use App\Models\Pengukuran;
use App\Models\RiskDetail;
use Illuminate\Support\Facades\Crypt;
use DNS2D;
use Session;

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
        $risk_owner = DefendidUser::where('company_id', Auth::user()->company_id)->where('is_risk_owner', '=', TRUE)->first();
        return view('risk-officer.risiko', compact("headers", "risk_owner"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        RiskHeader::insert([
            'id_user' => Auth::user()->id_user,
            'company_id' => Auth::user()->company_id,
            'tahun' => $request->tahun,
            'target' => $request->target,
            // 'penyusun' => Auth::user()->name,
            'id_penyusun' => Auth::user()->id_user,
            // 'pemeriksa' => $request->pemeriksa,
            'id_pemeriksa' => $request->id_pemeriksa,
            'tanggal' => date('Y-m-d'),
            'status_h' => 0,
            'created_at' => now(),
            'updated_at' => now()
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
        $s_risk_diinput = RiskDetail::where([
            ['company_id', '=', Auth::user()->company_id],
        ])->pluck('id_s_risiko');
        $pilihan_s_risiko = SRisiko::where([
            ['status_s_risiko', '=', 1],
            ['company_id', '=', Auth::user()->company_id],
        ]
        )
        ->whereNotIn('id_s_risiko', $s_risk_diinput)
        ->orderBy('id_s_risiko')->get();

        $s_risiko = SRisiko::where('tahun', '=', $headers->tahun)->where('company_id', '=', $headers->company_id)->limit(1)->first();
        $nilai_l = Pengukuran::where('id_s_risiko', '=', $s_risiko->id_s_risiko)->avg('nilai_L');
        $nilai_c = Pengukuran::where('id_s_risiko', '=', $s_risiko->id_s_risiko)->avg('nilai_C');
        return view('risk-officer.detail-risiko', compact("headers", 'pilihan_s_risiko', 'nilai_l', 'nilai_c'));
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
        $count = RiskDetail::where('id_riskh', '=', $id)->count('id_riskh');
        if ($count > 0) {
            return back()->with(["error-swal" => 'Data ini masih digunakan pada detail risiko. Mohon hapus detail risiko terlebih dahulu']);
        }
        RiskHeader::destroy($id);
        return redirect()->route('risk-officer.risiko.index')->with(['success-swal' => 'Risk Header berhasil dihapus!']);
    }

    public function print($id) {
        $header = RiskHeader::where('id_riskh', '=', $id)->first();
        $user = DefendidUser::where('id_user', '=', $header->id_user)->first();
        $encrypted = url('document/verify/').'/'.Crypt::encryptString(
            "url='risk-officer/risiko/print/".$header->id_riskh."';".
            "signed_by=".($header->pemeriksa ? $header->pemeriksa->name : '-').";".
            "instansi=".$header->perusahaan->instansi.";".
            "tahun=".$header->tahun.";".
            "created_at=".$header->created_at.";".
            "penyusun=".($header->penyusun ? $header->penyusun->name : '-').";"
        );
        $qrcode = DNS2D::getBarcodePNG($encrypted, 'QRCODE');
        $pdf = PDF::loadView('risk-officer.risk-header-pdf', compact('header', 'user', 'qrcode'))->setPaper('a4', 'landscape');
        Session::forget('is_bypass');
        // return view('risk-officer.risk-header-pdf', compact('header', 'user', 'qrcode'));
        return $pdf->stream('Laporan Rencana Pengelolaan Risiko '.$user->instansi.' Tahun '.$header->tahun.'.pdf');
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

    public function getNilai(Request $request) {
        $nilai_l = Pengukuran::where('id_s_risiko', '=', $request->id)->avg('nilai_L');
        $nilai_c = Pengukuran::where('id_s_risiko', '=', $request->id)->avg('nilai_C');

        return response()->json(['success' => true, 'nilai_l' => $nilai_l, "nilai_c" => $nilai_c]);
    }

    public function getRisikoSelected(Request $request) {
        $s_risk_selected = RiskDetail::where([
            ['id_riskd', '=', $request->id],
        ])->pluck('id_s_risiko');

        $all_s_risiko = SRisiko::where([
            ['status_s_risiko', '=', 1],
            ['company_id', '=', Auth::user()->company_id],
        ]
        )
        ->orderBy('id_s_risiko')->get();

        $s_risk_diinput = RiskDetail::where([
            ['company_id', '=', Auth::user()->company_id],
        ])->pluck('id_s_risiko');

        $pilihan_s_risiko = SRisiko::where([
            ['status_s_risiko', '=', 1],
            ['company_id', '=', Auth::user()->company_id],
        ]
        )
        ->whereIn('id_s_risiko', $s_risk_diinput)
        ->orderBy('id_s_risiko')->pluck('id_s_risiko');

        return response()->json(['s_risk_selected' => $s_risk_selected, 'all_s_risiko' => $all_s_risiko,'pilihan_s_risiko' => $pilihan_s_risiko ]);
    }
}
