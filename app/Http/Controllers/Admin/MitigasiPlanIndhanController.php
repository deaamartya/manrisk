<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiskHeaderIndhan;
use App\Models\RiskDetail;
use App\Models\MitigasiLogs;
use App\Models\RiskHeader;
use App\Models\DefendidUser;
use Redirect;
use Illuminate\Support\Arr;
use DNS2D;
use Session;
use PDF;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class MitigasiPlanIndhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = RiskHeaderIndhan::all();
        $jml_risk = [];
        foreach($headers as $h) {
            $jml_risk[] = RiskDetail::where('tahun', '=', $h->tahun)
                ->where('status_indhan', '=', 1)
                ->count();
        }
        return view('admin.mitigasi-plan-indhan', compact('headers', 'jml_risk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headers = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
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
                ->where('status_mitigasi', '=', 1)
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
            ->where('status_mitigasi', '=', 1)
            ->groupBy('id_riskd')
            ->get();
        return view('admin.detail-mitigasi-plan-indhan', compact("headers", "detail_risk" ,"detail_risk_indhan"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        $data = Arr::except($request->toArray(), ['_token', 'u_file']);
        $inputan_biaya = preg_replace("/[^0-9]/", "", $request->biaya_penanganan);
        $data['biaya_penanganan'] = (int) $inputan_biaya;
        $risk_detail->update($data);

        if ($request->u_file) {
            $filename = $request->file('u_file')->getClientOriginalName();
            $folder = '/document/lampiran-mitigasi/';
            $request->file('u_file')->storeAs($folder, $filename, 'public');
            $risk_detail->update([
                'u_file' => $filename,
            ]);
        }

        return Redirect::back()->with(['success-swal' => 'Data Mitigasi Plan Indhan berhasil diupdate!']);
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

    public function getProgressData(Request $request) {
        $data = null;
        $logs = MitigasiLogs::where('id_riskd', '=', $request->id)->orderBy('created_at', 'DESC')->get();
        if($logs != null){
            $data = new \stdClass();
            $data->data = [];
            $count = 0;
            foreach($logs as $c){
                if ($c->dokumen == null) {
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        date('d M Y', strtotime($c->created_at)),
                        '',
                        $c->description ? $c->description : '-'
                    ];
                } else {
                    $path = asset('document/mitigasi-progress/'. $c->dokumen);
                    $isi = [
                        $count + 1,
                        $c->realisasi,
                        date('d M Y', strtotime($c->created_at)),
                        '<a href="'. $path. '"  target="_blank" class="btn btn-xs btn-info p-1">Lihat Dokumen</a>',
                        $c->description ? $c->description : '-'
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
                'is_approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return Redirect::back()->with(['success-swal' => 'Progress Mitigasi Indhan berhasil ditambahkan.']);
        }else{
            return Redirect::back()->with(['error-swal' => 'Progress Mitigasi Indhan gagal ditambahkan. File dokumen harus dalam format pdf/png/jpeg. Silahkan upload ulang dokumen dengan format sesuai ketentuan.']);
        }
    }

    public function print($id) {
        $document_type = 'mitigasi_plan_indhan_admin';
        // $header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        // $user = DefendidUser::where('id_user', '=', $header->id_user)->first();
        $header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $detail_risk = RiskHeader::selectRaw('*,avg(pi.nilai_L) as avg_nilai_l, avg(pi.nilai_C) as avg_nilai_c')
                // ->select('DB::raw("(CONCAT(k.id_risk, '-', k.no_k)) as risk_code")')
                ->join('perusahaan', 'risk_header.company_id', 'perusahaan.company_id')
                ->join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )  
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks')
                ->leftJoin('pengukuran_indhan as pi', 'pi.id_s_risiko', 's_risiko.id_s_risiko')
                ->where('risk_detail.status_indhan', '=', 1)
                ->where('risk_detail.company_id', '!=', 6)
                ->whereNull('risk_detail.deleted_at')
                ->where('risk_header.tahun', '=', $header->tahun)
                ->whereNull('risk_header.deleted_at')
                ->where('status_mitigasi', '=', 1)
                ->groupBy('id_riskd')
                ->get();
        $detail_risk_indhan = RiskDetail::selectRaw('*,avg(pi.nilai_L) as avg_nilai_l, avg(pi.nilai_C) as avg_nilai_c')
            // ->select('DB::raw("(CONCAT(k.id_risk, '-', k.no_k)) as risk_code")')
            ->join('perusahaan as p', 'p.company_id', '=', 'risk_detail.company_id')
            ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
            ->join('konteks as k', 's_risiko.id_konteks', 'k.id_konteks' )
            ->leftJoin('pengukuran_indhan as pi', 'pi.id_s_risiko', 's_risiko.id_s_risiko')
            ->where('risk_detail.status_indhan', '=', 1)
            ->where('risk_detail.company_id', '=', 6)
            ->whereNull('risk_detail.deleted_at')
            ->where('risk_detail.tahun', '=', $header->tahun)
            ->where('status_mitigasi', '=', 1)
            ->groupBy('id_riskd')
            ->get();

        $url = "url='admin/mitigasi-plan/print/".$header->id_riskh."';".
            "signed_by=".($header->pemeriksa ? $header->pemeriksa : '-').";".
            "instansi= Industri Pertahanan ;".
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
        $pdf = PDF::loadView('admin.mitigasi-plan-indhan-pdf', compact('header', 'detail_risk', 'detail_risk_indhan','qrcode'))->setPaper('a4', 'landscape');
        Session::forget('is_bypass');
        return $pdf->stream('Hasil Mitigasi Indhan Tahun '.$header->tahun.'.pdf');
    }
}
