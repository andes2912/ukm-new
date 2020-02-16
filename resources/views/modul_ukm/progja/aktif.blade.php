@extends('layouts.ukm_template')
@section('title','UKM - Progja Aktif')
@section('header','Data Program Kerja Aktif')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            @if ($cekAnggota == '')
            <h4 class="card-title"><a href="{{url('anggota-create')}}" class="btn btn-success">Tambah Anggota</a></h4>
            @else
            <h4 class="card-title"><a href="{{route('ukm.create')}}" class="btn btn-primary">Tambah</a></h4>
            @endif
            <div class="table-responsive m-t-0">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Pengajuan</th>
                            <th>Program Kerja</th>
                            <th>PJ</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($progja as $item)
                            <tr style="color:black">
                                <td>{{$no}}</td>
                                <td>{{$item->no_pengajuan}}</td>
                                <td>
                                    <a href="" >{{$item->judul}}</a>
                                </td>
                                <td>{{$item->pic}}</td>
                                <td>{{$item->created_at->format('d-m-y')}}</td>
                                <td>{{$item->nama_status}}</td>
                                <td width="220px">
                                    @if ($item->id_status == "P00")
                                        <a class="btn btn-primary btn-sm text-white" data-id-konfirmasi="{{$item->id}}" id="konfirmasi">Konfirmasi</a>
                                    @elseif($item->id_status == "B101")
                                        <button disabled="disabled" class="btn btn-info btn-sm">Berkas Terkirim</button>
                                    @elseif($item->id_status == "P100")
                                        <a href="{{url('progja-ukm-revisi-pdf',$item->id)}}" target="_blank" class="btn btn-primary btn-sm"> <i class="fa fa-file-pdf-o"></i> Surat Revisi</a>
                                        @if ($item->id == null)
                                            <a href="{{url('progja-ukm-revisi', $item->id)}}" class="btn btn-info btn-sm">Revisi Berkas</a>
                                        @else
                                            <button disabled="disabled" class="btn btn-info btn-sm">Revisi Terkirim</button>
                                        @endif
                                    @elseif($item->id_status == "P10")
                                        <a class="btn btn-info btn-sm" data-id-mulai="{{$item->id}}" id="mulai">Mulai</a>
                                    @elseif($item->id_status == "P20")
                                        <a href="" class="btn btn-info btn-sm">Selesai</a>
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

    // Konfirmasi Berkas
    $(document).on('click','#konfirmasi', function () {
        var id = $(this).attr('data-id-konfirmasi');
        $.get(' {{Url("progja-ukm-a-konfirmasi")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
            swal({
                html : "Berhasil Ubah Status Diterima",
                showConfirmButton : false,
                type : "success",
                timer : 1000
            });
            location.reload();
        });
    });

    // Mulai Jalankan Progja
    $(document).on('click','#mulai', function () {
        var id = $(this).attr('data-id-mulai');
        $.get(' {{Url("progja-ukm-mulai")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
            swal({
                html : "Berhasil Ubah Status Diterima",
                showConfirmButton : false,
                type : "success",
                timer : 1000
            });
            location.reload();
        });
    });

    // Tunda Program Kerja
    $(document).on('click','#tunda', function () {
        var id = $(this).attr('data-id-tunda');
        $.get(' {{Url("progja-ukm-a-tunda")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
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