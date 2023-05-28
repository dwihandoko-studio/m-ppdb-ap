<?php if (isset($data)) { ?>
    <form id="formAddData" class="form-horizontal form-add-data" method="post">
        <input type="hidden" id="_id" name="_id" value="<?= $data->id ?>" />
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group _jumlah_kelas-block">
                    <label for="_jumlah_kelas" class="form-control-label">Jumlah Ketersediaan Ruang Kelas</label>
                    <input type="number" value="<?= $data->jumlah_kelas ?>" class="form-control jumlah-kelas" name="_jumlah_kelas" placeholder="Jumlah ketersediaan kelas..." id="_jumlah_kelas" onfocusin="inputFocus(this);" readonly="">
                    <div class="help-block _jumlah_kelas"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _jumlah_rombel_current-block">
                    <label for="_jumlah_rombel_current" class="form-control-label">Jumlah Rombel Kelas Akhir Saat Ini</label>
                    <input type="number" value="<?= $data->jumlah_rombel_current ?>" class="form-control jumlah-rombel-current" name="_jumlah_rombel_current" placeholder="Jumlah rombel akhir saat ini..." id="_jumlah_rombel_current" onfocusin="inputFocus(this);" readonly="">
                    <div class="help-block _jumlah_rombel_current"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _jumlah_rombel_kebutuhan-block">
                    <label for="_jumlah_rombel_kebutuhan" class="form-control-label">Jumlah yang disediakan</label>
                    <input type="number" value="<?= $data->jumlah_rombel_kebutuhan ?>" class="form-control jumlah-rombel-kebutuhan" name="_jumlah_rombel_kebutuhan" placeholder="Jumlah yang disediakan..." id="_jumlah_rombel_kebutuhan" onfocusin="inputFocus(this);" readonly="">
                    <div class="help-block _jumlah_rombel_kebutuhan"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _radius_zonasi-block">
                    <label for="_radius_zonasi" class="form-control-label">Radius Zonasi</label>
                    <input type="number" value="<?= $data->radius_zonasi ?>" class="form-control radius-zonasi" name="_radius_zonasi" placeholder="Radius Zonasi..." id="_radius_zonasi" onfocusin="inputFocus(this);" readonly="">
                    <div class="help-block _radius_zonasi"></div>
                    <p>Untuk satuan radius dalam Kilo Meter (Km).</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>

<?php } ?>