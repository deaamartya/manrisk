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
            // dd($data);
            $url = explode('=', $data[0])[1];
            $url = str_replace("'", '', $url);
            // dd($url);
            $signed_by = explode('=', $data[1])[1];
            $signed_by = str_replace('[', '', $signed_by);
            $signed_by = str_replace(']', '', $signed_by);
            $signed_by = str_replace("'", '', $signed_by);
            $signed_by = explode(',', $signed_by);
            // dd($signed_by);
            Session::put('is_bypass', true);
            $teks_signed = '';
            $length = count($signed_by);
            if ($length > 0) {
                $count = 1;
                foreach($signed_by as $d) {
                    $teks_signed = $teks_signed.$d;
                    if ($count == $length - 1) {
                        $teks_signed = $teks_signed.' dan ';
                    } elseif($length > 1 && $count !== $length) {
                        $teks_signed = $teks_signed.', ';
                    }
                    $count++;
                }
            }
            return view('verified', compact("url", "teks_signed"));
        } catch (DecryptException $e) {
            // dd($e);
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
