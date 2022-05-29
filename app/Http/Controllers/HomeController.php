<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->is_risk_officer) {
                return view('risk-officer.index');
            }
            if (Auth::user()->is_risk_owner) {
                return view('risk-owner.index');
            }
            if (Auth::user()->is_penilai) {
                return view('penilai.index');
            }
            if (Auth::user()->is_penilai_indhan) {
                return view('penilai-indhan.index');
            }
            if (Auth::user()->is_admin) {
                return view('admin.index');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
