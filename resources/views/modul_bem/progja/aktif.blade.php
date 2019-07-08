@extends('layouts.bem_template')
@section('title','BEM - Progja Aktif')
@section('header','Data Program Kerja Aktif')
@section('content')
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
                            <th>Penanggung Jawab</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status</th>
                            <th>Berkas</th>
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
                                <td>{{$item->penanggungjwb}}</td>
                                <td>{{$item->created_at->format('d-m-y')}}</td>
                                <td>
                                    @if ($item->status == "Pengajuan")
                                        <span class="label label-primary">Pengajuan</span>
                                    @elseif($item->status == "Ditinjau BEM")
                                        <span class="label label-info">Diproses</span>
                                    @elseif($item->status == "Revisi BEM")
                                        <span class="label label-warning">Revisi</span>
                                    @elseif($item->status == "Diteruskan ke KMH")
                                        <span class="label label-success">Diteruskan ke KMH</span>
                                    @elseif($item->status == "Pengajuan Ulang")
                                        <span class="label label-warning">Pengajuan Ulang</span>
                                    @elseif($item->status == "Disetujui")
                                        <span class="label label-success">Proposal Disetujui</span>
                                    @elseif($item->status == "Revisi")
                                        <span class="label label-warning">Revisi Diterima</span>
                                    @elseif($item->status == "Revisi Untuk BEM")
                                        <span class="label label-warning">Revisi Terkirim</span>
                                    @elseif($item->status == "Ditolak BEM")
                                        <span class="label label-danger">Ditolak</span>
                                    @elseif($item->status == "Ditinjau KMH")
                                        <span class="label label-success">Diserahkan KMH</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == "Pengajuan")
                                        <button class="btn btn-sm btn-info disabled">Lihat Berkas</button>
                                    @elseif ($item->status == "Pengajuan Ulang")
                                        <button class="btn btn-sm btn-info disabled">Lihat Berkas</button>
                                    @elseif($item->status == "Ditinjau BEM")
                                        <a href="{{url('download-progja-bem',$item->id)}}" class="btn btn-sm btn-info">Lihat Berkas</a>
                                    @elseif($item->status == "Revisi BEM")
                                        <a href="{{url('download-progja-bem',$item->id)}}" class="btn btn-sm btn-info">Lihat Berkas</a>
                                    @elseif($item->status == "Diteruskan ke KMH")
                                        <a href="{{url('download-progja-bem',$item->id)}}" class="btn btn-sm btn-info">Lihat Berkas</a>
                                    @elseif($item->status == "Revisi Untuk BEM")
                                        <a href="{{url('download-progja-bem',$item->id)}}" class="btn btn-sm btn-info">Berkas Revisi</a>
                                    @elseif($item->status == "Ditolak BEM")
                                        <a href="{{url('download-progja-bem',$item->id)}}" class="btn btn-sm btn-danger">Berkas Ditolak</a>
                                    @elseif($item->status == "Ditinjau KMH")
                                        <a href="{{url('download-progja-bem',$item->id)}}" class="btn btn-sm btn-success">Lihat Berkas</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == "Pengajuan")
                                        <a class="btn btn-sm btn-success" data-id-tinjau="{{$item->id}}" id="tinjau" style="color:white">Butuh Ditinjau</a>
                                    @elseif ($item->status == "Pengajuan Ulang")
                                        <a class="btn btn-sm btn-success" data-id-tinjau="{{$item->id}}" id="tinjau" style="color:white">Butuh Ditinjau</a>
                                    @elseif($item->status == "Ditinjau BEM")
                                        <a class="btn btn-sm btn-success" data-id-teruskan="{{$item->id}}" id="teruskan" style="color:white">Teruskan</a>
                                        <a class="btn btn-sm btn-warning" data-id-revisi="{{$item->id}}" id="revisi" style="color:white">Revisi</a>
                                        <a class="btn btn-sm btn-danger" data-id-tolak="{{$item->id}}" id="tolak" style="color:white">Tolak</a>
                                    @elseif($item->status == "Revisi BEM")
                                        <a class="btn btn-sm btn-success" data-id-teruskan="{{$item->id}}" id="teruskan" style="color:white">Teruskan</a>
                                        <a class="btn btn-sm btn-warning" data-id-revisi="{{$item->id}}" id="revisi" style="color:white">Revisi</a>
                                        <a class="btn btn-sm btn-danger" data-id-tolak="{{$item->id}}" id="tolak" style="color:white">Tolak</a>
                                    @elseif($item->status == "Diteruskan ke KMH")
                                        <button class="btn btn-sm btn-warning disabled">Revisi</button>
                                        <button class="btn btn-sm btn-danger disabled">Tolak</button>
                                    @elseif($item->status == "Disetujui")
                                        <button class="btn btn-sm btn-success disabled">Tunda</button>
                                        <button class="btn btn-sm btn-warning disabled">Batal</button>
                                    @elseif($item->status == "Revisi")
                                        <button class="btn btn-sm btn-success disabled">Tunda</button>
                                        <button class="btn btn-sm btn-warning disabled">Batal</button>
                                    @elseif($item->status == "Revisi Untuk BEM")
                                        <a class="btn btn-sm btn-success" data-id-teruskan="{{$item->id}}" id="teruskan" style="color:white">Teruskan</a>
                                        <a class="btn btn-sm btn-warning" data-id-revisi="{{$item->id}}" id="revisi" style="color:white">Revisi</a>
                                        <a class="btn btn-sm btn-danger" data-id-tolak="{{$item->id}}" id="tolak" style="color:white">Tolak</a>
                                    @elseif($item->status == "Ditolak BEM")
                                        <button class="btn btn-sm btn-danger disabled">Ditolak</button>
                                    @elseif($item->status == "Ditinjau KMH")
                                        <span class="label label-success">Diserahkan KMH</span>
                                    @else
                                    <a class="btn btn-sm btn-success" data-id-tunda="{{$item->id}}" id="tunda">Tunda</a>
                                    <a class="btn btn-sm btn-warning" data-id-batal="{{$item->id}}" id="batal">Batal</a>
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
    // Tinjau Program Kerja
    $(document).on('click','#tinjau', function () {
    var id = $(this).attr('data-id-tinjau');
    $.get(' {{Url("progja-bem-a-tinjau")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // Teruskan Program Kerja ke Kemahasiswaan
    $(document).on('click','#teruskan', function () {
    var id = $(this).attr('data-id-teruskan');
    $.get(' {{Url("progja-bem-teruskan")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // Revisi Program Kerja Untuk UKM
    $(document).on('click','#revisi', function () {
    var id = $(this).attr('data-id-revisi');
    $.get(' {{Url("progja-bem-revisi")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
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
    $.get(' {{Url("progja-bem-tolak")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
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