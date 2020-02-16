@extends('layouts.bem_template')
@section('title','BEM - Revisi program kerja')
@section('header','Form Revisi program kerja')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="col-xlg-10 col-lg-12 col-md-8 bg-light-part b-l">
                <div class="card-body">
                    <div class="form-group">
                        <label>To :</label>
                        <input class="form-control" value="{{$revisi->name}} - {{$revisi->email}}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Judul :</label>
                        <input class="form-control" value="{{$revisi->judul}}" disabled>
                    </div>
                    <form action="{{url('progja-bem-revisi-store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="textarea_editor form-control" rows="15" name="catatan" placeholder="Enter text ..."></textarea>
                        </div>
                        <input type="hidden" name="id_pengajuan" value="{{$revisi->id}}">
                        <button type="submit" class="btn btn-success m-t-20"><i class="fa fa-envelope-o"></i> Send</button>
                        <button class="btn btn-inverse m-t-20"><i class="fa fa-times"></i> Discard</button>
                    </form>
                </div>
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
    </script>
@endsection
