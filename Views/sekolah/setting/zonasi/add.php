<form id="formAddData" class="form-horizontal form-add-data" method="post">
    <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
        <div class="col-md-12">
            <div class="form-group _prov-block">
                <label for="_prov" class="form-control-label">Provinsi</label>
                <select onChange="changeProvinsi(this);" class="form-control prov" name="_prov" id="_prov" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                    <option value="">-- Pilih --</option>
                    <?php if (isset($provinsis)) {
                        if (count($provinsis) > 0) {
                            foreach ($provinsis as $key => $val) { ?>
                                <option value="<?= $val->id ?>"><?= $val->nama ?></option>
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
                <select onChange="changeKabupaten(this);" class="form-control kab" name="_kab" id="_kab" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                    <option value="">-- Pilih --</option>
                </select>
                <div class="help-block _kab"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group _kec-block">
                <label for="_kec" class="form-control-label">Kecamatan</label>
                <select onChange="changeKecamatan(this);" class="form-control kec" name="_kec" id="_kec" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                    <option value="">-- Pilih --</option>
                </select>
                <div class="help-block _kec"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group _kel-block">
                <label for="_kel" class="form-control-label">Kelurahan</label>
                <select onChange="changeKelurahan(this);" class="form-control kel" name="_kel" id="_kel" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                    <option value="">-- Pilih --</option>
                </select>
                <div class="help-block _kel"></div>
            </div>
        </div>
        <!-- <div class="col-md-12">
            <div class="form-group _dusun-block">
                <label for="_dusun" class="form-control-label">Dusun</label>
                <select onChange="changeDusun(this);" class="form-control dusun" name="_dusun" id="_dusun" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                    <option value="">-- Pilih --</option>
                </select>
                <div class="help-block _dusun"></div>
            </div>
        </div> -->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="saveAdd(this)" class="btn btn-outline-primary">Simpan</button>
    </div>
</form>

<script>
    function changeDusun(event) {
        if (event.value !== "") {
            const color = $(event).attr('name');
            $(event).removeAttr('style');
            $('.' + color).html('');
            // $( "label#"+color ).css("color", "#555");

        }
    }

    function changeKelurahan(event) {
        if (event.value !== "") {
            const color = $(event).attr('name');
            $(event).removeAttr('style');
            $('.' + color).html('');
            // $( "label#"+color ).css("color", "#555");

            // $.ajax({
            //     url: BASE_URL + '/sekolah/referensi/getDusun',
            //     type: 'POST',
            //     data: {
            //         id: event.value,
            //     },
            //     dataType: 'JSON',
            //     beforeSend: function() {
            //         $('.dusun').html('<option value="" selected>--Pilih--</option>');

            //         $('div._dusun-block').block({
            //             message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            //         });
            //     },
            //     success: function(msg) {
            //         // console.log(msg);
            //         $('div._dusun-block').unblock();
            //         // const msg = JSON.parse(resMsg);
            //         // const msg = JSON.parse(JSON.stringify(resMsg));
            //         if (msg.code == 200) {
            //             let htmldus = "";
            //             htmldus += '<option value="">--Pilih Dusun--</option>';
            //             if (msg.data.length > 0) {
            //                 for (let step = 0; step < msg.data.length; step++) {
            //                     htmldus += '<option value="';
            //                     htmldus += msg.data[step].id;
            //                     htmldus += '">';
            //                     htmldus += msg.data[step].nama;
            //                     htmldus += '</option>';
            //                 }

            //             }

            //             $('.dusun').html(htmldus);
            //         }
            //     },
            //     error: function(data) {
            //         console.log(data);
            //         $('div._dusun-block').unblock();
            //     }
            // })
        }
    }

    function changeKecamatan(event) {
        if (event.value !== "") {
            const color = $(event).attr('name');
            $(event).removeAttr('style');
            $('.' + color).html('');
            // $( "label#"+color ).css("color", "#555");

            $.ajax({
                url: BASE_URL + '/sekolah/referensi/getKelurahan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kel').html('<option value="" selected>--Pilih--</option>');
                    // $('.dusun').html('<option value="" selected>--Pilih--</option>');

                    $('div._kel-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    // $('div._dusun-block').block({
                    //     message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    // });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kel-block').unblock();
                    // $('div._dusun-block').unblock();
                    // const msg = JSON.parse(resMsg);
                    // const msg = JSON.parse(JSON.stringify(resMsg));
                    if (msg.code == 200) {
                        let htmlkel = "";
                        htmlkel += '<option value="">--Pilih Kelurahan--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                htmlkel += '<option value="';
                                htmlkel += msg.data[step].id;
                                htmlkel += '">';
                                htmlkel += msg.data[step].nama;
                                htmlkel += '</option>';
                            }

                        }

                        $('.kel').html(htmlkel);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kel-block').unblock();
                    // $('div._dusun-block').unblock();
                }
            })
        }
    }

    function changeKabupaten(event) {
        if (event.value !== "") {
            const color = $(event).attr('name');
            $(event).removeAttr('style');
            $('.' + color).html('');
            // $( "label#"+color ).css("color", "#555");

            $.ajax({
                url: BASE_URL + '/sekolah/referensi/getKecamatan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kec').html('<option value="" selected>--Pilih--</option>');
                    $('.kel').html('<option value="" selected>--Pilih--</option>');
                    // $('.dusun').html('<option value="" selected>--Pilih--</option>');

                    $('div._kec-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kel-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    // $('div._dusun-block').block({
                    //     message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    // });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kec-block').unblock();
                    $('div._kel-block').unblock();
                    // $('div._dusun-block').unblock();
                    // const msg = JSON.parse(resMsg);
                    // const msg = JSON.parse(JSON.stringify(resMsg));
                    if (msg.code == 200) {
                        let htmlkec = "";
                        htmlkec += '<option value="">--Pilih Kecamatan--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                htmlkec += '<option value="';
                                htmlkec += msg.data[step].id;
                                htmlkec += '">';
                                htmlkec += msg.data[step].nama;
                                htmlkec += '</option>';
                            }

                        }

                        $('.kec').html(htmlkec);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kec-block').unblock();
                    $('div._kel-block').unblock();
                    // $('div._dusun-block').unblock();
                }
            })
        }
    }

    function changeProvinsi(event) {
        if (event.value !== "") {
            const color = $(event).attr('name');
            $(event).removeAttr('style');
            $('.' + color).html('');
            // $( "label#"+color ).css("color", "#555");

            $.ajax({
                url: BASE_URL + '/sekolah/referensi/getKabupaten',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kab').html('<option value="" selected>--Pilih--</option>');
                    $('.kec').html('<option value="" selected>--Pilih--</option>');
                    $('.kel').html('<option value="" selected>--Pilih--</option>');
                    // $('.dusun').html('<option value="" selected>--Pilih--</option>');

                    $('div._kab-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kec-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kel-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    // $('div._dusun-block').block({
                    //     message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    // });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kab-block').unblock();
                    $('div._kec-block').unblock();
                    $('div._kel-block').unblock();
                    // $('div._dusun-block').unblock();
                    // const msg = JSON.parse(resMsg);
                    // const msg = JSON.parse(JSON.stringify(resMsg));
                    if (msg.code == 200) {
                        let htmlkab = "";
                        htmlkab += '<option value="">--Pilih Kabupaten--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                htmlkab += '<option value="';
                                htmlkab += msg.data[step].id;
                                htmlkab += '">';
                                htmlkab += msg.data[step].nama;
                                htmlkab += '</option>';
                            }

                        }

                        $('.kab').html(htmlkab);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kab-block').unblock();
                    $('div._kec-block').unblock();
                    $('div._kel-block').unblock();
                    // $('div._dusun-block').unblock();
                }
            })
        }
    }

    function saveAdd(event) {
        const prov = document.getElementsByName('_prov')[0].value;
        const kab = document.getElementsByName('_kab')[0].value;
        const kec = document.getElementsByName('_kec')[0].value;
        const kel = document.getElementsByName('_kel')[0].value;
        // const dusun = document.getElementsByName('_dusun')[0].value;

        if (prov === "") {
            $("select#_prov").css("color", "#dc3545");
            $("select#_prov").css("border-color", "#dc3545");
            $('._prov').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih provinsi dulu.</li></ul>');
        }
        if (kab === "") {
            $("select#_kab").css("color", "#dc3545");
            $("select#_kab").css("border-color", "#dc3545");
            $('._kab').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih kabupaten dulu.</li></ul>');
        }
        if (kec === "") {
            $("select#_kec").css("color", "#dc3545");
            $("select#_kec").css("border-color", "#dc3545");
            $('._kec').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih kecamatan dulu.</li></ul>');
        }
        if (kel === "") {
            $("select#_kel").css("color", "#dc3545");
            $("select#_kel").css("border-color", "#dc3545");
            $('._kel').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih kelurahan dulu.</li></ul>');
        }
        // if (dusun === "") {
        //     $("select#_dusun").css("color", "#dc3545");
        //     $("select#_dusun").css("border-color", "#dc3545");
        //     $('._dusun').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih dusun dulu.</li></ul>');
        // }

        if (prov === "" || kab === "" || kec === "" || kel === "") {
            // if (prov === "" || kab === "" || kec === "" || kel === "" || dusun === "") {
            return;
        } else {
            $.ajax({
                url: BASE_URL + "/sekolah/setting/zonasi/addSave",
                type: 'POST',
                data: {
                    prov: prov,
                    kab: kab,
                    kec: kec,
                    kel: kel,
                    // dusun: dusun,
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