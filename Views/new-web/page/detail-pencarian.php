<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="portfolio-details">
    <div class="lower-box">
        <div class="container" style="padding-top: 100px;">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 image-column">
                    <div class="image-content">
                        <div class="title-box">
                            <!-- <span>Graphic Design , Digital marketing</span> -->
                            <h2 style="text-align: center;">Detail Data Siswa</h2>
                        </div>
                        <div class="image-box wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                            <figure class="image"><a href="<?= base_url('uploads/peserta/user') . '/' . $siswa->profile_picture ?>" class="lightbox-image" data-fancybox="gallery"><img src="<?= base_url('uploads/peserta/user') . '/' . $siswa->profile_picture ?>" alt=""></a></figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                    <div class="content-box" style="padding-top: 100px;">
                        <h5><?= $siswa->fullname ?></h5>
                        <!-- <div class="text">
                            <p>Great code deserves an equally stunning visual representation, and this is what we deliver. Our Product Design team combines beautiful interfaces with captivating user experience. Top-notch blockchain developers, designers, and product owners - ready to build your product. </p>
                        </div> -->
                        <?php $s = json_decode($siswa->details) ?>
                        <ul class="info-list clearfix">
                            <li><span>NISN</span><?= $siswa->nisn ?></li>
                            <li><span>NIK</span><?= $s->nik ?></li>
                            <li><span>Tempat Lahir</span><?= $s->tempat_lahir ?></li>
                            <li><span>Tanggal Lahir</span><?= $s->tanggal_lahir ?></li>
                            <!-- <li><span>Sekolah Asal</span><a href="#"><? $s->npsn ?></a></li> -->
                        </ul>
                        <!-- <ul class="social-icons">
                            <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fab fa-dribbble-square"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-square"></i></a></li>
                        </ul> -->
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