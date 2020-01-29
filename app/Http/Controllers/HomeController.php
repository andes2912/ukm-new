<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\pengajuan;
use App\user;
use App\anggota;

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
                $setujui = pengajuan::whereIn('id_status',['Disetujui KMH','Disetujui BEM'])
                ->where('iduser',Auth::user()->id)
                ->count();
                $tolak = pengajuan::whereIn('id_status',['Ditolak KMH','Ditolak BEM','arsip'])
                ->where('iduser',Auth::user()->id)
                ->count();
                $pengajuan = pengajuan::all()
                ->where('iduser',Auth::user()->id_user)
                ->count();
                $aktif = anggota::where('status','Aktif')
                ->where('id_ukm',Auth::user()->id_user)->count();
                $dp = anggota::where('status','Pembimbing')
                ->where('id_ukm',Auth::user()->id_user)->count();
                $laki = anggota::where('status','Aktif')
                ->where('gender','L')
                ->where('id_ukm',Auth::user()->id_user)->count();
                $perempuan = anggota::where('status','Aktif')
                ->where('gender','P')
                ->where('id_ukm',Auth::user()->id_user)->count();
                $nonaktif = anggota::where('status','Non-Aktif')
                ->where('id_ukm',Auth::user()->id_user)->count();
                $all = anggota::where('id_ukm',Auth::user()->id_user)->count();
                return view('modul_ukm.index', compact('setujui','tolak','pengajuan','aktif','dp','laki','perempuan','nonaktif','all'));

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

                $setujui = pengajuan::whereIn('id_status',['Disetujui KMH' ,'Diteruskan ke KMH'])->count();
                $tolak = pengajuan::where('id_status','Ditolak BEM')->count();
                $all = pengajuan::count();
                $ukm = user::where('auth','UKM')->count();
                $anggota = anggota::where('status','Aktif')->whereNotIn('id_ukm', [Auth::user()->id_user])->count();
                $bem = anggota::where('status','Aktif')->where('id_ukm', Auth::user()->id_user)->count();

                return view('modul_bem.index', compact('setujui','tolak','all','ukm','anggota','bem'))
                -> with('_tanggal', substr($tanggal, 0,-1))
                -> with('_nilai', substr($nilai, 0, -1));

            } elseif(Auth::user()->auth === "KMH") {

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

                $setujui = pengajuan::whereIn('id_status',['Disetujui KMH' ,'Diteruskan ke KMH'])->count();
                $tolak = pengajuan::where('id_status','Ditolak KMH')->count();
                $all = pengajuan::count();
                $ukm = user::where('auth','UKM')->count();
                $anggota = anggota::where('status','Aktif')->whereNotIn('id_ukm', [Auth::user()->id_user])->count();
                $bem = anggota::selectRaw('anggotas.id,anggotas.id_ukm, anggotas.status,a.id_user')
                ->leftJoin('Users as a' , 'a.id_user' , '=' ,'anggotas.id_ukm')
                ->where('anggotas.status','Aktif')
                ->count();
                return view('modul_kmh.index', compact('setujui','tolak','all','ukm','anggota','bem'))
                -> with('_tanggal', substr($tanggal, 0,-1))
                -> with('_nilai', substr($nilai, 0, -1));
            } else {
                Auth::logout();
            }
        }
    }
}
