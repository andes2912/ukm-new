@extends('layouts.ukm_template')
@section('title','Tambah Anggota')
@section('header','Form Tambah Anggota')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Form Tambah Anggota</h4>
            </div>
            <div class="card-body">
                <form action="{{url('anggota-create-store')}}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-body">
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Nama :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_ukm">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Alamat :</label>
                                    <div class="col-md-9">
                                        <textarea name="alamat" id="" cols="54" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Jurusan :</label>
                                    <div class="col-md-9">
                                        <select class="form-control custom-select" name="jurusan">
                                            <option value="">--Pilih Jurusan--</option>
                                            <option value="TI">Teknik Informatika</option>
                                            <option value="SI">Sistem Informasi</option>
                                            <option value="AK">Akuntansi</option>
                                            <option value="MA">MANAJEMEN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Angkatan :</label>
                                    <div class="col-md-9">
                                        <select class="form-control custom-select" name="angkatan">
                                            <option value="">--Pilih Angkatan--</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Status :</label>
                                    <div class="col-md-9">
                                        <select class="form-control custom-select" name="status">
                                            <option value="">--Pilih Status--</option>
                                            <option value="Aktif">Anggota Aktif</option>
                                            <option value="Non-Aktif">Anggota Tidak Aktif</option>
                                            <option value="Pembembing">Pembimbing/Penasehat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">No. Telpon :</label>
                                    <div class="col-md-9">
                                        <input type="number" name="no_telp" class="form-control" placeholder="Nomor Telpon" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{url('progja-ukm-a')}}" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection