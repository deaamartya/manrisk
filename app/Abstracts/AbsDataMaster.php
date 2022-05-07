<?php

namespace App\Abstracts;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DefendidUser;
use Illuminate\Support\Facades\Hash;

class AbsDataMaster
{
    public static function user_data()
    {
        $wr = "1=1";
        if(auth()->user()->is_risk_officer == 1){
            $wr .= " AND defendid_user.company_id = ".auth()->user()->company_id;
        }

        $user = DefendidUser::where('is_admin', 0)
        ->whereRaw($wr)
        ->leftJoin('perusahaan', 'perusahaan.company_id', 'defendid_user.company_id')
        ->select(
            'defendid_user.*',
            'perusahaan.instansi',
            DB::raw("
                (CASE
                    WHEN is_risk_officer = 1 THEN 'Risk Officer'
                    WHEN is_penilai = 1 THEN 'Penilai'
                    WHEN is_penilai_indhan = 1 THEN 'Penilai Indhan'
                    WHEN is_risk_owner = 1 THEN 'Risk Owner'
                    WHEN is_admin = 1 THEN 'Admin'
                END
                ) AS jabatan
            ")
        )
        ->get();

        return $user;
    }

    public static function user_store($request, $id = null){
        // dd($request);
        if($id == null){
            DefendidUser::insert([
                'company_id' => $request->company_id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status_user' => 0,
                'is_risk_officer' => $request->is_risk_officer ?? 0,
                'is_admin' => $request->is_admin ?? 0,
                'is_penilai' => $request->is_penilai ?? 0,
                'is_penilai_indhan' => $request->is_penilai_indhan ?? 0,
                'is_risk_owner' => $request->is_risk_owner ?? 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        else{
            DefendidUser::where('id_user', $id)->update([
                'company_id' => $request->company_id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status_user' => 0,
                'is_risk_officer' => $request->is_risk_officer ?? 0,
                'is_admin' => $request->is_admin ?? 0,
                'is_penilai' => $request->is_penilai ?? 0,
                'is_penilai_indhan' => $request->is_penilai_indhan ?? 0,
                'is_risk_owner' => $request->is_risk_owner ?? 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $status = 200;

        return $status;
    }

    public static function update_status($id)
    {
        $user = DefendidUser::findOrFail($id);
        if($user->status_user == 0){
            $user->status_user = 1;
        }
        else{
            $user->status_user = 0;
        }

        $user->save();
        $msg = ['data' => $user, 'status' => 200];

        return $msg;
    }

    public static function get_user($id)
    {
        $user = DefendidUser::findOrFail($id);
        $msg = ['data' => $user, 'status' => 200];

        return $msg;
    }
}
