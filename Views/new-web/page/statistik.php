<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="crm-programming">
    <div class="image-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/crm-bg.png);"></div>
    <div class="container" style="margin-top: 90px;">>
        <div class="sec-title center">
            <h2>STATISTIK PPDB 2023<br>KABUPATEN PESAWARAN</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="900ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#2eb100" data-value=".75">
                            <span>75</span>
                        </div>
                    </div>
                    <div class="text">Jalur Afirmasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#ff0000" data-value=".50">
                            <span>50</span>
                        </div>
                    </div>
                    <div class="text">Jalur Zonasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#393e95" data-value=".24">
                            <span>24</span>
                        </div>
                    </div>
                    <div class="text">Jalur Prestasi</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#ff8500" data-value=".27">
                            <span>27</span>
                        </div>
                    </div>
                    <div class="text">Jalur Mutasi</div>
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