<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header1') ?>
<section class="error-section centred">
    <div class="container">
        <div class="content-box">
            <figure class="error-image"><img src="<?= base_url('themes') ?>/images/resource/error.png" alt=""></figure>
            <h1>Mohon maaf...!!!</h1>
            <div class="text">Data yang anda cari tidak ditemukan<br>Silahkan cari data lainnya.</div>
            <div class="btn-box"><a href="<?= base_url() ?>?" class="theme-btn-two">Kembali ke Home</a></div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script>

</script>

<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<?= $this->endSection(); ?>