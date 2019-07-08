<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengajuan;
use Auth;

class KmhController extends Controller
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

    public function progjakmha()
    {
        if (Auth::user()->auth == "KMH") {
            $aktif = pengajuan::whereIn('status',['Diteruskan ke KMH','Ditinjau KMH','Disetujui KMH','Direvisi KMH','Revisi Untuk KMH','Ditolak KMH'])->get();
            return view('modul_kmh.progja.aktif', compact('aktif'));
        } else {
            return redirect('/home');
        }
        
    }

    public function progjakmht()
    {
        if (Auth::user()->auth == "KMH") {
            $tolak = pengajuan::whereIn('status',['Ditolak KMH','Ditolak BEM'])->get();
            return view('modul_kmh.progja.tolak', compact('tolak'));
        } else {
            return redirect('/home');
        }
        
    }

    // Program Kerja Ditinjau KMH
    public function tinjauprogja(Request $request)
    {
        if (Auth::user()->auth == "KMH") {
            $tinjau = pengajuan::find($request->id);
            $tinjau->update([
                'status' => 'Ditinjau KMH',
            ]);
            return $tinjau;
        } else {
            return redirect('/home');
        }
        
    }

     // Program Kerja Disetujui KMH
     public function setujuiprogja(Request $request)
     {
        if (Auth::user()->auth == "KMH") {
            $tinjau = pengajuan::find($request->id);
            $tinjau->update([
                'status_kmh' => 'Disetujui KMH',
            ]);
            return $tinjau;
        } else {
            return redirect('/home');
        }
        
     }

     // Program Kerja Direvisi KMH
     public function revisiprogja(Request $request)
     {
         if (Auth::user()->auth == "KMH") {
            $tinjau = pengajuan::find($request->id);
            $tinjau->update([
                'status_kmh' => 'Direvisi KMH',
            ]);
            return $tinjau;
         } else {
             return redirect('/home');
         }
         
     }

     // Program Kerja Ditolak KMH
     public function tolakprogja(Request $request)
     {
         if (Auth::user()->auth == "KMH") {
            $tinjau = pengajuan::find($request->id);
            $tinjau->update([
                'status_kmh' => 'Ditolak KMH',
            ]);
            return $tinjau;
         } else {
            return redirect('/home');
         }
         
     }

}
