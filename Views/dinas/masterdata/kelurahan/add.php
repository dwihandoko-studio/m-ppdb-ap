<form id="formAddData" class="form-horizontal form-add-data" method="post">
    <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
        <div class="col-md-12">
            <div class="form-group _kecamatan-block">
                <label for="_kecamatan" class="form-control-label">Kecamatan</label>
                <select class="form-control kecamatan" name="_kecamatan" id="_kecamatan" onchange="changeKecamatan(this)" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                    <option value="">-- Pilih --</option>
                    <?php if (isset($kecamatans)) {
                        if (count($kecamatans) > 0) {
                            foreach ($kecamatans as $key => $value) {
                                echo '<option value="' . $value->id . '">' . $value->nama . '</option>';
                            }
                        }
                    } ?>
                </select>
                <div class="help-block _kecamatan"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group _kode-block">
                <label for="_kode" class="form-control-label">Kode</label>
                <input type="text" class="form-control kode" name="_kode" placeholder="Kode..." id="_kode" onfocusin="inputFocus(this);" required>
                <div class="help-block _kode"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group _nama-block">
                <label for="_nama" class="form-control-label">Nama Kelurahan/Desa</label>
                <input type="text" class="form-control nama" name="_nama" placeholder="Nama kelurahan/desa..." id="_nama" onfocusin="inputFocus(this);" required>
                <div class="help-block _nama"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="saveAdd(this)" class="btn btn-outline-primary">Simpan</button>
    </div>
</form>

<script>
    initSelect2('_kecamatan', '#contentModal');

    function changeKecamatan(event) {
        if (event.value !== "") {
            const color = $(event).attr('name');
            $(event).removeAttr('style');
            $('.' + color).html('');
            // $.ajax({
            //     url: BASE_URL + '/dinas/referensi/getSekolah',
            //     type: 'POST',
            //     data: {
            //         id: event.value,
            //     },
            //     dataType: 'JSON',
            //     beforeSend: function() {
            //         $('.sekolah').html('<option value="" selected>--Pilih Sekolah--</option>');
            //         $('div._sekolah-block').block({
            //             message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            //         });
            //     },
            //     success: function(msg) {
            //         $('div._sekolah-block').unblock();
            //         if (msg.code == 200) {
            //             let html = "";
            //             html += '<option value="">--Pilih Sekolah--</option>';
            //             if (msg.data.length > 0) {
            //                 for (let step = 0; step < msg.data.length; step++) {
            //                     html += '<option value="';
            //                     html += msg.data[step].id;
            //                     html += '">';
            //                     html += msg.data[step].npsn;
            //                     html += ' - ';
            //                     html += msg.data[step].nama;
            //                     html += '</option>';
            //                 }

            //             }

            //             $('.sekolah').html(html);
            //         }
            //     },
            //     error: function(data) {
            //         console.log(data);
            //         $('div._sekolah-block').unblock();
            //     }
            // })
        }
    }

    function saveAdd(event) {
        const kode = document.getElementsByName('_kode')[0].value;
        const kecamatan = document.getElementsByName('_kecamatan')[0].value;
        const nama = document.getElementsByName('_nama')[0].value;

        if (kecamatan === "") {
            $("select#_kecamatan").css("color", "#dc3545");
            $("select#_kecamatan").css("border-color", "#dc3545");
            $('._kecamatan').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Kecamatan tidak boleh kosong.</li></ul>');
        }
        if (kode === "") {
            $("input#_kode").css("color", "#dc3545");
            $("input#_kode").css("border-color", "#dc3545");
            $('._kode').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Kode kelurahan/desa tidak boleh kosong.</li></ul>');
        }
        if (nama === "") {
            $("input#_nama").css("color", "#dc3545");
            $("input#_nama").css("border-color", "#dc3545");
            $('._nama').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Nama kelurahan/desa tidak boleh kosong.</li></ul>');
        }

        if (kecamatan === "" || kode === "" || nama === "") {
            return;
        } else {
            $.ajax({
                url: BASE_URL + "/dinas/masterdata/kelurahan/addSave",
                type: 'POST',
                data: {
                    kecamatan: kecamatan,
                    kode: kode,
                    nama: nama,
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