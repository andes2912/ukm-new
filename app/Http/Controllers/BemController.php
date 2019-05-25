<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengajuan;
use Storage;
use Auth;

class BemController extends Controller
{
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
        $down = pengajuan::find($id);
        return  Storage::download($down->berkas, $down->name);
    }

    // Modul Program Kerja Aktif
    public function progjabema()
    {
       if (Auth::user()->auth === "BEM") {
            $aktif = pengajuan::whereIn('status',['Pengajuan','Pengajuan Ulang','Ditinjau BEM','Revisi BEM','Revisi Untuk BEM','Ditolak BEM','Diteruskan ke KMH','Revisi','Ditolak','Disetujui'])
            ->get();
            return view('modul_bem.progja.aktif', compact('aktif'));
       } else {
           return redirect('home');
       }
       
    }

    // Tinjau Program Kerja
    public function tinjauprogja(Request $request)
    {
        $tinjau = pengajuan::find($request->id);
        $tinjau->update([
            'status' => 'Ditinjau BEM',
        ]);
        return $tinjau;
    }

    // Revisi Program Kerja
    public function revisiprogja(Request $request)
    {
        $tinjau = pengajuan::find($request->id);
        $tinjau->update([
            'status' => 'Revisi BEM',
        ]);
        return $tinjau;
    }

    // Porgram Kerja Ditolak
    public function tolakprogja(Request $request)
    {
        $teruskan = pengajuan::find($request->id);
        $teruskan->update([
            'status' => 'Ditolak BEM',
        ]);
        return $teruskan;
    }

    // Porgram Diteruskan ke Kemahasiswaan
    public function teruskanprogja(Request $request)
    {
        $teruskan = pengajuan::find($request->id);
        $teruskan->update([
            'status' => 'Diteruskan ke KMH',
        ]);
        return $teruskan;
    }
}
