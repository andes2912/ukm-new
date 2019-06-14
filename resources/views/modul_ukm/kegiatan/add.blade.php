<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah kegiatan Harian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" name="id_kegiatan" id="id_kegiatan">
                        <input type="hidden" name="id_uk">
                        <label>Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" placeholder="Enter Task Name"> </div>
                    <div class="form-group">
                        <label>Waktu Pelaksanaan</label>
                        <input type="date" name="pelaksanaan" id="nama_kegiatan" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>