@extends('layouts.admin_template')
@section('title','Administrator -Program Kerja UKM')
@section('content')
@section('header','Data UKM')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table color-table dark-table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Pengajuan</th>
                            <th>Program Kerja</th>
                            <th>Pengaju</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($progja as $item)
                            <tr style="color:black">
                                <td>{{$no}}</td>
                                <td style="font-weight:bold">{{$item->no_pengajuan}}</td>
                                <td>{{$item->judul}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->nama_status}}</td>
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

    // Tinjau Program Kerja
    $(document).on('click','#tinjau', function () {
    var id = $(this).attr('data-id-tinjau');
    $.get(' {{Url("tinjau-progja-ukm")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // Setujui Program Kerja
    $(document).on('click','#setujui', function () {
    var id = $(this).attr('data-id-setujui');
    $.get(' {{Url("setujui-progja-ukm")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });
</script>
@endsection
