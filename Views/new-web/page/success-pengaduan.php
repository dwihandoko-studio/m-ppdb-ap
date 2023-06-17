<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<!-- <section class="banner-style-14 centred" style="padding-bottom: 0px;">
    <div class="container">
        <div class="content-box">
            <h2>PENGADUAN PPDB TA. 2023/2024</h2>
            <div class="text">Kabupaten Pesawaran.</div>
            <div class="mail-box">
                <form action="#" method="post">
                    <div class="form-group-custom">
                        <input class="custom-input-form" type="text" name="_tiket" id="_tiket" placeholder="No tiket" required="">
                        <input class="custom-input-form-1" type="text" name="_nohp_tiket" id="_nohp_tiket" placeholder="No handphone" required="">
                        <button class="custom-button-form" type="submit">Cari Pengaduan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> -->
<section class="subscribe-style-five home-18">
    <div class="image-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/layer-image-6.png);"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div id="image_block_38">
                    <div class="image-box">
                        <div class="bg-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/user-icon.png);"></div>
                        <figure class="image float-bob-y clearfix"><img src="<?= base_url('themes') ?>/images/resource/user-16.png" alt=""></figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div id="content_block_41">
                    <div class="content-box">
                        <div class="sec-title">
                            <h2>Terima Kasih, <?= $data->nama ?></h2>
                        </div>
                        <div class="text">Pengduan kamu dengan klasifikasi <b><?= $data->klasifikasi ?></b> yang ditujukan kepada <b><?= $data->tujuan ?></b> berhasil dikirim.<br /><br />Silahkan Catat No Tiket dan No Handphone kamu dibawah ini untuk proses pencarian dan memantau status pengaduan kamu:</div>
                        <div class="text">
                            <div style="padding: 20px; border: 2px dashed #777777;">
                                <table border="0">
                                    <thead>
                                        <tr>
                                            <th>
                                                No. Tiket
                                            </th>
                                            <th>:</th>
                                            <th><?= $data->token ?></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                No. Handphone
                                            </th>
                                            <th>:</th>
                                            <th><?= $data->no_hp ?></th>
                                        </tr>
                                    </thead>
                                </table>
                                <!-- <span>No. Tiket : </span></br>
                                <span><b><?= $data->token ?></b></span><br />
                                <span>No. Handphone</span><br />
                                <span><b><?= $data->no_hp ?></b></span><br /> -->
                            </div>
                        </div>
                        <form action="<?= base_url('web/pengaduan/data') ?>" method="GET" class="subscribe-form">
                            <div class="form-group">
                                <button type="submit" class="theme-btn-two">OK, Terima Kasih</button>
                            </div>
                        </form>
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
<style>
    .showed-on-page {
        display: none !important;
    }

    @media only screen and (max-width: 5000px) {
        .form-group-custom {
            position: relative;
            max-width: 650px;
            width: 100%;
            margin: 0 auto;
        }

        .custom-input-form {
            position: relative;
            width: 37%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
        }

        .custom-input-form-1 {
            position: relative;
            width: 60%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
        }

        .custom-button-form {
            position: absolute;
            top: 0px;
            right: 0px;
            width: 25%;
            height: 50px;
            background: #4527a4;
            text-align: center;
            font-size: 14px;
            color: #fff;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            cursor: pointer;
            transition: all 500ms ease;
        }

    }

    @media only screen and (max-width: 599px) {
        .form-group-custom {
            position: relative;
            /* max-width: 600px; */
            width: 100%;
            margin: 0 auto;
        }

        .custom-input-form {
            position: relative;
            width: 48%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
            margin-bottom: 15px;
        }

        .custom-input-form-1 {
            position: relative;
            width: 48%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
            margin-bottom: 15px;
        }

        .custom-button-form {
            position: relative;
            border-radius: 30px;
            width: 100%;
            top: 0px;
            right: 0px;
            height: 50px;
            background: #4527a4;
            text-align: center;
            font-size: 14px;
            color: #fff;
            cursor: pointer;
            transition: all 500ms ease;
        }

    }

    @media only screen and (max-width: 399px) {
        .form-group-custom {
            position: relative;
            /* max-width: 600px; */
            width: 100%;
            margin: 0 auto;
        }

        .custom-input-form {
            position: relative;
            width: 100%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
            margin-bottom: 15px;
        }

        .custom-input-form-1 {
            position: relative;
            width: 100%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
            margin-bottom: 15px;
        }

        .custom-button-form {
            position: relative;
            border-radius: 30px;
            width: 100%;
            top: 0px;
            right: 0px;
            height: 50px;
            background: #4527a4;
            text-align: center;
            font-size: 14px;
            color: #fff;
            cursor: pointer;
            transition: all 500ms ease;
        }

    }
</style>
<?= $this->endSection(); ?>