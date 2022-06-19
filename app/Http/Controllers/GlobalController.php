<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Srisiko;
use App\Models\Pengukuran;
use App\Models\PengukuranIndhan;
use App\Models\RiskHeader;
use App\Models\RiskHeaderIndhan;
use App\Models\RiskDetail;
use App\Models\PengajuanMitigasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

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
        DB::table('forum_detail')->where('id_forum', $id)->delete();
        DB::table('forum')->where('id', $id)->delete();

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
        if(Auth::user()->is_risk_officer){
            $data = $this->notif_risk_officer();
        }
        else if(Auth::user()->is_penilai){
            $data = $this->notif_penilai();
        }
        else if(Auth::user()->is_penilai_indhan){
            $data = $this->notif_penilai_indhan();
        }
        else if(Auth::user()->is_risk_owner){
            $data = $this->notif_risk_owner();
        }
        else if(Auth::user()->is_admin){
            $data = $this->notif_admin();
        }

        return response()->json(['message' => 'ok', 'data' => $data], 200);
    }

    public function notif_risk_officer()
    {
        $jml_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                    ->where('s_risiko.company_id', Auth::user()->company_id)
                    ->where('s_risiko.tahun', date('Y'))
                    ->where('s_risiko.status_s_risiko', 1)
                    ->count('pengukuran.id_p');
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
                'jumlah' => $jml_risk
            ];
        }
        if($jml_mitigasi > 0){
            $data[] = [
                'title' => 'Terdapat detail risiko yang belum dimitigasi sebanyak ',
                'jumlah' => $jml_mitigasi
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
        $jml_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                    ->where('s_risiko.company_id', Auth::user()->company_id)
                    ->where('s_risiko.tahun', date('Y'))
                    ->where('s_risiko.status_s_risiko', 1)
                    ->count('pengukuran.id_p');
        $jml_approval_risk_register = RiskHeader::where(['company_id' => Auth::user()->company_id, 'status_h' => 0])->count();

        $data = [];
        if($jml_risk > 0){
            $data[] = [
                'title' => 'Terdapat pengukuran risiko korporasi sebanyak ',
                'jumlah' => $jml_risk
            ];
        }
        if($jml_approval_risk_register > 0){
            $data[] = [
                'title' => 'Terdapat risk register korporasi yang belum disetujui sebanyak ',
                'jumlah' => $jml_approval_risk_register
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
        $data_sr = Srisiko::where('company_id', Auth::user()->company_id)
                    ->where('status_s_risiko', 1)->get();
        $id_s_risiko = [];
        foreach($data_sr as $dt){
            $id_s_risiko[] = $dt->id_s_risiko;
        }
        // dd($id_s_risiko);
        $jml_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
                    ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
                    ->whereIn('pengukuran.id_s_risiko', $id_s_risiko)
                    // ->where('pengukuran.id_pengukur', Auth::user()->id_user)
                    ->where('s_risiko.tahun', date('Y'))
                    ->count('pengukuran.id_p');
        // $jml_risk = Pengukuran::join('s_risiko', 'pengukuran.id_s_risiko', 's_risiko.id_s_risiko')
        //             ->join('defendid_pengukur', 'pengukuran.id_pengukur', 'defendid_pengukur.id_pengukur')
        //             ->where('defendid_pengukur.id_user', Auth::user()->id_user)
        //             ->where('s_risiko.tahun', date('Y'))
        //             ->where('s_risiko.status_s_risiko', 1)
        //             ->count('pengukuran.id_p');

        $data = [[
            'title' => 'Terdapat pengukuran risiko korporasi sebanyak ',
            'jumlah' => $jml_risk
        ]];
        if($jml_risk == 0){
            $data = [];
        }

        return $data;
    }

    public function notif_penilai_indhan()
    {
        $jml_risk = PengukuranIndhan::join('s_risiko', 'pengukuran_indhan.id_s_risiko', 's_risiko.id_s_risiko')
                    ->join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                    ->where('s_risiko.tahun', date('Y'))
                    ->where('risk_detail.status_indhan', 1)
                    ->whereNull('risk_detail.deleted_at')
                    ->count('pengukuran_indhan.id_p');

        $data = [[
            'title' => 'Terdapat pengukuran risiko indhan sebanyak ',
            'jumlah' => $jml_risk
        ]];
        if($jml_risk == 0){
            $data = [];
        }

        return $data;
    }

    public function notif_admin()
    {
        $approval_srisiko_indhan = Srisiko::join('risk_detail', 's_risiko.id_s_risiko', 'risk_detail.id_s_risiko')
                                    ->where('s_risiko.tahun', date('Y'))
                                    ->where('s_risiko.status_s_risiko', 0)
                                    ->where('risk_detail.status_indhan', 1)
                                    ->whereNull('risk_detail.deleted_at')
                                    ->count('s_risiko.id_s_risiko');
        $approval_pengajuan_mitigasi_indhan = PengajuanMitigasi::where('is_approved', 0)->count();
        // $approval_risk_register_indhan = RiskHeaderIndhan::where('status_h', 0)->count();
        $approval_risk_register_korporasi = RiskHeader::where('status_h_indhan', 0)->count();
        $approval_hasil_mitigasi = DB::table('mitigasi_logs')->where('is_approved', 0)->count();

        $data = [];
        if($approval_srisiko_indhan > 0){
            $data[] = [
                'title' => 'Terdapat sumber risiko indhan yang belum disetujui sebanyak ',
                'jumlah' => $approval_srisiko_indhan
            ];
        }
        if($approval_pengajuan_mitigasi_indhan > 0){
            $data[] = [
                'title' => 'Terdapat pengajuan mitigasi indhan yang belum disetujui sebanyak ',
                'jumlah' => $approval_pengajuan_mitigasi_indhan
            ];
        }
        if($approval_risk_register_korporasi > 0){
            $data[] = [
                'title' => 'Terdapat risk register korporasi yang belum disetujui sebanyak ',
                'jumlah' => $approval_risk_register_korporasi
            ];
        }
        if($approval_hasil_mitigasi > 0){
            $data[] = [
                'title' => 'Terdapat hasil mitigasi yang belum disetujui sebanyak ',
                'jumlah' => $approval_hasil_mitigasi
            ];
        }

        return $data;
    }


}
