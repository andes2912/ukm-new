@extends('layouts.kmh_template')
@section('title','Dashboard Kemahasiswaan')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <div class="col-8"><h2>{{$ukm}} <i class=" font-14 text-danger"></i></h2>
                        <h6>Jumlah UKM</h6></div>
                    <div class="col-4 align-self-center text-right  p-l-0">
                        <div id="sparklinedash3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <div class="col-8"><h2 class="">{{$anggota}} <i class=" font-14 text-success"></i></h2>
                        <h6>Jumlah Anggota UKM</h6></div>
                    <div class="col-4 align-self-center text-right p-l-0">
                        <div id="sparklinedash"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <div class="col-8"><h2>{{$bem}} <i class=" font-14 text-success"></i></h2>
                        <h6>Jumlah Anggota BEM</h6></div>
                    <div class="col-4 align-self-center text-right p-l-0">
                        <div id="sparklinedash2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <div class="col-8"><h2>35% <i class=" font-14 text-danger"></i></h2>
                        <h6>Jumlah Anggota MPM</h6></div>
                    <div class="col-4 align-self-center text-right p-l-0">
                        <div id="sparklinedash4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <!-- LINE CHART -->
        <div class="card">
          <div class="card-body">
            <h4 class="card-title m-b-0">Grafik Jumlah Pengajuan Program kerja</h4>
        </div>
          <div class="card-body">
            <div class="amp-pxl m-t-90" style="height: 390px;" id="linechart"></div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-lg-4 col-md-5">
        <!-- Column -->
        <div class="card card-default">
            <div class="card-header">
                <h4 class="card-title m-b-0">Grafik Keseluruhan</h4>
            </div>
            <div class="card-body collapse show">
            <div id="morris-donut-chart" class="ecomm-donute" style="height: 317px;"></div>
                <ul class="list-inline m-t-20 text-center">
                <li >
                    <h6 class="text-muted"><i class="fa fa-circle text-success"></i> Disetujui</h6>
                    <h4 class="m-b-0">{{$setujui}}</h4>
                </li>
                <li>
                    <h6 class="text-muted"><i class="fa fa-circle text-primary"></i> Ditolak</h6>
                    <h4 class="m-b-0">{{$tolak}}</h4>
                </li>
                <li>
                    <h6 class="text-muted"> <i class="fa fa-circle text-danger"></i> Masuk</h6>
                    <h4 class="m-b-0">{{$all}}</h4>
                </li>
            </ul>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(function () {
    "use strict";
    // ============================================================== 
   // ============================================================== 
   // Morris donut chart
   // ==============================================================       
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Disetujui",
            value: {{$setujui}},

        }, {
            label: "Ditolak",
            value: {{$tolak}},
        }, {
            label: "Masuk",
            value: {{$all}}
        }],
        resize: true,
        colors:['#26c6da', '#1976d2', '#ef5350']
    });
    // ============================================================== 
    // sales difference
    // ==============================================================
    
    // ============================================================== 
    // sparkline chart
    // ==============================================================
    var sparklineLogin = function() { 
       $('#sparklinedash').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#26c6da'
        });
         $('#sparklinedash2').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#7460ee'
        });
          $('#sparklinedash3').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#03a9f3'
        });
           $('#sparklinedash4').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '50',
            barWidth: '2',
            resize: true,
            barSpacing: '5',
            barColor: '#f62d51'
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
            text: 'Grafik Pengajuan Proposal'
        },
        yAxis: {
            title: {
                text: 'Jumlah Pengajuan Proposal'
            }

        },
        credits: {enabled: false},
        xAxis: {
            categories: [{{ $_tanggal }}],
            crosshair: true
        },series: [{
            name: 'Jumlah',
            data: [{{ $_nilai }}],
        }]
    });
});
</script>
@endsection