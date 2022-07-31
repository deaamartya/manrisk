<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\SRisiko;
use App\Models\Pengukuran;
use App\Models\PengukuranIndhan;
use App\Models\RiskHeader;
use App\Models\RiskHeaderIndhan;
use App\Models\RiskDetail;
use App\Models\PengajuanMitigasi;
use App\Models\Mitigasi;
use App\Models\ProsesManrisk;
use App\Models\StatusProses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Session;

class GlobalController extends Controller
{
    public function get_perusahaan()
    {
        if(Auth::check()){
            $wr = "1=1";
            if(auth()->user()->is_risk_officer == 1){
                $wr .= " AND company_id = ".auth()->user()->company_id;
            }

            $perusahaan = Perusahaan::whereRaw($wr)->get();

            return response()->json($perusahaan, 200);
        }
        else{
            return response()->json(["message" => "Unauthorized"], 401);
        }
    }

    public function forum()
    {
        if(Auth::check()){
            $wr = '1=1';
            if(!Auth::user()->is_admin){
                $wr.=' AND forum.display = 1';
            }
            $data = DB::table('forum')
            ->leftJoin('defendid_user as du', 'du.id_user', 'forum.id_user')
            ->whereRaw($wr)
            ->orWhere('forum.id_user', Auth::user()->id_user)
            ->orderBy('forum.updated_at', 'desc')
            ->select('forum.id', 'forum.id_user', 'forum.subject', 'forum.body', 'forum.display', 'forum.updated_at', 'du.username')
            ->simplePaginate(25);

            return view('forum', compact('data'));
        }
        else{
            return route('login');
        }

    }

    public function get_forum($id)
    {
        $data = DB::table('forum')->where('id', $id)->first();

        return response()->json(['message' => 'success', 'data' => $data], 200);
    }

    public function forum_delete($id)
    {
        DB::beginTransaction();

        DB::table('forum_detail')->where('id_forum', $id)->delete();
        DB::table('forum')->where('id', $id)->delete();

        DB::commit();
        return back()->with(['success-swal' => 'Forum berhasil dihapus!']);
    }

    public function forum_detail($id)
    {
        if(Auth::check()){
            $forum = DB::table('forum')->where('id', $id)
            ->leftJoin('defendid_user as du', 'du.id_user', 'forum.id_user')
            ->select('forum.id', 'forum.id_user', 'forum.subject', 'forum.body', 'forum.display', 'forum.updated_at', 'du.username')
            ->first();
            $forum_detail = DB::table('forum_detail')->where('id_forum', $id)
            ->leftJoin('defendid_user as du', 'du.id_user', 'forum_detail.id_user')
            ->select('forum_detail.id_forum', 'forum_detail.id_user', 'forum_detail.body', 'forum_detail.created_at', 'du.username')
            ->get();

            return view('forum-detail', compact('forum', 'forum_detail'));
        }
        else{
            return route('login');
        }
    }

    public function forum_detail_store(Request $request, $id)
    {
        DB::table('forum_detail')->insert([
            'id_forum' => $id,
            'id_user' => Auth::user()->id_user,
            'body' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return back()->with(['success-swal' => 'Tanggapan berhasil disimpan!']);
    }

    public function forum_store(Request $request, $id = null)
    {
        $req = [
            'subject' => 'required',
            'body' => 'required',
        ];

        $msg = [
            'subject.required' => 'Subject tidak boleh kosong',
            'body.required' => 'Isi/body tidak boleh kosong'
        ];

        $request->validate($req, $msg);

        $params = [
            'subject' => $request->subject,
            'body' => $request->body,
            'display' => $request->display,
            'updated_at' => Carbon::now()
        ];
        if($id){
            DB::table('forum')->where('id', $id)->update($params);
        }
        else{
            $params['id'] = Uuid::uuid4()->getHex();
            $params['id_user'] = Auth::user()->id_user;
            $params['created_at'] = Carbon::now();
            DB::table('forum')->insert($params);
        }

        return back()->with(['success-swal' => 'Forum berhasil disimpan!']);
    }

    public function get_notification()
    {
        // init
        $data_risk_officer = [];
        $data_penilai = [];
        $data_penilai_indhan = [];
        $data_risk_owner = [];
        $data_admin = [];

        // check role
        if(Auth::user()->is_risk_officer){
            $data_risk_officer = $this->notif_risk_officer();
        }
        if(Auth::user()->is_penilai){
            $data_penilai = $this->notif_penilai();
        }
        if(Auth::user()->is_penilai_indhan){
            $data_penilai_indhan = $this->notif_penilai_indhan();
        }
        if(Auth::user()->is_risk_owner){
            $data_risk_owner = $this->notif_risk_owner();
        }
        if(Auth::user()->is_admin){
            $data_admin = $this->notif_admin();
        }

        // merge notif
        $data = [];
        if(count($data_risk_officer) > 0){
            foreach($data_risk_officer as $dro){
                $data[] = $dro;
            }
        }
        if(count($data_penilai) > 0){
            foreach($data_penilai as $dp){
                $data[] = $dp;
            }
        }
        if(count($data_penilai_indhan) > 0){
            foreach($data_penilai_indhan as $dpi){
                $data[] = $dpi;
            }
        }
        if(count($data_risk_owner) > 0){
            foreach($data_risk_owner as $drow){
                $data[] = $drow;
            }
        }
        if(count($data_admin) > 0){
            foreach($data_admin as $da){
                $data[] = $da;
            }
        }

        // Notif/Alert kondisi risiko yang melewati jatuh tempo
        if(!Auth::user()->is_admin){
            // if(Auth::user()->is_risk_officer){
            //     $segment = '/risk-officer/pengukuran-risiko';
            // }
            // else{
            //     if(Auth::user()->is_penilai){
            //         $segment = '/penilai/pengukuran-risiko';
            //     }
            //     else if(Auth::user()->is_penilai_indhan){
            //         $segment = '/penilai-indhan/pengukuran-risiko-indhan';
            //     }
            //     else if(Auth::user()->is_risk_owner){
            //         $segment = '/risk-owner/pengukuran-risiko';
            //     }
            // }
            $segment = "/deadline-mitigasi";
            $temp = DB::raw("(
                SELECT MAX(realisasi) as final_realisasi, id_riskd FROM mitigasi_logs WHERE is_approved = 1 ORDER BY updated_at DESC
            ) as mitigasi_logs");
            $mitigasi_jatuh_tempo = Mitigasi::leftJoin('risk_detail', 'risk_detail.id_riskd', 'mitigasi.id_riskd')
            ->leftJoin($temp, 'mitigasi_logs.id_riskd', 'risk_detail.id_riskd')
            ->where('risk_detail.jadwal_mitigasi', '<', Carbon::now()->format('Y-m-d'))
            ->where('mitigasi_logs.final_realisasi', '<', 100)
            ->select('risk_detail.id_riskd', 'risk_detail.mitigasi')
            ->get();

            Session::forget('deadline-mitigasi');
            $total_jatuh_tempo = count($mitigasi_jatuh_tempo);
            if($total_jatuh_tempo > 0){
                Session::put('deadline-mitigasi', $mitigasi_jatuh_tempo);
                $data[] = [
                    'title' => 'Terdapat risiko telah melewati tanggal jatuh tempo sebanyak ',
                    'jumlah' => $total_jatuh_tempo,
                    'link' => url('/').$segment
                ];
            }
        }

        return response()->json(['message' => 'ok', 'data' => $data], 200);
    }

    public function notif_risk_officer()
    {
        $s_risk_dinilai = SRisiko::join('pengukuran as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
        ->join('defendid_pengukur as dp', 'p.id_pengukur', 'dp.id_pengukur')
        ->where('dp.id_user', Auth::user()->id_user)
        ->where('status_s_risiko', 1)
        ->pluck('s_risiko.id_s_risiko');
        // dd($s_risk_dinilai);
        $jml_risk = SRisiko::where('status_s_risiko', 1)
            ->where('s_risiko.company_id', Auth::user()->company_id)
            ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
            ->count('s_risiko.id_s_risiko');
        // dd($jml_risk);

        $risk_detail = RiskDetail::join('s_risiko', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                        ->select('risk_detail.id_riskd')
                        ->whereNull('risk_detail.deleted_at')
                        ->get();
        $rd = [];
        foreach ($risk_detail as $key => $value) {
            $rd[] = $value->id_riskd;
        }
        $jml_mitigasi = DB::table('mitigasi_logs')->whereNotIn('id_riskd', $rd)->count();

        $data = [];
        if($jml_risk > 0){
            $data[] = [
                'title' => 'Terdapat pengukuran risiko korporasi sebanyak ',
                'jumlah' => $jml_risk,
                'link' => url('/')."/risk-officer/pengukuran-risiko"
            ];
        }
        if($jml_mitigasi > 0){
            $data[] = [
                'title' => 'Terdapat detail risiko yang belum dimitigasi sebanyak ',
                'jumlah' => $jml_mitigasi,
                'link' => url('/')."/risk-officer/mitigasi-plan"
            ];
        }

        // $data = [[
        //     'title' => 'Terdapat pengukuran risiko korporasi sebanyak ',
        //     'jumlah' => $jml_risk
        // ],
        // [
        //     'title' => 'Terdapat detail risiko yang belum dimitigasi sebanyak ',
        //     'jumlah' => $jml_risk
        // ]];

        return $data;
    }

    public function notif_risk_owner()
    {
        $s_risk_dinilai = SRisiko::join('pengukuran as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
                        ->join('defendid_pengukur as dp', 'p.id_pengukur', 'dp.id_pengukur')
                        ->where('dp.id_user', Auth::user()->id_user)
                        ->where('status_s_risiko', 1)
                        ->pluck('s_risiko.id_s_risiko');
        // dd($s_risk_dinilai);
        $jml_risk = SRisiko::where('status_s_risiko', 1)
                    ->where('s_risiko.company_id', Auth::user()->company_id)
                    ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
                    ->count('s_risiko.id_s_risiko');
        // dd($jml_risk);

        $jml_approval_risk_register = RiskHeader::where(['company_id' => Auth::user()->company_id, 'status_h' => 0])->count();

        $data = [];
        if($jml_risk > 0){
            $data[] = [
                'title' => 'Terdapat pengukuran risiko korporasi sebanyak ',
                'jumlah' => $jml_risk,
                'link' => url('/')."/risk-owner/pengukuran-risiko"
            ];
        }
        if($jml_approval_risk_register > 0){
            $data[] = [
                'title' => 'Terdapat risk register korporasi yang belum disetujui sebanyak ',
                'jumlah' => $jml_approval_risk_register,
                'link' => url('/')."/risk-owner/risiko"
            ];
        }

        // $data = [[
        //     'title' => 'Terdapat pengukuran risiko korporasi sebanyak ',
        //     'jumlah' => $jml_risk
        // ],
        // [
        //     'title' => 'Terdapat risk register korporasi yang belum disetujui sebanyak ',
        //     'jumlah' => $jml_approval_risk_register
        // ]];

        return $data;
    }

    public function notif_penilai()
    {
        $s_risk_dinilai = SRisiko::join('pengukuran as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
        ->join('defendid_pengukur as dp', 'p.id_pengukur', 'dp.id_pengukur')
        ->where('dp.id_user', Auth::user()->id_user)
        ->where('status_s_risiko', 1)
        ->pluck('s_risiko.id_s_risiko');
        // dd($s_risk_dinilai);
        $jml_risk = SRisiko::where('status_s_risiko', 1)
            ->where('s_risiko.company_id', Auth::user()->company_id)
            ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
            ->count('s_risiko.id_s_risiko');
        // dd($jml_risk);

        $data = [[
            'title' => 'Terdapat pengukuran risiko korporasi sebanyak ',
            'jumlah' => $jml_risk,
            'link' => url('/')."/penilai/pengukuran-risiko"
        ]];
        if($jml_risk == 0){
            $data = [];
        }

        return $data;
    }

    public function notif_penilai_indhan()
    {
        $s_risk_dinilai = SRisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
        ->join('pengukuran_indhan as p', 'p.id_s_risiko', 's_risiko.id_s_risiko')
        ->join('defendid_pengukur as dp', 'p.id_pengukur', 'dp.id_pengukur')
        ->where('dp.id_user', Auth::user()->id_user)
        ->where('status_indhan', 1)
        ->pluck('s_risiko.id_s_risiko');

        // dd($s_risk_dinilai);
        $jml_risk = SRisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
            ->where('status_indhan', 1)
            ->whereNotIn('s_risiko.id_s_risiko', $s_risk_dinilai)
            ->count('s_risiko.id_s_risiko');
        // dd($jml_risk);

        $data = [[
            'title' => 'Terdapat pengukuran risiko indhan sebanyak ',
            'jumlah' => $jml_risk,
            'link' => url('/')."/penilai-indhan/pengukuran-risiko-indhan"
        ]];
        if($jml_risk == 0){
            $data = [];
        }

        return $data;
    }

    public function notif_admin()
    {
        $approval_srisiko_indhan = SRisiko::
        //join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                                    // where('s_risiko.tahun', date('Y'))
                                    where('s_risiko.status_s_risiko', 0)
                                    // ->where('risk_detail.status_indhan', 1)
                                    // ->whereNull('risk_detail.deleted_at')
                                    ->count('s_risiko.id_s_risiko');
        $approval_pengajuan_mitigasi_indhan = PengajuanMitigasi::where('is_approved', 0)->count();
        $approval_risk_register_korporasi = RiskHeader::where('status_h_indhan', 0)
                                    ->where('status_h', 1)->count();
        $approval_hasil_mitigasi = DB::table('mitigasi_logs')->where('is_approved', 0)->count();

        $data = [];
        if($approval_srisiko_indhan > 0){
            $data[] = [
                'title' => 'Terdapat sumber risiko yang belum disetujui sebanyak ',
                'jumlah' => $approval_srisiko_indhan,
                'link' => url('/')."/admin/sumber-risiko-indhan"
            ];
        }
        if($approval_pengajuan_mitigasi_indhan > 0){
            $data[] = [
                'title' => 'Terdapat pengajuan mitigasi yang belum disetujui sebanyak ',
                'jumlah' => $approval_pengajuan_mitigasi_indhan,
                'link' => url('/')."/admin/mitigasi-plan"
            ];
        }
        if($approval_risk_register_korporasi > 0){
            $data[] = [
                'title' => 'Terdapat risk register korporasi yang belum disetujui sebanyak ',
                'jumlah' => $approval_risk_register_korporasi,
                'link' => url('/')."/admin/risk-register-korporasi"
            ];
        }
        if($approval_hasil_mitigasi > 0){
            $data[] = [
                'title' => 'Terdapat hasil mitigasi yang belum disetujui sebanyak ',
                'jumlah' => $approval_hasil_mitigasi,
                'link' => url('/')."/admin/approval-hasil-mitigasi"
            ];
        }

        return $data;
    }

    public function deadlineMitigasi()
    {
        $temp = DB::raw("(
            SELECT MAX(realisasi) as final_realisasi, id_riskd FROM mitigasi_logs WHERE is_approved = 1 ORDER BY updated_at DESC
        ) as mitigasi_logs");

        $data = Mitigasi::leftJoin('risk_detail', 'risk_detail.id_riskd', 'mitigasi.id_riskd')
        ->leftJoin($temp, 'mitigasi_logs.id_riskd', 'risk_detail.id_riskd')
        ->leftJoin('s_risiko', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
        ->leftJoin('konteks', 'konteks.id_konteks', 's_risiko.id_konteks')
        ->leftJoin('perusahaan', 'perusahaan.company_id', 'risk_detail.company_id')
        ->where('risk_detail.jadwal_mitigasi', '<', Carbon::now()->format('Y-m-d'))
        ->where('mitigasi_logs.final_realisasi', '<', 100)
        ->selectRaw('
            konteks.id_risk,
            konteks.no_k,
            s_risiko.s_risiko,
            risk_detail.mitigasi,
            risk_detail.jadwal_mitigasi,
            mitigasi_logs.final_realisasi,
            perusahaan.instansi,
            risk_detail.tahun
        ')
        ->get();
        // dd($data);

        return view('deadline_mitigasi', compact('data'));
    }

    public function statusProses()
    {
        $status_proses = StatusProses::all();
        $proses = ProsesManrisk::all();
        return view('status_proses', compact('status_proses', 'proses'));
    }

    public function storeStatusProses(Request $request)
    {
      $request->validate([
        'tahun' => 'required',
        'id_proses' => 'required',
      ]);

      StatusProses::insert([
        'tahun' => $request->tahun,
        'id_proses' => $request->id_proses,
        'created_at' => now(),
      ]);

      return redirect()->route('status-proses.index')->with('created-alert', 'Status proses terkini berhasil ditambahkan.');
    }

    public function updateStatusProses(Request $request, $id)
    {
      $request->validate([
        'tahun' => 'required',
        'id_proses' => 'required',
      ]);

      StatusProses::find($id)->update([
        'tahun' => $request->tahun,
        'id_proses' => $request->id_proses,
        'updated_at' => now(),
      ]);

      return redirect()->route('status-proses.index')->with('updated-alert', 'Status proses terkini berhasil diubah.');
    }
}
