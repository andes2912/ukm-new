<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\pengajuan;
use Hash;
use Session;
use Auth;
use Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->auth === "Admin") {
            return view('modul_admin.index');
        } else {
            return redirect('home');
        }
        
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
    public function downberkas($id)
    {
        $down = pengajuan::find($id);
        return  Storage::download($down->berkas, $down->name);
    }


    // Modul UKM
    public function adminukm()
    {
        if (Auth::user()->auth === "Admin") {
            $ukm = User::where('auth','UKM')->get();
            return view('modul_admin.ukm.index', compact('ukm'));
        } else {
            return redirect('home');
        }
    }

    public function adminprogja()
    {
        $progja = pengajuan::whereIn('status',['Diteruskan ke KMH','Ditinjau KMH','Disetujui KMH'])->get();
        return view('modul_admin.ukm.progja', compact('progja'));
    }

    public function tinjauprogja(Request $request)
    {
        $tinjau = pengajuan::find($request->id);
        $tinjau->update([
            'status' => 'Ditinjau KMH'
        ]);
        return $tinjau;
    }

    public function setujuiprogja(Request $request)
    {
        $setujui = pengajuan::find($request->id);
        $setujui->update([
            'status' => 'Disetujui KMH'
        ]);
        return $setujui;
    }

    public function createukm()
    {
        if (Auth::user()->auth === "Admin") {
            return view('modul_admin.ukm.create');
        } else {
            return redirect('home');
        }
    }

    public function storeuser(Request $request)
    {
        if (Auth::user()->auth === "Admin") 
        {
            $adduser = New User();
            $adduser->name = $request->name;
            $adduser->email = $request->email;
            $adduser->status = $request->status;
            $adduser->auth = $request->auth;
            $adduser->password = Hash::make($request->password);
            $adduser->save();
            
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil Menambah UKM"
                ]);
                if ($adduser->auth == "UKM") {
                    return redirect('admin-ukm');
                } elseif($adduser->auth == "BEM") {
                    return redirect('admin-bem');
                } elseif($adduser->auth == "KMH") {
                    return redirect('admin-kmh');
                }
           
        } else {
            return redirect('home');
        }
    }

    public function editukm($id_user)
    {
        if (Auth::user()->auth === "Admin") {
            $editukm = User::find($id_user);
            return view('modul_admin.ukm.edit', compact('editukm'));
        } else {
            return redirect('home');
        }
    }

    public function updateuser(Request $request, $id_user)
    {
        if (Auth::user()->auth === "Admin") 
        {
            $adduser = User::find($id_user);
            $adduser->name = $request->name;
            $adduser->email = $request->email;
            $adduser->status = $request->status;
            $adduser->auth = $request->auth;
            $adduser->save();
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil Mengedit UKM"
                ]);
            if ($adduser->auth == "UKM") {
                return redirect('admin-ukm');
            } elseif($adduser->auth == "BEM") {
                return redirect('admin-bem');
            } elseif($adduser->auth == "KMH") {
                return redirect('admin-kmh');
            }
            
       } else {
           return redirect('home');
       }
    }

    // Modul BEM
    public function adminbem()
    {
        if (Auth::user()->auth === "Admin") {
            $bem = User::where('auth','BEM')->get();
            return view('modul_admin.bem.index', compact('bem'));
        } else {
            return redirect('home');
        }
    }
    public function createbem()
    {
        if (Auth::user()->auth === "Admin") {
            return view('modul_admin.bem.create');
        } else {
            return redirect('home');
        }
    }

    public function editbem($id_user)
    {
        if (Auth::user()->auth === "Admin") {
            $editbem = User::find($id_user);
            return view('modul_admin.bem.edit', compact('editbem'));
        } else {
            return redirect('home');
        }
    }

    // Modul Kemahasiswaan
    public function adminkmh()
    {
        $kmh = User::where('auth','KMH')->get();
        return view('modul_admin.kmh.index', compact('kmh'));
    }

    public function createkmh()
    {
        return view('modul_admin.kmh.create');
    }

    public function editkmh($id_user)
    {
        $editkmh = User::find($id_user);
        return view('modul_admin.kmh.edit', compact('editkmh'));
    }


    // Reset Password
    public function resetpwuser($id_user)
    {
        if (Auth::user()->auth === "Admin") 
        {
            $user = User::find($id_user);
            $user->password = bcrypt('12345678');
            $user->save();
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil Mereset Password"
                ]);
            if ($user->auth == "UKM") {
                return redirect('admin-ukm');
            } elseif($user->auth == "BEM") {
                return redirect('admin-bem');
            } elseif($user->auth == "KMH") {
                return redirect('admin-kmh');
            }
            
        } else {
            return redirect('home');
        }
    }
}
