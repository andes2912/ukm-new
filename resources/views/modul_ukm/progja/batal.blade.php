@extends('layouts.ukm_template')
@section('title','UKM - Progja Dibatalkan')
@section('header','Data Program Kerja Dibatalkan')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><a href="{{route('ukm.create')}}" class="btn btn-primary">Tambah</a></h4>
            <div class="table-responsive">
                <table class="table color-table dark-table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Pengajuan</th>
                            <th>Program Kerja</th>
                            <th>Penanggung Jawab</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($tunda as $item)
                            <tr style="color:black">
                                <td>{{$no}}</td>
                                <td style="font-weight:bold">{{$item->no_id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->penanggungjwb}}</td>
                                <td>{{$item->created_at->format('d-m-y')}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    <a class="btn btn-sm btn-success" data-id-hapus="{{$item->id}}" id="hapus">Hapus</a>
                                    <a class="btn btn-sm btn-warning disabled">Batal</a>
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
    // Hapus Program Kerja
    $(document).on('click','#hapus', function () {
    var id = $(this).attr('data-id-hapus');
    $.get(' {{Url("progja-ukm-hapus")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // Batal Program Kerja
    $(document).on('click','#batal', function () {
    var id = $(this).attr('data-id-batal');
    $.get(' {{Url("progja-ukm-b-batal")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
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