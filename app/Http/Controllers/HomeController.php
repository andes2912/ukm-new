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
        if (Auth::user()->auth === "Admin") {
            return view('modul_admin.index');
        } elseif(Auth::user()->auth === "UKM") {
            return view('modul_ukm.index');
        } elseif(Auth::user()->auth === "BEM") {
            return view('modul_bem.index'); 
        } elseif(Auth::user()->auth === "KMH") {
            return view('modul_kmh.index');
        }
    }
}
