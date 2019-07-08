@extends('layouts.ukm_template')
@section('title','Dashboard UKM')
@section('content')
<div class="row">
    <div class="col-lg-6 col-md-6">
        <!-- LINE CHART -->
        <div class="card">
            <div class="card-body">
            {{-- <h4 class="card-title m-b-0">Grafik Jumlah Pengajuan Program kerja</h4> --}}
        </div>
            <div class="card-body">
            <div class="amp-pxl m-t-130" style="height: 320px;" id="linechart"></div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Anggota Aktif</h4>
                <div class="d-flex">
                    <div class="align-self-center">
                        <h4 class="font-medium m-b-0"><i class="ti-angle-up text-success"></i>  {{$aktif}}</h4></div>
                    <div class="ml-auto">
                        <div id="spark8"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Laki-laki</h4>
                <div class="d-flex">
                    <div class="align-self-center">
                        <h4 class="font-medium m-b-0"><i class="ti-angle-down text-danger"></i>  {{$laki}}</h4></div>
                    <div class="ml-auto">
                        <div id="spark9"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Anggota Non-aktif</h4>
                <div class="d-flex">
                    <div class="align-self-center">
                        <h4 class="font-medium m-b-0"><i class="ti-angle-up text-success"></i> {{$nonaktif}}</h4></div>
                    <div class="ml-auto">
                        <div id="spark10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dewan Pimbimbing</h4>
                <div class="d-flex">
                    <div class="align-self-center">
                        <h4 class="font-medium m-b-0"><i class="ti-angle-up text-success"></i>  {{$dp}}</h4></div>
                    <div class="ml-auto">
                        <div id="spark11"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Perempuan</h4>
                <div class="d-flex">
                    <div class="align-self-center">
                        <h4 class="font-medium m-b-0"><i class="ti-angle-down text-danger"></i>  {{$perempuan}}</h4></div>
                    <div class="ml-auto">
                        <div id="spark12"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Keseluruhan</h4>
                <div class="d-flex">
                    <div class="align-self-center">
                        <h4 class="font-medium m-b-0"><i class="ti-angle-up text-success"></i> {{$all}}</h4></div>
                    <div class="ml-auto">
                        <div id="spark13"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <button class="pull-right btn btn-sm btn-rounded btn-success" data-toggle="modal" data-target="#myModal">Tambah</button>
                <h4 class="card-title">Program Kerja Harian </h4>
            <div class="comment-widgets m-b-20">
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row">
                    <div class="comment-text active w-100">
                        <h5>James Anderson</h5>
                        <div class="comment-footer">
                            <span class="date">April 14, 2016</span>
                            <span class="label label-info">Pending</span> <span class="action-icons active">
                                <a href="javascript:void(0)"><i class="mdi mdi-pencil-circle"></i></a>
                                <a href="javascript:void(0)"><i class="mdi mdi-checkbox-marked-circle"></i></a>
                                <a href="javascript:void(0)"><i class="mdi mdi-heart"></i></a>    
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @include('modul_ukm.kegiatan.add')
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <button class="pull-right btn btn-sm btn-rounded btn-info" data-toggle="modal" data-target="#myModal">Tambah</button>
                <h4 class="card-title">Program Kerja Mingguan</h4>
            <div class="comment-widgets m-b-20">
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row">
                    <div class="comment-text active w-100">
                        <h5>James Anderson</h5>
                        <div class="comment-footer">
                            <span class="date">April 14, 2016</span>
                            <span class="label label-info">Pending</span> <span class="action-icons active">
                                <a href="javascript:void(0)"><i class="mdi mdi-pencil-circle"></i></a>
                                <a href="javascript:void(0)"><i class="mdi mdi-checkbox-marked-circle"></i></a>
                                <a href="javascript:void(0)"><i class="mdi mdi-heart"></i></a>    
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <button class="pull-right btn btn-sm btn-rounded btn-primary" data-toggle="modal" data-target="#myModal">Tambah</button>
                <h4 class="card-title">Program Kerja Bulanan</h4>
            <div class="comment-widgets m-b-20">
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row">
                    <div class="comment-text active w-100">
                        <h5>James Anderson</h5>
                        <div class="comment-footer">
                            <span class="date">April 14, 2016</span>
                            <span class="label label-info">Pending</span> <span class="action-icons active">
                                <a href="javascript:void(0)"><i class="mdi mdi-pencil-circle"></i></a>
                                <a href="javascript:void(0)"><i class="mdi mdi-checkbox-marked-circle"></i></a>
                                <a href="javascript:void(0)"><i class="mdi mdi-heart"></i></a>    
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(function () {
    "use strict";
// ============================================================== 
    // sparkline chart
    // ==============================================================
    var sparklineLogin = function() { 
       
       $('.spark-count').sparkline([4, 5, 0, 10, 9, 12, 4, 9, 4, 5, 3, 10, 9, 12, 10, 9, 12, 4, 9], {
           type: 'bar'
           , width: '100%'
           , height: '70'
           , barWidth: '2'
           , resize: true
           , barSpacing: '6'
           , barColor: 'rgba(255, 255, 255, 0.3)'
       });
       
       $('.spark-count2').sparkline([4, 5, 0, 10, 9, 12, 4, 9, 4, 5, 3, 10, 9, 12, 10, 9, 12, 4, 9], {
           type: 'bar'
           , width: '100%'
           , height: '70'
           , barWidth: '2'
           , resize: true
           , barSpacing: '6'
           , barColor: 'rgba(255, 255, 255, 0.3)'
       });
       
       $('#spark8').sparkline([ 4, 5, 0, 10, 9, 12, 4, 9], {
           type: 'bar',
           width: '100%',
           height: '40',
           barWidth: '4',
           resize: true,
           barSpacing: '5',
           barColor: '#26c6da'
       });
        $('#spark9').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
           type: 'bar',
           width: '100%',
           height: '40',
           barWidth: '4',
           resize: true,
           barSpacing: '5',
           barColor: '#ef5350'
       });
         $('#spark10').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
           type: 'bar',
           width: '100%',
           height: '40',
           barWidth: '4',
           resize: true,
           barSpacing: '5',
           barColor: '#7460ee'
       });
        $('#spark11').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
           type: 'bar',
           width: '100%',
           height: '40',
           barWidth: '4',
           resize: true,
           barSpacing: '5',
           barColor: '#7460ee'
       });
       $('#spark12').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
           type: 'bar',
           width: '100%',
           height: '40',
           barWidth: '4',
           resize: true,
           barSpacing: '5',
           barColor: '#26c6da'
       });
       $('#spark13').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
           type: 'bar',
           width: '100%',
           height: '40',
           barWidth: '4',
           resize: true,
           barSpacing: '5',
           barColor: '#ef5350'
       });
  }
   var sparkResize;

       $(window).resize(function(e) {
           clearTimeout(sparkResize);
           sparkResize = setTimeout(sparklineLogin, 500);
       });
       sparklineLogin();
    });

    $(function () {
        $('#linechart').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Jumlah Program kerja'
            },

            credits: {enabled: false},
            xAxis: {
                categories: ['Grafik Jumlah Program kerja'],
                crosshair: true
            },series: [{
                name: 'Pengajuan',
                data: [{{$pengajuan}}]
            },{
                name: 'Ditolak',
                data: [{{$tolak}}]
            },{
                name: 'Disetujui',
                data: [{{$setujui}}]
            }]
        });
    });
</script>
@endsection