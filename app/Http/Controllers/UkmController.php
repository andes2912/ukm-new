<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\pengajuan;
use Auth;

class UkmController extends Controller
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
            'berkas' => $berkas
        ]);

        return redirect('progja-ukm-a');
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
        $edit = pengajuan::find($id);
        return view('modul_ukm.progja.edit', compact('edit'));
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
        $progja = pengajuan::where('pengaju',Auth::user()->name)
        ->whereIn('status',['Pengajuan','Pengajuan Ulang','Ditinjau BEM','Diteruskan ke KMH','Ditinjau KMH','Disetujui KMH','Direvisi KMH','Revisi Untuk KMH','Revisi BEM','Revisi Untuk BEM','Ditolak BEM','Disetujui','Ditolak KMH'])
        ->get();
        return view('modul_ukm.progja.aktif', compact('progja'));
    }

    // Index Program Kerja Dibatalkan
    public function progjaukmb()
    {
        $tunda = pengajuan::where('pengaju',Auth::user()->name)
        ->where('status','Dibatalkan')
        ->get();
        return view('modul_ukm.progja.batal', compact('tunda'));
    }

    // Index Program Kerja Ditunda
    public function progjaukmt()
    {
        $tunda = pengajuan::where('pengaju',Auth::user()->name)
        ->where('status','Ditunda')
        ->get();
        return view('modul_ukm.progja.tunda', compact('tunda'));
    }

    // Tunda Program Kerja
    public function tundaprogja(Request $request)
    {
        $tunda = pengajuan::find($request->id);
        $tunda->update([
            'status' => 'Ditunda',
        ]);
        return $tunda;
    }

    // Batal Program Kerja
    public function batalprogja(Request $request)
    {
        $tunda = pengajuan::find($request->id);
        $tunda->update([
            'status' => 'Dibatalkan',
        ]);
        return $tunda;
    }

    // Pengajuan Ulang Program Kerja
    public function ulangprogja(Request $request)
    {
        $tunda = pengajuan::find($request->id);
        $tunda->update([
            'status' => 'Pengajuan Ulang',
        ]);
        return $tunda;
    }

    // Program Kerja Dihapus/arsipkan
    public function hapusprogja(Request $request)
    {
        $tunda = pengajuan::find($request->id);
        $tunda->update([
            'status' => 'arsip',
        ]);
        return $tunda;
    }

    // Revisi Program kerja ke BEM
    public function revisibem(Request $request)
    {
        $revisi = pengajuan::find($request->id);
        // $upload = $request->file('berkas');
        // $berkas = $upload->store('public/storage');
        $revisi->update([
            'status' => 'Revisi Untuk BEM',
        ]);
        return $revisi;
    }

    // Revisi Program kerja ke BEM
    public function revisikmh(Request $request)
    {
        $revisi = pengajuan::find($request->id);
        // $upload = $request->file('berkas');
        // $berkas = $upload->store('public/storage');
        $revisi->update([
            'status' => 'Revisi Untuk KMH',
        ]);
        return $revisi;
    }
}
