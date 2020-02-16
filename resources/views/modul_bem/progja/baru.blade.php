@extends('layouts.bem_template')
@section('title','BEM - Progja Baru')
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
                                    @if ($item->id == null)
                                    <a href="" class="btn btn-info btn-sm">Download</a>
                                    @else
                                    <a href="" class="btn btn-info btn-sm">Lihat Berkas</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->id_status == "B101")
                                        <a class="btn btn-primary btn-sm text-white" data-id-setujui="{{$item->id}}" id="setujui">Setujui</a>
                                        <a href="{{url('progja-bem-revisi',$item->id)}}" class="btn btn-warning btn-sm">Revisi</a>
                                        <a href="" class="btn btn-danger btn-sm">Tolak</a>
                                    @elseif($item->id_status == "P100")
                                        @if ($item->id == null)
                                            <button disabled="disabled" class="btn btn-info btn-sm">Revisi Terkirim</button>
                                        @else
                                            <a class="btn btn-primary btn-sm text-white" data-id-setujui="{{$item->id}}" id="setujui">Setujui</a>
                                            <a href="{{url('progja-bem-revisi',$item->id)}}" class="btn btn-warning btn-sm">Revisi</a>
                                            <a href="" class="btn btn-danger btn-sm">Tolak</a>
                                        @endif
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
    // Setujui Program Kerja
    $(document).on('click','#setujui', function () {
        var id = $(this).attr('data-id-setujui');
        $.get(' {{Url("progja-bem-a-setujui")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
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