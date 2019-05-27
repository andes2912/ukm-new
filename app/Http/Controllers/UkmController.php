<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\pengajuan;
use App\anggota;
use Auth;
use carbon\carbon;

class UkmController extends Controller
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
        if (Auth::user()->auth === "UKM") {
            return view('modul_ukm.progja.create');
        } else {
            return redirect('home');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->auth == "UKM") {
            $this->validate($request, [
                'berkas' => 'required|file|max:2000'
            ]);
            $noid = pengajuan::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 8,"1") as no_id')-> first();
            $upload = $request->file('berkas');  
            $berkas = $upload->store('public/storage');
            $pnt = pengajuan::create([
                'name' => $request->name,
                'no_id' => '#P' . $noid->no_id,
                'pengaju' => Auth::user()->name,
                'status' => 'Pengajuan',
                'penanggungjwb' => $request->penanggungjwb,
                'deskripsi' => $request->deskripsi,
                'tgl'       => Carbon::now()->day,
                'berkas' => $berkas
            ]);
    
            return redirect('progja-ukm-a');
        } else {
            return redirect('/home');
        }
        
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
        if (Auth::user()->auth == "UKM") {
            $edit = pengajuan::find($id);
            return view('modul_ukm.progja.edit', compact('edit'));
        } else {
            return redirect('/home');
        }
        
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

    // Index Program Kerja Aktif
    public function progjaukma()
    {
        if (Auth::user()->auth == "UKM") {
            $progja = pengajuan::where('pengaju',Auth::user()->name)
            ->whereIn('status',['Pengajuan','Pengajuan Ulang','Ditinjau BEM','Diteruskan ke KMH','Ditinjau KMH','Disetujui KMH','Direvisi KMH','Revisi Untuk KMH','Revisi BEM','Revisi Untuk BEM','Ditolak BEM','Disetujui','Ditolak KMH'])
            ->get();
            return view('modul_ukm.progja.aktif', compact('progja'));
        } else {
            return redirect('/home');
        }
        
    }

    // Index Program Kerja Dibatalkan
    public function progjaukmb()
    {
        if (Auth::user()->auth == "UKM") {
            $batal = pengajuan::where('pengaju',Auth::user()->name)
            ->where('status','Dibatalkan')
            ->get();
            return view('modul_ukm.progja.batal', compact('batal'));
        } else {
            return redirect('/home');
        }
        
    }

    // Index Program Kerja Ditunda
    public function progjaukmt()
    {
        if (Auth::user()->auth == "UKM") {
            $tunda = pengajuan::where('pengaju',Auth::user()->name)
            ->where('status','Ditunda')
            ->get();
            return view('modul_ukm.progja.tunda', compact('tunda'));
        } else {
            return redirect('/home');
        }
        
    }

    // Tunda Program Kerja
    public function tundaprogja(Request $request)
    {
        if (Auth::user()->auth == "UKM") {
            $tunda = pengajuan::find($request->id);
        $tunda->update([
            'status' => 'Ditunda',
        ]);
        return $tunda;
        } else {
            return redirect('/home');
        }
        
    }

    // Batal Program Kerja
    public function batalprogja(Request $request)
    {
       if (Auth::user()->auth == "UKM") {
            $tunda = pengajuan::find($request->id);
            $tunda->update([
                'status' => 'Dibatalkan',
            ]);
            return $tunda;
       } else {
           return redirect('/home');
       }
       
    }

    // Pengajuan Ulang Program Kerja
    public function ulangprogja(Request $request)
    {
       if (Auth::user()->auth == "UKM") {
            $tunda = pengajuan::find($request->id);
            $tunda->update([
                'status' => 'Pengajuan Ulang',
            ]);
            return $tunda;
       } else {
           return redirect('/home');
       }
       
    }

    // Program Kerja Dihapus/arsipkan
    public function hapusprogja(Request $request)
    {
       if (Auth::user()->auth == "UKM") {
            $tunda = pengajuan::find($request->id);
            $tunda->update([
                'status' => 'arsip',
            ]);
            return $tunda;
       } else {
            return redirect('/home');
       }
       
    }

    // Revisi Program kerja ke BEM
    public function revisibem(Request $request)
    {if (Auth::user()->auth == "UKM") {
        $revisi = pengajuan::find($request->id);
        $revisi->update([
            'status' => 'Revisi Untuk BEM',
        ]);
        return $revisi;
    } else {
        return redirect('/home');
    }
    
    }

    // Revisi Program kerja ke BEM
    public function revisikmh(Request $request)
    {
       if (Auth::user()->auth == "UKM") {
            $revisi = pengajuan::find($request->id);
            $revisi->update([
                'status' => 'Revisi Untuk KMH',
            ]);
            return $revisi;
       } else {
           return redirect('/home');
       }
       
    }

    
    //  View Program Kerja Arsip
    public function arsipv()
    {
        if (Auth::user()->auth == "UKM") {
            $arsip = pengajuan::where('status','arsip')->get();
            return view('modul_ukm.progja.arsip', compact('arsip'));
        } else {
            return redirect('/home');
        }
        
    }

// Modul Anggota UKM

    // View Anggota UKM
    public function anggota()
    {
       if (Auth::user()->auth == "UKM") {
            $anggota = anggota::where('id_ukm', Auth::user()->id_user)
            ->where('status','Aktif')
            ->orderBy('id','DESC')
            ->get();
            return view('modul_ukm.anggota.index', compact('anggota'));
       } else {
           return redirect('/home');
       }
       
    }

    // Tambah Anggota UKM
    public function createAnggota()
    {
        if (Auth::user()->auth == "UKM") {
            return view('modul_ukm.anggota.create');
        } else {
            return redirect('/home');
        }
        
    }

    // Store Tambah Anggota
    public function storeanggota(Request $request)
    {
        if (Auth::user()->auth == "UKM") {
            $addanggota = new anggota();
            $addanggota->nama       = $request->nama;
            $addanggota->id_ukm     = Auth::user()->id_user;
            $addanggota->jurusan    = $request->jurusan;
            $addanggota->angkatan   = $request->angkatan;
            $addanggota->alamat     = $request->alamat;
            $addanggota->no_telp    = $request->no_telp;
            $addanggota->status     = $request->status;
            $addanggota->gender     = $request->gender;
            $addanggota->save();
            
            if ($addanggota->status == "Aktif") {
                return redirect('anggota');
            } else {
                return redirect('dp');
            }
        } else {
            return redirect('/home');
        }
        
    }

    // Edit Tambah Anggota
    public function editanggota(Request $request)
    {
       if (Auth::user()->auth == "UKM") {
            $edit = anggota::find($request->id);
            $edit->update([
                'nama'      => $request->nama,
                'jurusan'   => $request->jurusan,
                'angkatan'  => $request->angkatan,
                'alamat'    => $request->alamat,
                'no_telp'   => $request->no_telp,
                'status'    => $request->status
            ]);
            return $edit;
       } else {
           return redirect('home');
       }
    }

    // Tambah Jabatan
    public function addjabatan(Request $request)
    {
        if (Auth::user()->auth == "UKM") {
            $add = anggota::find($request->id);
            $add->update([
                'jabatan' => $request->jabatan,
            ]);
            return $add;
        } else {
            return redirect('/home');
        }
        
    }

    // Struktur Anggota
    public function struktur()
    {
        if (Auth::user()->auth == "UKM") {
            $struktur = anggota::whereNotIn('jabatan',[''])->where('id_ukm',Auth::user()->id_user)->get();
            return view('modul_ukm.anggota.struktur', compact('struktur'));
        } else {
            return redirect('home');
        }
    }

    // Data DP
    public function dp()
    {
        if (Auth::user()->auth == "UKM") {
            $dp = anggota::where('id_ukm',Auth::user()->id_user)
            ->where('status','Pembimbing')
            ->orderBy('id','DESC')
            ->get();
            return view('modul_ukm.anggota.dp', compact('dp'));
        } else {
            return redirect('/home');
        }
    }
}
