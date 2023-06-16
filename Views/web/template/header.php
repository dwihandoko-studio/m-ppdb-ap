<?php $uri = current_url(true);
$uriMain = "home";
$totalSegment = $uri->getTotalSegments();
if ($totalSegment > 0) {
    $uriMain = $uri->getSegment(2);
}
?>
<!-- Modal -->
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
                        <a href="<?= ($uriMain == "home") ? 'javascript:openAction(\'home\')' : base_url() ?>">Beranda</a>
                        <!-- add your sub menu here -->
                    </li>
                    <li>
                        <a href="<?= ($uriMain == "home") ? 'javascript:openAction(\'alur-pendaftaran\')' : base_url() ?>">Alur Pendaftaran</a>
                    </li>
                    <li>
                        <a href="<?= ($uriMain == "home") ? 'javascript:openAction(\'content-pengumuman\')' : base_url() ?>">Pengumuman</a>
                    </li>
                    <li>
                        <a href="<?= ($uriMain == "home") ? 'javascript:openAction(\'kuota-sekolah\')' : base_url() ?>">Referensi Sekolah</a>
                    </li>
                    <li>
                        <a href="<?= ($uriMain == "home") ? 'javascript:openAction(\'content-rekapitulasi\')' : base_url() ?>">Rekapitulasi</a>
                    </li>

                </ul>

                <!-- <div class="offcanvas-social">
                    <ul>
                        <li>
                            <a href="#"><i class="icofont-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icofont-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icofont-skype"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icofont-linkedin"></i></a>
                        </li>
                    </ul>
                </div> -->
            </nav>
            <!-- offcanvas-menu end -->

            <p class="text-gradient mt-3">PPDB KABUPATEN LAMPUNG TIMUR</p>
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
                    <p class="d-flex flex-wrap align-items-center text-gradient"><span class="hr-border d-none d-xl-block"></span>PPDB KABUPATEN LAMPUNG TIMUR</p>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <ul class="select-box d-flex flex-wrap align-items-center justify-content-center justify-content-md-end">
                        <li class="select-item"><a target="_blank" href="https://wa.me/+62123456789">CS PPDB: 0812 xxxx xxxx</a></li>
                        <!-- <li class="select-item">
                            <select class="form-select w-auto">
                                <option selected>English</option>
                                <option value="1">Français</option>
                                <option value="2">English</option>
                                <option value="3">Français</option>
                            </select>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="active-sticky" class="header-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <a href="<?= ($uriMain == "home") ? '#home' : base_url() ?>" class="brand-logo">
                        <img src="<?= base_url('template/pringo') ?>/assets/images/logo/logo.png" alt="brand logo" />
                    </a>
                </div>
                <div class="col-auto">
                    <a class="btn btn-warning btn-hover-warning d-none d-sm-inline-block d-lg-none" href="blog-details.html">Analyze Your Site <i class="icofont-arrow-right"></i>
                    </a>

                    <button type="button" class="btn btn-warning offcanvas-toggler" data-bs-toggle="modal" data-bs-target="#offcanvas-modal">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </button>

                    <nav class="d-none d-lg-block">
                        <ul class="main-menu text-end">
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= ($uriMain == "home") ? '#home' : base_url() ?>">Beranda</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= ($uriMain == "home") ? '#alur-pendaftaran' : base_url() ?>">Alur Pendaftaran</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= ($uriMain == "home") ? '#content-pengumuman' : base_url() ?>">Pengumuman</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= ($uriMain == "home") ? '#kuota-sekolah' : base_url() ?>">
                                    Referensi Sekolah</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= ($uriMain == "home") ? '#content-rekapitulasi' : base_url() ?>">Rekapitulasi</a>
                            </li>

                            <!-- <li class="main-menu-item">
                                    <a class="btn btn-warning btn-hover-warning btn-lg" href="#">Analyze Your Site <i
                                            class="icofont-arrow-right"></i>
                                    </a>
                                </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>