<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;

class VerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify()
    {
        // url=
    }

    //decrypt dengan parameter encrypted string.
    public function getDecrypted($token)
    {
        try {
            $decrypt = Crypt::decryptString($token);
            $data = explode(";", $decrypt);
            $url = explode('=', $data[0])[1];
            $url = str_replace("'", '', $url);
            $signed_by = explode('=', $data[1])[1];
            $instansi = explode('=', $data[2])[1];
            $tahun = explode('=', $data[3])[1];
            $created_at = explode('=', $data[4])[1];
            $penyusun = explode('=', $data[5])[1];
            Session::put('is_bypass', true);
            return view('verified', compact("url", "signed_by", "instansi", "tahun", "created_at", "penyusun"));
        } catch (DecryptException $e) {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
