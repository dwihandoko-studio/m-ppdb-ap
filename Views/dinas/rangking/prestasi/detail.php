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
                <?php if (isset($data->jenis_prestasi)) { ?>
                    <hr />
                    <h4>PRESTASI</h4>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="form-group _nama-block">
                                <label for="_nama" class="form-control-label">Jenis Prestasi</label>
                                <input type="text" value="<?= ($data->jenis_prestasi == NULL || $data->jenis_prestasi == "") ? '-' : $data->jenis_prestasi ?>" class="form-control judul" id="_nama" readonly />
                            </div>
                        </div>
                        <?php if ($data->jenis_prestasi == NULL || $data->jenis_prestasi == "") {
                        } else { ?>
                            <?php if ($data->jenis_prestasi == "NON AKADEMIK") { ?>
                                <div class="col-md-6">
                                    <div class="form-group _nama-block">
                                        <label for="_nama" class="form-control-label">Tingkat Prestasi</label>
                                        <input type="text" value="<?= ($data->tingkat_prestasi == NULL || $data->tingkat_prestasi == "") ? '-' : $data->tingkat_prestasi ?>" class="form-control judul" id="_nama" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _nama-block">
                                        <label for="_nama" class="form-control-label">Juara Prestasi</label>
                                        <input type="text" value="<?= ($data->juara_prestasi == NULL || $data->juara_prestasi == "") ? '-' : $data->juara_prestasi ?>" class="form-control judul" id="_nama" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _nama-block">
                                        <label for="_nama" class="form-control-label">Nilai Akumulative</label>
                                        <input type="text" value="<?= ($data->nilai_akumulative == NULL || $data->nilai_akumulative == "") ? '-' : $data->nilai_akumulative ?>" class="form-control judul" id="_nama" readonly />
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-6">
                                    <div class="form-group _nama-block">
                                        <label for="_nama" class="form-control-label">Akreditasi Sekolah Asal</label>
                                        <input type="text" value="<?= ($data->akreditasi_prestasi == NULL || $data->akreditasi_prestasi == "") ? '-' : $data->akreditasi_prestasi ?>" class="form-control judul" id="_nama" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _nama-block">
                                        <label for="_nama" class="form-control-label">Peringkat Prestasi</label>
                                        <input type="text" value="<?= ($data->peringkat_prestasi == NULL || $data->peringkat_prestasi == "") ? '-' : $data->peringkat_prestasi ?>" class="form-control judul" id="_nama" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _nama-block">
                                        <label for="_nama" class="form-control-label">Nilai Rata-rata Ijazah/SKL</label>
                                        <input type="text" value="<?= ($data->nilai_prestasi == NULL || $data->nilai_prestasi == "") ? '-' : $data->nilai_prestasi ?>" class="form-control judul" id="_nama" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _nama-block">
                                        <label for="_nama" class="form-control-label">Nilai Akumulative</label>
                                        <input type="text" value="<?= ($data->nilai_akumulative == NULL || $data->nilai_akumulative == "") ? '-' : $data->nilai_akumulative ?>" class="form-control judul" id="_nama" readonly />
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>
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
                            <label for="_nama" class="form-control-label">Akta Kelahiran</label>
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
                <!-- <button onclick="aksiCabutBerkas('<?= $data->id_pendaftaran ?>', '<?= str_replace("&#039;", "`", str_replace("'", "`", $data->fullname)) ?>')" type="button" class="btn btn-outline-danger">Cabut Berkas Pendaftaran</button> -->
                <button onclick="aksiUbahPeringkat('<?= $data->id_pendaftaran ?>', '<?= str_replace("&#039;", "`", str_replace("'", "`", $data->fullname)) ?>')" type="button" class="btn btn-outline-warning">Benahi Peringkat Peserta</button>
                <button onclick="aksiUbahKoordinat('<?= $data->id ?>', '<?= str_replace("&#039;", "`", str_replace("'", "`", $data->fullname)) ?>')" type="button" class="btn btn-outline-primary">Benahi Koordinat Peserta</button>
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>

        <script>
            function aksiCabutBerkas(id, name) {
                Swal.fire({
                    title: 'Apakah anda yakin ingin mencabut berkas pendaftaran peserta didik dari sekolah anda?',
                    text: "Cabut berkas pendaftaran peserta didik atas nama: " + name,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Cabut Berkas!',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.value) {
                        let cabutHtml = '';
                        cabutHtml += '<form>';
                        cabutHtml += '<div class="modal-body">';
                        cabutHtml += '<div class="form-group">';
                        cabutHtml += '<label for="_keterangan_pencabutan">Keterangan Pencabutan</label>';
                        cabutHtml += '<textarea class="form-control" id="_keterangan_pencabutan" name="_keterangan_pencabutan" placeholder="Masukkan keterangan pencabutan . . ." rows="5"></textarea>';
                        cabutHtml += '<input type="hidden" id="_id_pendaftar" name="_id_pendaftar" value="';
                        cabutHtml += id;
                        cabutHtml += '">';
                        cabutHtml += '<input type="hidden" id="_nama_pendaftar" name="_nama_pendaftar" value="';
                        cabutHtml += name;
                        cabutHtml += '">';
                        cabutHtml += '</div>';

                        cabutHtml += '<hr/><h5 class="heading-small" style="margin-top: 20px;">Upload Surat Pernyataan</h5>';
                        // cabutHtml += '<div class="row">';
                        // cabutHtml += '<div class="col-md-6">';
                        cabutHtml += '<div class="form-group" id="file-error">';
                        cabutHtml += '<h5>Pass Foto<span class="required">*</span></h5>';
                        cabutHtml += '<div class="controls">';
                        cabutHtml += '<input type="file" class="form-control" id="_file" name="_file" onFocus="inputFocus(this);" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this)" required>';
                        cabutHtml += '<div class="help-block _file" for="file"></div>';
                        cabutHtml += '</div>';
                        cabutHtml += '<p>Pilih gambar/pdf dengan ukuran maksimal 2 Mb.</p>';
                        cabutHtml += '</div>';
                        // cabutHtml += '</div>';
                        // cabutHtml += '<div class="col-md-6">';
                        // cabutHtml += '<label>&nbsp;</label>';
                        cabutHtml += '<div class="form-group">';
                        cabutHtml += '<div class="preview-image-upload">';
                        cabutHtml += '<img style="max-height: 100px;" class="imagePreviewUpload" id="imagePreviewUpload" />';
                        cabutHtml += '<button type="button" class="btn-remove-preview-image">Remove</button>';
                        cabutHtml += '</div>';
                        cabutHtml += '</div>';
                        // cabutHtml += '</div>';
                        // cabutHtml += '</div>';
                        cabutHtml += '</div>';
                        cabutHtml += '<div class="modal-footer">';
                        cabutHtml += '<div class="row">';
                        cabutHtml += '<div class="col-md-12">';
                        cabutHtml += '<div class="progress-wrapper progress-_progress_laporan" style="display: none;">';
                        cabutHtml += '<div class="progress-info">';
                        cabutHtml += '<div class="progress-label">';
                        cabutHtml += '<span class="status-_progress_laporan" id="status-_progress_laporan">Memulai Upload . . .</span>';
                        cabutHtml += '</div>';
                        cabutHtml += '<div class="progress-percentage progress-percent-_progress_laporan" id="progress-percent-_progress_laporan">';
                        cabutHtml += '<span>0%</span>';
                        cabutHtml += '</div>';
                        cabutHtml += '</div>';
                        cabutHtml += '<div class="progress">';
                        cabutHtml += '<div class="progress-bar bg-info progressbar-_progress_laporan" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>';
                        cabutHtml += '</div>';
                        cabutHtml += '</div>';
                        cabutHtml += '</div>';
                        cabutHtml += '<div class="col-md-12">';
                        cabutHtml += '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>';
                        cabutHtml += '<button onclick="saveCabutBerkas(event)" type="button" class="btn btn-outline-success">CABUT & SIMPAN</button>';
                        cabutHtml += '</div>';
                        cabutHtml += '</div>';
                        cabutHtml += '</form>';

                        $('#cabutModalLabel').html('CABUT BERKAS PENDAFTARAN PESERTA DIDIK AN. ' + name.toUpperCase());
                        $('.cabutBodyModal').html(cabutHtml);
                        $('#cabutModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        }, 'show');
                    }
                })
            }

            function saveCabutBerkas() {
                const keterangan = document.getElementsByName('_keterangan_pencabutan')[0].value;
                const id_pendaftaran = document.getElementsByName('_id_pendaftar')[0].value;
                const nama_pendaftaran = document.getElementsByName('_nama_pendaftar')[0].value;
                const surat_pernyataan = document.getElementsByName('_file')[0].value;

                if (keterangan === "") {
                    $("input#_keterangan_pencabutan").css("color", "#dc3545");
                    $("input#_keterangan_pencabutan").css("border-color", "#dc3545");
                    $('._keterangan_pencabutan').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Keterangan pencabutan tidak boleh kosong.</li></ul>');
                    return;
                }
                if (surat_pernyataan === "") {
                    $("input#_file").css("color", "#dc3545");
                    $("input#_file").css("border-color", "#dc3545");
                    $('._file').html('<ul role="alert" style="color: #dc3545; list-style: none;padding-inline-start: 10px;"><li style="color: #dc3545;">Surat pernyataan tidak boleh kosong.</li></ul>');
                    return;
                }

                const formUpload = new FormData();
                const file = document.getElementsByName('_file')[0].files[0];
                formUpload.append('keterangan', keterangan);
                formUpload.append('id', id_pendaftaran);
                formUpload.append('nama', nama_pendaftaran);
                formUpload.append('file', file);

                $.ajax({
                    xhr: function() {
                        let xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                let percent = (evt.loaded / evt.total) * 100;
                                $('#status-_progress_laporan').html("Sedang mengupload . . . " + evt.loaded + " byte Dari " + evt.total + " byte");
                                $('#progress-percent-_progress_laporan').html("<span>" + Math.round(percent) + "%</span>");
                                $('.progressbar-_progress_laporan').attr('aria-valuenow', Math.round(percent)).css('width', Math.round(percent) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    url: './simpanCabutBerkas',
                    type: 'POST',
                    data: formUpload,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'JSON',
                    beforeSend: function() {
                        // loading = true;
                        $('.progress-_progress_laporan').css('display', 'block');
                        $('.status-_progress_laporan').innerHTML = "Memulai mengupload . . .";
                        $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                        $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                        $('div.modal-cabut-loading').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(msg) {
                        if (msg.code !== 200) {
                            $('div.modal-cabut-loading').unblock();
                            if (msg.code === 401) {
                                Swal.fire(
                                    'Failed!',
                                    msg.message,
                                    'warning'
                                ).then((valRes) => {
                                    document.location.href = BASE_URL + '/dashboard';
                                });
                            } else {
                                $('.progress-_progress_laporan').css('display', 'none');
                                $('.status-_progress_laporan').innerHTML = "";
                                $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                                $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                                Swal.fire(
                                    'Gagal!',
                                    msg.message,
                                    'warning'
                                );
                            }
                        } else {
                            $('.progress-_progress_laporan').css('display', 'none');
                            $('.status-_progress_laporan').innerHTML = "";
                            $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                            $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                            Swal.fire(
                                'Berhasil!',
                                msg.message,
                                'success'
                            ).then((valRes) => {
                                document.location.href = msg.url;
                            })
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        $('div.modal-cabut-loading').unblock();
                        $('.progress-_progress_laporan').css('display', 'none');
                        $('.status-_progress_laporan').innerHTML = "";
                        $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                        $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                        Swal.fire(
                            'Gagal!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );

                    }
                })
            }

            function loadFilePdf(event) {
                // console.log(event);
                // const input = document.getElementsByName('_file')[0];
                const input = event;
                if (input.files && input.files[0]) {
                    let file = input.files[0];

                    // allowed MIME types
                    let mime_types = ['application/pdf', 'image/jpg', 'image/png', 'image/jpeg'];

                    if (mime_types.indexOf(file.type) == -1) {
                        input.value = "";
                        // const color = event.name
                        $('.' + event.name).css('display', 'block');
                        $("input#" + event.name).css("color", "#dc3545");
                        $("input#" + event.name).css("border-color", "#dc3545");
                        $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Hanya file type gambar/pdf yang diizinkan.</li></ul>');
                        // $('.imagePreviewUpload').attr('src', '');
                        Swal.fire(
                            'Warning!!!',
                            "Hanya file type gambar/pdf yang diizinkan.",
                            'warning'
                        );
                        return;
                    }

                    // console.log(file.size);

                    // validate file size
                    if (file.size > 1 * 2048 * 1000) {
                        input.value = "";
                        $('.' + event.name).css('display', 'block');
                        $("input#" + event.name).css("color", "#dc3545");
                        $("input#" + event.name).css("border-color", "#dc3545");
                        $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Ukuran file tidak boleh lebih dari 2 Mb.</li></ul>');
                        Swal.fire(
                            'Warning!!!',
                            "Ukuran file tidak boleh lebih dari 2 Mb.",
                            'warning'
                        );
                        return;
                    }
                    $('.' + event.name).css('display', 'none');
                    $('.' + event.name).html('');

                    $(event.name).removeAttr('style');

                    if (file.type !== 'application/pdf') {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.imagePreviewUpload').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                } else {
                    console.log("failed Load");
                }
            }

            function aksiUbahKoordinat(event, name) {
                $.ajax({
                    url: "./edit",
                    type: 'POST',
                    data: {
                        id: event,
                        name: name,
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
                                    'Failed!',
                                    resul.message,
                                    'warning'
                                );
                            }
                        } else {
                            $('#contentModalUpdateLabel').html('EDIT KOORDINAT PESERTA');
                            $('.contentBodyModalUpdate').html(resul.data);
                            $('#contentModalUpdate').modal({
                                backdrop: 'static',
                                keyboard: false
                            }, 'show');
                        }
                    },
                    error: function() {
                        $('div.modal-content-loading').unblock();
                        Swal.fire(
                            'Failed!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }

            function aksiUbahPeringkat(event, name) {
                $.ajax({
                    url: "./editPeringkat",
                    type: 'POST',
                    data: {
                        id: event,
                        name: name,
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
                                    'Failed!',
                                    resul.message,
                                    'warning'
                                );
                            }
                        } else {
                            $('#contentModalUpdateLabel').html('EDIT PERINGKAT PESERTA');
                            $('.contentBodyModalUpdate').html(resul.data);
                            $('#contentModalUpdate').modal({
                                backdrop: 'static',
                                keyboard: false
                            }, 'show');
                        }
                    },
                    error: function() {
                        $('div.modal-content-loading').unblock();
                        Swal.fire(
                            'Failed!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }
        </script>
<?php }
} ?>