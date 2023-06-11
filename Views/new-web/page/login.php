<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<header class="main-header style-four">
    <div class="outer-container">
        <div class="container">
            <div class="main-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="<?= base_url() ?>"><img src="<?= base_url('uploads/logo.png') ?>" alt=""></a></figure>
                </div>
                <div class="menu-area pull-right clearfix">
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="dropdown"><a href="#">Sekolah</a>
                                    <ul>
                                        <li class="dropdown"><a href="#">SD</a>
                                            <ul>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=5' ?>">Kec. Padang Cermin</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120902&j=5' ?>">Kec. Punduh Pedada</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120903&j=5' ?>">Kec. Kedondong</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120904&j=5' ?>">Kec. Way Lima</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120905&j=5' ?>">Kec. Gedung Tataan</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120906&j=5' ?>">Kec. Negeri Katon</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120907&j=5' ?>">Kec. Tegineneng</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120908&j=5' ?>">Kec. Marga Punduh</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120909&j=5' ?>">Kec. Way Khilau</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=5' ?>">Kec. Teluk Pandan</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=5' ?>">Kec. Way Ratai</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown"><a href="#">SMP</a>
                                            <ul>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=6' ?>">Kec. Padang Cermin</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120902&j=6' ?>">Kec. Punduh Pedada</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120903&j=6' ?>">Kec. Kedondong</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120904&j=6' ?>">Kec. Way Lima</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120905&j=6' ?>">Kec. Gedung Tataan</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120906&j=6' ?>">Kec. Negeri Katon</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120907&j=6' ?>">Kec. Tegineneng</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120908&j=6' ?>">Kec. Marga Punduh</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120909&j=6' ?>">Kec. Way Khilau</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=6' ?>">Kec. Teluk Pandan</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=6' ?>">Kec. Way Ratai</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="<?= base_url('web/jadwal') ?>">Jadwal</a></li>
                                <li><a href="<?= base_url('web/statistik') ?>">Statistik</a></li>
                                <li class="dropdown">
                                    <a href="#">Informasi</a>
                                    <ul>
                                        <li><a href="<?= base_url('web/profilsekolah') ?>">Profil Sekolah</a></li>
                                        <li><a href="<?= base_url('web/kuota') ?>">Kuota Sekolah</a></li>
                                        <li><a href="<?= base_url('web/zona') ?>">Zona Wilayah</a></li>
                                        <li><a href="<?= base_url('web/pengumuman') ?>">Pengumuman</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-header">
        <div class="container clearfix">
            <figure class="logo-box"><a href="<?= base_url() ?>"><img src="<?= base_url('themes') ?>/images/small-logo.png" alt=""></a></figure>
            <div class="menu-area">
                <nav class="main-menu clearfix">
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="<?= base_url() ?>"><img src="<?= base_url('uploads/logo.png') ?>" alt="" title=""></a></div>
        <div class="menu-outer"></div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>Komplek Pemerintah, Jl. Kedondong - Gedung Tataan</li>
                <li><a href="tel:+6282111837685">+62821-1183-7685</a></li>
                <li><a href="mailto:pesawaran.ppdb@kntechline.com">pesawaran.ppdb@kntechline.com</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                <li><a href="#"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div>
<section class="donate-section elements">
    <div class="container">
        <h2 style="color: #fff;">PPDB ONLINE TP. 2023 - 2024</h2>
        <h6 style="margin-bottom: 20px; color: #fff;background: rgb(255 255 255 / 19%);padding: 15px 20px; border-radius: 20px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);"><span>Untuk Login Panitia Sekolah, silahkan login menggunakan email dan password yang sudah didaftarkan pada layanan.</span></h6>
        <div id="content_block_51">
            <div class="content-box">
                <div class="donation-box wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 300ms; animation-name: fadeInUp;">
                    <div class="select-box">
                        <div class="form-group">
                            <p style="color: #fff;">NISN / NIK</p>
                            <input style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" type="text" name="_username" id="_username" placeholder="">
                        </div>
                        <div class="form-group">
                            <p style="color: #fff;">Password</p>
                            <input style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" type="password" name="_password" id="_password" placeholder="">
                            <p style="color: #fff;">Lupa password? <a style="color: #00fff2" href="<?= base_url('auth/lupapassword') ?>">Reset</a></p>
                        </div>
                    </div>
                    <div class="btn-box">
                        <button onclick="submitLoginButton(this)" class="donate-box-btn _submit_login_button" id="_submit_login_button">MASUK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="main-footer style-five style-six style-seven">
    <div class="container">
        <div class="footer-top">
            <div class="widget-section">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="about-widget footer-widget">
                            <figure class="footer-logo"><a href="index.html"><img src="images/footer-logo-2.png" alt=""></a></figure>
                            <div class="text">Lorem ipsum dolor sit consectetur adipisicing elit, sed do eiusmod tempor .........</div>
                            <div class="apps-download">
                                <h3>Download the App</h3>
                                <div class="download-btn">
                                    <a href="#" class="app-store-btn">
                                        <i class="fab fa-apple"></i>
                                        <span>Download on the</span>
                                        App Store
                                    </a>
                                    <a href="#" class="google-play-btn">
                                        <i class="fab fa-android"></i>
                                        <span>Get on it</span>
                                        Google Play
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget">
                            <h4 class="widget-title">Services</h4>
                            <div class="widget-content">
                                <ul class="list clearfix">
                                    <li><a href="#">Business Dashboards</a></li>
                                    <li><a href="#">Sales Analytics</a></li>
                                    <li><a href="#">Digital Marketing</a></li>
                                    <li><a href="#">Financial Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="contact-widget footer-widget">
                            <h4 class="widget-title">Contact Us</h4>
                            <div class="widget-content">
                                <ul class="contact-info clearfix">
                                    <li><i class="fas fa-map-marker-alt"></i> 25 Bedford St. New York City.</li>
                                    <li><i class="fas fa-phone"></i><a href="tel:0665184575181">(+066) 518 - 457 - 5181</a></li>
                                    <li><i class="fas fa-envelope"></i><a href="mailto:info@example.com">info@example.com</a></li>
                                </ul>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-skype"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget">
                            <h4 class="widget-title">About Company</h4>
                            <div class="widget-content">
                                <ul class="list clearfix">
                                    <li><a href="#">Appway Online</a></li>
                                    <li><a href="#">Our Leadership</a></li>
                                    <li><a href="#">Carrers</a></li>
                                    <li><a href="#">What We Do</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom clearfix">
            <ul class="footer-nav pull-right">
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Legal</a></li>
            </ul>
        </div>
    </div>
    <div class="copyright">&copy; 2020 <a href="#">appway</a>. All rights reserved</div>
</footer>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>