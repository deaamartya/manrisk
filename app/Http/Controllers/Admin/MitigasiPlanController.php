<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanMitigasi;
use Redirect;
use App\Models\RiskHeader;
use Auth;
use Illuminate\Support\Arr;
use App\Models\RiskDetail;
use App\Models\MitigasiLogs;
use Illuminate\Support\Facades\Crypt;
use DNS2D;
use Session;
use App\Models\DefendidUser;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use PDF;
use App\Models\SRisiko;
use App\Models\Pengukuran;
use Illuminate\Support\Facades\Route;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class MitigasiPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuan = PengajuanMitigasi::where('arah_pengajuan', 1)->orderBy('status', 'ASC')->orderBy('created_at', 'ASC')->get();
        return view('admin.pengajuan-mitigasi', compact("pengajuan"));
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
        $pengajuan = PengajuanMitigasi::where('id', '=', $id)->first();
        $risk_detail = RiskDetail::where('id_riskd', '=', $pengajuan->id_riskd)->first();
        $pengajuan->update($request->except('_token'));
        $pengajuan->update([
            'updated_at' => now(),
            'id_responden' => Auth::user()->id_user,
        ]);
        if ($request->is_approved == 1) {
            $risk_detail->update([
                'status_mitigasi' => $pengajuan->tipe_pengajuan,
            ]);
        }
        return Redirect::back()->with(['success-swal' => 'Pengajuan Mitigasi berhasil dikonfirmasi!']);
    }

    public function getProgressData(Request $request) {
        $data = null;
        $logs = MitigasiLogs::where('id_riskd', '=', $request->id)->orderBy('created_at', 'DESC')->get();
        if($logs != null){
            $data = new \stdClass();
            $data->data = [];
            $count = 0;
            foreach($logs as $c){
                if ($c->dokumen === null) {
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        date('d M Y', strtotime($c->created_at)),
                        '',
                        $c->description,
                    ];
                } else {
                    $path = asset('document/mitigasi-progress/'. $c->dokumen);
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        date('d M Y', strtotime($c->created_at)),
                        '<a href="'. $path. '"  target="_blank" class="btn btn-xs btn-info p-1">Lihat Dokumen</a>',
                        $c->description,
                    ];
                }
                array_push($data->data, $isi);
                $count++;
            }
        }
        return response()->json($data);
    }

    public function insertProgress(Request $request) {
        $extension_file = $request->file('dokumen')->extension();
        if($extension_file == "pdf" || $extension_file == "png" || $extension_file == "jpeg" ){
            $filename = null;
            if($request->dokumen) {
                $filename = $request->file('dokumen')->getClientOriginalName();
                $folder = '/document/mitigasi-progress/';
                $request->file('dokumen')->storeAs($folder, $filename, 'public');
            }
            MitigasiLogs::insert([
                'id_riskd' => $request->id_riskd,
                'id_user' => $request->id_user,
                'realisasi' => $request->prosentase,
                'dokumen' => $filename,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return Redirect::back()->with(['success-swal' => 'Progress Mitigasi berhasil ditambahkan.']);
        }else{
            return Redirect::back()->with(['error-swal' => 'Progress Mitigasi gagal ditambahkan. File dokumen harus dalam format pdf/png/jpeg. Silahkan upload ulang dokumen dengan format sesuai ketentuan.']);
        }

    }

    public function print($id) {
        $document_type = 'mitigasi_plan_admin';
        $header = RiskHeader::where('id_riskh', '=', $id)->first();
        $user = DefendidUser::where('id_user', '=', $header->id_user)->first();
        $url = "url='admin/mitigasi-plan/print/".$header->id_riskh."';".
            "signed_by=".($header->pemeriksa ? $header->pemeriksa->name : '-').";".
            "instansi=".$header->perusahaan->instansi.";".
            "tahun=".$header->tahun.";".
            "created_at=".$header->created_at.";".
            "penyusun=".($header->penyusun ? $header->penyusun->name : '-').";";
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
        $pdf = PDF::loadView('admin.mitigasi-plan-pdf', compact('header', 'user', 'qrcode'))->setPaper('a4', 'landscape');
        Session::forget('is_bypass');
        return $pdf->stream('Hasil Mitigasi '.$user->instansi.' Tahun '.$header->tahun.'.pdf');
    }
}
