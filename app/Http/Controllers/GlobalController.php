<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
