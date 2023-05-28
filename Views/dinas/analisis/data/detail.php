<?php if (isset($nisn)) { ?>
    <form id="formAddData" class="form-horizontal form-add-data" method="post">
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group -block">
                    <label for="nama" class="form-control-label">Nama</label>
                    <input type="text" value="<?= $nama ?>" class="form-control " name="nama" id="nama" onfocusin="inputFocus(this);" readonly>
                    <div class="help-block nama"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group -block">
                    <label for="nisn" class="form-control-label">NISN</label>
                    <input type="text" value="<?= $nisn ?>" class="form-control" name="nisn" placeholder="NISN..." id="nisn" onfocusin="inputFocus(this);" readonly>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group -block">
                    <label for="nisn" class="form-control-label">Tanggal Lahir</label>
                    <input type="text" value="<?= $tanggal ?>" class="form-control" name="tanggal" placeholder="Tanggal..." id="nisn" onfocusin="inputFocus(this);" readonly>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _nik-block">
                    <label for="_nik" class="form-control-label">NIK </label>
                    <input type="text" value="" class="form-control nik" name="_nik" placeholder="NIK..." id="_nik" onfocusin="inputFocus(this);" required>
                    <div class="help-block _nik"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="saveEditData(this)" class="btn btn-outline-primary">Update</button>
        </div>
    </form>

    <script>
        function saveEditData(event) {
            const nisn = document.getElementsByName('nisn')[0].value;
            const nama = document.getElementsByName('nama')[0].value;
            const tanggal = document.getElementsByName('tanggal')[0].value;
            const nik = document.getElementsByName('_nik')[0].value;

            if (nik === "") {
                $("input#_nik").css("color", "#dc3545");
                $("input#_nik").css("border-color", "#dc3545");
                $('._nik').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">NIK tidak boleh kosong.</li></ul>');
                return;
            }

            if (nisn === "" || nama === "" || tanggal === "" || nik.length !== 16) {
                $("input#_nik").css("color", "#dc3545");
                $("input#_nik").css("border-color", "#dc3545");
                $('._nik').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Panjang NIK harus 16 Digit.</li></ul>');
                return;
            } else {
                
                Swal.fire({
                    title: 'Apakah anda yakin ingin mengupdate data ini?',
                    text: "Update Data NIK Peserta.",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Update!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "<?= base_url('dinas/analisis/data/detailsave') ?>",
                            type: 'POST',
                            data: {
                                nisn: nisn,
                                nama: nama,
                                tanggal: tanggal,
                                nik: nik,
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
                                    if (resul.code !== 201) {
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
                                            'Peringatan!',
                                            resul.message,
                                            'success'
                                        ).then((valRes) => {
                                            reloadPage();
                                        })
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
                })
            }
        }
    </script>

<?php } ?>