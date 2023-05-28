<?php if (isset($data)) { ?>
    <hr style="color: orange; height: 3px; opacity: 0.75;">
    <h4 style="justify-content: center; justify-items: center;">RINCIAN DATA DAPODIK</h4>
    <input type="hidden" value="<?= trim($data->peserta_didik_id) ?>" id="_id_d" name="_id_d">
    <input type="hidden" value="<?= trim($data->sekolah_id) ?>" id="_sekolah_id_d" name="_sekolah_id_d">
    <input type="hidden" value="<?= safeEncryptMe(json_encode($data), 'Aswertyuioasdfghjkqwertyuiqwerty') ?>" id="_key_d" name="_key_d">
    <div class="formcus-row">
        <div class="formcus-group col-md-6">
            <label for="_nisn_d">NISN (Pada Dapodik)</label>
            <input type="text" value="<?= trim($data->nisn) ?>" class="formcus-control" id="_nisn_d" name="_nisn_d" placeholder="NISN" readonly>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_nik_d">NIK (Pada Dapodik)</label>
            <input type="text" value="<?= trim($data->nik) ?>" class="formcus-control" id="_nik_d" name="_nik_d" readonly>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_nama_d">NAMA LENGKAP (Pada Dapodik)</label>
            <input type="text" value="<?= trim($data->nama) ?>" class="formcus-control" id="_nama_d" name="_nama_d" readonly>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_tempat_lahir_d">TEMPAT LAHIR (Pada Dapodik)</label>
            <input type="text" value="<?= trim($data->tempat_lahir) ?>" class="formcus-control" id="_tempat_lahir_d" name="_tempat_lahir_d" readonly>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_tgl_lahir_d">TANGGAL LAHIR (Pada Dapodik)</label>
            <input type="text" value="<?= trim($data->tanggal_lahir) ?>" class="formcus-control" id="_tgl_lahir_d" name="_tgl_lahir_d" readonly>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_jk_d">JENIS KELAMIN (Pada Dapodik)</label>
            <input type="text" value="<?= (trim($data->jenis_kelamin) == "L") ? 'Laki-Laki' : ((trim($data->jenis_kelamin) == "P") ? 'Perempuan' : '') ?>" class="formcus-control" id="_jk_d" name="_jk_d" readonly>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_nama_ibu_d">NAMA IBU KANDUNG (Pada Dapodik)</label>
            <input type="text" value="<?= trim($data->nama_ibu_kandung) ?>" class="formcus-control" id="_nama_ibu_d" name="_nama_ibu_d" readonly>
        </div>
    </div>
    <div class="formcus-row">
        <div class="formcus-group col-md-6">
            <label for="_npsn_d">NPSN SEKOLAH ASAL (Pada Dapodik)</label>
            <input type="text" value="<?= (isset($sekolah)) ? trim($sekolah->npsn) : '' ?>" class="formcus-control" id="_npsn_d" name="_npsn_d" readonly>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_nama_sekolah_d">NAMA SEKOLAH ASAL (Pada Dapodik)</label>
            <input type="text" value="<?= (isset($sekolah)) ? trim($sekolah->nama) : '' ?>" class="formcus-control" id="_nama_sekolah_d" name="_nama_sekolah_d" readonly>
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