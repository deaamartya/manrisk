<?php

namespace App\Http\Controllers\RiskOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RiskHeader;
use App\Models\DefendidUser;
use App\Models\RiskHeaderIndhan;
use App\Models\RiskDetail;
use App\Models\SRisiko;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use Redirect;
use DNS2D;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class RiskRegisterIndhanController extends Controller
{
    public function index()
    {
        $headers = RiskHeaderIndhan::all();
        // $jml_risk = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh')
        // ->where('risk_header.tahun', '=', date('Y'))
        // ->where('status_indhan', '=', 1)
        // ->count();

        $jml_risk = [];
        foreach($headers as $h) {
            $jml_risk[] = RiskDetail::where('tahun', '=', $h->tahun)
                ->where('status_indhan', '=', 1)
                ->count();
        }
        // dd($jml_risk);
        return view('risk-owner.risk-register-indhan', compact('headers', 'jml_risk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RiskHeaderIndhan::insert([
            'tahun' => $request->tahun,
            'target' => $request->target,
            'penyusun' => $request->penyusun,
            'pemeriksa' => $request->pemeriksa,
        ]);
        return redirect()->route('risk-owner.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $riskheader = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $riskheader->update([
            'tahun' => $request->tahun,
            'target' => $request->target,
            'penyusun' => $request->penyusun,
            'pemeriksa' => $request->pemeriksa,
        ]);
        return redirect()->route('risk-owner.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RiskHeaderIndhan::destroy($id);
        return redirect()->route('risk-owner.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil dihapus!']);
    }


    public function show($id)
    {
        $headers = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        // dd($headers);
        $detail_risk = RiskHeader::selectRaw('*,avg(pi.nilai_L) as avg_nilai_l, avg(pi.nilai_C) as avg_nilai_c')
                ->join('perusahaan', 'risk_header.company_id', 'perusahaan.company_id')
                ->join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )  
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks')
                ->leftJoin('pengukuran_indhan as pi', 'pi.id_s_risiko', 's_risiko.id_s_risiko')
                ->where('risk_detail.status_indhan', '=', 1)
                ->where('risk_detail.company_id', '!=', 6)
                ->whereNull('risk_detail.deleted_at')
                ->where('risk_header.tahun', '=', $headers->tahun)
                ->whereNull('risk_header.deleted_at')
                ->groupBy('id_riskd')
                ->get();
        $detail_risk_indhan = RiskDetail::selectRaw('*,avg(pi.nilai_L) as avg_nilai_l, avg(pi.nilai_C) as avg_nilai_c')
                ->join('perusahaan as p', 'p.company_id', '=', 'risk_detail.company_id')
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->leftJoin('pengukuran_indhan as pi', 'pi.id_s_risiko', 's_risiko.id_s_risiko')
                ->where('risk_detail.status_indhan', '=', 1)
                ->where('risk_detail.company_id', '=', 6)
                ->whereNull('risk_detail.deleted_at')
                ->where('risk_detail.tahun', '=', $headers->tahun)
                ->groupBy('id_riskd')
                ->get();
        return view('risk-owner.detail-risk-register-indhan', compact('headers', 'detail_risk', 'detail_risk_indhan'));
    }

    public function uploadLampiran(Request $request) {
        $id = $request->id;
        $riskheader = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $filename = $request->file('lampiran')->getClientOriginalName();
        $folder = '/document/lampiran/';
        $request->file('lampiran')->storeAs($folder, $filename, 'public');
        $riskheader->update([
            'lampiran' => $filename,
        ]);
        return redirect()->route('risk-owner.risk-register-indhan.show', $id)->with(['success-swal' => 'Lampiran berhasil diupload!']);
    }

    public function print($id) {
        $header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $detail_risk = RiskHeader::join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->where('risk_detail.status_indhan', '=', 1)
                ->whereNull('risk_detail.deleted_at')
                ->whereNull('risk_header.deleted_at')
                ->where('risk_header.tahun', '=', $header->tahun)
                ->get();
        $document_type = 'risk_register_indhan_ro';
        $url = "url='risk-owner/print-risk-register-indhan/".$header->id_riskh."';".
            "signed_by=".($header->pemeriksa ? $header->pemeriksa : '-').";".
            "instansi=".'Industri Pertahanan'.";".
            "tahun=".$header->tahun.";".
            "created_at=".$header->created_at.";".
            "penyusun=".($header->penyusun ? $header->penyusun : '-').";";
        $short_url = ShortUrl::where(
            [
                'jenis_dokumen' => $document_type,
                'id_dokumen' => $id,
            ],
        )->first();
        if ($short_url) {
            $short_url->update([
                'url' => $url,
            ]);
        }
        $short_url = ShortUrl::firstOrCreate(
            [
                'jenis_dokumen' => $document_type,
                'id_dokumen' => $id,
            ],
            [
                'jenis_dokumen' => $document_type,
                'id_dokumen' => $id,
                'url' => $url,
                'short_code' => Str::random(10),
            ],
        );
        $encrypted = url('document/verify/').'/'.$short_url->short_code;
        $qrcode = DNS2D::getBarcodePNG($encrypted, 'QRCODE');
        $pdf = PDF::loadView('risk-owner.pdf-risk-register-indhan',  compact('header', 'detail_risk', 'qrcode'))->setPaper('a4', 'landscape');
        // return $pdf->stream('Laporan Manajemen Risiko '.$user->instansi.' Tahun '.$header->tahun.'.pdf');
        return $pdf->stream('Laporan Manajemen Risiko INDHAN Tahun '.$header->tahun.'.pdf');
    }
}
