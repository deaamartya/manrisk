<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RiskHeader;
use App\Models\DefendidUser;
use App\Models\PengukuranIndhan;
use App\Models\RiskHeaderIndhan;
use App\Models\RiskDetail;
use App\Models\SRisiko;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;
use Auth;
use PDF;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use DNS2D;
use Session;
use App\Imports\RiskDetailImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Carbon\Carbon;
use DB;
use App\Models\Pengukuran;
use App\Models\MitigasiLogs;
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
        return view('admin.risk-register-indhan', compact('headers', 'jml_risk'));
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
        return redirect()->route('admin.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil disimpan!']);
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
        return redirect()->route('admin.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil diubah!']);
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
        return redirect()->route('admin.risk-register-indhan.index')->with(['success-swal' => 'Risk Header INDHAN berhasil dihapus!']);
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
        // dd($detail_risk[0]->avg_nilai_l  );

        // $detail_risk_indhan = RiskDetail::join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
        //         ->join('perusahaan as p', 'p.company_id', '=', 'risk_detail.company_id')
        //         ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
        //         ->where('risk_detail.status_indhan', '=', 1)
        //         ->where('risk_detail.company_id', '=', 6)
        //         ->whereNull('risk_detail.deleted_at')
        //         ->where('risk_detail.tahun', '=', $headers->tahun)
        //         ->get();

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
        // dd($detail_risk_indhan);
        // $mitigasi = RiskDetail::join('risk_header', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
        // ->join('pengajuan_mitigasi', 'risk_detail.id_riskd', 'pengajuan_mitigasi.id_riskd' )
        //         ->where('risk_detail.status_indhan', '=', 1)
        //         ->whereNull('risk_detail.deleted_at')
        //         ->where('risk_header.tahun', '=', $headers->tahun)
        //         ->count();
            // dd($detail_risk);

        // $s_risk_diinput = RiskDetail::where([
        //         ['company_id', '=', 6],
        //     ])->pluck('id_s_risiko');

        // $pilihan_s_risiko = SRisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')->where([
        //         ['status_indhan', '=', 0],
        //     ])->where('s_risiko.tahun', '=', $headers->tahun)
        //     ->whereNull('risk_detail.deleted_at')
        //     ->whereNotIn('s_risiko.id_s_risiko', $s_risk_diinput)
        //     ->groupBy('risk_detail.id_s_risiko')
        //     ->orderBy('s_risiko.id_s_risiko')->get();

        $s_risk_diinput = RiskDetail::where([
                ['company_id', '=', 6],
            ])->whereNull('deleted_at')->pluck('id_s_risiko');

        $pilihan_s_risiko = SRisiko::where([ ['s_risiko.company_id', '=', 6],
        ])->where('s_risiko.tahun', '=', $headers->tahun)
        ->whereNotIn('s_risiko.id_s_risiko', $s_risk_diinput)
        ->whereNull('deleted_at')
        ->orderBy('s_risiko.id_s_risiko')->get();

        $s_risiko = SRisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                ->where('s_risiko.tahun', '=', $headers->tahun)
                ->where('risk_detail.status_indhan', '=', 0)
                ->orderBy('s_risiko.id_s_risiko')
                ->limit(1)->first();
        // dd($s_risiko);
        // dd($headers->tahun);

        $target = RiskHeaderIndhan::where('id_riskh', '=', $id)->pluck('target')->first();
        $sasaran = explode("\r\n", $target);

        if($s_risiko != null){
            $nilai_l = Pengukuran::where('id_s_risiko', '=', $s_risiko->id_s_risiko)->avg('nilai_L');
            $nilai_c = Pengukuran::where('id_s_risiko', '=', $s_risiko->id_s_risiko)->avg('nilai_C');
        }
        else{
            $nilai_l = null;
            $nilai_c = null;
        }
        return view('admin.detail-risk-register-indhan', compact('headers', 'detail_risk', 'detail_risk_indhan','pilihan_s_risiko', 'nilai_l', 'nilai_c', 'sasaran'));
    }

    public function storeDetail(Request $request)
    {
        $data = $request->except('_token');
        $data['company_id'] = 6;
        $data['status_mitigasi'] = ($request->r_awal >= 12) ? 1 : 0;
        $inputan_idr = preg_replace("/[^0-9]/", "", $request->dampak_kuantitatif);
        $data['dampak_kuantitatif'] = (int) $inputan_idr;
        $inputan_idr_residu = preg_replace("/[^0-9]/", "", $request->dampak_kuantitatif_residu);
        $data['dampak_kuantitatif_residu'] = (int) $inputan_idr_residu;
        RiskDetail::insert($data);
        return Redirect::back()->with(['success-swal' => 'Risk INDHAN berhasil dibuat!']);
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
        return redirect()->route('admin.risk-register-indhan.show', $id)->with(['success-swal' => 'Lampiran berhasil diupload!']);
    }


    public function print($id) {
        $header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
        $document_type = 'risk_register_indhan_admin';
        $url = "url='admin/print-risk-register-indhan/".$header->id_riskh."';".
            "signed_by=".$header->pemeriksa.";".
            "instansi=".'Industri Pertahanan'.";".
            "tahun=".$header->tahun.";".
            "created_at=".$header->created_at.";".
            "penyusun=".$header->penyusun.";";
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
        // dd($headers);
        $detail_risk = RiskHeader::selectRaw("risk_detail.*, s_risiko.*, konteks.*, risk.*, CONCAT(konteks.id_risk, '-', konteks.no_k) AS risk_code, avg(pi.nilai_L) as avg_nilai_l, avg(pi.nilai_C) as avg_nilai_c")
                ->join('risk_detail', 'risk_header.id_riskh', 'risk_detail.id_riskh' )
                ->join('s_risiko', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko' )
                ->join('konteks', 's_risiko.id_konteks', 'konteks.id_konteks' )
                ->join('risk', 'konteks.id_risk', 'risk.id_risk' )
                ->leftJoin('pengukuran_indhan as pi', 'pi.id_s_risiko', 's_risiko.id_s_risiko')
                ->where('risk_detail.status_indhan', '=', 1)
                ->whereNull('risk_detail.deleted_at')
                ->where('risk_header.tahun', '=', $header->tahun)
                ->whereNull('risk_header.deleted_at')
                ->orderBy('konteks.no_k', 'ASC')
                ->orderBy('konteks.id_risk', 'ASC')
                ->get();
            // dd($detail_risk);
        // $user = Auth::user();
        $encrypted = url('document/verify/').'/'.$short_url->short_code;
        $qrcode = DNS2D::getBarcodePNG($encrypted, 'QRCODE');
        $pdf = PDF::loadView('admin.pdf-risk-register-indhan', compact('header', 'detail_risk', 'qrcode'))->setPaper('a4', 'landscape');
        Session::forget('is_bypass');
        // return $pdf->stream('Laporan Manajemen Risiko '.$user->instansi.' Tahun '.$header->tahun.'.pdf');
        return $pdf->stream('Laporan Manajemen Risiko INDHAN Tahun '.$header->tahun.'.pdf');

    }

    // public function approval($id)
    // {
    //     $risk_header = RiskHeaderIndhan::where('id_riskh', '=', $id)->first();
    //     $risk_header->update([
    //         'status_h' => 1
    //     ]);
    //     // dd($risk_header);
    //     return Redirect::back()->with(['success-swal' => 'Risk Header INDHAN berhasil disetujui.']);
    // }

    public function import(Request $request)
    {
        $params = [];
        $risk_detail = Excel::toArray(new RiskDetailImport, $request->file('file'));
        for ($i=0; $i < count($risk_detail[0]); $i++) {
            $risiko = SRisiko::selectRaw('*,avg(pi.nilai_L) as avg_nilai_l, avg(pi.nilai_C) as avg_nilai_c')
                ->leftJoin('pengukuran_indhan as pi', 'pi.id_s_risiko', 's_risiko.id_s_risiko')
                ->where('s_risiko.id_s_risiko', '=', $risk_detail[0][$i]['id_s_risiko'])
                ->first();
            $nilai_l = floatval($risiko->avg_nilai_l);
            $nilai_c = floatval($risiko->avg_nilai_c);
            $nilai_r = floatval($risiko->avg_nilai_l) * floatval($risiko->avg_nilai_c);
            $params[] = [
                'id_riskh' => null,
                'company_id' => 6,
                'id_s_risiko' => $risk_detail[0][$i]['id_s_risiko'],
                'tahun' => $risk_detail[0][$i]['tahun'],
                'sasaran_kinerja' => $risk_detail[0][$i]['sasaran_kinerja'],
                'ppkh' => $risk_detail[0][$i]['ppkh'],
                'indikator' => $risk_detail[0][$i]['indikator'],
                'sebab' => $risk_detail[0][$i]['sebab'],
                'dampak_kuantitatif' => $risk_detail[0][$i]['dampak_kuantitatif'],
                'dampak' => $risk_detail[0][$i]['dampak'],
                'uc' => $risk_detail[0][$i]['uc'],
                'pengendalian' => $risk_detail[0][$i]['pengendalian'],
                'penilaian' => $risk_detail[0][$i]['penilaian'],
                'l_awal' => number_format($nilai_l, 2) + 0,
                'c_awal' => number_format($nilai_c, 2) + 0,
                'r_awal' => number_format($nilai_r, 2) + 0,
                'peluang' => $risk_detail[0][$i]['peluang'],
                'tindak_lanjut' => $risk_detail[0][$i]['tindak_lanjut'],
                'jadwal' => $risk_detail[0][$i]['jadwal'],
                'dampak_kuantitatif_residu' => $risk_detail[0][$i]['dampak_kuantitatif_residu'],
                'dampak_residu' => $risk_detail[0][$i]['dampak_residu'],
                'pic' => $risk_detail[0][$i]['pic'],
                'dokumen' => $risk_detail[0][$i]['dokumen'],
                'status_indhan' => 1,
                'status_mitigasi' => ($nilai_r >= 12 ? 1 : 0),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::beginTransaction();
        RiskDetail::insert($params);
        DB::commit();

        return back()->with(['success-swal' => 'Risk Detail berhasil diimport!']);
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

        $all_s_risiko = SRisiko::join('risk_detail', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko')
        ->whereNull('risk_detail.deleted_at')
        ->whereNull('s_risiko.deleted_at')
        ->where([
            ['status_s_risiko', '=', 1],
            ['status_indhan', '=', 0],
        ])
        ->orderBy('s_risiko.id_s_risiko')->get();

        $s_risiko_terpakai = SRisiko::join('risk_detail', 'risk_detail.id_s_risiko', 's_risiko.id_s_risiko')
        ->whereNull('risk_detail.deleted_at')
        ->whereNull('s_risiko.deleted_at')
        ->where([
            ['status_s_risiko', '=', 1],
            ['status_indhan', '=', 0],
            ['risk_detail.company_id', '=', 6],
        ])
        ->orderBy('s_risiko.id_s_risiko')->pluck('s_risiko.id_s_risiko');

        return response()->json(['s_risk_selected' => $s_risk_selected, 'all_s_risiko' => $all_s_risiko, 'pilihan_s_risiko' => $s_risiko_terpakai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDetail(Request $request, $id)
    {
        $risk_detail = RiskDetail::where('id_riskd', '=', $id)->first();
        // $risk_detail->update($request->except('_token'));
        $data = $request->except('_token');
        $inputan_idr = preg_replace("/[^0-9]/", "", $request->dampak_kuantitatif);
        $data['dampak_kuantitatif'] = (int) $inputan_idr;
        $inputan_idr_residu = preg_replace("/[^0-9]/", "", $request->dampak_kuantitatif_residu);
        $data['dampak_kuantitatif_residu'] = (int) $inputan_idr_residu;

        $risk_detail->update($data);

        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyDetail($id)
    {
        $count = MitigasiLogs::where('id_riskd', '=', $id)->count('id_riskd');
        if ($count > 0) {
            return back()->with(["error-swal" => 'Data ini masih digunakan pada log mitigasi. Mohon hapus data yang menggunakan risiko ini terlebih dahulu.']);
        }
        RiskDetail::destroy($id);
        return Redirect::back()->with(['success-swal' => 'Risk Detail berhasil dihapus!']);
    }
}
