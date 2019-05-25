@extends('layouts.ukm_template')
@section('title','UKM - Progja Aktif')
@section('header','Data Program Kerja Aktif')
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
                        @foreach ($progja as $item)
                            <tr style="color:black">
                                <td>{{$no}}</td>
                                <td style="font-weight:bold">{{$item->no_id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->penanggungjwb}}</td>
                                <td>{{$item->created_at->format('d-m-y')}}</td>
                                <td>
                                    @if ($item->status == "Pengajuan")
                                        <span class="label label-primary">Berhasil Dikirim</span>
                                    @elseif($item->status == "Ditinjau BEM")
                                        <span class="label label-info">Sedang Ditinjau BEM</span>
                                    @elseif($item->status == "Diteruskan ke KMH")
                                        <span class="label label-success">Diteruskan ke KMH</span>
                                    @elseif($item->status == "Pengajuan Ulang")
                                        <span class="label label-warning">Pengajuan Ulang</span>
                                    @elseif($item->status == "Ditinjau KMH")
                                        <span class="label label-info">Sedang Ditinjau KMH</span>
                                    @elseif($item->status == "Disetujui KMH")
                                        <span class="label label-success">Program Kerja Disetujui</span>
                                    @elseif($item->status == "Direvisi KMH")
                                        <span class="label label-warning">Revisi Dari KMH</span>
                                    @elseif($item->status == "Revisi Untuk KMH")
                                        <span class="label label-warning">Revisi Terkirim</span>
                                    @elseif($item->status == "Revisi BEM")
                                        <span class="label label-warning">Revisi Dari BEM</span>
                                    @elseif($item->status == "Revisi Untuk BEM")
                                        <span class="label label-info">Revisi Terkirim</span>
                                    @elseif($item->status == "Ditolak BEM")
                                        <span class="label label-danger">Program Kerja Ditolak BEM</span>
                                    @elseif($item->status == "Ditolak KMH")
                                        <span class="label label-danger">Program Kerja Ditolak KMH</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == "Ditinjau BEM")
                                        <button class="btn btn-sm btn-success disabled">Tunda</button>
                                        <button class="btn btn-sm btn-warning disabled">Batal</button>
                                    @elseif($item->status == "Diteruskan ke KMH")
                                        <button class="btn btn-sm btn-success disabled">Tunda</button>
                                        <button class="btn btn-sm btn-warning disabled">Batal</button>
                                    @elseif($item->status == "Ditinjau KMH")
                                        <button class="btn btn-sm btn-success disabled">Tunda</button>
                                        <button class="btn btn-sm btn-warning disabled">Batal</button>
                                    @elseif($item->status == "Disetujui KMH")
                                        <button class="btn btn-sm btn-success disabled">Tunda</button>
                                        <button class="btn btn-sm btn-warning disabled">Batal</button>
                                    @elseif($item->status == "Direvisi KMH")
                                        <a class="btn btn-sm btn-success" data-id-name="{{$item->name}}" data-id-rev="{{$item->id}}" id="revisi_kmh" >Kirim Revisi</a>
                                    @elseif($item->status == "Revisi Untuk KMH")
                                        <a class="btn btn-sm btn-warning" data-id-batal="{{$item->id}}" id="batal">Batal Kirim Revisi</a>
                                    @elseif($item->status == "Revisi BEM")
                                        {{-- <a class="btn btn-sm btn-success" data-id-name="{{$item->name}}" data-id-revisi="{{$item->id}}" id="click_revisi_bem" data-toggle="modal" data-target="#revisi_bem">Kirim Revisi</a> --}}
                                        <a class="btn btn-sm btn-success" data-id-name="{{$item->name}}" data-id-revisi="{{$item->id}}" id="kirim_revisi" >Kirim Revisi</a>
                                    @elseif($item->status == "Revisi Untuk BEM")
                                        <a class="btn btn-sm btn-warning" data-id-batal="{{$item->id}}" id="batal">Batal Kirim Revisi</a>
                                    @elseif($item->status == "Ditolak BEM")
                                        <a class="btn btn-sm btn-warning" data-id-arsip="{{$item->id}}" id="arsip">Arsipkan</a>
                                    @elseif($item->status == "Ditolak KMH")
                                        <a class="btn btn-sm btn-warning" data-id-arsip="{{$item->id}}" id="arsip">Arsipkan</a>
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
                @include('modul_ukm.progja.revisi')
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
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


    // Kirim Revisi ke BEM
    $(document).on('click','#kirim_revisi', function () {
    var id = $(this).attr('data-id-revisi');
    $.get(' {{Url("kirim-revisi-bem")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // Kirim Revisi ke KMH
    $(document).on('click','#revisi_kmh', function () {
    var id = $(this).attr('data-id-rev');
    $.get(' {{Url("kirim-revisi-kmh")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Ubah Status Diterima",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

    // Arsipkan Program Kerja
    $(document).on('click','#arsip', function () {
    var id = $(this).attr('data-id-arsip');
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

    // Kirim Revisi Untuk BEM
//     $(document).on('click','#click_revisi_bem', function(){
//         var id = $(this).attr('data-id-revisi');
//         $("#id_revisi").val(id)
//         var nama = $(this).attr('data-id-name');
//         $("#name").val(nama)
//     });

//     $(document).on('click','#kirim_revisi', function(){
//     var id_revisi = $("#id_revisi").val();
//     var status = $("#status").val();
    
//     if (status == "") {
//             swal({
//                 html: "Silakan Isi Nilai !"
//             });
//     }else{
//         $.get('{{Url("kirim-revisi-bem")}}',{'_token': $('meta[name=csrf-token]').attr('content'),id_revisi:id_revisi}, function(resp){
//                 swal({
//                 html :  "Berhasil Memberikan Nilai",
//                 showConfirmButton :  false,
//                 type: "success",
//                 timer: 1000 
//                 });
//             $("#id_revisi").val(''); 
//             $("#status").val('');
//             location.reload();
//         });
//     }
        
//  });
</script>
@endsection