<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berkasrev extends Model
{
    protected $fillable = [
        'id_pengajuan','berkas_revisi','iduser','id_status'
    ];
}
