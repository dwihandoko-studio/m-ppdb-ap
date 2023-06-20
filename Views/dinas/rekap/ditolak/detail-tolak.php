<?php if (isset($data)) {
    if (isset($data->details)) {
        $siswa = json_decode($data->details);
?>
        <form id="formAddData" class="form-horizontal form-add-data" method="post">
            <div class="modal-body">
                <h4>Data Peserta Didik</h4>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Nama</label>
                            <input type="text" value="<?= str_replace("&#039;", "`", str_replace("'", "`", $data->fullname)) ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">NISN</label>
                            <input type="text" value="<?= $data->nisn ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">No Pendaftaran</label>
                            <input type="text" value="<?= $data->kode_pendaftaran ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">NIK</label>
                            <input type="text" value="<?= $siswa->nik ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Tempat Lahir</label>
                            <input type="text" value="<?= $siswa->tempat_lahir ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Tanggal Lahir</label>
                            <input type="text" value="<?= $siswa->tanggal_lahir ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Jenis Kelamin</label>
                            <input type="text" value="<?= $siswa->jenis_kelamin ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Nama Ibu Kandung</label>
                            <input type="text" value="<?= $siswa->nama_ibu_kandung ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                </div>
                <hr />
                <h4>Informasi Kontak</h4>
                <hr />
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Nomor Handphone</label>
                            <input type="text" value="<?= ($data->no_hp == NULL || $data->no_hp == "") ? '-' : $data->no_hp ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Email</label>
                            <input type="text" value="<?= ($data->email == NULL || $data->email == "") ? '-' : $data->email ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                </div>
                <hr />
                <h4>Data Alamat Siswa</h4>
                <div class="row col-md-12">
                    <div class="col-md-4">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Provinsi</label>
                            <input type="text" value="<?= $data->nama_provinsi ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Kabupaten</label>
                            <input type="text" value="<?= $data->nama_kabupaten ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Kecamatan</label>
                            <input type="text" value="<?= $data->nama_kecamatan ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Kelurahan</label>
                            <input type="text" value="<?= $data->nama_kelurahan ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Dusun</label>
                            <input type="text" value="<?= $data->nama_dusun ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Alamat</label>
                            <input type="text" value="<?= $data->alamat ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                </div>

                <hr />
                <h4>Data Sekolah Asal</h4>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Nama Sekolah Asal</label>
                            <input type="text" value="<?= $data->nama_sekolah_asal ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">NPSN Sekolah Asal</label>
                            <input type="text" value="<?= $data->npsn_sekolah_asal ?>" class="form-control judul" id="_nama" readonly />
                        </div>
                    </div>
                </div>
                <hr />
                <h4>Keterangan Penolakan</h4>
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Keterangan</label>
                            <textarea class="form-control judul" id="_nama" readonly><?= $data->keterangan_penolakan ?></textarea>
                        </div>
                    </div>
                </div>
                <hr />
                <h4>Dokumen Pedaftaran</h4>
                <div class="row col-md-12">
                    <div class="col-md-2">
                        <div class="form-group _nama-block">
                            <img style="min-width: 100px; max-width: 100px;" src="<?= base_url('uploads/peserta/user') . '/' . $data->profile_picture ?>" alt="Pas Foto">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Koordinat Siswa</label>
                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?= $data->latitude ?>%2C<?= $data->longitude ?>" class="btn btn-block btn-warning">Lihat Koordinat</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Lampiran Akta Kelahiran</label>
                            <a target="_blank" href="<?= base_url('uploads/peserta/akta') . '/' . $data->lampiran_akta_kelahiran ?>" class="btn btn-block btn-info">Lampiran Akta Kelahiran</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Kartu Keluarga</label>
                            <a target="_blank" href="<?= base_url('uploads/peserta/kk') . '/' . $data->lampiran_kk ?>" class="btn btn-block btn-info">Lampiran Kartu Keluarga</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Surat Kelulusan</label>
                            <a target="_blank" href="<?= base_url('uploads/peserta/kelulusan') . '/' . $data->lampiran_lulus ?>" class="btn btn-block btn-info">Lampiran Surat Kelulusan</a>
                        </div>
                    </div>
                    <?php if ($data->lampiran_prestasi !== null) { ?>
                        <div class="col-md-3">
                            <div class="form-group _nama-block">
                                <label for="_nama" class="form-control-label">Bukti Pestasi</label>
                                <a target="_blank" href="<?= base_url('uploads/peserta/prestasi') . '/' . $data->lampiran_prestasi ?>" class="btn btn-block btn-info">Lampiran Prestasi</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($data->lampiran_afirmasi !== null) { ?>
                        <div class="col-md-3">
                            <div class="form-group _nama-block">
                                <label for="_nama" class="form-control-label">Bukti Afirmasi</label>
                                <a target="_blank" href="<?= base_url('uploads/peserta/afirmasi') . '/' . $data->lampiran_afirmasi ?>" class="btn btn-block btn-info">Lampiran Afirmasi</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($data->lampiran_foto_rumah !== null) { ?>
                        <div class="col-md-3">
                            <div class="form-group _nama-block">
                                <label for="_nama" class="form-control-label">Foto Rumah</label>
                                <a target="_blank" href="<?= base_url('uploads/peserta/fotorumah') . '/' . $data->lampiran_foto_rumah ?>" class="btn btn-block btn-info">Lampiran Foto Rumah</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($data->lampiran_pernyataan !== null) { ?>
                        <div class="col-md-3">
                            <div class="form-group _nama-block">
                                <label for="_nama" class="form-control-label">Bukti Pernyataan</label>
                                <a target="_blank" href="<?= base_url('uploads/peserta/pernyataan') . '/' . $data->lampiran_pernyataan ?>" class="btn btn-block btn-info">Lampiran Pernyataan</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($data->lampiran_mutasi !== null) { ?>
                        <div class="col-md-3">
                            <div class="form-group _nama-block">
                                <label for="_nama" class="form-control-label">Bukti Mutasi</label>
                                <a target="_blank" href="<?= base_url('uploads/peserta/mutasi') . '/' . $data->lampiran_mutasi ?>" class="btn btn-block btn-info">Lampiran Mutasi</a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($data->lampiran_lainnya !== null) { ?>
                        <div class="col-md-3">
                            <div class="form-group _nama-block">
                                <label for="_nama" class="form-control-label">Lainnya</label>
                                <a target="_blank" href="<?= base_url('uploads/peserta/lainnya') . '/' . $data->lampiran_lainnya ?>" class="btn btn-block btn-info">Lampiran Lainnya</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <!--<button onclick="aksiCabutBerkas('<?= $data->id_pendaftaran ?>', '<?= str_replace("&#039;", "`", str_replace("'", "`", $data->fullname)) ?>')" type="button" class="btn btn-outline-danger">Cabut Berkas Pendaftaran</button>-->
            </div>
        </form>
        <script>
            function aksiCabutBerkas(id, name) {
                Swal.fire({
                    title: 'Apakah anda yakin ingin Mencabut Berkas Pendaftaran Peserta Didik ini?',
                    text: "Pendaftar An. : " + name.toUpperCase(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Cabut Berkas Verifikasi!'
                }).then((result) => {
                    if (result.value) {
                        let tolakHtml = '';
                        tolakHtml += '<form>';
                        tolakHtml += '<div class="modal-body">';
                        tolakHtml += '<div class="form-group">';
                        tolakHtml += '<label for="_keterangan_tolak">Keterangan Cabut Berkas</label>';
                        tolakHtml += '<textarea class="form-control" id="_keterangan_tolak" name="_keterangan_tolak" placeholder="Masukkan keterangan cabut berkas . . ." rows="10"></textarea>';
                        tolakHtml += '<input type="hidden" id="_id_pendaftar" name="_id_pendaftar" value="';
                        tolakHtml += id;
                        tolakHtml += '">';
                        tolakHtml += '<input type="hidden" id="_nama_pendaftar" name="_nama_pendaftar" value="';
                        tolakHtml += name;
                        tolakHtml += '">';
                        tolakHtml += '</div>';
                        tolakHtml += '</div>';
                        tolakHtml += '<div class="modal-footer">';
                        tolakHtml += '<button onclick="saveCabutBerkas()" type="button" class="btn btn-outline-success">CABUT BERKAS & SIMPAN</button>';
                        tolakHtml += '</div>';
                        tolakHtml += '</form>';

                        $('#tolakModalLabel').html('CABUT BERKAS VERIFIKASI UNTUK PENDAFTARAN AN. ' + name.toUpperCase());
                        $('.tolakBodyModal').html(tolakHtml);
                        $('#tolakModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        }, 'show');
                    }
                });
            }

            function saveCabutBerkas() {
                const keteranganPenolakan = document.getElementsByName('_keterangan_tolak')[0].value;
                const id = document.getElementsByName('_id_pendaftar')[0].value;
                const name = document.getElementsByName('_nama_pendaftar')[0].value;

                if (keteranganPenolakan === "") {
                    Swal.fire(
                        'Peringatan!',
                        "Keterangan cabut berkas tidak boleh kosong.",
                        'warning'
                    );
                    return;
                }

                $.ajax({
                    url: "<?= base_url('dinas/rekap/diverifikasi/aksicabutberkas') ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        name: name,
                        keterangan: keteranganPenolakan
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('div.modal-tolak-loading').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(resul) {
                        $('div.modal-tolak-loading').unblock();

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
                                'BERHASIL!',
                                resul.message,
                                'success'
                            ).then((valRes) => {
                                reloadPage();
                            })
                        }
                    },
                    error: function() {
                        $('div.modal-tolak-loading').unblock();
                        Swal.fire(
                            'GAGAL!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }
        </script>
<?php }
} ?>