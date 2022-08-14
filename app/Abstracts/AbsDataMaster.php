<?php

namespace App\Abstracts;

use App\Models\DefendidPengukur;
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
            // DB::raw("
            //     (CASE
            //         WHEN is_risk_officer = 1 THEN 'Risk Officer'
            //         WHEN is_penilai = 1 THEN 'Penilai'
            //         WHEN is_penilai_indhan = 1 THEN 'Penilai Indhan'
            //         WHEN is_risk_owner = 1 THEN 'Risk Owner'
            //         WHEN is_admin = 1 THEN 'Admin'
            //     END
            //     ) AS role
            // ")
        )
        ->get();

        return $user;
    }

    public static function user_store($request, $id = null){
        $results = [];
        $params = [
            'company_id' => $request->company_id,
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
            'username' => $request->username,
            'status_user' => 0,
            'is_risk_officer' => $request->is_risk_officer ?? 0,
            'is_admin' => $request->is_admin ?? 0,
            'is_penilai' => $request->is_penilai ?? 0,
            'is_penilai_indhan' => $request->is_penilai_indhan ?? 0,
            'is_risk_owner' => $request->is_risk_owner ?? 0,
            'is_assessment' => $request->melakukan_penilaian ?? 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        if($request->filled('password')){
            $params['password'] = Hash::make($request->password);
        }

        DB::beginTransaction();
        if($id == null){
            $id_user = DefendidUser::insertGetId($params);
            if($request->melakukan_penilaian == 1){
                DefendidPengukur::insert([
                    'company_id' => $request->company_id,
                    'id_user' => $id_user,
                    'jabatan' => $request->jabatan,
                    'nip' => $request->nip,
                    'nama' => $request->name,
                    'jenis' => $request->is_penilai_indhan ? 1 : 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            $results['messages'] = ['success-swal' => 'User berhasil disimpan!'];
        }
        else{
            // dd($params);
            DefendidUser::where('id_user', $id)->update($params);
            if($request->melakukan_penilaian == 1){
                if(DefendidPengukur::where('id_user', $id)->exists()){
                    DefendidPengukur::where('id_user', $id)->update([
                        'company_id' => $request->company_id,
                        'id_user' => $id,
                        'jabatan' => $request->jabatan,
                        'nip' => $request->nip,
                        'jenis' => $request->is_penilai_indhan ? 1 : 0,
                        'nama' => $request->name,
                        'updated_at' => Carbon::now()
                    ]);
                }
                else{
                    DefendidPengukur::insert([
                        'company_id' => $request->company_id,
                        'id_user' => $id,
                        'jabatan' => $request->jabatan,
                        'nip' => $request->nip,
                        'nama' => $request->name,
                        'jenis' => $request->is_penilai_indhan ? 1 : 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
            $results['messages'] = ['success-swal' => 'User berhasil diubah!'];
        }
        DB::commit();

        $results['status'] = 201;

        return $results;
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
        $user = DefendidUser::where('id_user', $id)->get();
        $pengukur = DefendidPengukur::selectRaw('company_id, id_user, nama, nip, jabatan, status_pengukur, jenis')->where('id_user', $id)->get();

        $data = $user->merge($pengukur);
        $msg = ['data' => $data, 'status' => 200];
        // dd($pengukur);
        return $msg;
    }
}
