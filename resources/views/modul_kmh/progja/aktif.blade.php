@extends('layouts.kmh_template')
@section('title','KMH - Progja Aktif')
@section('header','Data Program Kerja Aktif')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive m-t-0">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Pengajuan</th>
                            <th>Program Kerja</th>
                            <th>Pengaju</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($aktif as $item)
                            <tr style="color:black">
                                <td>{{$no}}</td>
                                <td style="font-weight:bold">{{$item->no_id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->pengaju}}</td>
                                <td>
                                    @if ($item->status == "Diteruskan ke KMH")
                                        <span class="label label-info">Butuh Ditinjau</span>
                                    @elseif($item->status == "Ditinjau KMH")
                                        <a href="{{url('download-berkas', $item->id)}}" class="btn btn-sm btn-info">Lihat Berkas</a>
                                    @elseif($item->status == "Disetujui KMH")
                                        <span class="label label-success">Proposal Disetujui</span>
                                    @elseif($item->status == "Direvisi KMH")
                                        <span class="label label-warning">Revisi Terkirim</span>
                                    @elseif($item->status == "Revisi Untuk KMH")
                                        <span class="label label-warning">Revisi Diterima</span>
                                    @elseif($item->status == "Ditolak KMH")
                                        <span class="label label-danger">Proposal Ditolak</span>
                                    @endif    
                                </td>
                                <td>
                                    @if ($item->status == "Diteruskan ke KMH")
                                        <a class="btn btn-sm btn-success" data-id-tinjau="{{$item->id}}" id="tinjau" style="color:white">Tinjau</a>
                                        <a class="btn btn-sm btn-warning disabled">Batal</a>
                                    @elseif($item->status == "Ditinjau KMH")
                                        <a class="btn btn-sm btn-success" data-id-setujui="{{$item->id}}" id="setujui" style="color:white">Setujui</a>
                                        <a class="btn btn-sm btn-warning" data-id-rev="{{$item->id}}" id="revisi" style="color:white">Revisi</a>
                                        <a class="btn btn-sm btn-danger" data-id-tolak="{{$item->id}}" id="tolak" style="color:white">Tolak</a>
                                    @elseif($item->status == "Disetujui KMH")
                                        <a href="{{url('download-berkas', $item->id)}}" class="btn btn-sm btn-info">Lihat Berkas</a>
                                    @elseif($item->status == "Direvisi KMH")
                                        <button class="btn btn-sm btn-success disabled">Setujui</button>
                                        <button class="btn btn-sm btn-warning disabled">Revisi</button>
                                        <button class="btn btn-sm btn-danger disabled">Tolak</button>
                                    @elseif($item->status == "Revisi Untuk KMH")
                                        <a class="btn btn-sm btn-success" data-id-setujui="{{$item->id}}" id="setujui" style="color:white">Setujui</a>
                                        <a class="btn btn-sm btn-warning" data-id-rev="{{$item->id}}" id="revisi" style="color:white">Revisi</a>
                                        <a class="btn btn-sm btn-danger" data-id-tolak="{{$item->id}}" id="tolak" style="color:white">Tolak</a>
                                    @elseif($item->status == "Ditolak KMH")
                                        <button class="btn btn-sm btn-success disabled">Setujui</button>
                                        <button class="btn btn-sm btn-warning disabled">Revisi</button>
                                        <button class="btn btn-sm btn-danger disabled">Tolak</button>
                                    @endif
                            </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

    // Program Kerja Ditinjau KMH
    $(document).on('click','#tinjau', function () {
    var id = $(this).attr('data-id-tinjau');
    $.get(' {{Url("progja-kmh-a-tinjau")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // Program Kerja Disetujui KMH
    $(document).on('click','#setujui', function () {
    var id = $(this).attr('data-id-setujui');
    $.get(' {{Url("progja-kmh-setujui")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // Program Kerja Direvisi ke UKM
    $(document).on('click','#revisi', function () {
    var id = $(this).attr('data-id-rev');
    $.get(' {{Url("progja-kmh-revisi")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // / Program Kerja Ditolak
    $(document).on('click','#tolak', function () {
    var id = $(this).attr('data-id-tolak');
    $.get(' {{Url("progja-kmh-tolak")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // DATATABLE
    $(document).ready(function() {
    $('#myTable').DataTable();
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
    });
    });
</script>
@endsection