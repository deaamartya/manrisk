<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeader;
use App\Models\RiskDetail;
use App\Models\RiskHeaderIndhan;
use App\Models\DefendidUser;
use App\Models\SRisiko;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use DNS2D;
use Session;


class RiskRegisterKorporasiController extends Controller
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
        return view('admin.risk-register-korporasi', compact('data_headers', 'tahun', 'tahun_filter'));
    }

    public function allRiskHeader()
    {
        $data_headers= RiskHeader::join('defendid_user', 'risk_header.id_user', 'defendid_user.id_user')
                        ->join('perusahaan', 'defendid_user.company_id', 'perusahaan.company_id')
                        ->orderBy('risk_header.id_riskh')
                        ->get();
        $tahun = RiskHeader::select('tahun')->orderBy('tahun')->distinct()->get();
        $tahun_filter = null;
        return view('admin.risk-register-korporasi', compact('data_headers', 'tahun', 'tahun_filter'));
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
        return view('admin.risk-register-korporasi', compact('data_headers', 'tahun', 'tahun_filter'));
    }

    public function print($id) {
        $header = RiskHeader::where('id_riskh', '=', $id)->first();
        $user = DefendidUser::where('id_user', '=', $header->id_user)->first();
        $encrypted = url('document/verify/').'/'.Crypt::encryptString("url='admin/print-risk-register-korporasi/".$header->id_riskh."';signed_by=[".$header->pemeriksa."]");
        $qrcode = DNS2D::getBarcodePNG($encrypted, 'QRCODE');
        $pdf = PDF::loadView('admin.pdf-risk-register', compact('header', 'user', 'qrcode'))->setPaper('a4', 'landscape');
        Session::forget('is_bypass');
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
        // dd($headers_indhan);
        return view('admin.detail-risk-register', compact('headers'));
    }

    public function korporate($id, Request $request)
    {
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $risk_detail->update([
            'status_korporasi' => 1
        ]);
        $id_risk = $request->id_risk;
        return Redirect::back()->with(['success-swal' => 'Data '.$id_risk.' berhasil diubah menjadi INDHAN.']);
    }

    public function unKorporate($id, Request $request)
    {
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $risk_detail->update([
            'status_korporasi' => 0
        ]);
        $id_risk = $request->id_risk;
        return Redirect::back()->with(['success-swal' => 'Data '.$id_risk.' berhasil diubah menjadi Bukan INDHAN.']);
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
