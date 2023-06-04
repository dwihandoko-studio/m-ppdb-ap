<?php if (isset($data)) { ?>
    <div class="col-lg-12">
        <hr style="color: #fff; height: 3px; opacity: 0.75;">
        <h4 style="justify-content: center; justify-items: center; color: #fff;">LENGKAPI DATA</h4>
        <input type="hidden" value="<?= trim($data['nik']) ?>" id="_nik_d_belum" name="_nik_d_belum">
        <input type="hidden" value="<?= trim($data['kk']) ?>" id="_kk_d_belum" name="_kk_d_belum">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <p style="color: #fff;">Nama Lengkap</p>
                    <input type="text" onfocus="inputFocus(this)" class="formcus-control" id="_nama_d_belum" name="_nama_d_belum" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                    <div class="help-block _nama_d_belum"></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <p style="color: #fff;">Tempat Lahir</p>
                    <input type="text" onfocus="inputFocus(this)" class="formcus-control" id="_tempat_lahir_d_belum" name="_tempat_lahir_d_belum" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                    <div class="help-block _tempat_lahir_d_belum"></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <p style="color: #fff;">Tanggal Lahir</p>
                    <input type="date" onfocus="inputFocus(this)" class="formcus-control" id="_tgl_lahir_d_belum" name="_tgl_lahir_d_belum" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                    <div class="help-block _tgl_lahir_d_belum"></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <p style="color: #fff;">Jenis Kelamin</p>
                    <div class="select-box">
                        <select class="selectmenu1" name="_jk_d_belum" id="_jk_d_belum" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; width: 100%; font-weight: 400; height: 50px; outline: medium none; padding: 0px 10px;">
                            <option selected value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <p style="color: #fff;">Nama Ayah Kandung</p>
                    <input type="text" onfocus="inputFocus(this)" class="formcus-control" id="_nama_ayah_d_belum" name="_nama_ayah_d_belum" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                    <div class="help-block _nama_ayah_d_belum"></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <p style="color: #fff;">Nama Ibu Kandung</p>
                    <input type="text" onfocus="inputFocus(this)" class="formcus-control" id="_nama_ibu_d_belum" name="_nama_ibu_d_belum" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                    <div class="help-block _nama_ibu_d_belum"></div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="formcus-row">
                    <div class="formcus-group col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <button id="btncekdatabelumsekolah" type="button" style="min-width: 100%; max-height: 40px; padding: 10px;" onclick="cancelConfirm(this)" class="btn btn-block btn-warning">BATAL</button>
                            </div>
                            <div class="col-md-8">
                                <button id="btnsimpan" type="button" style="min-width: 100%; max-height: 40px; padding: 10px;" onclick="submitRegistrasiBelumSekolah(this)" class="btn btn-block btn-primary">LANJUTKAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>