<?php if (isset($data)) {
    if (isset($data->details)) {
        $siswa = json_decode($data->details);
?>
        <form id="formAddData" class="form-horizontal form-add-data" method="post">
            <input type="hidden" value="<?= $data->peserta_didik_id ?>" name="_id" />
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Data Peserta Didik</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Nama</label>
                                    <input type="text" value="<?= $data->fullname ?>" class="form-control judul" name="_namas" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">NISN</label>
                                    <input type="text" value="<?= $data->nisn ?>" class="form-control judul" name="_nisn" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">NIK</label>
                                    <input type="text" value="<?= $siswa->nik ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Tempat Lahir</label>
                                    <input type="text" value="<?= $siswa->tempat_lahir ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Tanggal Lahir</label>
                                    <input type="text" value="<?= $siswa->tanggal_lahir ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Jenis Kelamin</label>
                                    <input type="text" value="<?= $siswa->jenis_kelamin ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Nama Ibu Kandung</label>
                                    <input type="text" value="<?= $siswa->nama_ibu_kandung ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h4>Data Alamat Siswa</h4>
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Provinsi</label>
                                    <input type="text" value="<?= $data->namaProvinsi ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Kabupaten</label>
                                    <input type="text" value="<?= $data->namaKabupaten ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Kecamatan</label>
                                    <input type="text" value="<?= $data->namaKecamatan ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Kelurahan</label>
                                    <input type="text" value="<?= $data->namaKelurahan ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Dusun</label>
                                    <input type="text" value="<?= $data->namaDusun ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Alamat</label>
                                    <textarea class="form-control judul" id="_nama" readonly><?= $data->alamat ?></textarea>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h4>Data Sekolah Asal</h4>
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">Nama Sekolah Asal</label>
                                    <input type="text" value="<?= $data->namaSekolahAsal ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group _nama-block">
                                    <label for="_nama" class="form-control-label">NPSN Sekolah Asal</label>
                                    <input type="text" value="<?= ($data->npsnSekolahAsal == '10000001') ? '-' : $data->npsnSekolahAsal ?>" class="form-control judul" id="_nama" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4>Data Sekolah Pelimpahan</h4>
                        <div class="col-md-12">
                            <div class="form-group _kec-block">
                                <label for="_kec" class="form-control-label">Kecamatan</label>
                                <select onChange="changeKecamatan(this);" class="form-control kec" name="_kec" id="_kec" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    <option value="">-- Pilih --</option>
                                    <?php if (isset($kecamatans)) {
                                        if (count($kecamatans) > 0) {
                                            foreach ($kecamatans as $key => $val) { ?>
                                                <option value="<?= $val->id ?>"><?= $val->nama ?></option>
                                    <?php }
                                        }
                                    } ?>
                                </select>
                                <div class="help-block _kec"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group _sekolah-block">
                                <label for="_sekolah" class="form-control-label">Sekolah</label>
                                <select onChange="changeSekolah(this);" class="form-control sekolah" name="_sekolah" id="_sekolah" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    <option value="">-- Pilih --</option>
                                </select>
                                <div class="help-block _sekolah"></div>
                            </div>
                        </div>
                        <div class="col-md-12 button-pelimpahan" id="button-pelimpahan" style="display: none;">
                            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="actionDaftarPelimpahan(this)">DAFTARKAN</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                
            </div>
        </form>
        <script>
            initSelect2('_kec', '#contentModal');
            initSelect2('_sekolah', '#contentModal');
            
            function actionDaftarPelimpahan(event) {
                const nama = document.getElementsByName('_namas')[0].value;
                const nisn = document.getElementsByName('_nisn')[0].value;
                Swal.fire({
                    title: 'Apakah anda yakin ingin mendaftarkan perseta didik ini?',
                    text: 'Daftarkan ' + nama + ' - ' + nisn + ' ke sekolah yang telah dipilih.',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Daftarkan!'
                }).then((result) => {
                    if (result.value) {
                        const peserta_didik_id = document.getElementsByName('_id')[0].value;
                        const sekolah_tujuan = document.getElementsByName('_sekolah')[0].value;
                        
                        $.ajax({
                            url: BASE_URL + '/dinas/pelimpahan/sd/savepelimpahan',
                            type: 'POST',
                            data: {
                                peserta_didik_id: peserta_didik_id,
                                sekolah_tujuan: sekolah_tujuan,
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
                                        if (resul.code === 201) {
                                            Swal.fire(
                                                'PERINGATAN!',
                                                resul.message,
                                                'warning'
                                            ).then((valRes) => {
                                                reloadPage();
                                            })
                                        } else {
                                            Swal.fire(
                                                'GAGAL!',
                                                resul.message,
                                                'warning'
                                            );
                                        }
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
            
            function changeSekolah(event) {
                if(event.value !== "") {
                    $('.button-pelimpahan').css('display', 'block');
                } else {
                    $('.button-pelimpahan').css('display', 'none');
                }
            }
            
            function changeKecamatan(event) {
                if (event.value !== "") {
                    const color = $(event).attr('name');
                    $(event).removeAttr('style');
                    $('.' + color).html('');
                    // $( "label#"+color ).css("color", "#555");
        
                    $.ajax({
                        url: BASE_URL + '/dinas/pelimpahan/sd/getSekolah',
                        type: 'POST',
                        data: {
                            id: event.value,
                            lat: '<?= $data->latitude ?>',
                            long: '<?= $data->longitude ?>',
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            $('.sekolah').html('<option value="" selected>--Pilih--</option>');
        
                            $('div._sekolah-block').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(msg) {
                            $('div._sekolah-block').unblock();
                            if (msg.code == 200) {
                                let htmlkel = "";
                                htmlkel += '<option value="">--Pilih Sekolah--</option>';
                                if (msg.data.length > 0) {
                                    for (let step = 0; step < msg.data.length; step++) {
                                        // if(step === 0) {
                                        //     htmlkel += '<option style="color: #F0" data-color="#F0" value="';
                                        // } else {
                                        // }
                                            htmlkel += '<option value="';
                                        htmlkel += msg.data[step].id;
                                        htmlkel += '">';
                                        // htmlkel += step;
                                        // htmlkel += ' - ';
                                        htmlkel += msg.data[step].nama;
                                        htmlkel += ' - ';
                                        // htmlkel += Math.round(parseFloat(msg.data[step].jarak) * 100)/100;
                                        // htmlkel += roundToTwo(parseFloat(msg.data[step].jarak));
                                        htmlkel += msg.data[step].jarak;
                                        htmlkel += ' Km ';
                                        htmlkel += '</option>';
                                    }
        
                                }
        
                                $('.sekolah').html(htmlkel);
                            }
                        },
                        error: function(data) {
                            console.log(data);
                            $('div._sekolah-block').unblock();
                        }
                    })
                }
            }

        </script>
<?php }
} ?>