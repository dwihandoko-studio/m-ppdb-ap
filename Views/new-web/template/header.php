<header class="main-header style-two">
    <div class="outer-container">
        <div class="container">
            <div class="main-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="index.html"><img src="<?= base_url('uploads/logo.png') ?>" alt=""></a></figure>
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
                                            <ul class="megamenu clearfix">
                                                <h5 style="padding-left: 10px; font-size: 16px;">Kec. Gedung Tataan</h5>
                                                <li><a href="team.html">Team 01</a></li>
                                                <li><a href="team-2.html">Team 02</a></li>
                                                <li><a href="team-3.html">Team 03</a></li>
                                                <h5 style="padding-left: 10px; font-size: 16px;">Zona 2</h5>
                                                <li><a href="team.html">Team 01</a></li>
                                                <li><a href="team-2.html">Team 02</a></li>
                                                <li><a href="team-3.html">Team 03</a></li>
                                                <h5 style="padding-left: 10px; font-size: 16px;">Zona 3</h5>
                                                <li><a href="team.html">Team 01</a></li>
                                                <li><a href="team-2.html">Team 02</a></li>
                                                <li><a href="team-3.html">Team 03</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown"><a href="#">SMP</a>
                                            <ul class="megamenu clearfix">
                                                <h5 style="padding-left: 10px; font-size: 16px;">Zona 1</h5>
                                                <li><a href="team.html">Team 01</a></li>
                                                <li><a href="team-2.html">Team 02</a></li>
                                                <li><a href="team-3.html">Team 03</a></li>
                                                <h5 style="padding-left: 10px; font-size: 16px;">Zona 2</h5>
                                                <li><a href="team.html">Team 01</a></li>
                                                <li><a href="team-2.html">Team 02</a></li>
                                                <li><a href="team-3.html">Team 03</a></li>
                                                <h5 style="padding-left: 10px; font-size: 16px;">Zona 3</h5>
                                                <li><a href="team.html">Team 01</a></li>
                                                <li><a href="team-2.html">Team 02</a></li>
                                                <li><a href="team-3.html">Team 03</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="<?= base_url('web/jadwal') ?>">Jadwal</a></li>
                                <li><a href="<?= base_url('web/statistik') ?>">Statistik</a></li>
                                <li><a href="<?= base_url('web/pengumuman') ?>">Pengumuman</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="btn-box"><a href="#" style="padding: 10px 18px;">Login</a></div>
                    <div class="btn-box" style="margin-left: 10px;"><a href="#" style="background: #feff59; padding: 10px 18px;">Registrasi Akun</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-header">
        <div class="container clearfix">
            <figure class="logo-box"><a href="index.html"><img src="<?= base_url('themes') ?>/images/small-logo.png" alt=""></a></figure>
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
        <div class="nav-logo"><a href="index.html"><img src="<?= base_url('uploads/logo.png') ?>" alt="" title=""></a></div>
        <div class="menu-outer">
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>Chicago 12, Melborne City, USA</li>
                <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                <li><a href="mailto:info@example.com">info@example.com</a></li>
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