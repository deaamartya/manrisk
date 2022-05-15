<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Risk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ResikoController extends Controller
{
    public function index()
    {
        $resiko = Risk::whereNull('deleted_at')->get();

        return view('admin.resiko', compact('resiko'));
    }

    public function store(Request $request, $id = null)
    {
        $req = [
            'id_risk' => 'required',
            'risk' => 'required',
        ];

        $msg = [
            'id_risk.required' => 'Kode tidak boleh kosong',
            'risk.required' => 'Resiko tidak boleh kosong'
        ];

        $request->validate($req, $msg);

        $params = [
            'id_risk' => $request->id_risk,
            'risk' => $request->risk,
            'updated_at' => Carbon::now()
        ];

        if($id == null){
            $params['created_at'] = Carbon::now();
            Risk::insert($params);
        }
        else{
            Risk::where('id_risk', $id)->update($params);
        }

        return back();
    }

    public function delete(Request $request)
    {
        try {
            Risk::where('id_risk', $request->id_risk)->update(['deleted_at' => Carbon::now()]);
        } catch (\ErrorException $e) {
            return back()->with("message", $e->getMessage());
        }

        return back();
    }

    public function get_resiko($id = null)
    {
        $wr = "1=1";
        if($id){
            $wr .= " AND id_risk = '{$id}'";
        }
        $resiko = Risk::whereRaw($wr)->get();

        return response()->json($resiko, 200);
    }
}
