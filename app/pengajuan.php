<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    protected $fillable = [
        'no_pengajuan','judul','deskripsi','tgl','bln','thn','mulai','selesai','iduser','id_status','pic','berkas'
    ];
}
