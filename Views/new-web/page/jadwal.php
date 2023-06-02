<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h2>JADWAL PELAKSANAAN</h2>
            <p>Untuk jadwal pelaksanaan PPDB Tahun 2023 Kab. Pesawaran, terbagi menjadi 2 tahap:</p>
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
                                        <h3 class="title">Jalur</h3>
                                        <h3 class="price" style="font-size: 38px;">AFIRMASI</span></h3>
                                    </div>
                                    <div class="table-content" style="padding-left: 15px;">
                                        <ul>
                                            <li>
                                                <b>Pendaftaran : </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_zonasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Verifikasi : </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_zonasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Analisis : </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_zonasi) ?> WIB
                                            </li>
                                            <li>
                                                <b>Pengumuman : </b><br>
                                                <i class="far fa-calendar"></i> <?= tgl_indo($data->tgl_awal_pendaftaran_zonasi) ?> <i class="far fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_zonasi) ?> WIB
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="<?= base_url('themes') ?>/images/icons/price-icon-2.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title">Jalur</h3>
                                        <h2 class="price" style="font-size: 38px;">ZONASI</span></h2>
                                    </div>
                                    <div class="table-content" style="padding-left: 15px;">
                                        <ul>
                                            <li>One User</li>
                                            <li>Ui elements 1000</li>
                                            <li>E-mail support</li>
                                            <li>Phone Support</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="<?= base_url('themes') ?>/images/icons/price-icon-3.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title">Jalur</h3>
                                        <h2 class="price" style="font-size: 28px; ">PRESTASI DAN MUTASI</span></h2>
                                    </div>
                                    <div class="table-content" style="padding-left: 15px;">
                                        <ul>
                                            <li>One User</li>
                                            <li>Ui elements 1000</li>
                                            <li>E-mail support</li>
                                            <li>Phone Support</li>
                                        </ul>
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