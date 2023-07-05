<?php if (isset($data)) { ?>
    <form id="formPilihanData" class="form-horizontal form-pilihan-data" method="post">
        <input type="hidden" value="<?= $data->id ?>" name="_id" id="_id" />
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group _jenis_prestasi-block">
                    <label for="_jenis_prestasi" class="form-control-label">Pilih Jenis Prestasi</label>
                    <select onChange="changeJenisPrestasi(this);" class="form-control jenis_prestasi" name="_jenis_prestasi" id="_jenis_prestasi" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                        <option value="">&nbsp;</option>
                        <option value="AKADEMIK" <?= $data->jenis_prestasi == "AKADEMIK" ? ' selected' : '' ?>>AKADEMIK</option>
                        <option value="NON AKADEMIK" <?= $data->jenis_prestasi == "NON AKADEMIK" ? ' selected' : '' ?>>NON AKADEMIK</option>
                    </select>
                    <div class="help-block _jenis_prestasi"></div>
                </div>
            </div>
            <div class="content-pilihan-prestasi-akademik" id="content-pilihan-prestasi-akademik" style="display:  <?= $data->jenis_prestasi == "AKADEMIK" ? 'block' : '' ?>;">
                <div class="col-md-12">
                    <div class="form-group _pilih_peringkat-block">
                        <label for="_pilih_peringkat" class="form-control-label">Pilih Peringkat</label>
                        <select class="form-control pilih_peringkat" name="_pilih_peringkat" id="_pilih_peringkat" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">&nbsp;</option>
                            <option value="PERINGKAT PERTAMA" <?= $data->peringkat_prestasi == "PERINGKAT PERTAMA" ? ' selected' : '' ?>>PERINGKAT PERTAMA</option>
                            <option value="PERINGKAT KEDUA" <?= $data->peringkat_prestasi == "PERINGKAT KEDUA" ? ' selected' : '' ?>>PERINGKAT KEDUA</option>
                            <option value="PERINGKAT KETIGA" <?= $data->peringkat_prestasi == "PERINGKAT KETIGA" ? ' selected' : '' ?>>PERINGKAT KETIGA</option>
                        </select>
                        <div class="help-block _pilih_peringkat"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group _pilih_akreditasi-block">
                        <label for="_pilih_akreditasi" class="form-control-label">Pilih Akreditasi</label>
                        <select class="form-control pilih_akreditasi" name="_pilih_akreditasi" id="_pilih_akreditasi" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">&nbsp;</option>
                            <option value="AKREDITASI A" <?= $data->akreditasi_prestasi == "AKREDITASI A" ? ' selected' : '' ?>>AKREDITASI A</option>
                            <option value="AKREDITASI B" <?= $data->akreditasi_prestasi == "AKREDITASI B" ? ' selected' : '' ?>>AKREDITASI B</option>
                            <option value="AKREDITASI C" <?= $data->akreditasi_prestasi == "AKREDITASI C" ? ' selected' : '' ?>>AKREDITASI C</option>
                        </select>
                        <div class="help-block _pilih_akreditasi"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group _nilai_rata_rata-block">
                        <label for="_nilai_rata_rata" class="form-control-label">Nilai Rata-Rata (Ijazah/SKL)</label>
                        <input type="text" value="<?= $data->nilai_prestasi ?>" class="form-control" id="_nilai_rata_rata" name="_nilai_rata_rata" placeholder="Nilai rata-rata " />
                        <div class="help-block _nilai_rata_rata"></div>
                    </div>
                </div>
            </div>
            <div class="content-pilihan-prestasi-non-akademik" id="content-pilihan-prestasi-non-akademik" style="display: <?= $data->jenis_prestasi == "NON AKADEMIK" ? 'block' : '' ?>;">
                <div class="col-md-12">
                    <div class="form-group _pilih_tingkat-block">
                        <label for="_pilih_tingkat" class="form-control-label">Pilih Tingkat</label>
                        <select class="form-control pilih_tingkat" name="_pilih_tingkat" id="_pilih_tingkat" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">&nbsp;</option>
                            <option value="INTERNASIONAL" <?= $data->tingkat_prestasi == "INTERNASIONAL" ? ' selected' : '' ?>>INTERNASIONAL</option>
                            <option value="NASIONAL" <?= $data->tingkat_prestasi == "NASIONAL" ? ' selected' : '' ?>>NASIONAL</option>
                            <option value="PROVINSI" <?= $data->tingkat_prestasi == "PROVINSI" ? ' selected' : '' ?>>PROVINSI</option>
                            <option value="KABUPATEN/KOTA" <?= $data->tingkat_prestasi == "KABUPATEN/KOTA" ? ' selected' : '' ?>>KABUPATEN/KOTA</option>
                            <option value="KECAMATAN" <?= $data->tingkat_prestasi == "KECAMATAN" ? ' selected' : '' ?>>KECAMATAN</option>
                        </select>
                        <div class="help-block _pilih_tingkat"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group _pilih_juara-block">
                        <label for="_pilih_juara" class="form-control-label">Pilih Juara</label>
                        <select class="form-control pilih_juara" name="_pilih_juara" id="_pilih_juara" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">&nbsp;</option>
                            <option value="JUARA PERTAMA" <?= $data->juara_prestasi == "JUARA PERTAMA" ? ' selected' : '' ?>>JUARA PERTAMA</option>
                            <option value="JUARA KEDUA" <?= $data->juara_prestasi == "JUARA KEDUA" ? ' selected' : '' ?>>JUARA KEDUA</option>
                            <option value="JUARA KETIGA" <?= $data->juara_prestasi == "JUARA KETIGA" ? ' selected' : '' ?>>JUARA KETIGA</option>
                            <option value="JAMBORE TK. INTERNASIONAL" <?= $data->juara_prestasi == "JAMBORE TK. INTERNASIONAL" ? ' selected' : '' ?>>JAMBORE TK. INTERNASIONAL</option>
                            <option value="JAMBORE TK. NASIONAL" <?= $data->juara_prestasi == "JAMBORE TK. NASIONAL" ? ' selected' : '' ?>>JAMBORE TK. NASIONAL</option>
                        </select>
                        <div class="help-block _pilih_juara"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="saveEditPeringkat(this)" class="btn btn-outline-primary">Simpan</button>
        </div>
    </form>

    <script>
        let contentAkademik = document.getElementById("content-pilihan-prestasi-akademik");
        let contentNonAkademik = document.getElementById("content-pilihan-prestasi-non-akademik");

        function changeJenisPrestasi(event) {
            if (event.value !== "") {
                const color = $(event).attr('name');
                $(event).removeAttr('style');
                $('.' + color).html('');

                if (event.value === "AKADEMIK") {
                    contentAkademik.style.display = "block";
                    contentNonAkademik.style.display = "none";
                }
                if (event.value === "NON AKADEMIK") {
                    contentAkademik.style.display = "none";
                    contentNonAkademik.style.display = "block";
                }

            }
        }

        function saveEditPeringkat(event) {
            const id = document.getElementsByName('_id')[0].value;

            const jenis_prestasi = document.getElementsByName('_jenis_prestasi')[0].value;

            const peringkat_prestasi = document.getElementsByName('_pilih_peringkat')[0].value;
            const akreditasi_prestasi = document.getElementsByName('_pilih_akreditasi')[0].value;
            const nilai_prestasi = document.getElementsByName('_nilai_rata_rata')[0].value;

            const tingkat_prestasi = document.getElementsByName('_pilih_tingkat')[0].value;
            const juara_prestasi = document.getElementsByName('_pilih_juara')[0].value;

            if (jenis_prestasi === "") {
                $("select#_jenis_prestasi").css("color", "#dc3545");
                $("select#_jenis_prestasi").css("border-color", "#dc3545");
                $('._jenis_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih jenis prestasi.</li></ul>');
                return;
            }

            if (jenis_prestasi === "AKADEMIK") {
                if (peringkat_prestasi === "") {
                    $("select#_pilih_peringkat").css("color", "#dc3545");
                    $("select#_pilih_peringkat").css("border-color", "#dc3545");
                    $('._pilih_peringkat').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih peringkat.</li></ul>');
                    return;
                }
                if (akreditasi_prestasi === "") {
                    $("select#_pilih_akreditasi").css("color", "#dc3545");
                    $("select#_pilih_akreditasi").css("border-color", "#dc3545");
                    $('._pilih_akreditasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih akreditasi.</li></ul>');
                    return;
                }
                if (nilai_prestasi === "") {
                    $("input#_nilai_rata_rata").css("color", "#dc3545");
                    $("input#_nilai_rata_rata").css("border-color", "#dc3545");
                    $('._nilai_rata_rata').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Inputkan nilai rata-rata Ijazah/SKL.</li></ul>');
                    return;
                }
            }

            if (jenis_prestasi === "NON AKADEMIK") {
                if (tingkat_prestasi === "") {
                    $("select#_pilih_tingkat").css("color", "#dc3545");
                    $("select#_pilih_tingkat").css("border-color", "#dc3545");
                    $('._pilih_tingkat').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih tingkat.</li></ul>');
                    return;
                }
                if (juara_prestasi === "") {
                    $("select#_pilih_juara").css("color", "#dc3545");
                    $("select#_pilih_juara").css("border-color", "#dc3545");
                    $('._pilih_juara').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Pilih juara.</li></ul>');
                    return;
                }
            }

            Swal.fire({
                title: 'Apakah anda yakin ingin menyimpan perubahan pada peringkat peserta ini?',
                text: "Simpan Perubahan Prestasi: " + name,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan & Update!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "./editSavePeringkat",
                        type: 'POST',
                        data: {
                            id: id,
                            jenis_prestasi: jenis_prestasi,
                            peringkat_prestasi: peringkat_prestasi,
                            akreditasi_prestasi: akreditasi_prestasi,
                            nilai_prestasi: nilai_prestasi,
                            tingkat_prestasi: tingkat_prestasi,
                            juara_prestasi: juara_prestasi,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            $('div.modal-content-update-loading').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(resul) {
                            $('div.modal-content-update-loading').unblock();

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
                            $('div.modal-content-update-loading').unblock();
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
    </script>

<?php } ?>