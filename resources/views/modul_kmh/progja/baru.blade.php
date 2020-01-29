@extends('layouts.kmh_template')
@section('title','KMH - Progja Baru')
@section('header','Data Program Kerja Baru')
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
                            <th>Penanggung Jawab</th>
                            <th>Tgl Pengajuan</th>
                            <th>Berkas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($baru as $item)
                            <tr style="color:black">
                                <td>{{$no}}</td>
                                <td>{{$item->no_pengajuan}}</td>
                                <td>{{$item->judul}}</td>
                                <td>{{$item->pic}}</td>
                                <td>{{$item->created_at->format('d-m-y')}}</td>
                                <td>
                                    <a href="" class="btn btn-info btn-sm">Download</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" data-id-setujui="{{$item->id}}" id="setujui">Setujui</a>
                                    <a href="" class="btn btn-warning btn-sm">Revisi</a>
                                    <a href="" class="btn btn-danger btn-sm">Tolak</a>
                                </td>
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