@extends('layouts.bem_template')
@section('title','Laporan')
@section('header','Laporan Pengajuan Proposal UKM')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-success">
                    <select class="form-control custom-select">
                        <option value="">Bahasa</option>
                        <option value="">Assalam</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-info">Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No Pengajuan</th>
                        <th>Pengaju</th>
                        <th>Program Kerja</th>
                        <th>Tgl Pengajuan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($laporan as $item)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->no_id}}</td>
                            <td>{{$item->pengaju}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->created_at->format('d-m-y')}}</td>
                            <td><span class="label label-success">{{$item->status}}</span></td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">Print</a>
                            </td>
                        </tr>
                    <?php $no++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
 $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
        });
    });
</script>
@endsection