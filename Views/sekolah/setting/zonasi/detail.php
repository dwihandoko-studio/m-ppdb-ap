<?php if (isset($data)) { ?>
    <form id="formEditData" class="form-horizontal form-edit-data" method="post">
        <input type="hidden" id="_id" name="_id" value="<?= $data->id ?>" />
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group _prov-block">
                    <label for="_prov" class="form-control-label">Provinsi</label>
                    <select onChange="changeProvinsi(this);" class="form-control prov" name="_prov" id="_prov" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." readonly="">
                        <option value="">-- Pilih --</option>
                        <?php if (isset($provinsis)) {
                            if (count($provinsis) > 0) {
                                foreach ($provinsis as $key => $val) { ?>
                                    <option value="<?= $val->id ?>" <?= ($data->provinsi === $val->id) ? 'selected' : '' ?>><?= $val->nama ?></option>
                        <?php }
                            }
                        } ?>
                    </select>
                    <div class="help-block _prov"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _kab-block">
                    <label for="_kab" class="form-control-label">Kabupaten</label>
                    <select onChange="changeKabupaten(this);" class="form-control kab" name="_kab" id="_kab" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." readonly="">
                        <option value="">-- Pilih --</option>
                        <?php if (isset($kabupatens)) {
                            if (count($kabupatens) > 0) {
                                foreach ($kabupatens as $key => $val) { ?>
                                    <option value="<?= $val->id ?>" <?= ($data->kabupaten === $val->id) ? 'selected' : '' ?>><?= $val->nama ?></option>
                        <?php }
                            }
                        } ?>
                    </select>
                    <div class="help-block _kab"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _kec-block">
                    <label for="_kec" class="form-control-label">Kecamatan</label>
                    <select onChange="changeKecamatan(this);" class="form-control kec" name="_kec" id="_kec" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." readonly="">
                        <option value="">-- Pilih --</option>
                        <?php if (isset($kecamatans)) {
                            if (count($kecamatans) > 0) {
                                foreach ($kecamatans as $key => $val) { ?>
                                    <option value="<?= $val->id ?>" <?= ($data->kecamatan === $val->id) ? 'selected' : '' ?>><?= $val->nama ?></option>
                        <?php }
                            }
                        } ?>
                    </select>
                    <div class="help-block _kec"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _kel-block">
                    <label for="_kel" class="form-control-label">Kelurahan</label>
                    <select onChange="changeKelurahan(this);" class="form-control kel" name="_kel" id="_kel" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." readonly="">
                        <option value="">-- Pilih --</option>
                        <?php if (isset($kelurahans)) {
                            if (count($kelurahans) > 0) {
                                foreach ($kelurahans as $key => $val) { ?>
                                    <option value="<?= $val->id ?>" <?= ($data->kelurahan === $val->id) ? 'selected' : '' ?>><?= $val->nama ?></option>
                        <?php }
                            }
                        } ?>
                    </select>
                    <div class="help-block _kel"></div>
                </div>
            </div>
            <!-- <div class="col-md-12">
                <div class="form-group _dusun-block">
                    <label for="_dusun" class="form-control-label">Dusun</label>
                    <select onChange="changeDusun(this);" class="form-control dusun" name="_dusun" id="_dusun" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                        <option value="">-- Pilih --</option>
                        <?php if (isset($dusuns)) {
                            if (count($dusuns) > 0) {
                                foreach ($dusuns as $key => $val) { ?>
                                    <option value="<?= $val->id ?>" <?= ($data->dusun === $val->id) ? 'selected' : '' ?>><?= $val->nama ?></option>
                        <?php }
                            }
                        } ?>
                    </select>
                    <div class="help-block _dusun"></div>
                </div>
            </div> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>


<?php } ?>