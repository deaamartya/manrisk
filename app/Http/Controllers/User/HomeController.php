<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return 'index';
    }

    public function table() {
        return view('user.table');
    }

    public function form() {
        return view('user.form');
    }
}
