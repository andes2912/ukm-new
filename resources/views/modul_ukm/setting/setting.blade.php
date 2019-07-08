@extends('layouts.ukm_template')
@section('title','Setting Data UKM')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Setting Data UKM</h4>
            </div>
            <div class="card-body">
                <form action="{{url('anggota-create-store')}}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <div class="form-group  has-success">
                                    <label class="control-label">Nama :</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" required>
                                </div>
                            </div>
                            <!--/span-->
    
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-success">
                                    <label class="control-label">Jurusan :</label>
                                    <select class="form-control custom-select" name="jurusan">
                                        <option value="">--Pilih Jurusan--</option>
                                        <option value="TI">Teknik Informatika</option>
                                        <option value="SI">Sistem Informasi</option>
                                        <option value="AK">Akuntansi</option>
                                        <option value="MA">MANAJEMEN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group  has-success">
                                    <label class="control-label">Status :</label>
                                    <select class="form-control custom-select" name="status">
                                        <option value="">--Pilih Status--</option>
                                        <option value="Aktif">Anggota Aktif</option>
                                        <option value="Non-Aktif">Anggota Tidak Aktif</option>
                                        <option value="Pembimbing">Pembimbing/Penasehat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-success">
                                    <label class="control-label">Angkatan :</label>
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
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group  has-success">
                                    <label class="control-label">Alamat :</label>
                                    <textarea name="alamat" id="" cols="54" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group  has-success">
                                    <label class="control-label">Gender :</label>
                                    <select class="form-control custom-select" name="gender">
                                        <option value="">--Pilih Gender--</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group  has-success">
                                    <label class="control-label">Nomor Telp :</label>
                                    <input type="number" name="no_telp" class="form-control" placeholder="Nomor Telpon" required>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{url('anggota')}}" class="btn btn-inverse">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection