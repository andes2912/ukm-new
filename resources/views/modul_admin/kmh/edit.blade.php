@extends('layouts.admin_template')
@section('title','Edit Data KMH')
@section('content')
@section('header','Edit Data KMH')
<div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Form Edit Data KMH</h4>
                </div>
                <div class="card-body">
                    <form action="{{url('admin-user-update', $editkmh->id_user)}}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <hr class="m-t-0 m-b-40">
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Nama KMH :</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" value="{{$editkmh->name}}" placeholder="Nama KMH">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">E-mail KMH :</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="email" value="{{$editkmh->email}}" placeholder="E-mail KMH">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hiddeN" name="auth" value="KMH">
                            <div class="row">
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Status KMH :</label>
                                        <div class="col-md-9">
                                            <select class="form-control custom-select" name="status">
                                                <option value="1"@if($editkmh->status=='1') selected='selected' @endif >Aktif</option>
                                                <option value="0"@if($editkmh->status=='0') selected='selected' @endif >Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Password :</label>
                                        <div class="col-md-9">
                                            <input type="password" readonly class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <hr>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a href="{{url('admin-KMH')}}" class="btn btn-inverse">Cancel</a>
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