@extends('layouts.ukm_template')
@section('title','Revisi Program Kerja')
@section('content')
@section('header','Revisi Program Kerja')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Form Revisi Program Kerja</h4>
            </div>
            <div class="card-body">
                <form action="{{url('program-kerja-revisi',$revisi->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">No Pengajuan :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$revisi->no_pengajuan}}" disabled>
                                        <input type="hidden" name="id_pengajuan" value="{{$revisi->id}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Program Kerja :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$revisi->judul}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tgl Pengajuan :</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{$revisi->created_at->format('d-m-Y')}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">File Revisi :</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="berkas_revisi" placeholder="Pilih File Untuk Diupload">
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