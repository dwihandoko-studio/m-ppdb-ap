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
                            <input type="text" value="<?= str_replace("&#039;","`",str_replace("'","`",$data->fullname)) ?>" class="form-control judul" id="_nama" readonly />
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
                <!--<button onclick="aksiUbahKoordinat('<?= $data->id ?>', '<?= str_replace("&#039;","`",str_replace("'","`",$data->fullname)) ?>')" type="button" class="btn btn-outline-primary">Benahi Koordinat Peserta</button> -->
            </div>
        </form>
        
        <script>
            
    function aksiUbahKoordinat(event) {
        $.ajax({
            url: "<?= base_url('sekolah/rekap/diverifikasi/edit') ?>",
            type: 'POST',
            data: {
                id: event,
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

        </script>
<?php }
} ?>