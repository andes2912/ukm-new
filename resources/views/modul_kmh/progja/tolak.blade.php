@extends('layouts.kmh_template')
@section('title','KMH - Program Kerja Ditolak')
@section('header','Data Program Kerja Ditolak')
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
                            <th>Status</th>
                            <th>Berkas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($tolak as $item)
                            <tr style="color:black">
                                <td>{{$no}}</td>
                                <td style="font-weight:bold">{{$item->no_id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->penanggungjwb}}</td>
                                <td>{{$item->created_at->format('d-m-y')}}</td>
                                <td>
                                    <span class="label label-danger">Ditolak</span>
                                </td>
                                <td>
                                    @if ($item->status = ['arsip','Ditolak KMH'])
                                        <a href="{{url('download-progja-bem',$item->id)}}" class="btn btn-sm btn-danger">Berkas Ditolak</a>
                                    
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status =['arsip','Ditolak KMH'])
                                        <a class="btn btn-sm btn-success" data-id-ditolak="{{$item->id}}" id="ditolak" style="color:white">Delete</a>
                                   @endif
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