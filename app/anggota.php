<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    protected $fillable = [
        'nama','alamat','no_telp','jurusan','angkatan','jabatan','status','id_ukm'
    ];
}
