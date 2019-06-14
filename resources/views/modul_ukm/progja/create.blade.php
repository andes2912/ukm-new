@extends('layouts.ukm_template')
@section('title','Pengajuan Program Kerja')
@section('content')
@section('header','Pengajuan Program Kerja')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Form Pengajuan Program Kerja</h4>
            </div>
            <div class="card-body">
                <form action="{{route('ukm.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Program Kerja :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Program kerja">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">File Progja :</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="berkas" placeholder="Pilih File Untuk Diupload">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Penanggung Jawab :</label>
                                    <div class="col-md-9">
                                        <select class="form-control custom-select" name="penanggungjwb">
                                            <option value="">--Pilih Penanggung Jawab--</option>
                                            <option value="ukm">UKM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Deskripsi :</label>
                                    <div class="col-md-9">
                                        <textarea name="deskripsi" id="" cols="54" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tgl">
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