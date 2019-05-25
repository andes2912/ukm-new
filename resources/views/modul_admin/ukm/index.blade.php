@extends('layouts.admin_template')
@section('title','Administrator - UKM')
@section('content')
@section('header','Data UKM')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><a href="{{url('admin-ukm-create')}}" class="btn btn-primary">Tambah</a></h4>
            <div class="table-responsive">
                <table class="table color-table dark-table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>UKM</th>
                            <th>E-Mail</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($ukm as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="label label-success">Aktif</span>
                                    @else
                                        <span class="label label-warning">Tidak Aktif</span>
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{url('admin-ukm-edit', $item->id_user)}}" class="btn btn-sm btn-success">Edit</a>
                                    <a href="" class="btn btn-sm btn-danger">Hapus</a>
                                    <a href="{{url('admin-user-reset', $item->id_user)}}" class="btn btn-sm btn-warning">Reset</a>
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
