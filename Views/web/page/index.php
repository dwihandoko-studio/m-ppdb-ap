<?= $this->extend('web/template/index') ?>

<?= $this->section('content') ?>
<div class="modal offcanvas-modal fade" id="offcanvas-modal">
    <div class="modal-dialog offcanvas-dialog">
        <div class="modal-content">
            <div class="modal-header offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- offcanvas-form-wrap start -->
            <!-- <div class="offcanvas-form-wrap">
                <form action="#" class="offcanvas-form position-relative">
                    <input class="form-control" type="text" placeholder="Enter your search key ... " />
                    <button class="btn btn-warning">search</button>
                </form>
            </div> -->
            <!-- offcanvas-form-wrap end -->
            <!-- offcanvas-menu start -->
            <nav id="offcanvas-menu" class="offcanvas-menu">
                <ul>
                    <li>
                        <a href="<?= base_url() ?>">Beranda</a>
                        <!-- add your sub menu here -->
                    </li>
                    <li>
                        <a href="javascript:openAction('alur-pendaftaran')">Alur Pendaftaran</a>
                    </li>
                    <li>
                        <a href="<?= base_url('web/home/pengumuman') ?>">Pengumuman</a>
                    </li>
                    <li>
                        <a href="<?= base_url('web/home/referensizonasi') ?>">Referensi Zonasi Sekolah</a>
                    </li>
                    <li>
                        <a href="<?= base_url('web/home/rekapitulasi') ?>">Rekapitulasi</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://nisn.data.kemdikbud.go.id/">Cek NISN</a>
                    </li>

                </ul>
            </nav>
            <p class="text-gradient mt-3">PPDB KAB. LAMPUNG TENGAH</p>
        </div>
    </div>
</div>

<header class="header">
    <div class="header-top bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-lg-4 d-none d-lg-block">
                    <ul class="header-social-links d-flex flex-wrap align-items-center">
                        <li class="social-link-item"><a href="javascript:;" class="social-link">P</a></li>
                        <li class="social-link-item"><a href="javascript:;" class="social-link">P</a></li>
                        <li class="social-link-item"><a href="javascript:;" class="social-link">D</a></li>
                        <li class="social-link-item"><a href="javascript:;" class="social-link">B</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-none d-md-block">
                    <p class="d-flex flex-wrap align-items-center text-gradient"><span class="hr-border d-none d-xl-block"></span><?= getenv('web.meta.site.title') ?></p>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <ul class="select-box d-flex flex-wrap align-items-center justify-content-center justify-content-md-end">
                        <li class="select-item"><a target="_blank" href="https://wa.me/62<?= str_replace('-', '', getenv('web.meta.site.cs')) ?>">CS SMP: 0<?= getenv('web.meta.site.cs') ?></a> / <a target="_blank" href="https://wa.me/62<?= str_replace('-', '', getenv('web.meta.site.cs2')) ?>">SD: 0<?= getenv('web.meta.site.cs2') ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="active-sticky" class="header-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <a href="#home" class="brand-logo">
                        <img width="130" src="<?= base_url('template/pringo') ?>/assets/images/logo/logo.png" alt="brand logo" />
                    </a>
                </div>
                <div class="col-auto">
                    <!--<a class="btn btn-warning btn-hover-warning d-none d-sm-inline-block d-lg-none" href="blog-details.html">Analyze Your Site <i class="icofont-arrow-right"></i>-->
                    <!--</a>-->

                    <button type="button" class="btn btn-warning offcanvas-toggler" data-bs-toggle="modal" data-bs-target="#offcanvas-modal">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </button>

                    <nav class="d-none d-lg-block">
                        <ul class="main-menu text-end">
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= '#home' ?>">Beranda</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= '#alur-pendaftaran' ?>">Alur Pendaftaran</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/pengumuman') ?>">Pengumuman</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/referensizonasi') ?>">
                                    Referensi Zonasi Sekolah</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/rekapitulasi') ?>">Rekapitulasi</a>
                            </li>
                            <li class="main-menu-item">
                                <a target="_blank" class="main-menu-link" href="https://nisn.data.kemdikbud.go.id/">Cek NISN</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>

<section class="hero-section section-loading" id="home">
    <img class="shape shape1" src="<?= base_url('template/pringo'); ?>/assets/images/hero/shape1.png" alt="img_not_found" />
    <img class="shape shape2" src="<?= base_url('template/pringo'); ?>/assets/images/hero/shape2.png" alt="img_not_found" />
    <img class="shape particle1" src="<?= base_url('template/pringo'); ?>/assets/images/hero/particle1.png" alt="img_not_found" />
    <img class="shape particle2" src="<?= base_url('template/pringo'); ?>/assets/images/hero/particle2.png" alt="img_not_found" />
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-xl-6">
                <div class="hero-content" style="padding-top: 40px;">
                    <!-- <h2 class="title">Top Ranking Your Brand New Website.</h2> -->
                    <img class="particle3" style="margin-top: 400px;" src="<?= base_url('template/pringo'); ?>/assets/images/hero/particle3.png" alt="particle2" />
                    <div style="background-color: rgba(209, 224, 251, 0.86); max-width: 470px; padding: 20px; border-radius: 15px;">
                        <?php //if (!session()->has('login')) { 
                        ?>
                        <?php if (isset($user)) { ?>
                            <p style="margin-bottom: 25px;">
                                <span class="hr d-none d-xl-block"></span> PPDB ONLINE TP. 2023 - 2024 &nbsp;&nbsp;&nbsp;&nbsp;<span class="hr d-none d-xl-block"></span>
                            </p>
                            <p style="margin-bottom: 25px;">
                                SELAMAT DATANG
                            </p>
                            <p style="margin-bottom: 25px;">
                                <?= isset($user) ? $user->fullname : '' ?>
                            </p>
                            <button type="button" onclick="aksiDashboard(this)" style="width: 100%; min-height: 40px; padding: 5px; margin-bottom: 10px;" class="btn btn-warning">KE DASHBOARD SAYA</button>
                            <!-- <p style="margin-bottom: 25px;">
                                <span class="hr d-none d-xl-block"></span> PPDB ONLINE TP. 2023 - 2024 &nbsp;&nbsp;&nbsp;&nbsp;<span class="hr d-none d-xl-block"></span>
                            </p>
                            <form action="#" class="hero-form position-relative" style="margin-bottom: 20px;">
                                <input class="form-control username" id="_username" name="_username" style="padding-right: 0px; height: 40px;width: 100%;" type="text" placeholder="NISN/NIK" />
                                <input class="form-control password" id="_password" name="_password" style="padding-right: 0px; margin-top: 10px; width: 100%; margin-bottom: 20px; height: 40px;" type="password" placeholder="Password" />
                                <button type="button" onclick="showPassword(this)" class="btn btn-info" style="padding: 8px; color: #000; border-color: #0dcaf000; background-color: #0dcaf000; margin-top: 45px; margin-bottom: 0px; margin-right: -6px; margin-left: 0px; height: 40px;"><span class="inputss-group-text show-password">
                                        <i class="fas fa-eye"></i>
                                    </span></button>
                                <a href="" style="margin-left: 10px;">Lupa password? <span style="color: blue; pointer-events: auto;">Reset..</span></a>
                            </form>
                            <button type="button" onclick="aksiLogin(this)" style="width: 100%; min-height: 40px; padding: 5px; margin-bottom: 20px;" class="btn btn-warning">M A S U K</button>
                            <p style="justify-content: center; justify-items: center; margin-bottom: 20px;">Belum punya Akun?</p>
                            <button type="button" onclick="aksiRegister(this)" style="width: 100%; min-height: 40px; padding: 5px; margin-bottom: 10px;" class="btn btn-info">D A F T A R</button> -->
                        <?php } else { ?>
                            <p style="margin-bottom: 25px;">
                                <span class="hr d-none d-xl-block"></span> PPDB ONLINE TP. 2023 - 2024 &nbsp;&nbsp;&nbsp;&nbsp;<span class="hr d-none d-xl-block"></span>
                            </p>
                            <form action="" class="hero-form position-relative" style="margin-bottom: 20px;" id="form-login">
                                <input class="form-control username" id="_username" name="username" style="padding-right: 0px; height: 40px;width: 100%;" type="text" placeholder="NISN/NIK/Email" />
                                <input class="form-control password" id="_password" name="password" style="padding-right: 0px; margin-top: 10px; width: 100%; margin-bottom: 20px; height: 40px;" type="password" placeholder="Password" />
                                <button type="button" onclick="showPassword(this)" class="btn btn-info" style="padding: 8px; color: #000; border-color: #0dcaf000; background-color: #0dcaf000; margin-top: 45px; margin-bottom: 0px; margin-right: -6px; margin-left: 0px; height: 40px;"><span class="inputss-group-text show-password">
                                        <i class="fas fa-eye"></i>
                                    </span></button>
                                <a href="<?= base_url('auth/lupapassword') ?>" style="margin-left: 10px;">Lupa password? <span style="color: blue; pointer-events: auto;">Reset..</span></a>
                                <button type="submit" style="width: 100%; min-height: 40px; padding: 5px; right: 0px; margin-top: 140px;" class="btn btn-warning">M A S U K</button>
                            </form>
                            <p style="justify-content: center; justify-items: center; margin-bottom: 20px; margin-top: 60px;">Belum punya Akun?</p>
                            <button type="button" onclick="aksiRegister(this)" style="width: 100%; min-height: 40px; padding: 5px; margin-bottom: 10px;" class="btn btn-info">D A F T A R</button>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-xl-6">
                <div class="hero-img">
                    <img class="animate-one" src="<?= base_url('template/pringo'); ?>/assets/images/hero/1.png" alt="img_not_found" data-aos="zoom-in" data-aos-delay="100" />
                    <!-- <div class="position-absolute animate-two" style="bottom: -140px;">
                        <img data-aos="fade-up" data-aos-delay="600" src="<?= base_url('template/pringo'); ?>/assets/images/hero/2.png" alt="img_not_found" />
                    </div>

                    <div class="position-absolute animate-three">
                        <img data-aos="fade-down" data-aos-delay="400" src="<?= base_url('template/pringo'); ?>/assets/images/hero/3.png" alt="img_not_found" />
                    </div> -->
                </div>

                <div class="hero-img-mobile">
                    <img src="<?= base_url('template/pringo'); ?>/assets/images/hero/mobile.png" alt="images-not_found" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- working process section start -->
<section class="working-process-section" style="padding-top: 50px; padding-bottom: 90px;" id="alur-pendaftaran">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                <div class="section-title process text-center pb-50">
                    <!-- <div class="icon">
                            <img src="assets/images/icon/pencile.png" alt="Icon_not_found" />
                        </div> -->
                    <h3 class="title" style="font-size: 35px !important;">Bagan Alur Pendaftaran</h3>
                    <!-- <span class="hr-secodary"></span> -->
                </div>
            </div>
        </div>

        <div class="row working-process mb-n4">
            <!-- working-process-list start -->
            <div class="col-lg-3 col-sm-6 working-process-list mb-4" onclick="openActionAlur('cara-daftar-akun');" data-aos="fade-up" data-aos-delay="200">
                <img class="arrow-shape" onclick="openActionAlur('cara-daftar-akun');" src="<?= base_url('template/pringo') ?>/assets/images/working/arrow-shape1.png" alt="images_not_found" />
                <div class="icon">
                    <img onclick="openActionAlur('cara-daftar-akun');" src="<?= base_url('template/pringo') ?>/assets/images/working/1.png" alt="images_not_found" />
                </div>
                <h4 class="title" onclick="openActionAlur('cara-daftar-akun');">Daftar Akun PPDB</h4>
            </div>
            <!-- working-process-list end -->

            <!-- working-process-list start -->
            <div class="col-lg-3 col-sm-6 working-process-list mb-4" onclick="openActionAlur('cara-unggah-dokument');" data-aos="fade-up" data-aos-delay="250">
                <img class="arrow-shape" onclick="openActionAlur('cara-unggah-dokument');" src="<?= base_url('template/pringo') ?>/assets/images/working/arrow-shape2.png" alt="images_not_found" />
                <div class="icon">
                    <img onclick="openActionAlur('cara-unggah-dokument');" src="<?= base_url('template/pringo') ?>/assets/images/working/2.png" alt="images_not_found" />
                </div>
                <h4 class="title" onclick="openActionAlur('cara-unggah-dokument');">Unggah Dokumen</h4>
            </div>
            <!-- working-process-list end -->

            <!-- working-process-list start -->
            <div class="col-lg-3 col-sm-6 working-process-list mb-4" onclick="openActionAlur('cara-daftar-sekolah');" data-aos="fade-up" data-aos-delay="300">
                <img class="arrow-shape" onclick="openActionAlur('cara-daftar-sekolah');" src="<?= base_url('template/pringo') ?>/assets/images/working/arrow-shape1.png" alt="images_not_found" />
                <div class="icon">
                    <img onclick="openActionAlur('cara-daftar-sekolah');" src="<?= base_url('template/pringo') ?>/assets/images/working/3.png" alt="images_not_found" />
                </div>
                <h4 class="title" onclick="openActionAlur('cara-daftar-sekolah');">Daftar Sekolah</h4>
            </div>
            <!-- working-process-list end -->

            <!-- working-process-list start -->
            <div class="col-lg-3 col-sm-6 working-process-list mb-4" onclick="openActionAlur('cara-pengumuman');" data-aos="fade-up" data-aos-delay="350">
                <div class="icon">
                    <img onclick="openActionAlur('cara-pengumuman');" src="<?= base_url('template/pringo') ?>/assets/images/working/4.png" alt="images_not_found" />
                </div>
                <h4 class="title" onclick="openActionAlur('cara-pengumuman');">Pengumuman</h4>
            </div>
            <!-- working-process-list end -->
        </div>
    </div>
</section>
<!-- working process section end -->

<!-- brand section start -->
<div class="brand-section section-pb-150 loading-content-jadwal" data-aos="fade-up" data-aos-delay="100" style="padding-top: 50px; padding-bottom: 50px;" id="jadwal-pendaftaran">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="brand-card brand-carousel" style="padding-bottom: 20px;">
                    <p class="text-center">
                        <span class="text-gradient">Jadwal Pendaftaran Tahun Pelajaran 2023/2024</span>
                    </p>
                    <section id="dashboard" class="flat-row element-countdown bg-black">
                        <div class="container session-content-jadwal" id="session-content-jadwal">
                            <?php if (isset($jadwal)) { ?>
                                <div class="row">
                                    <!--<div class="col-md-3 p-2">-->
                                    <!--    <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="150">-->
                                    <!--        <h5 class="text-center" style="margin-bottom: 0;">Persiapan PPDB 2023/2024</h5>-->
                                    <!--        <hr class="m-3">-->
                                    <!--        <div class="user-activity user-activity-sm">-->
                                    <!--            <div class="media">-->
                                    <!--                <div class="media-body">-->
                                    <!--                    <div>-->
                                    <!--                        <h6 class="d-block">Tanggal Persiapan</h6>-->
                                    <!--                        <span class="d-block mb-5"><i class="fa fa-calendar"></i>-->
                                    <!--                            25-Mei-2023 <i class="fa fa-arrow-right"></i> 26-Juni-2023-->
                                    <!--                        </span>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--            <div class="media">-->
                                    <!--                <div class="media-body">-->
                                    <!--                    <div>-->
                                    <!--                        <h6 class="d-block">Dibuka</h6>-->
                                    <!--                        <span class="d-block mb-5"><i class="fa fa-calendar"></i>-->
                                    <!--                            25-Mei-2023 <br>-->
                                    <!--                            <i class="fa fa-clock"></i> Pukul 07:00 WIB-->
                                    <!--                        </span>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--            <div class="media">-->
                                    <!--                <div class="media-body">-->
                                    <!--                    <div>-->
                                    <!--                        <h6 class="d-block">Ditutup</h6>-->
                                    <!--                        <span class="d-block mb-5"><i class="fa fa-calendar"></i>-->
                                    <!--                            26-Juni-2023 <br><i class="fa fa-clock"></i> Pukul 17:00 WIB-->
                                    <!--                        </span>-->
                                    <!--                    </div>-->
                                    <!--                </div>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-md-3 p-2">
                                        <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="200">
                                            <h5 class="text-center" style="margin-bottom: 0;">Pelaksanaan PPDB 2023/2024</h5>
                                            <hr class="m-3">
                                            <div class="user-activity user-activity-sm">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Tanggal Pelaksanaan</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_awal_pendaftaran_zonasi) ?> <i class="fa fa-arrow-right"></i> 24 Juni 2023<?php //echo tgl_indo($jadwal->tgl_akhir_pendaftaran_zonasi) 
                                                                                                                                                                    ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Dibuka</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_awal_pendaftaran_zonasi) ?> <br><i class="fa fa-clock"></i> Pukul <?= waktu_indo($jadwal->tgl_awal_pendaftaran_zonasi) ?> WIB
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Ditutup</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i> 24 Juni 2023
                                                                <?php //echo tgl_indo($jadwal->tgl_akhir_pendaftaran_zonasi) 
                                                                ?> <br><i class="fa fa-clock"></i> Pukul <?= waktu_indo($jadwal->tgl_akhir_pendaftaran_zonasi) ?> WIB
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 p-2">
                                        <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="250">
                                            <h5 class="text-center" style="margin-bottom: 0;">Verifikasi Berkas Pendaftaran</h5>
                                            <hr class="m-3">
                                            <div class="user-activity user-activity-sm">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Tanggal Verifikasi</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_awal_verifikasi_zonasi) ?> <i class="fa fa-arrow-right"></i> <?= tgl_indo($jadwal->tgl_akhir_verifikasi_zonasi) ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Dibuka</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_awal_verifikasi_zonasi) ?> <br><i class="fa fa-clock"></i> Pukul <?= waktu_indo($jadwal->tgl_awal_verifikasi_zonasi) ?> WIB
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Ditutup</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_akhir_verifikasi_zonasi) ?> <br><i class="fa fa-clock"></i> Pukul <?= waktu_indo($jadwal->tgl_akhir_verifikasi_zonasi) ?> WIB
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 p-2">
                                        <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="300">
                                            <h5 class="text-center" style="margin-bottom: 0;">Analisis dan Pengumuman </h5>
                                            <hr class="m-3">
                                            <div class="user-activity user-activity-sm">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Tanggal Analisis</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_awal_analisis_zonasi) ?> <i class="fa fa-arrow-right"></i> <?= tgl_indo($jadwal->tgl_akhir_analisis_zonasi) ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>

                                                            <h6 class="d-block">Pengumuman</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_pengumuman_zonasi) ?> <br><br>
                                                            </span>
                                                            <br><br><br><br>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div class="media">-->
                                                <!--    <div class="media-body">-->
                                                <!--        <div>-->
                                                <!--            <h6 class="d-block">Daftar Ulang</h6>-->
                                                <!--            <span class="d-block mb-5"><i class="fa fa-calendar"></i>-->
                                                <!--                <?= tgl_indo($jadwal->tgl_awal_daftar_ulang_zonasi) ?> <i class="fa fa-arrow-right"></i> <?= tgl_indo($jadwal->tgl_akhir_daftar_ulang_zonasi) ?><br><br>-->
                                                <!--            </span>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 p-2">
                                        <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="300">
                                            <h5 class="text-center" style="margin-bottom: 0;">Pelimpahan dan Daftar Ulang</h5>
                                            <hr class="m-3">
                                            <div class="user-activity user-activity-sm">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Tanggal Pelimpahan</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_awal_daftar_ulang_zonasi) ?> <i class="fa fa-arrow-right"></i> <?= tgl_indo($jadwal->tgl_akhir_daftar_ulang_zonasi) ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="media">
                                                    <div class="media-body">
                                                        <div>
                                                            <h6 class="d-block">Daftar Ulang</h6>
                                                            <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                                <?= tgl_indo($jadwal->tgl_awal_daftar_ulang_zonasi) ?> <i class="fa fa-arrow-right"></i> <?= tgl_indo($jadwal->tgl_akhir_daftar_ulang_zonasi) ?><br><br>
                                                            </span>
                                                            <br><br><br><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 p-2">
                                    <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="350">
                                        <h5 class="text-center" style="margin-bottom: 0;">Jalur Zonasi</h5>
                                        <hr class="m-3">
                                        <div class="user-activity user-activity-sm">
                                            <div class="media">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="d-block">Tanggal Pendaftaran</h6>
                                                        <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                            24-Mei-2021 <i class="fa fa-arrow-right"></i> 29-Mei-2021
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="d-block">Tanggal Pendaftaran</h6>
                                                        <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                            24-Mei-2021 <i class="fa fa-arrow-right"></i> 29-Mei-2021
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="d-block">Tanggal Pendaftaran</h6>
                                                        <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                                            24-Mei-2021 <i class="fa fa-arrow-right"></i> 29-Mei-2021
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                </div>
                            <?php } ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand section start -->

<!-- faq section start -->
<section class="faq-section" style="padding-bottom: 50px;" id="cara-pendaftaran">

    <div class="container">
        <div class="row mb-n7">

            <div class="col-xl-12 mb-7">
                <div class="faq-content">
                    <div class="section-title primary" data-aos="fade-up" data-aos-delay="100">

                        <h3 class="title" style="font-size: 35px !important;">Cara Pendaftaran</h3>
                        <span class="hr-primary mt-4"></span>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="150" id="cara-daftar-akun">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <span>1. Registrasi Akun PPDB?</span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Calon Peserta Didik melakukan registrasi melalui sistem aplikasi PPDB Online
                                    </p>
                                    <img src="<?= base_url('template/pringo') ?>/assets/images/logo/daftar.png" width="100%" alt="brand logo" />
                                    <br>
                                    <br>
                                    <br>
                                    <img src="<?= base_url('template/pringo') ?>/assets/images/logo/daftar1.png" width="100%" alt="brand logo" />
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="150" id="cara-unggah-dokument">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>2. Unggah Dokumen?</span>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Calon Peserta Didik melengkapi data & mengunggah dokumen kelengkapan
                                        pendaftaran pada sistem ppdb.
                                    </p>
                                    <img src="<?= base_url('template/pringo') ?>/assets/images/logo/unggah.png" width="100%" alt="brand logo" />
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="150" id="cara-daftar-sekolah">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span>3. Daftar Sekolah?</span>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Calon Peserta Didik mendaftar ke Sekolah yang dituju sesuai dengan jalur
                                        yang dipilih melalui aplikasi ppdb online
                                    </p>
                                    <img src="<?= base_url('template/pringo') ?>/assets/images/logo/pendaftaran.png" width="100%" alt="brand logo" />
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="150" id="cara-cetak-bukti">
                            <h2 class="accordion-header" id="headingLima">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLima" aria-expanded="false" aria-controls="collapseLima">
                                    <span>4. Cetak Bukti Pendaftaran?</span>
                                </button>
                            </h2>
                            <div id="collapseLima" class="accordion-collapse collapse" aria-labelledby="headingLima" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Calon Peserta Didik mencetak tanda bukti pendaftaran
                                    </p>
                                    <img src="<?= base_url('template/pringo') ?>/assets/images/logo/cetak.png" width="100%" alt="brand logo" />
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="150" id="cara-pengumuman">
                            <h2 class="accordion-header" id="headingEnam">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEnam" aria-expanded="false" aria-controls="collapseEnam">
                                    <span>5. Pengumuman?</span>
                                </button>
                            </h2>
                            <div id="collapseEnam" class="accordion-collapse collapse" aria-labelledby="headingEnam" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Calon Peserta Didik melihat hasil seleksi dan pengumuman secara online
                                        melalui situs PPDB Online
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- faq team section end -->

<!-- blog section start -->
<section class="blog-section" style="padding-top: 50px; padding-bottom: 50px;" id="content-pengumuman">
    <div class="container">
        <div class="row mb-n7">
            <div class="col-lg-6 mb-7">
                <div class="section-title text-center text-lg-start primary" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="title">Informasi</h3>
                    <span class="hr-primary mt-4"></span>
                </div>

                <div class="blog-card" data-aos="fade-up" data-aos-delay="150">
                    <div class="thumb">
                        <a href="#"><img src="<?= base_url('template/pringo') ?>/assets/images/blog/1.png" alt="images-not_found" /></a>
                    </div>
                    <div class="content">
                        <!-- <p>
                                Pendaftar <span>Jalur Zonasi.</span>
                            </p> -->
                        <h3 class="title">
                            <a href="#">Syarat Pendataran dan Jadwal Pendaftaran PPDB 2023 JALUR ZONASI.</a>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-7">
                <div class="blog-meta-cards">
                    <!-- blog-meta-card  -->
                    <div class="blog-meta-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="thumb">
                            <img src="<?= base_url('template/pringo') ?>/assets/images/blog/2.png" alt="images-not_found" />
                        </div>
                        <div class="content">
                            <!-- <p>
                                    By Admin / 12 January, 2021 /
                                    <span>Digital Marketing.</span>
                                </p> -->
                            <h3 class="title">
                                <a href="#">
                                    Syarat Pendataran dan Jadwal Pendaftaran PPDB 2023 JALUR PRESTASI.
                                </a>
                            </h3>
                        </div>
                    </div>
                    <!-- blog-meta-card  end-->
                    <!-- blog-meta-card  -->
                    <div class="blog-meta-card" data-aos="fade-up" data-aos-delay="250">
                        <div class="thumb">
                            <img src="<?= base_url('template/pringo') ?>/assets/images/blog/3.png" alt="images-not_found" />
                        </div>
                        <div class="content">
                            <!-- <p>
                                    By Admin / 12 January, 2021 /
                                    <span>Digital Marketing.</span>
                                </p> -->
                            <h3 class="title">
                                <a href="#">
                                    Syarat Pendataran dan Jadwal Pendaftaran PPDB 2023 JALUR AFIRMASI.
                                </a>
                            </h3>
                        </div>
                    </div>
                    <!-- blog-meta-card  end-->
                    <!-- blog-meta-card  -->
                    <div class="blog-meta-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="thumb">
                            <img src="<?= base_url('template/pringo') ?>/assets/images/blog/4.png" alt="images-not_found" />
                        </div>
                        <div class="content">
                            <!-- <p>
                                    By Admin / 12 January, 2021 /
                                    <span>Digital Marketing.</span>
                                </p> -->
                            <h3 class="title">
                                <a href="#">
                                    Syarat Pendataran dan Jadwal Pendaftaran PPDB 2023 JALUR MUTASI ORANG TUA/WALI.
                                </a>
                            </h3>
                        </div>
                    </div>
                    <!-- blog-meta-card  end-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog section end -->

<!-- working process section start -->
<section class="working-process-section" style="padding-top: 50px; padding-bottom: 90px;background-color: #02126a;
    background-image: none" id="kuota-sekolah">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                <div class="section-title process text-center pb-50">
                    <!-- <div class="icon">
                        <img src="<?= base_url('template/pringo'); ?>/assets/images/icon/pencile.png" alt="Icon_not_found" />
                    </div> -->
                    <h3 class="title" style="font-size: 35px !important;">Informasi Kuota Sekolah</h3>
                    <!-- <span class="hr-secodary"></span> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-default" style="border-bottom: none;">
                    <div class="card-body">
                        <div class="callout callout-info">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group jenjang-block">
                                        <label for="filter_jenjang" class="form-control-label">Filter Jenjang</label>
                                        <select class="form-control filter-jenjang" name="filter_jenjang" id="filter_jenjang" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                            <option value="">-- Pilih --</option>
                                            <option value="6">SMP</option>
                                            <option value="5">SD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group kecamatan-block">
                                        <label for="filter_kecamatan" class="form-control-label">Filter Kecamatan</label>
                                        <select class="form-control filter-kecamatan" name="filter_kecamatan" id="filter_kecamatan" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                            <option value="">-- Pilih --</option>
                                            <?php if (isset($kecamatans)) {
                                                if (count($kecamatans) > 0) {
                                                    foreach ($kecamatans as $key => $value) {
                                                        echo '<option value="' . $value->id . '">' . $value->nama . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive" style="background-color: #fff; padding: 12px;border-radius: 5px; margin-top: -8px;">
                    <table class="table table-hover" id="tabelKuotaSekolah">
                        <thead style="border: 1px solid #273581;">
                            <tr>
                                <th data-orderable="false" style="vertical-align: middle;">#</th>
                                <th style="vertical-align: middle;">Nama Sekolah</th>
                                <th style="vertical-align: middle;">NPSN</th>
                                <th style="vertical-align: middle;">Nama Kecamatan</th>
                                <th style="vertical-align: middle;">Daya Tampung</th>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- working process section end -->

<!-- brand section start -->
<div class="brand-section section-pb-150" data-aos="fade-up" data-aos-delay="100" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="brand-card brand-carousel" style="padding-bottom: 20px;">
                    <p class="text-center">
                        <span class="text-gradient">Statistik PPDB</span>
                    </p>
                    <section id="dashboard" class="flat-row element-countdown bg-black">
                        <div class="container">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="150">
                                        <div class="info-box bg-blue">
                                            <span class="info-box-icon"><i class="glyphicon glyphicon-user"></i></span>
                                            <div class="info-box-content">
                                                <?php
                                                $kuota_zonasi = 0;
                                                $kuota_afirmasi = 0;
                                                $kuota_mutasi = 0;
                                                $kuota_prestasi = 0;
                                                $pendaftar_zonasi = 0;
                                                $pendaftar_afirmasi = 0;
                                                $pendaftar_mutasi = 0;
                                                $pendaftar_prestasi = 0;

                                                if (isset($jumlah_kuota)) {
                                                    $kuota_zonasi = $jumlah_kuota->zonasi;
                                                    $kuota_afirmasi = $jumlah_kuota->afirmasi;
                                                    $kuota_mutasi = $jumlah_kuota->mutasi;
                                                    $kuota_prestasi = $jumlah_kuota->mutasi;
                                                    $pendaftar_zonasi = ((int)$jumlah_kuota->pendaftar_zonasi_terverifikasi + (int)$jumlah_kuota->pendaftar_zonasi_antrian + (int)$jumlah_kuota->pendaftar_swasta_antrian + (int)$jumlah_kuota->pendaftar_swasta_terverifikasi);
                                                    $pendaftar_afirmasi = ((int)$jumlah_kuota->pendaftar_afirmasi_terverifikasi + (int)$jumlah_kuota->pendaftar_afirmasi_antrian);
                                                    $pendaftar_mutasi = ((int)$jumlah_kuota->pendaftar_mutasi_terverifikasi + (int)$jumlah_kuota->pendaftar_mutasi_antrian);
                                                    $pendaftar_prestasi = ((int)$jumlah_kuota->pendaftar_prestasi_terverifikasi + (int)$jumlah_kuota->pendaftar_prestasi_antrian);
                                                }
                                                ?>
                                                <span class="info-box-text">Kuota Zonasi : <b><?= $kuota_zonasi ?></b></span>
                                                <span class="info-box-number">Pendaftar : <?= $pendaftar_zonasi ?> (<?= $pendaftar_zonasi > 0 ? ($pendaftar_zonasi / $kuota_zonasi) * 100 : 0 ?>%)</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 100%"></div>
                                                </div>
                                                <span class="progress-description">&nbsp;</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                                        <div class="info-box bg-blue">
                                            <span class="info-box-icon"><i class="glyphicon glyphicon-user"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kuota Afirmasi : <b><?= $kuota_afirmasi ?></b></span>
                                                <span class="info-box-number">Pendaftar : <?= $pendaftar_afirmasi ?> (<?= $pendaftar_afirmasi > 0 ? ($pendaftar_afirmasi / $kuota_afirmasi) * 100 : 0 ?>%)</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 100%"></div>
                                                </div>
                                                <span class="progress-description">&nbsp;</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="250">
                                        <div class="info-box bg-blue">
                                            <span class="info-box-icon"><i class="glyphicon glyphicon-user"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kuota Perpindahan Tugas Orang Tua : <b><?= $kuota_mutasi ?></b></span>
                                                <span class="info-box-number">Pendaftar : <?= $pendaftar_mutasi ?> (<?= $pendaftar_mutasi > 0 ? ($pendaftar_mutasi / $kuota_mutasi) * 100 : 0 ?>%)</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 100%"></div>
                                                </div>
                                                <span class="progress-description">&nbsp;</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="300">
                                        <div class="info-box bg-blue">
                                            <span class="info-box-icon"><i class="glyphicon glyphicon-user"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kuota Prestasi : <b><?= $kuota_prestasi ?></b></span>
                                                <span class="info-box-number">Pendaftar : <?= $pendaftar_prestasi ?> (<?= $pendaftar_prestasi > 0 ? ($pendaftar_prestasi / $kuota_prestasi) * 100 : 0 ?>%)</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 100%"></div>
                                                </div>
                                                <span class="progress-description">&nbsp;</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px; padding-top: 20px; background-color: white; border-radius: 20px;">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="350">
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <i class="glyphicon glyphicon-dashboard"></i>
                                            <h3 class="box-title"><b>Progres Penerimaan</b></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div id="gauge" style="margin: 0 auto; padding: 20px 0;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="400">
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <i class="glyphicon glyphicon-dashboard"></i>
                                            <h3 class="box-title"><b>Grafik Pendaftar</b></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div id="bar" style="margin: 0 auto; padding: 20px 0;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="450">
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <i class="glyphicon glyphicon-dashboard"></i>
                                            <h3 class="box-title"><b>Progres Harian Pendaftaran</b></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div id="line" style="margin: 0 auto; padding: 20px 0;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="500">
                                    <div class="box box-solid">
                                        <div class="box-header with-border">
                                            <i class="glyphicon glyphicon-dashboard"></i>
                                            <h3 class="box-title"><b>Prosentase Jalur Pendaftaran</b></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div id="pie" style="margin: 0 auto; padding: 20px 0;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand section start -->

<div class="brand-section section-pb-150" data-aos="fade-up" data-aos-delay="100" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="brand-card brand-carousel" style="padding-bottom: 50px;">
                    <section id="dashboard" class="flat-row element-countdown bg-black">
                        <div class="container">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-8" style="margin-bottom: 50px;">
                                        <h2 style="color: #fff; margin-bottom: 40px;">Download berbagai macam informasi terkait pendaftaran PPDB Kabupaten Lampung Tengah</h2>
                                        <div class="row">
                                            <div class="col-md-6" style="color: #fff;">
                                                <a href="<?= base_url('uploads/panduan/panduan_panitia.pdf') ?>" style="color: #fff;" target="_blank">
                                                    <img src="<?= base_url() ?>/template/pringo/download.svg" alt="" class="mr-2 align-items-center">
                                                    Panduan Sekolah
                                                </a>
                                            </div>
                                            <div class="col-md-6" style="color: #fff;">
                                                <a href="<?= base_url('uploads/panduan/panduan_web_siswa.pdf') ?>" style="color: #fff;" target="_blank">
                                                    <img src="<?= base_url() ?>/template/pringo/download.svg" alt="" class="mr-2 align-items-center">
                                                    Panduan Web Siswa/Orang Tua/Wali
                                                </a>
                                            </div>
                                            <div class="col-md-6" style="color: #fff;">
                                                <a href="<?= base_url('uploads/panduan/panduan_aplikasi.pdf') ?>" style="color: #fff;" target="_blank">
                                                    <img src="<?= base_url() ?>/template/pringo/download.svg" alt="" class="mr-2 align-items-center">
                                                    Panduan Android Siswa/Orang Tua/Wali
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" style="color: #fff;">
                                        Download juga aplikasi PPDB Kabupaten Lampung Tengah di Playstore untuk pengalaman lebih baik.<br>
                                        <a href="https://play.google.com/store/apps/details?id=com.kntechline.ppdb.duatiga.lamteng" target="_blank">
                                            <img src="<?= base_url() ?>/template/pringo/playstore.png" alt="" class="mr-2 align-items-center">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url('new-assets/assets'); ?>/js/jquery-block-ui.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>
<script src="<?= base_url('template/pringo') ?>/assets/js/highcharts.js"></script>
<script src="<?= base_url('template/pringo') ?>/assets/js/highcharts-more.js"></script>
<script src="<?= base_url('template/pringo') ?>/assets/js/grid-light.js"></script>

<script>
    let loadedAll = false;
    let loading = false;

    function initSelect2(event) {
        $('#' + event).select2({
            dropdownParent: "#kuota-sekolah"
        });
    }

    function formatKuota(d) {
        return ('<table cellpadding="5" cellspacing="0" border="1" style="padding-left:50px;">' +
            '<tr>' +
            '<td>Rincian Total Kuota: <b>' + d.jumlah + '</b></td>' +
            '<td></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Zonasi:</td>' +
            '<td>' +
            d.zonasi +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Afirmasi:</td>' +
            '<td>' +
            d.afirmasi +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Mutasi:</td>' +
            '<td>' +
            d.mutasi +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Prestasi:</td>' +
            '<td>' +
            d.prestasi +
            '</td>' +
            '</tr>' +
            '</table>'
        );
        // `d` is the original data object for the row

    }

    $(document).ready(function() {
        loadedAll = true;
        initSelect2('filter_kecamatan');
        initSelect2('filter_jenjang');

        let tableKuotaSekolah = $('#tabelKuotaSekolah').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('web/home/getKuotaSekolah') ?>",
                "type": "POST",
                "data": function(data) {
                    data.filter_kecamatan = $('#filter_kecamatan').val();
                    data.filter_jenjang = $('#filter_jenjang').val();
                }
            },
            language: {
                paginate: {
                    next: '<i class="ni ni-bold-right">',
                    previous: '<i class="ni ni-bold-left">'
                },
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
            },
            'columns': [
                // {
                //     'data': 'button',
                //     'className': 'dt-control',
                //     "defaultContent": "",
                //     'name': 'Aksi'
                {
                    className: 'dt-control',
                    orderable: false,
                    data: 'button',
                    defaultContent: '',
                },
                {
                    data: 'nama'
                },
                {
                    data: 'npsn'
                },
                {
                    data: 'kecamatan'
                },
                {
                    data: 'jumlah'
                }
            ],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
            }],
        });

        $('#tabelKuotaSekolah tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = tableKuotaSekolah.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row

                row.child(formatKuota(row.data())).show();
                tr.addClass('shown');
            }
        });

        $('#filter_kecamatan').change(function() {
            tableKuotaSekolah.draw();
        });

        $('#filter_jenjang').change(function() {
            tableKuotaSekolah.draw();
        });

    });

    function showPassword(event) {
        let showedPassword = document.getElementsByName('password')[0];
        if (showedPassword.type === "password") {
            showedPassword.type = "text";
            $('.show-password').html('<i class="fas fa-eye-slash"></i>');
        } else {
            showedPassword.type = "password";
            $('.show-password').html('<i class="fas fa-eye"></i>');
        }
    }

    function aksiRegister(event) {
        if (loadedAll) {
            if (loading) {
                return;
            }
            <?php if (isset($jadwal)) {
                $today = date("Y-m-d H:i:s");
                $startdate = strtotime($today);
                $enddateAwal = strtotime($jadwal->tgl_awal_pendaftaran_zonasi);

                if ($startdate < $enddateAwal) { ?>
                    Swal.fire(
                        'PERINGATAN!',
                        "Mohon maaf, saat ini proses pendaftaran PPDB belum dibuka.",
                        'warning'
                    );
                    <?php } else {
                    $enddateAkhir = strtotime($jadwal->tgl_akhir_pendaftaran_zonasi);
                    if ($startdate > $enddateAkhir) { ?>
                        Swal.fire(
                            'PERINGATAN!',
                            "Mohon maaf, saat ini proses pendaftaran PPDB telah ditutup.",
                            'warning'
                        );
                    <?php } else { ?>
                        document.location.href = BASE_URL + '/web/home/register';
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                Swal.fire(
                    'PERINGATAN!',
                    "Mohon maaf, saat ini proses pendaftaran PPDB belum dibuka.",
                    'warning'
                );
            <?php } ?>

        }
    }

    function aksiDashboard(event) {
        if (loadedAll) {
            if (loading) {
                return;
            }

            document.location.href = BASE_URL + '/dashboard';
        }
    }

    $("form").on("submit", function(e) {
        var dataString = $(this).serialize();

        $.ajax({
            type: "POST",
            url: BASE_URL + '/auth/login',
            data: dataString,
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('section.section-loading').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                console.log(msg);
                if (msg.code != 200) {
                    if (msg.code !== 201) {
                        if (msg.code !== 202) {
                            $('section.section-loading').unblock();
                            loading = false;
                            Swal.fire(
                                'Gagal!',
                                msg.message,
                                'warning'
                            );
                        } else {
                            Swal.fire(
                                'Warning!',
                                msg.message,
                                'warning'
                            ).then((valRes) => {
                                // setTimeout(function() {
                                document.location.href = msg.url;
                                // }, 2000);

                            })
                        }
                    } else {
                        Swal.fire(
                            'Berhasil!',
                            msg.message,
                            'success'
                        ).then((valRes) => {
                            // setTimeout(function() {
                            document.location.href = msg.url;
                            // }, 2000);
                        })
                    }
                } else {
                    Swal.fire(
                        'Berhasil!',
                        msg.message,
                        'success'
                    ).then((valRes) => {
                        // setTimeout(function() {
                        document.location.href = msg.url;
                        // }, 2000);
                        // document.location.href = window.location.href + "dashboard";
                    })
                }
            },
            error: function(data) {
                console.log(data);
                if (data.status === 200 && (data.statusText === "parsererror" || data.statusText === "OK")) {
                    // setTimeout(function() {
                    document.location.href = BASE_URL + '/dahboard';
                    // }, 2000);
                } else {
                    loading = false;
                    $('section.section-loading').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            }
        });

        e.preventDefault();
    });

    theme = 'grid-light';


    //Line Chart
    Highcharts.chart('line', {
        chart: {
            type: 'line'
        },
        title: {
            text: false
        },
        xAxis: {
            categories: [
                '', '', '', '', ''
            ]
        },
        yAxis: {
            title: {
                text: false
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Progres Pendaftar',
            data: [
                '0',
                '0',
                '0',
                '0',
                '0'
            ]
        }]
    });

    //Bar Chart
    Highcharts.chart('bar', {
        chart: {
            type: 'column'
        },
        title: {
            text: false
        },
        xAxis: {
            categories: ['Kab. Lampung Tengah'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: false,
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Siswa'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        legend: {
            enabled: true
        },
        credits: {
            enabled: true
        },
        series: [{
                name: 'Zonasi',
                color: 'rgba(13, 121, 182, 0.7)',
                data: [<?php if (isset($jumlah_kuota)) {
                            echo (int)$jumlah_kuota->pendaftar_zonasi_terverifikasi + (int)$jumlah_kuota->pendaftar_swasta_terverifikasi + (int)$jumlah_kuota->pendaftar_zonasi_antrian + (int)$jumlah_kuota->pendaftar_swasta_antrian;
                        ?>

                    <?php } else { ?>
                        0
                    <?php } ?>
                ]
            },
            {
                name: 'Afirmasi',
                color: 'rgb(247, 163, 92)',
                data: [<?php if (isset($jumlah_kuota)) {
                            echo (int)$jumlah_kuota->pendaftar_afirmasi_terverifikasi + (int)$jumlah_kuota->pendaftar_afirmasi_antrian;
                        ?>

                    <?php } else { ?>
                        0
                    <?php } ?>
                ]
            },
            {
                name: 'Mutasi',
                color: 'rgba(215, 44, 44, 0.7)',
                data: [<?php if (isset($jumlah_kuota)) {
                            echo (int)$jumlah_kuota->pendaftar_mutasi_terverifikasi + (int)$jumlah_kuota->pendaftar_mutasi_antrian;
                        ?>

                    <?php } else { ?>
                        0
                    <?php } ?>
                ]
            },
            {
                name: 'Prestasi',
                color: 'rgba(41, 232, 44, 0.7)',
                data: [<?php if (isset($jumlah_kuota)) {
                            echo (int)$jumlah_kuota->pendaftar_prestasi_terverifikasi + (int)$jumlah_kuota->pendaftar_prestasi_antrian;
                        ?>

                    <?php } else { ?>
                        0
                    <?php } ?>
                ]
            }
        ]
    });

    //Pie Chart
    Highcharts.chart('pie', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: false
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Jumlah {point.y}'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Prosentase',
            colorByPoint: true,
            data: [{
                name: 'Zonasi',
                y: <?php if (isset($jumlah_kuota)) {
                        echo (int)$jumlah_kuota->pendaftar_zonasi_terverifikasi + (int)$jumlah_kuota->pendaftar_swasta_terverifikasi + (int)$jumlah_kuota->pendaftar_zonasi_antrian + (int)$jumlah_kuota->pendaftar_swasta_antrian;
                    ?>

            <?php } else { ?>
                0
            <?php } ?>
            }, {
                name: 'Afirmasi',
                y: <?php if (isset($jumlah_kuota)) {
                        echo (int)$jumlah_kuota->pendaftar_afirmasi_terverifikasi + (int)$jumlah_kuota->pendaftar_afirmasi_antrian;
                    ?>

            <?php } else { ?>
                0
            <?php } ?>
            }, {
                name: 'Perpindahan Tugas Orang Tua',
                y: <?php if (isset($jumlah_kuota)) {
                        echo (int)$jumlah_kuota->pendaftar_mutasi_terverifikasi + (int)$jumlah_kuota->pendaftar_mutasi_antrian;
                    ?>

            <?php } else { ?>
                0
            <?php } ?>
            }, {
                name: 'Prestasi',
                y: <?php if (isset($jumlah_kuota)) {
                        echo (int)$jumlah_kuota->pendaftar_prestasi_terverifikasi + (int)$jumlah_kuota->pendaftar_prestasi_antrian;
                    ?>

            <?php } else { ?>
                0
            <?php } ?>
            }, ]
        }]
    });

    //Gauge Chart
    Highcharts.chart('gauge', {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: false
        },
        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {}, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        yAxis: {
            min: 0,
            max: 100,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: '%'
            },
            plotBands: [{
                from: 90,
                to: 100,
                color: '#55BF3B' // green
            }, {
                from: 30,
                to: 90,
                color: '#DDDF0D' // yellow
            }, {
                from: 0,
                to: 30,
                color: '#DF5353' // red
            }]
        },
        series: [{
            name: 'Progres Penerimaan',
            data: [
                <?php if (isset($jumlah_kuota)) {
                    $jumlahKuota = (int)$jumlah_kuota->zonasi + (int)$jumlah_kuota->afirmasi + (int)$jumlah_kuota->mutasi + (int)$jumlah_kuota->prestasi;
                    $jumlahPendaftar = (int)$jumlah_kuota->pendaftar_zonasi_terverifikasi + (int)$jumlah_kuota->pendaftar_afirmasi_terverifikasi + (int)$jumlah_kuota->pendaftar_mutasi_terverifikasi + (int)$jumlah_kuota->pendaftar_prestasi_terverifikasi + (int)$jumlah_kuota->pendaftar_swasta_terverifikasi + (int)$jumlah_kuota->pendaftar_zonasi_antrian + (int)$jumlah_kuota->pendaftar_afirmasi_antrian + (int)$jumlah_kuota->pendaftar_mutasi_antrian + (int)$jumlah_kuota->pendaftar_prestasi_antrian + (int)$jumlah_kuota->pendaftar_swasta_antrian;
                    echo $jumlahPendaftar > 0 ? round(($jumlahPendaftar / $jumlahKuota) * 100, 2) : 0;
                ?>

                <?php } else { ?>
                    0
                <?php } ?>
            ],
            tooltip: {
                valueSuffix: ''
            }
        }]
    });

    function openActionAlur(event) {
        console.log(event);
        document.getElementById(event).scrollIntoView({
            behavior: 'smooth'
        });
    }

    function openAction(event) {
        $('#offcanvas-modal').modal('hide');
        window.location.hash = event;
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/DataTables/datatables.css" type="text/css">
<style>
    @media screen and (min-width: 992px) {
        .hero-content {
            min-height: 440px;
        }
    }

    span.select2-selection__rendered {
        padding-top: 8px;
    }

    span.select2-selection__arrow {
        top: 8px !important;
    }
</style>

<?= $this->endSection(); ?>