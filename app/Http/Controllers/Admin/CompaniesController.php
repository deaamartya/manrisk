<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DefendidUser;
use App\Models\DefendidPengukur;
use App\Models\RiskHeader;
use App\Models\SRisiko;
use App\Models\PengajuanMitigasi;
use App\Models\RiskDetail;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Perusahaan::whereNull('deleted_at')->get();

        return view('admin.perusahaan', compact('companies'));
    }

    public function store(Request $request, $id = null)
    {
        $req = [
            'company_code' => 'required',
            'instansi' => 'required',
        ];

        $msg = [
            'company_code.required' => 'Kode perusahaan tidak boleh kosong',
            'instansi.required' => 'Nama perusahaan tidak boleh kosong'
        ];

        $request->validate($req, $msg);

        $params = [
            'company_code' => $request->company_code,
            'instansi' => $request->instansi,
            'updated_at' => Carbon::now()
        ];

        if($id == null){
            $params['created_at'] = Carbon::now();
            Perusahaan::insert($params);
            $messages = ['success-swal' => 'Perusahaan berhasil disimpan!'];
        }
        else{
            Perusahaan::where('company_id', $id)->update($params);
            $messages = ['success-swal' => 'Perusahaan berhasil diubah!'];
        }

        return back()->with($messages);
    }

    public function delete(Request $request)
    {
        try {
            $checkUser = DefendidUser::where('company_id', $request->company_id)->exists();
            $checkPengukur = DefendidPengukur::where('company_id', $request->company_id)->exists();
            $checkHeader = RiskHeader::where('company_id', $request->company_id)->exists();
            $checkSRisiko = SRisiko::where('company_id', $request->company_id)->exists();
            $checkPengajuan = PengajuanMitigasi::where('company_id', $request->company_id)->exists();
            $checkDetail = RiskDetail::where('company_id', $request->company_id)->exists();
            if (!$checkUser && !$checkPengukur && !$checkHeader && !$checkSRisiko && !$checkPengajuan && !$checkDetail) {
                Perusahaan::where('company_id', $request->company_id)->update(['deleted_at' => Carbon::now()]);
            } else {
                return back()->with(["error-swal" => 'Data masih digunakan pada user, pengukur, risk header, sumber risiko, pengajuan mitigasi atau risk detail. Mohon hapus data yang menggunakan perusahaan ini terlebih dahulu.']);
            }
        } catch (\ErrorException $e) {
            return back()->with(["error-swal" => $e->getMessage()]);
        }

        return back()->with(['success-swal' => 'Perusahaan berhasil dihapus!']);
    }

    public function get_perusahaan($id)
    {
        $perusahaan = Perusahaan::where('company_id', $id)->first();

        return response()->json($perusahaan, 200);
    }
}
