<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeader;
use App\Models\RiskDetail;
use App\Models\DefendidUser;
use App\Models\SRisiko;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use Redirect;


class RiskRegisterIndhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_headers= RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                        ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                        ->orderBy('risk_header.id_riskh')
                        ->get();
        $tahun = RiskHeader::select('tahun')->orderBy('tahun')->distinct()->get();
        $tahun_filter = null;
        return view('admin.risk-register-indhan', compact('data_headers', 'tahun', 'tahun_filter'));
    }

    public function allRiskHeader()
    {
        $data_headers= RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                        ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                        ->orderBy('risk_header.id_riskh')
                        ->get();
        $tahun = RiskHeader::select('tahun')->orderBy('tahun')->distinct()->get();
        $tahun_filter = null;
        return view('admin.risk-register-indhan', compact('data_headers', 'tahun', 'tahun_filter'));
    }

    public function searchRiskHeader(Request $request)
    {
        $data_headers= RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                    ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                    ->where('risk_header.tahun', $request->tahun)
                    ->orderBy('risk_header.id_riskh')
                    ->get();
        $tahun = RiskHeader::select('tahun')->orderBy('tahun')->distinct()->get();
        $tahun_filter = $request->tahun;
        return view('admin.risk-register-indhan', compact('data_headers', 'tahun', 'tahun_filter'));
    }

    public function print($id) {
        $header = RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
        ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')->where('id_riskh', '=', $id)->first();

        $pdf = PDF::loadView('admin.pdf-risk-register', compact('header'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Manajemen Risiko '.$header->instansi.' Tahun '.$header->tahun.'.pdf');
    }

    public function approval($id)
    {
        $risk_header = RiskHeader::where('id_riskh', '=', $id)->first();
        $risk_header->update([
            'status_h_indhan' => 1
        ]);
        // dd($risk_header);
        return Redirect::back()->with(['success-swal' => 'Risk Header berhasil disetujui.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headers = RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                    ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                    ->where('id_riskh', '=', $id)->first();
        return view('admin.detail-risk-register', compact('headers'));
    }

    public function korporate($id, Request $request)
    {
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $risk_detail->update([
            'status_korporasi' => 1
        ]);
        $id_risk = $request->id_risk;
        return Redirect::back()->with(['success-swal' => 'Data '.$id_risk.' berhasil diubah menjadi Korporasi.']);
    }

    public function unKorporate($id, Request $request)
    {
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $risk_detail->update([
            'status_korporasi' => 0
        ]);
        $id_risk = $request->id_risk;
        return Redirect::back()->with(['success-swal' => 'Data '.$id_risk.' berhasil diubah menjadi Bukan Korporasi.']);
    }

    public function mitigation($id, Request $request)
    {
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $risk_detail->update([
            'status_mitigasi' => 1
        ]);
        $id_risk = $request->id_risk;
        return Redirect::back()->with(['success-swal' => 'Data '.$id_risk.' berhasil diubah menjadi Perlu Mitigasi.']);
    }

    public function notMitigation($id, Request $request)
    {
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $risk_detail->update([
            'status_mitigasi' => 0
        ]);
        $id_risk = $request->id_risk;
        return Redirect::back()->with(['success-swal' => 'Data '.$id_risk.' berhasil diubah menjadi Tidak Mitigasi.']);
    }

    public function deleteRiskDetail($id, Request $request)
    {
        RiskDetail::destroy($id);
        $id_risk = $request->id_risk;
        return Redirect::back()->with(['success-swal' => 'Data '.$id_risk.' berhasil dihapus.']);
    }


}
