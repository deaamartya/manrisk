<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontek;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KonteksController extends Controller
{
    public function index()
    {
        $konteks = Kontek::join('risk', 'risk.id_risk', 'konteks.id_risk')->whereNull('konteks.deleted_at')->get();

        return view('admin.konteks', compact('konteks'));
    }

    public function store(Request $request, $id = null)
    {
        $req = [
            'no_k' => 'required',
            'konteks' => 'required',
            'tahun_konteks' => 'required',
        ];

        $msg = [
            'no_k.required' => 'No tidak boleh kosong',
            'tahun_konteks.required' => 'Tahun konteks tidak boleh kosong',
            'konteks.required' => 'Konteks tidak boleh kosong'
        ];

        $request->validate($req, $msg);

        $params = [
            'id_risk' => $request->id_risk ?? null,
            'no_k' => $request->no_k,
            'konteks' => $request->konteks,
            'tahun_konteks' => $request->tahun_konteks,
            'updated_at' => Carbon::now()
        ];

        DB::beginTransaction();
        if($id){
            Kontek::where('id_konteks', $id)->update($params);
            $messages = ['success-swal' => 'Konteks berhasil diubah!'];
        }
        else{
            $params['created_at'] = Carbon::now();
            Kontek::insert($params);
            $messages = ['success-swal' => 'Konteks berhasil disimpan!'];
        }
        DB::commit();

        return back()->with($messages);
    }

    public function delete(Request $request)
    {
        try {
            $count = SRisiko::where('id_konteks', $request->id_konteks)->count('id_s_risiko');
            if ($count > 0) {
                return back()->with(["error-swal" => 'Konteks ini tidak dapat dihapus karena masih dipakai oleh sumber risiko']);
            }
            Kontek::where('id_konteks', $request->id_konteks)->update(['deleted_at' => Carbon::now()]);
        } catch (\ErrorException $e) {
            return back()->with(["error-swal" => $e->getMessage()]);
        }

        return back()->with(['success-swal' => 'Konteks berhasil dihapus!']);
    }

    public function get_konteks($id)
    {
        $konteks = Kontek::where('id_konteks', $id)->first();

        return response()->json($konteks, 200);
    }
}
