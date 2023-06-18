<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred _profil_sekolah" id="_profil_sekolah">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h4>DETAIL PENGADUAN DENGAN TICKET <?= $data->token ?></h4>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 content-column" style="text-align: left !important;">
                <div id="content_block_38">
                    <div class="content-box wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="sec-title">
                            <div class="feature-btn"><a href="#" class="theme-btn-two">Open</a></div>
                            <p>Hallo <?= $data->nama ?>,<br />Kamu bisa menulis komentar dikolom komentar dan update status pengaduan kamu.</p>
                            <div style="margin-top: 35px; padding: 20px; border: 2px solid #777777;">
                                <table border="0">
                                    <thead>
                                        <tr>
                                            <td style="padding-right: 20px;">
                                                No. Tiket
                                            </td>
                                            <td style="padding-right: 20px;">:</td>
                                            <th><?= $data->token ?></th>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 20px;">
                                                No. Handphone
                                            </td>
                                            <td style="padding-right: 20px;">:</td>
                                            <th><?= $data->no_hp ?></th>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 20px;">
                                                Klasifikasi
                                            </td>
                                            <td style="padding-right: 20px;">:</td>
                                            <th><?= $data->klasifikasi ?></th>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 20px;">
                                                Tujuan
                                            </td>
                                            <td style="padding-right: 20px;">:</td>
                                            <th><?= $data->tujuan ?></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="lower-content">
                                <div class="single-item">
                                    <div class="icon-box"><i class="flaticon-growth"></i></div>
                                    <h3><a href="#">Detailing and Analysis</a></h3>
                                    <div class="text">Naff are you taking the piss say blow off faff about wellies richard.</div>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="flaticon-art-and-design"></i></div>
                                    <h3><a href="#">Specialized SEO Audit</a></h3>
                                    <div class="text">Naff are you taking the piss say blow off faff about wellies richard.</div>
                                </div>
                            </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 image-column">
                <div id="image_block_36">
                    <div class="image-box wow slideInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="lower-content">
                            <div class="single-item">
                                <div class="icon-box"><i class="flaticon-growth"></i></div>
                                <h4><?= $data->nama ?></h3>
                                    <div class="text"><?= $data->deskripsi ?></div>
                            </div>
                            <div class="single-item">
                                <form action="#" method="post" class="subscribe-form">
                                    <div class="form-group">
                                        <input type="text" name="_komentar" id="_komentar" placeholder="Tulis komentar" required="">
                                        <button type="submit">Kirim</button>
                                    </div>
                                </form>
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