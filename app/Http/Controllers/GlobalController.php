<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
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
            $data = DB::table('forum')
            ->leftJoin('defendid_user as du', 'du.id_user', 'forum.id_user')
            ->where('forum.display', 1)
            ->orWhere('forum.id_user', Auth::user()->id_user)
            ->orderBy('forum.updated_at', 'desc')
            ->select('forum.id', 'forum.id_user', 'forum.subject', 'forum.body', 'forum.display', 'forum.updated_at', 'du.username')
            ->simplePaginate(1);

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
}
