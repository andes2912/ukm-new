@extends('layouts.ukm_template')
@section('title','UKM - Progja Arsip')
@section('header','Data Program Kerja Arsip')
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($arsip as $item)
                            <tr style="color:black">
                                <td>{{$no}}</td>
                                <td style="font-weight:bold">{{$item->no_id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->penanggungjwb}}</td>
                                <td>{{$item->created_at->format('d-m-y')}}</td>
                                <td>
                                    <Span class="label label-danger">Ditolak BEM</span>
                                </td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary">Berkas</a>
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