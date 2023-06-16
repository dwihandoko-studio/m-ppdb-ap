<?php if (isset($data)) { ?>
    <form id="formEditData" class="form-horizontal form-edit-data" method="post">
        <input type="hidden" id="_id" name="_id" value="<?= $data->id ?>" />
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group _nama_panitia-block">
                    <label for="_nama_panitia" class="form-control-label">Nama Panitia</label>
                    <input type="text" class="form-control nama-panitia" name="_nama_panitia" value="<?= $data->nama ?>" placeholder="Nama panitia..." id="_nama_panitia" onfocusin="inputFocus(this);" required>
                    <div class="help-block _nama_panitia"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _nohp_panitia-block">
                    <label for="_nohp_panitia" class="form-control-label">No Handphone Panitia</label>
                    <input type="text" class="form-control nohp-panitia" value="<?= $data->no_hp ?>" name="_nohp_panitia" placeholder="No handphone panitia..." id="_nohp_panitia" onfocusin="inputFocus(this);" required>
                    <div class="help-block _nohp_panitia"></div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="saveAdd(this)" class="btn btn-outline-primary">Simpan</button>
        </div>
    </form>

    <script>
        function saveAdd(event) {
            const nama_panitia = document.getElementsByName('_nama_panitia')[0].value;
            const nohp_panitia = document.getElementsByName('_nohp_panitia')[0].value;
            const id = document.getElementsByName('_id')[0].value;

            if (nama_panitia === "") {
                $("input#_nama_panitia").css("color", "#dc3545");
                $("input#_nama_panitia").css("border-color", "#dc3545");
                $('._nama_panitia').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Nama panitia tidak boleh kosong.</li></ul>');
                return;
            }

            if (nohp_panitia === "") {
                $("input#_nohp_panitia").css("color", "#dc3545");
                $("input#_nohp_panitia").css("border-color", "#dc3545");
                $('._nohp_panitia').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Nomor handphone panitia tidak boleh kosong.</li></ul>');
                return;
            }

            $.ajax({
                url: BASE_URL + "/sekolah/setting/panitia/editSave",
                type: 'POST',
                data: {
                    nama_panitia: nama_panitia,
                    nohp_panitia: nohp_panitia,
                    id: id,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('div.modal-content-loading').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(resul) {
                    $('div.modal-content-loading').unblock();

                    if (resul.code !== 200) {
                        if (resul.code === 401) {
                            Swal.fire(
                                'Failed!',
                                resul.message,
                                'warning'
                            ).then((valRes) => {
                                document.location.href = BASE_URL + '/dashboard';
                            });
                        } else {
                            Swal.fire(
                                'GAGAL!',
                                resul.message,
                                'warning'
                            );
                        }
                    } else {
                        Swal.fire(
                            'SELAMAT!',
                            resul.message,
                            'success'
                        ).then((valRes) => {
                            reloadPage();
                        })
                    }
                },
                error: function() {
                    $('div.modal-content-loading').unblock();
                    Swal.fire(
                        'PERINGATAN!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            });
        }
    </script>
<?php } ?>