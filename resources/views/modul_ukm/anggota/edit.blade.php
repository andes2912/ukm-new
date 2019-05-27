<div class="modal fade" id="tampil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">New message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Nama :</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="control-label">Alamat :</label>
                            <input type="text" name="alamat" id="alamat" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="control-label">No Telpon :</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Jurusan :</label>
                            <select name="jurusan" id="jurusan" class="form-control">
                                <option value="">--Pilih Jurusan--</option>
                                <option value="TI">Teknik Informatika</option>
                                <option value="SI">Sistem Informasi</option>
                                <option value="AK">Akuntansi</option>
                                <option value="MA">MANAJEMEN</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Angkatan :</label>
                            <select id="angkatan" nama="angkatan" class="form-control">
                                <option value="">--Pilih Angkatan--</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Status :</label>
                            <select class="form-control custom-select" name="status" id="status">
                                <option value="">--Pilih Status--</option>
                                <option value="Aktif">Anggota Aktif</option>
                                <option value="Non-Aktif">Anggota Tidak Aktif</option>
                                <option value="Pembembing">Pembimbing/Penasehat</option>
                            </select>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="simpan">Edit</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>