<?php if (isset($tujuan_sekolah_id)) { ?>
    <form id="formPilihanData" class="form-horizontal form-pilihan-data" method="post">
        <input type="hidden" id="_tujuan_sekolah_id" name="_tujuan_sekolah_id" value="<?= $tujuan_sekolah_id ?>" />
        <input type="hidden" id="_tujuan_sekolah_nama" name="_tujuan_sekolah_nama" value="<?= $tujuan_sekolah_nama ?>" />
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="col-md-12">
                <div class="form-group _jenis_prestasi-block">
                    <label for="_jenis_prestasi" class="form-control-label">Pilih Jenis Prestasi</label>
                    <select onChange="changeJenisPrestasi(this);" class="form-control jenis_prestasi" name="_jenis_prestasi" id="_jenis_prestasi" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                        <option value="" selected>&nbsp;</option>
                        <option value="AKADEMIK">AKADEMIK</option>
                        <option value="NON AKADEMIK">NON AKADEMIK</option>
                    </select>
                    <div class="help-block _jenis_prestasi"></div>
                </div>
            </div>
            <div class="content-pilihan-prestasi-akademik" id="content-pilihan-prestasi-akademik" style="display: none;">
                <div class="col-md-12">
                    <div class="form-group _pilih_peringkat-block">
                        <label for="_pilih_peringkat" class="form-control-label">Pilih Peringkat</label>
                        <select class="form-control pilih_peringkat" name="_pilih_peringkat" id="_pilih_peringkat" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">&nbsp;</option>
                            <option value="PERINGKAT PERTAMA">PERINGKAT PERTAMA</option>
                            <option value="PERINGKAT KEDUA">PERINGKAT KEDUA</option>
                            <option value="PERINGKAT KETIGA">PERINGKAT KETIGA</option>
                        </select>
                        <div class="help-block _pilih_peringkat"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group _pilih_akreditasi-block">
                        <label for="_pilih_akreditasi" class="form-control-label">Pilih Akreditasi</label>
                        <select class="form-control pilih_akreditasi" name="_pilih_akreditasi" id="_pilih_akreditasi" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">&nbsp;</option>
                            <option value="AKREDITASI A">AKREDITASI A</option>
                            <option value="AKREDITASI B">AKREDITASI B</option>
                            <option value="AKREDITASI C">AKREDITASI C</option>
                        </select>
                        <div class="help-block _pilih_akreditasi"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group _nilai_rata_rata-block">
                        <label for="_nilai_rata_rata" class="form-control-label">Nilai Rata-Rata (Ijazah/SKL)</label>
                        <input type="text" class="form-control" id="_nilai_rata_rata" name="_nilai_rata_rata" placeholder="Nilai rata-rata " />
                        <div class="help-block _nilai_rata_rata"></div>
                    </div>
                </div>
            </div>
            <div class="content-pilihan-prestasi-non-akademik" id="content-pilihan-prestasi-non-akademik" style="display: none;">
                <div class="col-md-12">
                    <div class="form-group _pilih_tingkat-block">
                        <label for="_pilih_tingkat" class="form-control-label">Pilih Tingkat</label>
                        <select class="form-control pilih_tingkat" name="_pilih_tingkat" id="_pilih_tingkat" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">&nbsp;</option>
                            <option value="INTERNASIONAL">INTERNASIONAL</option>
                            <option value="NASIONAL">NASIONAL</option>
                            <option value="PROVINSI">PROVINSI</option>
                            <option value="KABUPATEN/KOTA">KABUPATEN/KOTA</option>
                            <option value="KECAMATAN">KECAMATAN</option>
                        </select>
                        <div class="help-block _pilih_tingkat"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group _pilih_juara-block">
                        <label for="_pilih_juara" class="form-control-label">Pilih Juara</label>
                        <select class="form-control pilih_juara" name="_pilih_juara" id="_pilih_juara" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                            <option value="">&nbsp;</option>
                            <option value="JUARA PERTAMA">JUARA PERTAMA</option>
                            <option value="JUARA KEDUA">JUARA KEDUA</option>
                            <option value="JUARA KETIGA">JUARA KETIGA</option>
                            <option value="JAMBORE TK. INTERNASIONAL">JAMBORE TK. INTERNASIONAL</option>
                            <option value="JAMBORE TK. NASIONAL">JAMBORE TK. NASIONAL</option>
                        </select>
                        <div class="help-block _pilih_juara"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="saveAddPendaftaran(this)" class="btn btn-outline-primary">Simpan</button>
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

        function saveAddPendaftaran(event) {
            const tujuan_sekolah_id = document.getElementsByName('_tujuan_sekolah_id')[0].value;
            const tujuan_sekolah_nama = document.getElementsByName('_tujuan_sekolah_nama')[0].value;

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


            $.ajax({
                url: BASE_URL + "/peserta/pendaftaran/prestasi/aksidaftar",
                type: 'POST',
                data: {
                    tujuan_sekolah_id: tujuan_sekolah_id,
                    tujuan_sekolah_nama: tujuan_sekolah_nama,
                    jenis_prestasi: jenis_prestasi,
                    peringkat_prestasi: peringkat_prestasi,
                    akreditasi_prestasi: akreditasi_prestasi,
                    nilai_prestasi: nilai_prestasi,
                    tingkat_prestasi: tingkat_prestasi,
                    juara_prestasi: juara_prestasi,
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
                        // Swal.fire(
                        //     'SELAMAT!',
                        //     resul.message,
                        //     'success'
                        // ).then((valRes) => {
                        //     reloadPage();
                        // })
                        Swal.fire({
                            title: 'BERHASIL !!!',
                            text: resul.message,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Tutup',
                            confirmButtonText: 'Download Bukti Pendaftaran'
                        }).then((result) => {
                            if (result.value) {
                                window.open(
                                    "<?= base_url('peserta/riwayat/cetakpendaftaran') ?>?id=" + resul.data.id + "&kode=" + resul.data.kode_pendaftaran + "&jalur=" + resul.data.via_jalur, "_blank");
                                // document.location.href = "<?= base_url("peserta/home") ?>";
                                reloadPage('<?= base_url("peserta/home") ?>');
                            } else {
                                console.log('tutup');
                                reloadPage();
                            }
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