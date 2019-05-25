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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($progja as $item)
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
                                    @endif    
                                </td>
                                <td>
                                    @if ($item->status == "Diteruskan ke KMH")
                                        <a class="btn btn-sm btn-success" data-id-tinjau="{{$item->id}}" id="tinjau" style="color:white">Tinjau</a>
                                        <a class="btn btn-sm btn-warning disabled">Batal</a>
                                    @elseif($item->status == "Ditinjau KMH")
                                        <a class="btn btn-sm btn-success" data-id-setujui="{{$item->id}}" id="setujui" style="color:white">Setujui</a>
                                        <a class="btn btn-sm btn-warning" data-id-tolak="{{$item->id}}" id="tolak" style="color:white">Tolak</a>
                                    @elseif($item->status == "Disetujui KMH")
                                        <a href="{{url('download-berkas', $item->id)}}" class="btn btn-sm btn-info">Lihat Berkas</a>
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
