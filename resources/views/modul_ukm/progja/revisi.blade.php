<!-- Modal -->
<div class="modal fade" id="revisi_bem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Program Kerja :</label>
                        <input type="text" class="form-control" id="name" readonly>
                    </div>
                </h5>
            </div>
            <form enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" name="id_revisi" id="id_revisi" >
                <input type="text" class="form-control" name="status" id="status" placeholder=" status" required>
            </div>
            <div class="modal-footer">
                <button type="button" id="kirim_revisi" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
        </div>
    </div>