<?php if (isset($data)) { ?>
    <form id="formAddData" class="form-horizontal form-add-data" method="post">
        <input type="hidden" value="<?= $data->id ?>" name="_id" id="_id" />
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group nama-block">
                    <label for="nama" class="form-control-label">Nama Peserta</label>
                    <input type="text" class="form-control nama" value="<?= $data->fullname ?>" name="_fullname" placeholder="nama..." id="_fullname" onfocusin="inputFocus(this);" readonly>
                    <div class="help-block nama"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _latitude-block">
                    <label for="_latitude" class="form-control-label">Latitude</label>
                    <input type="text" class="form-control latitude" value="<?= $data->latitude == null ? '' : $data->latitude ?>" name="_latitude" placeholder="Latitude..." id="_latitude" onfocusin="inputFocus(this);" required>
                    <div class="help-block _latitude"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group _longitude-block">
                    <label for="_longitude" class="form-control-label">Longitude</label>
                    <input type="text" class="form-control longitude" value="<?= $data->longitude ?>" name="_longitude" placeholder="Longitude..." id="_longitude" onfocusin="inputFocus(this);" required>
                    <div class="help-block _longitude"></div>
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
            const id = document.getElementsByName('_id')[0].value;
            const latitude = document.getElementsByName('_latitude')[0].value;
            const longitude = document.getElementsByName('_longitude')[0].value;
            if (latitude === "") {
                $("input#_latitude").css("color", "#dc3545");
                $("input#_latitude").css("border-color", "#dc3545");
                $('._latitude').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Kode kelurahan/desa tidak boleh kosong.</li></ul>');
            }
            if (longitude === "") {
                $("input#_longitude").css("color", "#dc3545");
                $("input#_longitude").css("border-color", "#dc3545");
                $('._longitude').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Nama kelurahan/desa tidak boleh kosong.</li></ul>');
            }

            if (id === "" || latitude === "" || longitude === "") {
                return;
            } else {
                $.ajax({
                    url: "./editSave",
                    type: 'POST',
                    data: {
                        id: id,
                        latitude: latitude,
                        longitude: longitude,
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
        }
    </script>
<?php } ?>