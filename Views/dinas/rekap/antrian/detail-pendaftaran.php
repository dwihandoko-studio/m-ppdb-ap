<?php if (isset($data)) {
    if (isset($data->details)) {
        $siswa = json_decode($data->details);
?>
        <form id="formAddData" class="form-horizontal" method="post">
            <div class="modal-body">
                <h4>Data Peserta Didik</h4>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="form-group _nama-block">
                            <label for="_nama" class="form-control-label">Nama</label>
                            <input type="text" value="<?= $data->fullname ?>" class="form-control judul" id="_nama" readonly />
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
            </div>
        </form>
<?php }
} ?>