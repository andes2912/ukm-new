@extends('layouts.bem_template')
@section('title','BEM - Progja Ditolak')
@section('header','Data Program Kerja Ditolak')
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
                                    @if ($item->status == "arsip")
                                        <a href="{{url('download-progja-bem',$item->id)}}" class="btn btn-sm btn-danger">Berkas Ditolak</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == "arsip")
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
    // Hapus Program Kerja
    $(document).on('click','#ditolak', function () {
    var id = $(this).attr('data-id-ditolak');
    $.get(' {{Url("progja-bem-hapus")}}', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(resp){
        swal({
            html : "Berhasil Menghapus Data",
            showConfirmButton : false,
            type : "success",
            timer : 1000
        });
        location.reload();
    });
    });

</script>
@endsection