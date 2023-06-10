<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h2>JADWAL PELAKSANAAN</h2>
            <p>Untuk jadwal pelaksanaan PPDB Tahun 2023 Kab. Pesawaran, sebagai berikut:</p>
        </div>
        <div class="tabs-box">
            <div class="tabs-content">
                <div class="tab active-tab" id="tab-1">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="<?= base_url('themes') ?>/images/icons/price-icon-1.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title" style="padding: 10px 15px;">Jalur</h3>
                                        <h3 class="price" style="font-size: 26px; padding-top: 6px;">AFIRMASI</span></h3>
                                    </div>
                                    <div class="table-content" style="padding-left: 15px;">
                                        <ul>
                                            <li>
                                                <b>Pendaftaran </b><br>
                                                Buka : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_afirmasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_afirmasi) ?> WIB<br>
                                                Tutup : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_akhir_pendaftaran_afirmasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_akhir_pendaftaran_afirmasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Verifikasi </b><br>
                                                Buka : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_afirmasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_afirmasi) ?> WIB<br>
                                                Tutup : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_akhir_pendaftaran_afirmasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_akhir_pendaftaran_afirmasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Analisis </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_analisis_afirmasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_analisis_afirmasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Pengumuman </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_pengumuman_afirmasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_pengumuman_afirmasi) ?> WIB
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="<?= base_url('themes') ?>/images/icons/price-icon-2.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title" style="padding: 10px 15px;">Jalur</h3>
                                        <h2 class="price" style="font-size: 26px; padding-top: 6px;">ZONASI</span></h2>
                                    </div>
                                    <div class="table-content" style="padding-left: 15px;">
                                        <ul>
                                            <li>
                                                <b>Pendaftaran </b><br>
                                                Buka : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_zonasi) ?> WIB<br>
                                                Tutup : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_akhir_pendaftaran_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_akhir_pendaftaran_zonasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Verifikasi </b><br>
                                                Buka : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_verifikasi_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_verifikasi_zonasi) ?> WIB<br>
                                                Tutup : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_verifikasi_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_verifikasi_zonasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Analisis </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_analisis_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_analisis_zonasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Pengumuman </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_pengumuman_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_pengumuman_zonasi) ?> WIB
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="<?= base_url('themes') ?>/images/icons/price-icon-3.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title" style="padding: 10px 15px;">Jalur</h3>
                                        <h2 class="price" style="font-size: 26px; padding-top: 6px;">PRESTASI DAN MUTASI</span></h2>
                                    </div>
                                    <div class="table-content" style="padding-left: 15px;">
                                        <ul>
                                            <li>
                                                <b>Pendaftaran </b><br>
                                                Buka : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_prestasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_prestasi) ?> WIB<br>
                                                Tutup : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_akhir_pendaftaran_prestasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_akhir_pendaftaran_prestasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Verifikasi </b><br>
                                                Buka : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_prestasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_prestasi) ?> WIB<br>
                                                Tutup : <br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_akhir_pendaftaran_prestasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_akhir_pendaftaran_prestasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Analisis </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_analisis_prestasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_analisis_prestasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Pengumuman </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_pengumuman_prestasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_pengumuman_prestasi) ?> WIB
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>