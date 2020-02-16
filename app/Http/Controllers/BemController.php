<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengajuan;
use App\anggota;
use App\catatan;
use Auth;

class BemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $user ;
    function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->user = \Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    // Download Berkas Program Kerja
    public function downberkasbem($id)
    {
        // $down = pengajuan::find($id);
        // return  Storage::download($down->berkas, $down->name);
        $entry = pengajuan::find($id);
        $pathToFile = public_path('/berkas/' . $entry->berkas);
        return response()->download($pathToFile);   
        
    }

    // Modul Program Kerja Aktif
    public function progjabema()
    {
       if (Auth::user()->auth === "BEM") {
            $aktif = pengajuan::selectRaw('pengajuans.*,a.nama as pic,b.name as nama_status')
            ->leftJoin('anggotas as a','a.id','=','pengajuans.pic')
            ->leftJoin('statuses as b','b.status_id','=','pengajuans.id_status')
            ->where('id_status','P20')
            ->get();
            return view('modul_bem.progja.aktif', compact('aktif'));
       } else {
           return redirect('home');
       }
    }

    // Modul Program Baru
    public function bemnew()
    {
        if (auth::user()->auth === "BEM") {
            $baru = pengajuan::selectRaw('pengajuans.*, a.nama as pic,b.name as nama_status')
            ->leftJoin('anggotas as a','a.id','=','pengajuans.pic')
            ->leftJoin('statuses as b','b.status_id','=','pengajuans.id_status')
            ->whereIn('id_status',['B101','P100'])->get();
            return view('modul_bem.progja.baru', compact('baru'));
        } else {
            return redirect('home');
        }
    }

    // Modul Program Revisi
    public function bemreivisi(Request $request, $id)
    {
        if (auth::user()->auth == "BEM") {
            $revisi = pengajuan::selectRaw('pengajuans.*,a.name,a.email')
            ->leftJoin('users as a','a.id_user','=','pengajuans.iduser')
            ->first();
            return view('modul_bem.progja.revisi', compact('revisi'));
        }
    }

    // Program Revisi Store
    public function bemrevisistore(Request $request)
    {
        if (auth::user()->auth == "BEM") {
            $revisi = new catatan;
            $revisi->id_pengajuan = $request->id_pengajuan;
            $revisi->catatan = $request->catatan;
            $revisi->id_status = 'P100';
            $revisi->iduser = auth::user()->id_user;
            if ($revisi->save()) {
                $rev = pengajuan::find($request->id_pengajuan);
                $rev->update([
                    'id_status' => 'P100'
                ]);
            }
            return redirect('progja-bem-new');
        }
    }

    // Setujui Program Kerja ke KMH
    public function setujuiBem(Request $request)
    {
        if (auth::user()->auth == "BEM") {
            $setujui = pengajuan::find($request->id);
            $setujui->update([
                'id_status' => 'K101',
            ]);
            return $setujui;
        }
    }

    // Tinjau Program Kerja
    public function tinjauprogja(Request $request)
    {
        if (Auth::user()->auth == "BEM") {
            $tinjau = pengajuan::find($request->id);
            $tinjau->update([
                'status' => 'Ditinjau BEM',
            ]);
            return $tinjau;
        } else {
            return redirect('/home');
        }
        
    }

    // Revisi Program Kerja
    public function revisiprogja(Request $request)
    {
        if (Auth::user()->auth == "BEM") {
            $tinjau = pengajuan::find($request->id);
            $tinjau->update([
                'status_bem' => 'Revisi BEM',
            ]);
            return $tinjau;
        } else {
            return redirect('/home');
        }
        
    }

    // Porgram Kerja Ditolak
    public function tolakprogja(Request $request)
    {
        if (Auth::user()->auth == "BEM") {
            $teruskan = pengajuan::find($request->id);
            $teruskan->update([
                'status_bem' => 'Ditolak BEM',
            ]);
            return $teruskan;
        } else {
            return redirect('/home');
        }
        
    }

    // Porgram Diteruskan ke Kemahasiswaan
    public function teruskanprogja(Request $request)
    {
        if (Auth::user()->auth == "BEM") {
            $teruskan = pengajuan::find($request->id);
            $teruskan->update([
                'status_bem' => 'Diteruskan ke KMH',
            ]);
            return $teruskan;
        } else {
            return redirect('/home');
        }
        
    }

    // View Program Kerja Ditolak
    public function tolakbem()
    {
        if (Auth::user()->auth == "BEM") {
            $tolak = pengajuan::where('id_status','P1001')->get();
            return view('modul_bem.progja.tolak', compact('tolak'));
        } else {
            return redirect('/home');
        }
    }

    // Hapus Program Kerja in view tolak
    public function hapusbem(request $request)
    {
        if (Auth::user()->auth == "BEM") {
            $hapus = pengajuan::find($request->id);
            $hapus->update([
                'status' => 'hapus bem',
            ]);
            return $hapus;
        } else {
            return redirect('/home');
        }
        
    }

    // View Laporan Bem
    public function laporanbem()
    {
       if (Auth::user()->auth == "BEM") {
            $laporan = pengajuan::all();
            return view('modul_bem.laporan.index', compact('laporan'));
       } else {
           return redirect('/home');
       }
       
    }
// Anggota BEM
    // View Anggota Bem
    public function anggotabem()
    {
        if (Auth::user()->auth == "BEM") {
            $anggota = anggota::where('status','Aktif')->where('id_ukm', Auth::user()->id_user)->get();
            return view('modul_bem.anggota.aktif', compact('anggota'));
        } else {
            return redirect('/home');
        }
        
    }

    public function addanggotabem()
    {
        if (Auth::user()->auth == "BEM") {
            return view('modul_bem.anggota.add');
        } else {
            return redirect('/home');
        }
        
    }

    public function storeanggotaukm(Request $request)
    {
        if (Auth::user()->auth == "BEM") {
            $addanggota = new anggota();
            $addanggota->nama       = $request->nama;
            $addanggota->id_ukm     = Auth::user()->id_user;
            $addanggota->jurusan    = $request->jurusan;
            $addanggota->angkatan   = $request->angkatan;
            $addanggota->alamat     = $request->alamat;
            $addanggota->no_telp    = $request->no_telp;
            $addanggota->status     = $request->status;
            $addanggota->save();

            return redirect('anggota-bem');
        } else {
            return redirect('/home');
        }
    }

    public function editanggotabem(Request $request)
    {
        if (Auth::user()->auth == "BEM") {
            $editanggota = anggota::find($request->id);
            $editanggota->update([
                'nama'      => $request->nama,
            'jurusan'   => $request->jurusan,
            'angkatan'  => $request->angkatan,
            'alamat'    => $request->alamat,
            'no_telp'   => $request->no_telp,
            'status'    => $request->status
            ]);

            return $editanggota;
        } else {
            return redirect('/home');
        }
    }

    // Tambah Jabatan BEM
    public function addjabatanbem(Request $request)
    {
        if (Auth::user()->auth == "BEM") {
            $addjabatan  = anggota::find($request->id);
            $addjabatan->update([
                'jabatan' => $request->jabatan,
            ]);
            return $addjabatan;
        } else {
            return redirect('home');
        }
    }

    // Struktur BEM
    public function strukturbem()
    {
        if (Auth::user()->auth == "BEM") {
            $struktur = anggota::whereNotIn('jabatan',[''])->where('id_ukm',Auth::user()->id_user)->get();
            return view('modul_bem.anggota.struktur', compact('struktur'));
        } else {
            return redirect('home');
        }
    }

    // Data Profile
    public function profilebem($id)
    {
        if (Auth::user()->auth == "BEM") {
            $anggota = anggota::where('id_ukm', Auth::user()->id_user)
            ->where('status','Aktif')
            ->orderBy('id','DESC')
            ->first()->find($id);
            return view('modul_bem.anggota.profile', compact('anggota'));
        } else {
            return redirect('home');
        }
    }

    // Data DP
    public function dpbem()
    {
        if (Auth::user()->auth == "BEM") {
            $dp = anggota::where('id_ukm',Auth::user()->id_user)
            ->where('status','Pembimbing')
            ->orderBy('id','DESC')
            ->get();
            return view('modul_bem.anggota.dp', compact('dp'));
        } else {
            return redirect('/home');
        }
    }
}
