<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>

<!--<body>-->
<!-- Main content -->
<div class="main-content" id="panel">
    <?= $this->include('templates/topnav'); ?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="<?= base_url('peserta/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Upload Berkas</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <!-- Light table -->
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">UPLOAD BERKAS</h3>
                    </div>
                    <!-- Light table -->
                    <div class="card-body">
                        <form id="formAddData" class="form-horizontal" method="post">
                            <?php if (isset($dataUpload)) {  ?>
                                <div class="row">
                                    <div class="col-md-6 _file_kk-block">
                                        <h4>Akta Kelahiran</h4>
                                        <?php if ($dataUpload->lampiran_akta_kelahiran != null) { ?>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="DOKUMEN AKTA KELAHIRAN" readonly />
                                                    <div class="input-group-append">
                                                        <a style="padding-top: 12px;" class="btn btn-sm btn-info" href="<?= base_url('uploads/peserta/akta') . '/' . $dataUpload->lampiran_akta_kelahiran ?>" target="_blank">LIHAT</a>
                                                        <?php if ((int)$dataUpload->is_locked === 0) {
                                                        ?>
                                                            <!-- <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-warning action-edit" href="javascript:actionEdit('_file_kk', '<?= $dataUpload->id ?>', 'Lampiran Kartu Keluarga')" data-id="_file_kk">EDIT</a> -->
                                                            <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-danger action-hapus" href="javascript:actionHapus('_file_akta', '<?= $dataUpload->id ?>', 'Akta Kelahiran')" data-id="_file_akta" data-token="<?= '' ?>">HAPUS</a>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-akta" id="_file_akta" name="_file_akta" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_akta', 'Lampiran Akta Kelahiran')">
                                                <label class="custom-file-label" for="_file_akta"></label>
                                                <div class="progress-wrapper progress-_file_akta" style="display: none;">
                                                    <div class="progress-info">
                                                        <div class="progress-label">
                                                            <span class="status-_file_akta" id="status-_file_akta">Memulai Upload . . .</span>
                                                        </div>
                                                        <div class="progress-percentage progress-percent-_file_akta" id="progress-percent-_file_akta">
                                                            <span>0%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info progressbar-_file_akta" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <div class="help-block _file_akta" for="_file_akta"></div>
                                                <p style="font-size: 10px;"> Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_kk-block">
                                        <h4>Kartu Keluarga</h4>
                                        <?php if ($dataUpload->lampiran_kk != null) { ?>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="DOKUMEN KARTU KELUARGA" readonly />
                                                    <div class="input-group-append">
                                                        <a style="padding-top: 12px;" class="btn btn-sm btn-info" href="<?= base_url('uploads/peserta/kk') . '/' . $dataUpload->lampiran_kk ?>" target="_blank">LIHAT</a>
                                                        <?php if ((int)$dataUpload->is_locked === 0) {
                                                        ?>
                                                            <!-- <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-warning action-edit" href="javascript:actionEdit('_file_kk', '<?= $dataUpload->id ?>', 'Lampiran Kartu Keluarga')" data-id="_file_kk">EDIT</a> -->
                                                            <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-danger action-hapus" href="javascript:actionHapus('_file_kk', '<?= $dataUpload->id ?>', 'Kartu Keluarga')" data-id="_file_kk" data-token="<?= '' ?>">HAPUS</a>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-kk" id="_file_kk" name="_file_kk" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_kk', 'Lampiran Kartu Keluarga')">
                                                <label class="custom-file-label" for="_file_kk"></label>
                                                <div class="progress-wrapper progress-_file_kk" style="display: none;">
                                                    <div class="progress-info">
                                                        <div class="progress-label">
                                                            <span class="status-_file_kk" id="status-_file_kk">Memulai Upload . . .</span>
                                                        </div>
                                                        <div class="progress-percentage progress-percent-_file_kk" id="progress-percent-_file_kk">
                                                            <span>0%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info progressbar-_file_kk" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <div class="help-block _file_kk" for="_file_kk"></div>
                                                <p style="font-size: 10px;"> Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if (substr($user->nisn, 0, 2) == "BS") { ?>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-6 _file_lulus-block">
                                            <h4>Surat Keterangan Lulus</h4>
                                            <?php if ($dataUpload->lampiran_lulus != null) { ?>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="DOKUMEN KELULUSAN" readonly />
                                                        <div class="input-group-append">
                                                            <a style="padding-top: 12px;" class="btn btn-sm btn-info" href="<?= base_url('uploads/peserta/kelulusan') . '/' . $dataUpload->lampiran_lulus ?>" target="_blank">LIHAT</a>
                                                            <?php if ((int)$dataUpload->is_locked === 0) {
                                                            ?>
                                                                <!-- <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-warning action-edit" href="javascript:actionEdit('_file_lulus', '<?= $dataUpload->id ?>', 'Lampiran Keterangan Lulus / SKHU')" data-id="_file_lulus">EDIT</a> -->
                                                                <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-danger action-hapus" href="javascript:actionHapus('_file_lulus', '<?= $dataUpload->id ?>', 'Surat Keterangan Lulus')" data-id="_file_lulus" data-token="<?= '' ?>">HAPUS</a>
                                                            <?php }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input file-kk" id="_file_lulus" name="_file_lulus" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_lulus', 'Surat Keterangan Lulus')">
                                                    <label class="custom-file-label" for="_file_lulus"></label>
                                                    <div class="progress-wrapper progress-_file_lulus" style="display: none;">
                                                        <div class="progress-info">
                                                            <div class="progress-label">
                                                                <span class="status-_file_lulus" id="status-_file_lulus">Memulai Upload . . .</span>
                                                            </div>
                                                            <div class="progress-percentage progress-percent-_file_lulus" id="progress-percent-_file_lulus">
                                                                <span>0%</span>
                                                            </div>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info progressbar-_file_lulus" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="help-block _file_lulus" for="_file_lulus"></div>
                                                    <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-md-6 _file_afirmasi-block">
                                        <h4>Afirmasi (Kartu Jaminan Sosial: PKH / KIP / PIP / KKS / Surat Keterangan Keluarga Prasejahterah dari Kelurahan/Kampung/Desa)</h4>
                                        <?php if ($dataUpload->lampiran_afirmasi != null) { ?>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="DOKUMEN AFIRMASI" readonly />
                                                    <div class="input-group-append">
                                                        <a style="padding-top: 12px;" class="btn btn-sm btn-info" href="<?= base_url('uploads/peserta/afirmasi') . '/' . $dataUpload->lampiran_afirmasi ?>" target="_blank">LIHAT</a>
                                                        <?php if ((int)$dataUpload->is_locked === 0) {
                                                        ?>
                                                            <!-- <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-warning action-edit" href="javascript:actionEdit('_file_prestasi', '<?= $dataUpload->id ?>', 'Lampiran Keterangan Prestasi / Sertifikat')" data-id="_file_prestasi">EDIT</a> -->
                                                            <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-danger action-hapus" href="javascript:actionHapus('_file_afirmasi', '<?= $dataUpload->id ?>', 'Afirmasi (Kartu Jaminan Sosial: PKH / KIP / PIP / KIS)')" data-id="_file_afirmasi" data-token="<?= '' ?>">HAPUS</a>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-afirmasi" id="_file_afirmasi" name="_file_afirmasi" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_afirmasi', 'Afirmasi (Kartu Jaminan Sosial: PKH / KIP / PIP / KIS)')">
                                                <label class="custom-file-label" for="_file_afirmasi"></label>
                                                <div class="progress-wrapper progress-_file_afirmasi" style="display: none;">
                                                    <div class="progress-info">
                                                        <div class="progress-label">
                                                            <span class="status-_file_afirmasi" id="status-_file_afirmasi">Memulai Upload . . .</span>
                                                        </div>
                                                        <div class="progress-percentage progress-percent-_file_afirmasi" id="progress-percent-_file_afirmasi">
                                                            <span>0%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info progressbar-_file_afirmasi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <div class="help-block _file_afirmasi" for="_file_afirmasi"></div>
                                                <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_pernyataan-block">
                                        <h4>Afirmasi (Surat Pernyataan Orang Tua / Wali Bermaterai)</h4>
                                        <?php if ($dataUpload->lampiran_pernyataan != null) { ?>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="DOKUMEN PERNYATAAN" readonly />
                                                    <div class="input-group-append">
                                                        <a style="padding-top: 12px;" class="btn btn-sm btn-info" href="<?= base_url('uploads/peserta/pernyataan') . '/' . $dataUpload->lampiran_pernyataan ?>" target="_blank">LIHAT</a>
                                                        <?php if ((int)$dataUpload->is_locked === 0) {
                                                        ?>
                                                            <!-- <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-warning action-edit" href="javascript:actionEdit('_file_prestasi', '<?= $dataUpload->id ?>', 'Lampiran Keterangan Prestasi / Sertifikat')" data-id="_file_prestasi">EDIT</a> -->
                                                            <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-danger action-hapus" href="javascript:actionHapus('_file_pernyataan', '<?= $dataUpload->id ?>', 'Afirmasi (Surat Pernyataan Orang Tua / Wali Bermaterai)')" data-id="_file_pernyataan" data-token="<?= '' ?>">HAPUS</a>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-pernyataan" id="_file_pernyataan" name="_file_pernyataan" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_pernyataan', 'Afirmasi (Surat Pernyataan Orang Tua / Wali Bermaterai)')">
                                                <label class="custom-file-label" for="_file_pernyataan"></label>
                                                <div class="progress-wrapper progress-_file_pernyataan" style="display: none;">
                                                    <div class="progress-info">
                                                        <div class="progress-label">
                                                            <span class="status-_file_pernyataan" id="status-_file_pernyataan">Memulai Upload . . .</span>
                                                        </div>
                                                        <div class="progress-percentage progress-percent-_file_pernyataan" id="progress-percent-_file_pernyataan">
                                                            <span>0%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info progressbar-_file_afirmasi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <div class="help-block _file_pernyataan" for="_file_pernyataan"></div>
                                                <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_foto_rumah-block">
                                        <h4>Afirmasi (Foto Rumah Tempat Tinggal Siswa)</h4>
                                        <?php if ($dataUpload->lampiran_foto_rumah != null) { ?>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="DOKUMEN FOTO RUMAH" readonly />
                                                    <div class="input-group-append">
                                                        <a style="padding-top: 12px;" class="btn btn-sm btn-info" href="<?= base_url('uploads/peserta/fotorumah') . '/' . $dataUpload->lampiran_foto_rumah ?>" target="_blank">LIHAT</a>
                                                        <?php if ((int)$dataUpload->is_locked === 0) {
                                                        ?>
                                                            <!-- <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-warning action-edit" href="javascript:actionEdit('_file_prestasi', '<?= $dataUpload->id ?>', 'Lampiran Keterangan Prestasi / Sertifikat')" data-id="_file_prestasi">EDIT</a> -->
                                                            <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-danger action-hapus" href="javascript:actionHapus('_file_foto_rumah', '<?= $dataUpload->id ?>', 'Afirmasi (Foto Rumah Tempat Tinggal Siswa)')" data-id="_file_foto_rumah" data-token="<?= '' ?>">HAPUS</a>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input foto-rumah" id="_file_foto_rumah" name="_file_foto_rumah" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_foto_rumah', 'Afirmasi (Foto Rumah Tempat Tinggal Siswa)')">
                                                <label class="custom-file-label" for="_file_foto_rumah"></label>
                                                <div class="progress-wrapper progress-_file_foto_rumah" style="display: none;">
                                                    <div class="progress-info">
                                                        <div class="progress-label">
                                                            <span class="status-_file_foto_rumah" id="status-_file_foto_rumah">Memulai Upload . . .</span>
                                                        </div>
                                                        <div class="progress-percentage progress-percent-_file_foto_rumah" id="progress-percent-_file_foto_rumah">
                                                            <span>0%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info progressbar-_file_foto_rumah" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <div class="help-block _file_foto_rumah" for="_file_foto_rumah"></div>
                                                <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_mutasi-block">
                                        <h4>Mutasi Orang Tua / Wali (Surat Keterangan Pindah Kerja Orang Tua / Wali)</h4>
                                        <?php if ($dataUpload->lampiran_mutasi != null) { ?>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="DOKUMEN MUTASI" readonly />
                                                    <div class="input-group-append">
                                                        <a style="padding-top: 12px;" class="btn btn-sm btn-info" href="<?= base_url('uploads/peserta/mutasi') . '/' . $dataUpload->lampiran_mutasi ?>" target="_blank">LIHAT</a>
                                                        <?php if ((int)$dataUpload->is_locked === 0) {
                                                        ?>
                                                            <!-- <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-warning action-edit" href="javascript:actionEdit('_file_prestasi', '<?= $dataUpload->id ?>', 'Lampiran Keterangan Prestasi / Sertifikat')" data-id="_file_prestasi">EDIT</a> -->
                                                            <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-danger action-hapus" href="javascript:actionHapus('_file_mutasi', '<?= $dataUpload->id ?>', 'Mutasi Orang Tua / Wali (Surat Keterangan Pindah Kerja Orang Tua / Wali)')" data-id="_file_mutasi" data-token="<?= '' ?>">HAPUS</a>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-mutasi" id="_file_mutasi" name="_file_mutasi" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_mutasi', 'Mutasi Orang Tua / Wali (Surat Keterangan Pindah Kerja Orang Tua / Wali)')">
                                                <label class="custom-file-label" for="_file_mutasi"></label>
                                                <div class="progress-wrapper progress-_file_mutasi" style="display: none;">
                                                    <div class="progress-info">
                                                        <div class="progress-label">
                                                            <span class="status-_file_mutasi" id="status-_file_mutasi">Memulai Upload . . .</span>
                                                        </div>
                                                        <div class="progress-percentage progress-percent-_file_mutasi" id="progress-percent-_file_mutasi">
                                                            <span>0%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info progressbar-_file_mutasi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <div class="help-block _file_mutasi" for="_file_mutasi"></div>
                                                <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_prestasi-block">
                                        <h4>Prestasi (Dokumen Prestasi Siswa)</h4>
                                        <?php if ($dataUpload->lampiran_prestasi != null) { ?>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="DOKUMEN PRESTASI" readonly />
                                                    <div class="input-group-append">
                                                        <a style="padding-top: 12px;" class="btn btn-sm btn-info" href="<?= base_url('uploads/peserta/prestasi') . '/' . $dataUpload->lampiran_prestasi ?>" target="_blank">LIHAT</a>
                                                        <?php if ((int)$dataUpload->is_locked === 0) {
                                                        ?>
                                                            <!-- <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-warning action-edit" href="javascript:actionEdit('_file_prestasi', '<?= $dataUpload->id ?>', 'Lampiran Keterangan Prestasi / Sertifikat')" data-id="_file_prestasi">EDIT</a> -->
                                                            <a style="margin-left: 5px; padding-top: 12px;" class="btn btn-sm btn-danger action-hapus" href="javascript:actionHapus('_file_prestasi', '<?= $dataUpload->id ?>', 'Prestasi (Dokumen Prestasi Siswa)')" data-id="_file_prestasi" data-token="<?= '' ?>">HAPUS</a>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-kk" id="_file_prestasi" name="_file_prestasi" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_prestasi', 'Prestasi (Dokumen Prestasi Siswa)')">
                                                <label class="custom-file-label" for="_file_prestasi"></label>
                                                <div class="progress-wrapper progress-_file_prestasi" style="display: none;">
                                                    <div class="progress-info">
                                                        <div class="progress-label">
                                                            <span class="status-_file_prestasi" id="status-_file_prestasi">Memulai Upload . . .</span>
                                                        </div>
                                                        <div class="progress-percentage progress-percent-_file_prestasi" id="progress-percent-_file_prestasi">
                                                            <span>0%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info progressbar-_file_prestasi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <div class="help-block _file_prestasi" for="_file_prestasi"></div>
                                                <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="col-md-6 _file_akta-block">
                                        <h4>Akta Kelahiran</h4>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input file-akta" id="_file_akta" name="_file_akta" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_akta', 'Lampiran Akta Kelahiran')">
                                            <label class="custom-file-label" for="_file_akta"></label>
                                            <div class="progress-wrapper progress-_file_akta" style="display: none;">
                                                <div class="progress-info">
                                                    <div class="progress-label">
                                                        <span class="status-_file_akta" id="status-_file_akta">Memulai Upload . . .</span>
                                                    </div>
                                                    <div class="progress-percentage progress-percent-_file_akta" id="progress-percent-_file_akta">
                                                        <span>0%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info progressbar-_file_akta" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <div class="help-block _file_akta" for="_file_akta"></div>
                                            <p style="font-size: 10px;"> Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_kk-block">
                                        <h4>Kartu Keluarga</h4>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input file-kk" id="_file_kk" name="_file_kk" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_kk', 'Lampiran Kartu Keluarga')">
                                            <label class="custom-file-label" for="_file_kk"></label>
                                            <div class="progress-wrapper progress-_file_kk" style="display: none;">
                                                <div class="progress-info">
                                                    <div class="progress-label">
                                                        <span class="status-_file_kk" id="status-_file_kk">Memulai Upload . . .</span>
                                                    </div>
                                                    <div class="progress-percentage progress-percent-_file_kk" id="progress-percent-_file_kk">
                                                        <span>0%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info progressbar-_file_kk" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <div class="help-block _file_kk" for="_file_kk"></div>
                                            <p style="font-size: 10px;"> Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                        </div>
                                    </div>
                                </div>
                                <?php if (substr($user->nisn, 0, 2) == "BS") { ?>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-6 _file_lulus-block" style="padding-top: 10px;">
                                            <h4>Surat Keterangan Lulus</h4>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-kk" id="_file_lulus" name="_file_lulus" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_lulus', 'Surat Keterangan Lulus')">
                                                <label class="custom-file-label" for="_file_lulus"></label>
                                                <div class="progress-wrapper progress-_file_lulus" style="display: none;">
                                                    <div class="progress-info">
                                                        <div class="progress-label">
                                                            <span class="status-_file_lulus" id="status-_file_lulus">Memulai Upload . . .</span>
                                                        </div>
                                                        <div class="progress-percentage progress-percent-_file_lulus" id="progress-percent-_file_lulus">
                                                            <span>0%</span>
                                                        </div>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info progressbar-_file_lulus" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                                <div class="help-block _file_lulus" for="_file_lulus"></div>
                                                <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-md-6 _file_prestasi-block" style="padding-top: 10px;">
                                        <h4>Afirmasi (Kartu Jaminan Sosial: PKH / KIP / PIP / KKS / Surat Keterangan Keluarga Prasejahterah dari Kelurahan/Kampung/Desa)</h4>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input file-afirmasi" id="_file_afirmasi" name="_file_afirmasi" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_afirmasi', 'Afirmasi (Kartu Jaminan Sosial: PKH / KIP / PIP / KKS / Surat Keterangan Keluarga Prasejahterah dari Kelurahan/Kampung/Desa)')">
                                            <label class="custom-file-label" for="_file_afirmasi"></label>
                                            <div class="progress-wrapper progress-_file_afirmasi" style="display: none;">
                                                <div class="progress-info">
                                                    <div class="progress-label">
                                                        <span class="status-_file_afirmasi" id="status-_file_afirmasi">Memulai Upload . . .</span>
                                                    </div>
                                                    <div class="progress-percentage progress-percent-_file_afirmasi" id="progress-percent-_file_afirmasi">
                                                        <span>0%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info progressbar-_file_afirmasi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <div class="help-block _file_afirmasi" for="_file_afirmasi"></div>
                                            <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_pernyataan-block" style="padding-top: 10px;">
                                        <h4>Afirmasi (Surat Pernyataan Orang Tua / Wali Bermaterai)</h4>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input file-pernyataan" id="_file_pernyataan" name="_file_pernyataan" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_pernyataan', 'Afirmasi (Surat Pernyataan Orang Tua / Wali Bermaterai)')">
                                            <label class="custom-file-label" for="_file_pernyataan"></label>
                                            <div class="progress-wrapper progress-_file_pernyataan" style="display: none;">
                                                <div class="progress-info">
                                                    <div class="progress-label">
                                                        <span class="status-_file_pernyataan" id="status-_file_pernyataan">Memulai Upload . . .</span>
                                                    </div>
                                                    <div class="progress-percentage progress-percent-_file_pernyataan" id="progress-percent-_file_pernyataan">
                                                        <span>0%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info progressbar-_file_pernyataan" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <div class="help-block _file_pernyataan" for="_file_pernyataan"></div>
                                            <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_foto_rumah-block" style="padding-top: 10px;">
                                        <h4>Afirmasi (Foto Rumah Tempat Tinggal Siswa)</h4>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input file-foto-rumah" id="_file_foto_rumah" name="_file_foto_rumah" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_foto_rumah', 'Afirmasi (Foto Rumah Tempat Tinggal Siswa)')">
                                            <label class="custom-file-label" for="_file_foto_rumah"></label>
                                            <div class="progress-wrapper progress-_file_foto_rumah" style="display: none;">
                                                <div class="progress-info">
                                                    <div class="progress-label">
                                                        <span class="status-_file_foto_rumah" id="status-_file_foto_rumah">Memulai Upload . . .</span>
                                                    </div>
                                                    <div class="progress-percentage progress-percent-_file_foto_rumah" id="progress-percent-_file_foto_rumah">
                                                        <span>0%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info progressbar-_file_foto_rumah" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <div class="help-block _file_foto_rumah" for="_file_foto_rumah"></div>
                                            <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_prestasi-block" style="padding-top: 10px;">
                                        <h4>Mutasi Orang Tua / Wali (Surat Keterangan Pindah Kerja Orang Tua / Wali)</h4>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input file-mutasi" id="_file_mutasi" name="_file_mutasi" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_mutasi', 'Mutasi Orang Tua / Wali (Surat Keterangan Pindah Kerja Orang Tua / Wali)')">
                                            <label class="custom-file-label" for="_file_mutasi"></label>
                                            <div class="progress-wrapper progress-_file_mutasi" style="display: none;">
                                                <div class="progress-info">
                                                    <div class="progress-label">
                                                        <span class="status-_file_mutasi" id="status-_file_mutasi">Memulai Upload . . .</span>
                                                    </div>
                                                    <div class="progress-percentage progress-percent-_file_mutasi" id="progress-percent-_file_mutasi">
                                                        <span>0%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info progressbar-_file_mutasi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <div class="help-block _file_mutasi" for="_file_mutasi"></div>
                                            <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 _file_prestasi-block" style="padding-top: 10px;">
                                        <h4>Prestasi (Dokumen Prestasi Siswa)</h4>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input file-kk" id="_file_prestasi" name="_file_prestasi" lang="en" accept="application/pdf;image/jpg;image/jpeg;image/png" onchange="loadFilePdf(this, '_file_prestasi', 'Prestasi (Dokumen Prestasi Siswa)')">
                                            <label class="custom-file-label" for="_file_prestasi"></label>
                                            <div class="progress-wrapper progress-_file_prestasi" style="display: none;">
                                                <div class="progress-info">
                                                    <div class="progress-label">
                                                        <span class="status-_file_prestasi" id="status-_file_prestasi">Memulai Upload . . .</span>
                                                    </div>
                                                    <div class="progress-percentage progress-percent-_file_prestasi" id="progress-percent-_file_prestasi">
                                                        <span>0%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info progressbar-_file_prestasi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <div class="help-block _file_prestasi" for="_file_prestasi"></div>
                                            <p style="font-size: 10px;">Pilih file PDF / Gambar dengan ukuran maksimal 1 Mb.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            </from>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content modal-content-loading">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contentModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="contentBodyModal">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-document-loading">
                    <div class="modal-header">
                        <h5 class="modal-title" id="documentModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="documentBodyModal">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>

<script>
    const settingUploadedFile = {};

    function changeValidation(event) {
        $('.' + event).css('display', 'none');
    };

    function inputFocus(id) {
        const color = $(id).attr('id');
        $(id).removeAttr('style');
        $('.' + color).html('');
    }

    function ambilId(id) {
        return document.getElementById(id);
    }

    let editor;

    function loadFileImage() {
        const input = document.getElementsByName('_file')[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];

            // allowed MIME types
            var mime_types = ['image/jpg', 'image/jpeg', 'image/png'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type gambar yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 1 * 2048 * 1000) {
                input.value = "";
                $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 2 Mb.",
                    'warning'
                );
                return;
            }

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.imagePreviewUpload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
            // console.log("success Load");
        } else {
            console.log("failed Load");
        }
    }

    function loadFilePdf(event, id = "", title = "") {
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
                $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Hanya file type pdf yang diizinkan.</li></ul>');
                // $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type pdf yang diizinkan.",
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

            // resizeImage({
            //     file: input.files[0],
            //     maxSize: 500
            // }).then(function(resizedImage) {
            // console.log(resizeImage);
            // console.log(input.files[0].name);
            notifUpload(file, event, id, title, input.files[0].name);
            // console.log("upload resized image")
            // }).catch(function(err) {
            //     console.error(err);
            // });


            // $('.'+color).html('');

            // let reader = new FileReader();

            // reader.onload = function(e) {
            //     $('.imagePreviewUpload').attr('src', e.target.result);
            // }

            // reader.readAsDataURL(input.files[0]); // convert to base64 string
            // console.log("success Load");
        } else {
            console.log("failed Load");
        }
    }

    var dataURLToBlob = function(dataURL) {
        var BASE64_MARKER = ';base64,';
        if (dataURL.indexOf(BASE64_MARKER) == -1) {
            var parts = dataURL.split(',');
            var contentType = parts[0].split(':')[1];
            var raw = parts[1];

            return new Blob([raw], {
                type: contentType
            });
        }

        var parts = dataURL.split(BASE64_MARKER);
        var contentType = parts[0].split(':')[1];
        var raw = window.atob(parts[1]);
        var rawLength = raw.length;

        var uInt8Array = new Uint8Array(rawLength);

        for (var i = 0; i < rawLength; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }

        return new Blob([uInt8Array], {
            type: contentType
        });
    }

    function notifUpload(fileCompress, event, dataValue, title, fileName) {
        const inputUpload = event;
        if (fileCompress) {
            // if (inputUpload.files && inputUpload.files[0]) {
            let fileUpload = inputUpload.files[0];

            // settingUploadedFile.file = fileCompress;
            settingUploadedFile.event = event;
            settingUploadedFile.dataValue = dataValue;
            settingUploadedFile.title = title;
            settingUploadedFile.fileName = fileName;

            let contentUpload = '';
            contentUpload += '<div class="modal-body">';
            contentUpload += '<div class="col-md-12">';
            if (fileUpload.type === 'application/pdf') {
                // contentUpload += '<img class="imagePriviewNow" ec="H" style="width: 100%; height: 100%; background-color: white;" alt="File Upload"/>';
                contentUpload += '<div class="content_pdf" id="content_pdf"></div>';
            } else {
                contentUpload += '<img class="imagePriviewNow" ec="H" style="width: 100%; height: 100%; background-color: white;" alt="File Upload"/>';
            }
            contentUpload += '</div>';
            contentUpload += '</div>';
            contentUpload += '<div class="modal-footer">';
            contentUpload += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            contentUpload += '<button type="button" onclick="uploadFile(\'_file_upload\')" class="btn btn-primary">Upload File</button>';
            contentUpload += '</div>';

            $('#contentModalLabel').html('Upload ' + title);
            $('.contentBodyModal').html(contentUpload);
            $('#contentModal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');

            if (fileUpload.type === 'application/pdf') {
                pdffile_url = URL.createObjectURL(fileUpload);
                settingUploadedFile.file = fileUpload;
                // const previewUri = encodeURI(pdffile_url);
                // $('.content_pdf').html('<div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 129.4118%;"><iframe src="https://docs.google.com/viewer?embedded=true&url=' + previewUri + '" style="top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;" allowfullscreen></iframe></div>');
            } else {
                let reader = new FileReader();
                reader.onload = function(readerEvent) {
                    var image = new Image();
                    image.onload = function(imageEvent) {

                        // Resize the image
                        var canvas = document.createElement('canvas'),
                            max_size = 544, // TODO : pull max size from a site config
                            width = image.width,
                            height = image.height;
                        if (width > height) {
                            if (width > max_size) {
                                height *= max_size / width;
                                width = max_size;
                            }
                        } else {
                            if (height > max_size) {
                                width *= max_size / height;
                                height = max_size;
                            }
                        }
                        canvas.width = width;
                        canvas.height = height;
                        canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                        var dataUrl = canvas.toDataURL('image/jpeg');
                        var resizedImage = dataURLToBlob(dataUrl);
                        settingUploadedFile.file = resizedImage;
                        $.event.trigger({
                            type: "imageResized",
                            blob: resizedImage,
                            url: dataUrl
                        });
                    }
                    image.src = readerEvent.target.result;
                    $('.imagePriviewNow').attr('src', readerEvent.target.result);
                }
                reader.readAsDataURL(fileCompress);

                // reader.readAsDataURL(inputUpload.files[0]);
                // reader.onload = function(e) {
                //     $('.imagePriviewNow').attr('src', e.target.result);
                // }
                // $('.imagePriviewNow').attr('src', window.URL.createObjectURL(fileCompress));
            }


        } else {
            Swal.fire(
                'Peringatan!!!',
                "Terjadi kesalahan saat mengambil file.",
                'warning'
            );
            return;
        }
    }

    function cancelActionEdit(id) {
        $('.' + id + '-block').html(oldHtml);
    }

    function ajukanVerifikasi(id) {
        if (id === '') {
            Swal.fire(
                'PERINGATAN!',
                "Silahkan untuk melengkapi semua dokumen terlebih dahulu.",
                'warning'
            );
        } else {
            $.ajax({
                url: '<?= base_url('v1/sekolah/upload/kelengkapan/ajukanVerifikasi') ?>',
                type: 'POST',
                data: {
                    id: id,
                },
                beforeSend: function() {
                    $('div.main-content').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(resMsg) {
                    $('div.main-content').unblock();
                    const msg = JSON.parse(resMsg);
                    if (msg.code != 200) {
                        if (msg.code != 201) {
                            Swal.fire(
                                'Gagal!',
                                msg.message,
                                'warning'
                            );
                        } else {
                            Swal.fire(
                                'PERINGATAN!',
                                "Silahkan untuk melengkapi semua dokumen terlebih dahulu.",
                                'warning'
                            );
                        }
                    } else {
                        Swal.fire(
                            'Berhasil!',
                            msg.message,
                            'success'
                        ).then((valRes) => {
                            document.location.href = "<?= current_url(true); ?>";
                        })
                    }
                },
                error: function() {
                    $('div.main-content').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            })
        }
    }

    function actionEdit(id, token, title) {
        // const id = $(this).data('id');
        oldHtml = $('.' + id + '-block').html();

        // console.log(oldHtml);

        let labelNameds = "KTP";

        if (id === "_file_ktp") {
            labelNameds = "KTP";
        } else if (id === "_file_nuptk") {
            labelNameds = "Kartu NUPTK";
        } else if (id === "_file_nrg") {
            labelNameds = "Kartu NRG";
        } else if (id === "_file_npwp") {
            labelNameds = "Kartu NPWP";
        } else if (id === "_file_serdik") {
            labelNameds = "Sertifikat Pendidik";
        } else if (id === "_file_rekening") {
            labelNameds = "Buku Rekening";
        } else if (id === "_file_foto") {
            labelNameds = "Foto PTK";
        } else if (id === "_file_ijazah") {
            labelNameds = "IJAZAH TERAKHIR";
        } else if (id === "_file_karpeg") {
            labelNameds = "KARPEG";
        } else if (id === "_file_inpassing") {
            labelNameds = "INPASSING";
        } else {
            labelNameds = "";
        }

        let contentHtml = '';
        contentHtml += '<div class="col-lg-8">';
        contentHtml += '<div class="form-group">';
        contentHtml += '<div class="input-group">';
        contentHtml += '<div class="input-group-prepend">';
        contentHtml += '<span class="input-group-text" id="';
        contentHtml += id;
        contentHtml += '" style="min-width: 230px;">';
        contentHtml += labelNameds;
        contentHtml += '</span>';
        contentHtml += '</div>';
        contentHtml += '<input type="file" class="form-control" aria-describedby="';
        contentHtml += id;
        contentHtml += '" name="';
        contentHtml += id;
        contentHtml += '" id="';
        contentHtml += id;
        contentHtml += '" onFocus="inputFocus(this);" accept="application/pdf" onchange="loadFilePdf(this)" required/>';
        contentHtml += '</div>';
        contentHtml += '<div class="progress-wrapper progress-';
        contentHtml += id;
        contentHtml += '" style="display: none;">';
        contentHtml += '<div class="progress-info">';
        contentHtml += '<div class="progress-label">';
        contentHtml += '<span class="status-';
        contentHtml += id;
        contentHtml += '" id="status-';
        contentHtml += id;
        contentHtml += '">Memulai Upload . . .</span>';
        contentHtml += '</div>';
        contentHtml += '<div class="progress-percentage progress-percent-';
        contentHtml += '" id ="progress-percent-';
        contentHtml += id;
        contentHtml += '">';
        contentHtml += '<span>0%</span>';
        contentHtml += '</div>';
        contentHtml += '</div>';
        contentHtml += '<div class="progress">';
        contentHtml += '<div class="progress-bar bg-info progressbar-';
        contentHtml += id;
        contentHtml += '" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>';
        contentHtml += '</div>';
        contentHtml += '</div>';
        contentHtml += '<div class="help-block ';
        contentHtml += id;
        contentHtml += '" for="';
        contentHtml += id;
        contentHtml += '"></div>';
        contentHtml += '<p>Pilih file PDF dengan ukuran maksimal 500 Kb.</p>';
        contentHtml += '</div>';
        contentHtml += '</div>';
        contentHtml += '<div class="col-lg-4 text-left button-';
        contentHtml += id;
        contentHtml += '">';
        contentHtml += '<button type="button" onclick="uploadFile(this, \'';
        contentHtml += id;
        contentHtml += '\')" class="btn btn-success simpan-';
        contentHtml += id;
        contentHtml += '" id="simpan-';
        contentHtml += id;
        contentHtml += '">UPLOAD</button>';
        contentHtml += '<button type="button" onclick="cancelActionEdit(\'';
        contentHtml += id;
        contentHtml += '\')" class="btn btn-primary">CANCEL</button>';
        contentHtml += '</div>';

        $('.' + id + '-block').html(contentHtml);
    };

    function actionHapus(id, token, title) {
        Swal.fire({
            title: 'Apakah anda yakin ingin menghapus dokumen ini?',
            text: title + ' yang telah dihapus tidak dapat dikembalikan.',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, HAPUS!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url('peserta/upload/hapusLampiran') ?>',
                    type: 'POST',
                    data: {
                        id: token,
                        nama: title,
                        jenis: id,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('div.main-content').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(msg) {
                        $('div.main-content').unblock();
                        if (msg.code != 200) {
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
                                    'Gagal!',
                                    msg.message,
                                    'warning'
                                );
                            }
                        } else {
                            Swal.fire(
                                'Berhasil!',
                                msg.message,
                                'success'
                            ).then((valRes) => {
                                document.location.href = "<?= current_url(true); ?>";
                            })
                        }
                    },
                    error: function() {
                        $('div.main-content').unblock();
                        Swal.fire(
                            'Gagal!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                })
            }
        })


    };

    function uploadFile(title) {
        const formUpload = new FormData();
        formUpload.append('file', settingUploadedFile.file);
        formUpload.append('filename', settingUploadedFile.fileName);
        formUpload.append('id', settingUploadedFile.dataValue);
        $.ajax({
            xhr: function() {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        let percent = (evt.loaded / evt.total) * 100;
                        $('#status-' + settingUploadedFile.dataValue).html("Sedang mengupload . . . " + evt.loaded + " byte Dari " + evt.total + " byte");
                        $('#progress-percent-' + settingUploadedFile.dataValue).html("<span>" + Math.round(percent) + "%</span>");
                        $('.progressbar-' + settingUploadedFile.dataValue).attr('aria-valuenow', Math.round(percent)).css('width', Math.round(percent) + '%');
                    }
                }, false);
                return xhr;
            },
            url: "<?= base_url('peserta/upload/addSave') ?>",
            type: 'POST',
            data: formUpload,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function() {
                $('#contentModal').modal('hide');
                $('.progress-' + settingUploadedFile.dataValue).css('display', 'block');
                $('.status-' + settingUploadedFile.dataValue).innerHTML = "Memulai mengupload . . .";
                $('.progress-percent-' + settingUploadedFile.dataValue).innerHTML = "<span>0%</span>";
                $('.progressbar-' + settingUploadedFile.dataValue).attr('aria-valuenow', '0').css('width', '0%');
                event.disabled = 'disabled';
                $('div.main-content').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                $('div.main-content').unblock();
                if (msg.code !== 200) {
                    if (msg.code !== 201) {
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
                                'Gagal!',
                                msg.message,
                                'warning'
                            );
                        }
                    } else {
                        Swal.fire(
                            'Peringatan!',
                            msg.message,
                            'success'
                        ).then((valRes) => {
                            document.location.href = "<?= current_url(true); ?>";
                        })
                    }
                } else {
                    Swal.fire(
                        'Berhasil!',
                        msg.message,
                        'success'
                    ).then((valRes) => {
                        document.location.href = "<?= current_url(true); ?>";
                    })
                }
            },
            error: function(error) {
                $('div.main-content').unblock();
                $('.progress-' + settingUploadedFile.dataValue).css('display', 'none');
                $('.status-' + settingUploadedFile.dataValue).innerHTML = "";
                $('.progress-percent-' + settingUploadedFile.dataValue).innerHTML = "<span>0%</span>";
                $('.progressbar-' + settingUploadedFile.dataValue).attr('aria-valuenow', '0').css('width', '0%');
                event.disabled = false;
                Swal.fire(
                    'Failed!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }


    // function uploadFile(event, dataValue) {
    //     const input = document.getElementsByName(dataValue)[0];
    //     if (input.files && input.files[0]) {
    //         let file = input.files[0];

    //         const formUpload = new FormData();
    //         formUpload.append('file', file);
    //         formUpload.append('jenis', dataValue);
    //         <?php if (isset($tw)) { ?>
    //             formUpload.append('id_tw', '<?= $tw->id ?>');
    //         <?php } ?>


    //         $.ajax({
    //             xhr: function() {
    //                 let xhr = new window.XMLHttpRequest();
    //                 xhr.upload.addEventListener("progress", function(evt) {
    //                     if (evt.lengthComputable) {
    //                         // ambilId("loaded_n_total").innerHTML = "Uploaded " + evt.loaded + " bytes of " + evt.total;
    //                         let percent = (evt.loaded / evt.total) * 100;
    //                         // ambilId("progressBar").value = Math.round(percent);
    //                         // ambilId("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
    //                         $('#status-' + dataValue).html("Sedang mengupload . . . " + evt.loaded + " byte Dari " + evt.total + " byte");
    //                         $('#progress-percent-' + dataValue).html("<span>" + Math.round(percent) + "%</span>");
    //                         $('.progressbar-' + dataValue).attr('aria-valuenow', Math.round(percent)).css('width', Math.round(percent) + '%');
    //                     }
    //                 }, false);
    //                 return xhr;
    //             },
    //             url: "<?= base_url('v1/ptk/upload/datamaster/addSave') ?>",
    //             type: 'POST',
    //             data: formUpload,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             beforeSend: function() {
    //                 $('.progress-' + dataValue).css('display', 'block');
    //                 $('.status-' + dataValue).innerHTML = "Memulai mengupload . . .";
    //                 $('.progress-percent-' + dataValue).innerHTML = "<span>0%</span>";
    //                 $('.progressbar-' + dataValue).attr('aria-valuenow', '0').css('width', '0%');
    //                 event.disabled = 'disabled';
    //                 // $('div.modal-content-loading').block({
    //                 //     message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
    //                 //     // message: '<img src="<?= base_url('busy.gif'); ?>" />'
    //                 // });
    //             },
    //             success: function(resMsg) {
    //                 // $('div.modal-content-loading').unblock();
    //                 const resul = JSON.parse(resMsg);

    //                 if (resul.code !== 200) {
    //                     $('.progress-' + dataValue).css('display', 'none');
    //                     $('.status-' + dataValue).innerHTML = "";
    //                     $('.progress-percent-' + dataValue).innerHTML = "<span>0%</span>";
    //                     $('.progressbar-' + dataValue).attr('aria-valuenow', '0').css('width', '0%');
    //                     event.disabled = false;

    //                     Swal.fire(
    //                         'Failed!',
    //                         resul.message,
    //                         'warning'
    //                     );
    //                 } else {
    //                     $('.progress-' + dataValue).css('display', 'none');
    //                     $('.status-' + dataValue).innerHTML = "";
    //                     $('.progress-percent-' + dataValue).innerHTML = "<span>0%</span>";
    //                     $('.progressbar-' + dataValue).attr('aria-valuenow', '0').css('width', '0%');
    //                     $('.button-' + dataValue).css('display', 'none');

    //                     let labelNamedss = "KTP";

    //                     if (dataValue === "_file_ktp") {
    //                         labelNamedss = "KTP";
    //                     } else if (dataValue === "_file_nuptk") {
    //                         labelNamedss = "Kartu NUPTK";
    //                     } else if (dataValue === "_file_nrg") {
    //                         labelNamedss = "Kartu NRG";
    //                     } else if (dataValue === "_file_npwp") {
    //                         labelNamedss = "Kartu NPWP";
    //                     } else if (dataValue === "_file_serdik") {
    //                         labelNamedss = "Sertifikat Pendidik";
    //                     } else if (dataValue === "_file_rekening") {
    //                         labelNamedss = "Buku Rekening";
    //                     } else if (dataValue === "_file_foto") {
    //                         labelNamedss = "Foto PTK";
    //                     } else if (dataValue === "_file_ijazah") {
    //                         labelNamedss = "IJAZAH TERAKHIR";
    //                     } else if (dataValue === "_file_karpeg") {
    //                         labelNamedss = "KARPEG";
    //                     } else if (dataValue === "_file_inpassing") {
    //                         labelNamedss = "INPASSING";
    //                     } else {
    //                         labelNamedss = " ";
    //                     }

    //                     Swal.fire(
    //                         'SELAMAT!',
    //                         resul.message,
    //                         'success'
    //                     ).then((valRes) => {
    //                         let html = '';
    //                         html += '<div class="col-lg-8">';
    //                         html += '<div class="form-group">';
    //                         html += '<div class="input-group">';
    //                         html += '<div class="input-group-prepend">';
    //                         html += '<span class="input-group-text" style="min-width: 230px;">';
    //                         html += labelNamedss;
    //                         html += '</span>';
    //                         html += '</div>';
    //                         html += '<input type="text" class="form-control" value="';
    //                         html += resul.data_name;
    //                         html += '" readonly/>';
    //                         html += '<div class="input-group-append">';
    //                         html += resul.data_aksi;
    //                         html += '<a style="margin-left: 5px;" class="btn btn-warning action-edit" href="javascript:actionEdit(\'';
    //                         html += dataValue;
    //                         html += '\')" data-id="';
    //                         html += dataValue;
    //                         html += '">EDIT</a>';
    //                         html += '<a style="margin-left: 5px;" class="btn btn-danger action-hapus" href="javascript:actionHapus(\'';
    //                         html += dataValue;
    //                         html += '\', \'';
    //                         html += resul.data;
    //                         html += '\')" data-id="';
    //                         html += dataValue;
    //                         html += '" data-token="';
    //                         html += resul.data;
    //                         html += '">HAPUS</a>';
    //                         html += '</div>';
    //                         html += '</div>';
    //                         html += '</div>';
    //                         html += '</div>';

    //                         // let contentButtonAjukan = '';
    //                         //     contentButtonAjukan +=  '<button type="button" onclick="ajukanVerifikasi(\'';
    //                         //     contentButtonAjukan +=  resul.data;
    //                         //     contentButtonAjukan +=  '\')" class="btn btn-success" >AJUKAN VERIFIKASI</button>';

    //                         $('.' + dataValue + '-block').html(html);
    //                         // $('.content-button-ajukan').html(contentButtonAjukan);
    //                     })
    //                 }
    //             },
    //             error: function() {
    //                 $('.progress-' + dataValue).css('display', 'none');
    //                 $('.status-' + dataValue).innerHTML = "";
    //                 $('.progress-percent-' + dataValue).innerHTML = "<span>0%</span>";
    //                 $('.progressbar-' + dataValue).attr('aria-valuenow', '0').css('width', '0%');
    //                 event.disabled = false;
    //                 Swal.fire(
    //                     'Failed!',
    //                     "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
    //                     'warning'
    //                 );
    //             }
    //         });
    //     } else {
    //         Swal.fire(
    //             'Warning!!!',
    //             "Silahkan pilih file terlebih dahulu.",
    //             'warning'
    //         );
    //     }
    // }

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<!--<link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">-->
<style>
    .preview-image-upload {
        position: relative;
    }

    .preview-image-upload .imagePreviewUpload {
        max-width: 300px;
        max-height: 300px;
        cursor: pointer;
    }

    .preview-image-upload .btn-remove-preview-image {
        display: none;
        position: absolute;
        top: 5px;
        left: 5px;
        /*top: 50%;*/
        /*left: 50%;*/
        /*transform: translate(-50%, -50%);*/
        /*-ms-transform: translate(-50%, -50%);*/
        background-color: #555;
        color: white;
        font-size: 16px;
        padding: 5px 10px;
        border: none;
        /*cursor: pointer;*/
        border-radius: 5px;
    }

    .imagePreviewUpload:hover+.btn-remove-preview-image,
    .btn-remove-preview-image:hover {
        display: block;
    }

    /*.imagePreviewUpload .btn-remove-preview-image:hover {*/

    /*    background-color: black;*/
    /*}*/
</style>
<?= $this->endSection(); ?>