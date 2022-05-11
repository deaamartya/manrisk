<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        }
        else{
            Perusahaan::where('company_id', $id)->update($params);
        }

        return back();
    }

    public function delete(Request $request)
    {
        try {
            Perusahaan::where('company_id', $request->company_id)->update(['deleted_at' => Carbon::now()]);
        } catch (\ErrorException $e) {
            return back()->with("message", $e->getMessage());
        }

        return back();
    }

    public function get_perusahaan($id)
    {
        $perusahaan = Perusahaan::where('company_id', $id)->first();

        return response()->json($perusahaan, 200);
    }
}
