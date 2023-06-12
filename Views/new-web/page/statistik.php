<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="crm-programming">
    <div class="image-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/crm-bg.webp);"></div>
    <div class="container" style="margin-top: 90px;">>
        <div class="sec-title center">
            <h2>STATISTIK PPDB 2023<br>KABUPATEN PESAWARAN</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="900ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#2eb100" data-value=".0">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="text">Jalur Afirmasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#393e95" data-value=".0">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="text">Jalur Zonasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#ff8500" data-value=".0">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="text">Jalur Prestasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#ff0000" data-value="0">
                            <span>0</span>
                        </div>
                    </div>
                    <div class="text">Jalur Mutasi</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="pricing-style-four" style="padding-top: 10px;">
    <div class="container">
        <div class="sec-title center">
            <h2>Unmatched Features With<br>Transparent Pricing</h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 pricing-column">
                <div class="pricing-inner clearfix">
                    <div class="pricing-table">
                        <div class="table-header">
                            <h3 class="title">Jalur Zonasi</h3>
                        </div>
                        <div class="table-content">
                            <ul class="clearfix">
                                <li><i class="fas fa-times"></i></li>
                                <li><i class="fas fa-times"></i></li>
                                <li><i class="fas fa-times"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                            </ul>
                        </div>
                        <div class="table-footer">&nbsp;</div>
                    </div>
                    <div class="pricing-table">
                        <div class="table-header">
                            <h3 class="title">Jalur Zonasi</h3>
                        </div>
                        <div class="table-content">
                            <ul class="clearfix">
                                <li><i class="fas fa-times"></i></li>
                                <li><i class="fas fa-times"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                            </ul>
                        </div>
                        <div class="table-footer">&nbsp;</div>
                    </div>
                    <div class="pricing-table">
                        <div class="table-header">
                            <h3 class="title">Jalur Prestasi</h3>
                        </div>
                        <div class="table-content">
                            <ul class="clearfix">
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                            </ul>
                        </div>
                        <div class="table-footer">&nbsp;</div>
                    </div>
                    <div class="pricing-table">
                        <div class="table-header">
                            <h3 class="title">Jalur Mutasi</h3>
                        </div>
                        <div class="table-content">
                            <ul class="clearfix">
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                                <li><i class="fas fa-check"></i></li>
                            </ul>
                        </div>
                        <div class="table-footer">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>