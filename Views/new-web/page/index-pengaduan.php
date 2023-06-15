<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="banner-style-14 centred" style="padding-bottom: 0px;">
    <div class="container">
        <div class="content-box">
            <h2>PENGADUAN PPDB TA. 2023/2024</h2>
            <div class="text">Kabupaten Pesawaran.</div>
            <div class="mail-box">
                <form action="#" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="_tiket" id="_tiket" placeholder="No Tiket" required="">
                                </div>
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="_nohp_tiket" id="_nohp_tiket" placeholder="No handphone" required="">
                                </div>
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                                <div class="col-md-2">
                                    <button type="submit">Cari Pengaduan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="image-box">
                <figure class="image-1 js-tilt"><img src="<?= base_url('themes') ?>/images/resource/illustration-26.png" alt=""></figure>
                <figure class="image-2 float-bob-x"><img src="<?= base_url('themes') ?>/images/icons/cloud-1.png" alt=""></figure>
                <figure class="image-3 float-bob-x"><img src="<?= base_url('themes') ?>/images/icons/cloud-2.png" alt=""></figure>
            </div> -->
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>