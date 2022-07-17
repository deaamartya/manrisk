<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Abstracts\AbsDataMaster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DefendidUser;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = AbsDataMaster::user_data();
        // $perusahaan = Perusahaan::all();

        return view('risk-officer.user', compact('user'));
    }

    public function store(Request $request, $id = null)
    {
        $req = [
            'company_id' => 'required',
            'username' => 'required',
            'jabatan' => 'required',
        ];

        $msg = [
            'company_id.required' => 'Perusahaan tidak boleh kosong',
            'username.required' => 'Nama user tidak boleh kosong',
            'jabatan.required' => 'Jabatan user tidak boleh kosong'
        ];

        $request->validate($req, $msg);

        $store = AbsDataMaster::user_store($request, $id);

        return back()->with($store['messages']);
    }

    public function update_status($id)
    {
        $update_status = AbsDataMaster::update_status($id);

        return response()->json($update_status);
    }

    public function get_user($id)
    {
        $user = AbsDataMaster::get_user($id);

        return response()->json($user);
    }
}
