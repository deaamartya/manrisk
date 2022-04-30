<?php

namespace App\Http\Controllers\RiskOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return 'index';
    }

    public function table() {
        return view('risk-officer.table');
    }

    public function form() {
        return view('risk-officer.form');
    }
}
