<?php if (isset($data)) { ?>
    <form id="formSaveData" class="form-horizontal form-save-data" method="post">
        <input type="hidden" value="<?= trim($data->sekolah_id) ?>" id="_sekolah_id_d" name="_sekolah_id_d">
        <input type="hidden" value="<?= safeEncryptMe(json_encode($data), 'Aswertyuioasdfghjkqwertyuiqwerty') ?>" id="_key_d" name="_key_d">
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_nisn_d">NISN (Pada Dapodik)</label>
                    <input type="text" value="<?= trim($data->nisn) ?>" class="formcus-control" id="_nisn_d" name="_nisn_d" placeholder="NISN" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_nik_d">NIK (Pada Dapodik)</label>
                    <input type="text" value="<?= trim($data->nik) ?>" class="formcus-control" id="_nik_d" name="_nik_d" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_nama_d">NAMA LENGKAP (Pada Dapodik)</label>
                    <input type="text" value="<?= trim($data->nama) ?>" class="formcus-control" id="_nama_d" name="_nama_d" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_tempat_lahir_d">TEMPAT LAHIR (Pada Dapodik)</label>
                    <input type="text" value="<?= trim($data->tempat_lahir) ?>" class="formcus-control" id="_tempat_lahir_d" name="_tempat_lahir_d" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_tgl_lahir_d">TANGGAL LAHIR (Pada Dapodik)</label>
                    <input type="text" value="<?= trim($data->tanggal_lahir) ?>" class="formcus-control" id="_tgl_lahir_d" name="_tgl_lahir_d" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_jk_d">JENIS KELAMIN (Pada Dapodik)</label>
                    <input type="text" value="<?= (trim($data->jenis_kelamin) == "L") ? 'Laki-Laki' : ((trim($data->jenis_kelamin) == "P") ? 'Perempuan' : '') ?>" class="formcus-control" id="_jk_d" name="_jk_d" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_nama_ibu_d">NAMA IBU KANDUNG (Pada Dapodik)</label>
                    <input type="text" value="<?= trim($data->nama_ibu_kandung) ?>" class="formcus-control" id="_nama_ibu_d" name="_nama_ibu_d" readonly>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="_npsn_d">NPSN SEKOLAH ASAL (Pada Dapodik)</label>
                    <input type="text" value="<?= (isset($sekolah)) ? trim($sekolah->npsn) : '' ?>" class="formcus-control" id="_npsn_d" name="_npsn_d" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_nama_sekolah_d">NAMA SEKOLAH ASAL (Pada Dapodik)</label>
                    <input type="text" value="<?= (isset($sekolah)) ? trim($sekolah->nama) : '' ?>" class="formcus-control" id="_nama_sekolah_d" name="_nama_sekolah_d" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_email_d">EMAIL PESERTA</label>
                    <input type="email" class="formcus-control" placeholder="E-mail..." id="_email_d" name="_email_d" required>
                    <div class="help-block _email_d"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_nohp_d">NO HP PESERTA</label>
                    <input type="phone" class="formcus-control" placeholder="08xxxxxxxxxxx..." id="_nohp_d" name="_nohp_d" required>
                    <div class="help-block _nohp_d"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="_peserta_didik_id_d">PESERTA DIDIK ID</label>
                    <input type="phone" class="formcus-control" placeholder="xxxxxxx-xxxx-xxxxxxxx..." id="_peserta_didik_id_d" name="_peserta_didik_id_d" required>
                    <div class="help-block _peserta_didik_id_d"></div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="saveDataAkun(this)" class="btn btn-outline-primary">SIMPAN</button>
        </div>
    </form>
    <script>
        function saveDataAkun(event) {
            const nisn = document.getElementsByName('_nisn_d')[0].value;
            const keyD = document.getElementsByName('_key_d')[0].value;
            const npsn = document.getElementsByName('_npsn_d')[0].value;

            const email = document.getElementsByName('_email_d')[0].value;
            const nohp = document.getElementsByName('_nohp_d')[0].value;
            const peserta_didik_id = document.getElementsByName('_peserta_didik_id_d')[0].value;

            if (email === "") {
                $("input#_email_d").css("color", "#dc3545");
                $("input#_email_d").css("border-color", "#dc3545");
                $('._email_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Email tidak boleh kosong.</li></ul>');
                return;
            }
            if (nohp === "") {
                $("input#_nohp_d").css("color", "#dc3545");
                $("input#_nohp_d").css("border-color", "#dc3545");
                $('._nohp_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">No Handphone tidak boleh kosong.</li></ul>');
                return;
            }
            if (peserta_didik_id.length !== 36) {
                $("input#_peserta_didik_id_d").css("color", "#dc3545");
                $("input#_peserta_didik_id_d").css("border-color", "#dc3545");
                $('._peserta_didik_id_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Peserta didik id tidak valid.</li></ul>');
                return;
            }

            $.ajax({
                url: BASE_URL + '/dinas/masterdata/pengguna/savePenguna',
                type: 'POST',
                data: {
                    nisn: nisn,
                    key: keyD,
                    npsn: npsn,
                    email: email,
                    nohp: nohp,
                    peserta_didik_id: peserta_didik_id,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    loading = true;
                    $('div.modal-content-loading').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    $('div.modal-content-loading').unblock();
                    if (msg.code !== 200) {

                        Swal.fire(
                            'Gagal!',
                            msg.message,
                            'warning'
                        );

                    } else {
                        Swal.fire(
                            'Berhasil!',
                            msg.message,
                            'success'
                        ).then((valRes) => {
                            document.location.href = reloadPage();
                        })
                    }
                },
                error: function(data) {
                    $('div.modal-content-loading').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );

                }
            })
        }
    </script>
<?php } ?>