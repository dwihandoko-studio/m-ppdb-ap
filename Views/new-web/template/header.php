<header class="main-header style-two">
    <div class="outer-container">
        <div class="container">
            <div class="main-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="<?= base_url() ?>"><img src="<?= base_url('uploads/logo.webp') ?>" alt=""></a></figure>
                </div>
                <div class="menu-area pull-right clearfix">
                    <!--Mobile Navigation Toggler-->
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
                    <div class="btn-box _login_button"><a href="<?= base_url('web/login') ?>" style="padding: 10px 18px;">Login</a></div>
                    <!-- <div class="btn-box _login_button"><a href="javascript:actionLoginButton(this);" style="padding: 10px 18px;">Login</a></div> -->
                    <div class="btn-box _register_button" style="margin-left: 10px;"><a href="<?= base_url('web/register') ?>" style="background: #feff59; padding: 10px 18px;">Registrasi Akun</a></div>
                    <!-- <div class="btn-box _register_button" style="margin-left: 10px;"><a href="javascript:actionRegisterButton(this);" style="background: #feff59; padding: 10px 18px;">Registrasi Akun</a></div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-header">
        <div class="container clearfix">
            <figure class="logo-box"><a href="<?= base_url() ?>"><img src="<?= base_url('themes') ?>/images/small-logo.webp" alt=""></a></figure>
            <div class="menu-area">
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="<?= base_url() ?>"><img src="<?= base_url('uploads/logo.webp') ?>" alt="" title=""></a></div>
        <div class="menu-outer">
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="content-box" style="margin-top: 20px; margin-bottom: 5px;">
            <a href="<?= base_url('web/login') ?>" class="theme-btn-two" style="margin-left: 15px; padding: 5px 18px;">Login</a>
            <!-- <a href="javascript:actionLoginButtonMobile(this);" class="theme-btn-two" style="margin-left: 15px; padding: 5px 18px;">Login</a> -->
            <a href="<?= base_url('web/register') ?>" class="theme-btn-two" style="padding: 5px 18px;">Registrasi Akun</a>
            <!-- <a href="javascript:actionRegisterButtonMobile(this);" class="theme-btn-two" style="padding: 5px 18px;">Registrasi Akun</a> -->
        </div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>Jl. Buay Selagai Kompleks Perkantoran Pemda Lampung Timur, Sukadana</li>
                <li><a href="tel:082185581129">082185581129</a></li>
                <!-- <li><a href="mailto:lamtim.ppdb@kntechline.com">lamtim.ppdb@kntechline.com</a></li> -->
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
<!-- End Mobile Menu -->