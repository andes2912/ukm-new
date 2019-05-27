<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\pengajuan;

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
        if(Auth::check()){
            if (Auth::user()->auth === "Admin") {
                return view('modul_admin.index');
            } elseif(Auth::user()->auth === "UKM") {
                return view('modul_ukm.index');
            } elseif(Auth::user()->auth === "BEM") {

                $data = DB::table('pengajuans')
                ->  select('tgl', DB::raw('count(id) AS jml'))
                ->  whereYear('created_at','=',date("Y", strtotime(now())))
                ->  whereMonth('created_at','=',date("m", strtotime(now())))
                ->  groupBy('tgl')
                ->  get();

                $tanggal = '';
                $batas =  31;
                $nilai = '';
                for($_i=1; $_i <= $batas; $_i++){
                    $tanggal = $tanggal . (string)$_i . ',';
                    $_check = false;
                    foreach($data as $_data){
                        if((int)@$_data->tgl === $_i){
                            $nilai = $nilai . (string)$_data->jml . ',';
                            $_check = true;
                        }
                    }
                    if(!$_check){
                        $nilai = $nilai . '0,';
                    }
                }

                $setujui = pengajuan::whereIn('status',['Disetujui KMH,Diteruskan ke KMH'])->count();
                $tolak = pengajuan::where('status','Ditolak BEM')->count();
                $all = pengajuan::count();
                return view('modul_bem.index', compact('setujui','tolak','all'))
                // -> with('setujui')
                -> with('_tanggal', substr($tanggal, 0,-1))
                -> with('_nilai', substr($nilai, 0, -1));

            } elseif(Auth::user()->auth === "KMH") {
                return view('modul_kmh.index');
            } else {
                Auth::logout();
            }
        }
    }
}
