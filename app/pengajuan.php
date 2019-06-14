<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    protected $fillable = [
        'no_id','name','status','penanggungjwb','berkas','deskripsi','pengaju','tgl','status_bem','status_kmh'
    ];
}
