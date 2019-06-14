<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kegiatan extends Model
{
    protected $fillable = [
        'id_uk','nama_kegiatan','status','pelaksanaan'
    ];
}
