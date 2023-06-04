<?php if (isset($data)) { ?>
    <hr style="color: #fff; height: 3px; opacity: 0.75;">
    <h4 style="justify-content: center; justify-items: center;">RINCIAN DATA DAPODIK</h4>
    <input type="hidden" value="<?= trim($data->peserta_didik_id) ?>" id="_id_d" name="_id_d">
    <input type="hidden" value="<?= trim($data->sekolah_id) ?>" id="_sekolah_id_d" name="_sekolah_id_d">
    <input type="hidden" value="<?= safeEncryptMe(json_encode($data), 'Aswertyuioasdfghjkqwertyuiqwerty') ?>" id="_key_d" name="_key_d">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <p style="color: #fff;">NISN (Pada Dapodik)</p>
            <input type="text" value="<?= trim($data->nisn) ?>" class="formcus-control" id="_nisn_d" name="_nisn_d" placeholder="NISN" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
        <div class="form-group">
            <p style="color: #fff;">NIK (Pada Dapodik)</p>
            <input type="text" value="<?= trim($data->nik) ?>" class="formcus-control" id="_nik_d" name="_nik_d" placeholder="NIK" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
        <div class="form-group">
            <p style="color: #fff;">Nama Lengkap (Pada Dapodik)</p>
            <input type="text" value="<?= trim($data->nama) ?>" class="formcus-control" id="_nama_d" name="_nama_d" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
        <div class="form-group">
            <p style="color: #fff;">Tempat Lahir (Pada Dapodik)</p>
            <input type="text" value="<?= trim($data->tempat_lahir) ?>" class="formcus-control" id="_tempat_lahir_d" name="_tempat_lahir_d" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
        <div class="form-group">
            <p style="color: #fff;">Tanggal Lahir (Pada Dapodik)</p>
            <input type="text" value="<?= trim($data->tanggal_lahir) ?>" class="formcus-control" id="_tgl_lahir_d" name="_tgl_lahir_d" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
        <div class="form-group">
            <p style="color: #fff;">Jenis Kelamin (Pada Dapodik)</p>
            <input type="text" value="<?= (trim($data->jenis_kelamin) == "L") ? 'Laki-Laki' : ((trim($data->jenis_kelamin) == "P") ? 'Perempuan' : '') ?>" class="formcus-control" id="_jk_d" name="_jk_d" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
        <div class="form-group">
            <p style="color: #fff;">Nama Ibu Kandung (Pada Dapodik)</p>
            <input type="text" value="<?= trim($data->nama_ibu_kandung) ?>" class="formcus-control" id="_nama_ibu_d" name="_nama_ibu_d" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
        <div class="form-group">
            <p style="color: #fff;">NPSN Sekolah Asal (Pada Dapodik)</p>
            <input type="text" value="<?= (isset($sekolah)) ? trim($sekolah->npsn) : '' ?>" class="formcus-control" id="_npsn_d" name="_npsn_d" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
        <div class="form-group">
            <p style="color: #fff;">Nama Sekolah Asal (Pada Dapodik)</p>
            <input type="text" value="<?= (isset($sekolah)) ? trim($sekolah->nama) : '' ?>" class="formcus-control" id="_nama_sekolah_d" name="_nama_sekolah_d" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" readonly>
        </div>
    </div>
    <div class="formcus-row">
        <div class="formcus-group col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <button id="btncancel" type="button" style="min-width: 100%; max-height: 40px; padding: 10px;" onclick="cancelConfirm(this)" class="btn btn-block btn-warning">BATAL</button>
                </div>
                <div class="col-md-8">
                    <button id="btnsimpan" type="button" style="min-width: 100%; max-height: 40px; padding: 10px;" onclick="submitConfirm(this)" class="btn btn-block btn-primary">LANJUTKAN</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>