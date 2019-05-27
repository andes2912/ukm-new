@extends('layouts.ukm_template')
@section('title','Struktur Anggota')
@section('header','Struktur Anggota')
@section('content')
<div class="container-fluid">
    <div class="row el-element-overlay">
        @foreach ($struktur as $item)
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1"> <img src="{{asset('asset/images/users/5.jpg')}}" alt="user" />
                        <div class="el-overlay scrl-dwn">
                            <ul class="el-info">
                                <li><a class="btn default btn-outline image-popup-vertical-fit" href="#"><i class="icon-magnifier"></i></a></li>
                                <li><a class="btn default btn-outline" href="javascript:void(0);"><i class="icon-link"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="el-card-content">
                        <h3 class="box-title">{{$item->nama}}</h3> <small>{{$item->jabatan}}</small>
                        <br/> 
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection