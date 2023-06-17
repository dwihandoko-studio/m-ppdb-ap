<?php if (isset($data)) { ?>
    <form id="formEditData" class="form-horizontal form-edit-data" method="post">
        <input type="hidden" id="_id" name="_id" value="<?= $data->id ?>" />
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">Jenjang</label>
                    <input type="text" class="form-control" value="<?= $data->nama_jenjang ?>" readonly />
                    <div class="help-block _prov"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">NPSN</label>
                    <input type="text" class="form-control" value="<?= $data->npsn ?>" readonly />
                    <div class="help-block _prov"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">Sekolah</label>
                    <input type="text" class="form-control" value="<?= $data->nama_sekolah ?>" readonly />
                    <div class="help-block _prov"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">Dusun</label>
                    <input type="text" class="form-control" value="<?= $data->namaDusun ?>" readonly />
                    <div class="help-block _prov"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">Kelurahan</label>
                    <input type="text" class="form-control" value="<?= $data->namaKelurahan ?>" readonly />
                    <div class="help-block _prov"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">Kecamatan</label>
                    <input type="text" class="form-control" value="<?= $data->namaKecamatan ?>" readonly />
                    <div class="help-block _prov"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">Kabupaten</label>
                    <input type="text" class="form-control" value="<?= $data->namaKabupaten ?>" readonly />
                    <div class="help-block _prov"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">Provinsi</label>
                    <input type="text" class="form-control" value="<?= $data->namaProvinsi ?>" readonly />
                    <div class="help-block _prov"></div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>

    <script>

    </script>

<?php } ?>