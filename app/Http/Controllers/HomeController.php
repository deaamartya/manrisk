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
            $kat = Auth::user()->kat_user;
            switch($kat) {
                case 1:
                    return view('risk-officer.index');
                case 2:
                    return view('risk-owner.index');
                case 3:
                    return view('admin.index');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
