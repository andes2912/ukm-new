@extends('layouts.ukm_template')
@section('title','Dewan Pembimbing')
@section('header','Data Dewan Pembimbing')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><a href="{{url('anggota-create')}}" class="btn btn-primary">Tambah</a></h4>
            <div class="table-responsive">
                <table class="table color-table dark-table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No. Telp</th>
                            <th>Jurusan</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($dp as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->no_telp}}</td>
                                <td>
                                    @if ($item->jurusan == "TI")
                                        <span class="label label-primary">Teknik Informatika</span>
                                    @elseif($item->jurusan == "SI")
                                        <span class="label label-primary">Sistem Informasi</span>
                                    @elseif($item->jurusan == "AK")
                                        <span class="label label-primary">Akuntansi</span>
                                    @elseif($item->jurusan == "MA")
                                        <span class="label label-primary">Manajemen</span>
                                    @endif
                                </td>
                                <td>{{$item->angkatan}}</td>
                                <td>
                                    @if ($item->status == "Aktif")
                                        <span class="label label-primary">Anggota Aktif</span>
                                    @elseif($item->status == "Non-Aktif")
                                        <span class="label label-warning">Tidak Aktif</span>
                                    @else
                                        <span class="label label-warning">Pembimbing</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="" class="btn btn-sm btn-info">Profile</a>
                                    <a data-id={{$item->id}} 
                                        data-id-name={{$item->nama}}
                                        data-id-alamat={{$item->alamat}}
                                        data-id-no={{$item->no_telp}}
                                        data-id-jur={{$item->jurusan}}
                                        data-id-angkatan={{$item->angkatan}}
                                        data-id-status={{$item->status}}
                                    class="btn btn-sm btn-warning" data-toggle="modal" data-target="#tampil" id="edit" style="color:white" >Edit</a>
                                </td>
                            </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
                @include('modul_ukm.anggota.edit')
            </div>
        </div>
    </div>
</div>
@endsection