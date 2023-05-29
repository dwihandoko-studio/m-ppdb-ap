<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<main class="main-content fix">
    <div class="noise-bg" data-background="<?= base_url('themes') ?>/img/bg/noise_bg.png"></div>
    <div class="main-shape" data-background="<?= base_url('themes') ?>/img/images/main_shape.png"></div>

    <section class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-content ta-animated-headline">
                        <h2 class="title ah-headline wow fadeInUp" data-wow-delay=".2s"><span>Penerimaan Peserta Didik Baru</span>
                            <span class="ah-words-wrapper">
                                <b class="is-visible">Dinas Pendidikan Dan Kebudayaan</b>
                                <b>Kabupaten Pesawaran</b>
                                <b>Tahun Pelajaran 2023/2024</b>
                            </span>
                        </h2>
                        <h2 class="title d-none wow fadeInUp" data-wow-delay=".2s">Penerimaan Peserta Didik Baru <span>Dinas Pendidikan dan Kebudayaan</span> <span>Kabupaten Pesawaran</span> <span>Tahun Pelajaran 2023/2024</span></h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Webiste ini digunakan sebagai pusat informasi dan pengolahan seleksi data peserta didik Dinas Pendidikan dan Kebudayaan Kabupaten Pesawaran Tahun Pelajaran 2023/2024 secara online dan realtime.</p>
                        <div class="banner-btn">
                            <a href="<?= base_url('auth') ?>" class="gradient-btn wow fadeInLeft" data-wow-delay=".6s">Login</a>
                            <a href="<?= base_url('auth/signup') ?>" class="gradient-btn gradient-btn-two wow fadeInRight" data-wow-delay=".6s">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="roadmap-area pt-140 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-70">
                        <h2 class="title title-animation">How it <span>works</span></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-9">
                    <div class="roadmap-timeline-wrap">
                        <div class="roadmap-line" data-background="<?= base_url('themes') ?>/img/brand/Line.svg"></div>
                        <ul class="list-wrap">
                            <li>
                                <div class="roadmap-item">
                                    <div class="roadmap-img wow fadeInLeft" data-wow-delay=".2s">
                                        <img src="<?= base_url('themes') ?>/img/images/roadmap_img01.png" alt="">
                                        <span class="number">01</span>
                                    </div>
                                    <div class="roadmap-content wow fadeInRight" data-wow-delay=".2s">
                                        <h4 class="title">Selecting an AI tool</h4>
                                        <p>Choose from a variety of AI tools to write social media ads, hero sections, blog posts...</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="roadmap-item">
                                    <div class="roadmap-img wow fadeInRight" data-wow-delay=".2s">
                                        <img src="<?= base_url('themes') ?>/img/images/roadmap_img02.png" alt="">
                                        <span class="number">02</span>
                                    </div>
                                    <div class="roadmap-content wow fadeInLeft" data-wow-delay=".2s">
                                        <h4 class="title">Write your keywords</h4>
                                        <p>Explain to the AI ​​what you want to write. The more details, the better output.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="roadmap-item">
                                    <div class="roadmap-img wow fadeInLeft" data-wow-delay=".2s">
                                        <img src="<?= base_url('themes') ?>/img/images/roadmap_img03.png" alt="">
                                        <span class="number">03</span>
                                    </div>
                                    <div class="roadmap-content wow fadeInRight" data-wow-delay=".2s">
                                        <h4 class="title">Let's the AI do its magic</h4>
                                        <p>Our highly trained AI understands your details and generate unique and human-like content in seconds.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- video-area -->
    <div class="video-area">
        <div class="video-shape">
            <svg height="1192" viewBox="0 0 1920 1192" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path stroke="url(#paint0_linear_2840_46)" stroke-width="7" stroke-dasharray="10 10" d="M-40.9996 902C-8.39405 961.001 87.0357 1262.13 234 1171.5C385.21 1078.25 424.961 618.039 479.564 680.288C534.166 742.538 625.164 842.979 735.172 706.451C845.181 569.923 839.697 412.37 1093.03 631.043C1346.36 849.717 1371.47 413.985 1477.97 274.534C1584.48 135.083 1738.61 381.41 1830.32 343.155C1922.04 304.9 1862.93 -74.0337 2236.96 18.2495" />
                <defs>
                    <linearGradient id="paint0_linear_2840_46" x1="2117.79" y1="34.1404" x2="83.2194" y2="768.35" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="rgba(200 189 255)" />
                        <stop offset="0.13824" stop-color="#BAA6FF" />
                        <stop offset="0.337481" stop-color="#6721FF" />
                        <stop offset="0.900573" stop-color="#180048" />
                        <stop offset="1" stop-color="#00CBFF" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video-wrap">
                        <video class="live-video" loop autoplay muted>
                            <source src="<?= base_url('themes') ?>/videos/video_01.mp4" type="video/mp4">
                            <source src="<?= base_url('themes') ?>/videos/video_01.ogg" type="video/ogg">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- video-area-end -->

    <!-- counter-area -->
    <section class="counter-area pt-150 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="counter-item">
                        <h2 class="count">3DAYS</h2>
                        <p>Average Saved / Week</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="counter-item">
                        <h2 class="count">$400000</h2>
                        <p>Trained AI Model</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="counter-item">
                        <h2 class="count">480+</h2>
                        <p>Powerful AI Business Tools</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- counter-area-end -->

    <!-- writing-area -->
    <section class="writing-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-80">
                        <h2 class="title title-animation">Start writing <span>10x faster</span> with AI</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-9">
                    <div class="writing-item">
                        <div class="writing-shape">
                            <svg viewBox="0 0 417 207" fill="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" preserveAspectRatio="none">
                                <g opacity="0.1">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 96C0 82 7.5 73 26.2229 76.38C43.8225 79.5573 73.5 62.5 65 34C58.0931 10.8417 68.4854 0.0152226 90.4536 0H387C403.569 0 417 13.4315 417 30V177C417 193.569 403.569 207 387 207H30C13.4315 207 0 193.569 0 177V96Z" fill="currentcolor" />
                                    <path d="M26.2229 76.38L26.0452 77.3641L26.0452 77.3641L26.2229 76.38ZM65 34L64.0417 34.2858L65 34ZM90.4536 0L90.4536 -1L90.4529 -1L90.4536 0ZM26.4005 75.3959C16.8849 73.6781 9.9765 75.0628 5.4433 78.9101C0.915622 82.7526 -1 88.8465 -1 96H1C1 89.1535 2.83438 83.7474 6.73743 80.4349C10.6349 77.1272 16.838 75.7019 26.0452 77.3641L26.4005 75.3959ZM64.0417 34.2858C68.1618 48.1001 63.0533 59.0984 54.7432 66.3139C46.3758 73.5791 34.8545 76.9221 26.4005 75.3959L26.0452 77.3641C35.1909 79.0152 47.3082 75.4182 56.0544 67.8241C64.858 60.1802 70.3382 48.3998 65.9583 33.7142L64.0417 34.2858ZM90.4529 -1C79.3517 -0.992307 70.8799 1.74143 66.1176 7.69682C61.3388 13.673 60.5475 22.57 64.0417 34.2858L65.9583 33.7142C62.5456 22.2717 63.4971 14.1764 67.6796 8.94589C71.8788 3.69466 79.5873 1.00753 90.4543 1L90.4529 -1ZM90.4536 1H387V-1H90.4536V1ZM387 1C403.016 1 416 13.9837 416 30H418C418 12.8792 404.121 -1 387 -1V1ZM416 30V177H418V30H416ZM416 177C416 193.016 403.016 206 387 206V208C404.121 208 418 194.121 418 177H416ZM387 206H30V208H387V206ZM30 206C13.9837 206 1 193.016 1 177H-1C-1 194.121 12.8792 208 30 208V206ZM1 177V96H-1V177H1Z" fill="currentcolor" />
                                </g>
                            </svg>
                        </div>
                        <div class="writing-icon">
                            <i class="far fa-brain"></i>
                        </div>
                        <div class="writing-content">
                            <h4 class="title">The GPT-3.5 language</h4>
                            <p>Unlike anything you've experienced - unique and unimaginable capabilities.</p>
                            <a href="work.html" class="link-btn">Try Gpt-3.5 language<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-9">
                    <div class="writing-item">
                        <div class="writing-shape">
                            <svg viewBox="0 0 417 207" fill="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" preserveAspectRatio="none">
                                <g opacity="0.1">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 96C0 82 7.5 73 26.2229 76.38C43.8225 79.5573 73.5 62.5 65 34C58.0931 10.8417 68.4854 0.0152226 90.4536 0H387C403.569 0 417 13.4315 417 30V177C417 193.569 403.569 207 387 207H30C13.4315 207 0 193.569 0 177V96Z" fill="currentcolor" />
                                    <path d="M26.2229 76.38L26.0452 77.3641L26.0452 77.3641L26.2229 76.38ZM65 34L64.0417 34.2858L65 34ZM90.4536 0L90.4536 -1L90.4529 -1L90.4536 0ZM26.4005 75.3959C16.8849 73.6781 9.9765 75.0628 5.4433 78.9101C0.915622 82.7526 -1 88.8465 -1 96H1C1 89.1535 2.83438 83.7474 6.73743 80.4349C10.6349 77.1272 16.838 75.7019 26.0452 77.3641L26.4005 75.3959ZM64.0417 34.2858C68.1618 48.1001 63.0533 59.0984 54.7432 66.3139C46.3758 73.5791 34.8545 76.9221 26.4005 75.3959L26.0452 77.3641C35.1909 79.0152 47.3082 75.4182 56.0544 67.8241C64.858 60.1802 70.3382 48.3998 65.9583 33.7142L64.0417 34.2858ZM90.4529 -1C79.3517 -0.992307 70.8799 1.74143 66.1176 7.69682C61.3388 13.673 60.5475 22.57 64.0417 34.2858L65.9583 33.7142C62.5456 22.2717 63.4971 14.1764 67.6796 8.94589C71.8788 3.69466 79.5873 1.00753 90.4543 1L90.4529 -1ZM90.4536 1H387V-1H90.4536V1ZM387 1C403.016 1 416 13.9837 416 30H418C418 12.8792 404.121 -1 387 -1V1ZM416 30V177H418V30H416ZM416 177C416 193.016 403.016 206 387 206V208C404.121 208 418 194.121 418 177H416ZM387 206H30V208H387V206ZM30 206C13.9837 206 1 193.016 1 177H-1C-1 194.121 12.8792 208 30 208V206ZM1 177V96H-1V177H1Z" fill="currentcolor" />
                                </g>
                            </svg>
                        </div>
                        <div class="writing-icon">
                            <i class="far fa-chart-line"></i>
                        </div>
                        <div class="writing-content">
                            <h4 class="title">Grow with the use of AI</h4>
                            <p>Unlike anything you've experienced - unique and unimaginable capabilities.</p>
                            <a href="work.html" class="link-btn">Try use of AI<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-9">
                    <div class="writing-item">
                        <div class="writing-shape">
                            <svg viewBox="0 0 417 207" fill="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" preserveAspectRatio="none">
                                <g opacity="0.1">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 96C0 82 7.5 73 26.2229 76.38C43.8225 79.5573 73.5 62.5 65 34C58.0931 10.8417 68.4854 0.0152226 90.4536 0H387C403.569 0 417 13.4315 417 30V177C417 193.569 403.569 207 387 207H30C13.4315 207 0 193.569 0 177V96Z" fill="currentcolor" />
                                    <path d="M26.2229 76.38L26.0452 77.3641L26.0452 77.3641L26.2229 76.38ZM65 34L64.0417 34.2858L65 34ZM90.4536 0L90.4536 -1L90.4529 -1L90.4536 0ZM26.4005 75.3959C16.8849 73.6781 9.9765 75.0628 5.4433 78.9101C0.915622 82.7526 -1 88.8465 -1 96H1C1 89.1535 2.83438 83.7474 6.73743 80.4349C10.6349 77.1272 16.838 75.7019 26.0452 77.3641L26.4005 75.3959ZM64.0417 34.2858C68.1618 48.1001 63.0533 59.0984 54.7432 66.3139C46.3758 73.5791 34.8545 76.9221 26.4005 75.3959L26.0452 77.3641C35.1909 79.0152 47.3082 75.4182 56.0544 67.8241C64.858 60.1802 70.3382 48.3998 65.9583 33.7142L64.0417 34.2858ZM90.4529 -1C79.3517 -0.992307 70.8799 1.74143 66.1176 7.69682C61.3388 13.673 60.5475 22.57 64.0417 34.2858L65.9583 33.7142C62.5456 22.2717 63.4971 14.1764 67.6796 8.94589C71.8788 3.69466 79.5873 1.00753 90.4543 1L90.4529 -1ZM90.4536 1H387V-1H90.4536V1ZM387 1C403.016 1 416 13.9837 416 30H418C418 12.8792 404.121 -1 387 -1V1ZM416 30V177H418V30H416ZM416 177C416 193.016 403.016 206 387 206V208C404.121 208 418 194.121 418 177H416ZM387 206H30V208H387V206ZM30 206C13.9837 206 1 193.016 1 177H-1C-1 194.121 12.8792 208 30 208V206ZM1 177V96H-1V177H1Z" fill="currentcolor" />
                                </g>
                            </svg>
                        </div>
                        <div class="writing-icon">
                            <i class="fal fa-lightbulb-on"></i>
                        </div>
                        <div class="writing-content">
                            <h4 class="title">Optimized for conversions</h4>
                            <p>Unlike anything you've experienced - unique and unimaginable capabilities.</p>
                            <a href="work.html" class="link-btn">Try conversions<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-9">
                    <div class="writing-item">
                        <div class="writing-shape">
                            <svg viewBox="0 0 417 207" fill="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" preserveAspectRatio="none">
                                <g opacity="0.1">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 96C0 82 7.5 73 26.2229 76.38C43.8225 79.5573 73.5 62.5 65 34C58.0931 10.8417 68.4854 0.0152226 90.4536 0H387C403.569 0 417 13.4315 417 30V177C417 193.569 403.569 207 387 207H30C13.4315 207 0 193.569 0 177V96Z" fill="currentcolor" />
                                    <path d="M26.2229 76.38L26.0452 77.3641L26.0452 77.3641L26.2229 76.38ZM65 34L64.0417 34.2858L65 34ZM90.4536 0L90.4536 -1L90.4529 -1L90.4536 0ZM26.4005 75.3959C16.8849 73.6781 9.9765 75.0628 5.4433 78.9101C0.915622 82.7526 -1 88.8465 -1 96H1C1 89.1535 2.83438 83.7474 6.73743 80.4349C10.6349 77.1272 16.838 75.7019 26.0452 77.3641L26.4005 75.3959ZM64.0417 34.2858C68.1618 48.1001 63.0533 59.0984 54.7432 66.3139C46.3758 73.5791 34.8545 76.9221 26.4005 75.3959L26.0452 77.3641C35.1909 79.0152 47.3082 75.4182 56.0544 67.8241C64.858 60.1802 70.3382 48.3998 65.9583 33.7142L64.0417 34.2858ZM90.4529 -1C79.3517 -0.992307 70.8799 1.74143 66.1176 7.69682C61.3388 13.673 60.5475 22.57 64.0417 34.2858L65.9583 33.7142C62.5456 22.2717 63.4971 14.1764 67.6796 8.94589C71.8788 3.69466 79.5873 1.00753 90.4543 1L90.4529 -1ZM90.4536 1H387V-1H90.4536V1ZM387 1C403.016 1 416 13.9837 416 30H418C418 12.8792 404.121 -1 387 -1V1ZM416 30V177H418V30H416ZM416 177C416 193.016 403.016 206 387 206V208C404.121 208 418 194.121 418 177H416ZM387 206H30V208H387V206ZM30 206C13.9837 206 1 193.016 1 177H-1C-1 194.121 12.8792 208 30 208V206ZM1 177V96H-1V177H1Z" fill="currentcolor" />
                                </g>
                            </svg>
                        </div>
                        <div class="writing-icon">
                            <i class="fal fa-globe"></i>
                        </div>
                        <div class="writing-content">
                            <h4 class="title">Supports 26 languages</h4>
                            <p>Unlike anything you've experienced - unique and unimaginable capabilities.</p>
                            <a href="work.html" class="link-btn">Try supports languages<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-9">
                    <div class="writing-item">
                        <div class="writing-shape">
                            <svg viewBox="0 0 417 207" fill="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" preserveAspectRatio="none">
                                <g opacity="0.1">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 96C0 82 7.5 73 26.2229 76.38C43.8225 79.5573 73.5 62.5 65 34C58.0931 10.8417 68.4854 0.0152226 90.4536 0H387C403.569 0 417 13.4315 417 30V177C417 193.569 403.569 207 387 207H30C13.4315 207 0 193.569 0 177V96Z" fill="currentcolor" />
                                    <path d="M26.2229 76.38L26.0452 77.3641L26.0452 77.3641L26.2229 76.38ZM65 34L64.0417 34.2858L65 34ZM90.4536 0L90.4536 -1L90.4529 -1L90.4536 0ZM26.4005 75.3959C16.8849 73.6781 9.9765 75.0628 5.4433 78.9101C0.915622 82.7526 -1 88.8465 -1 96H1C1 89.1535 2.83438 83.7474 6.73743 80.4349C10.6349 77.1272 16.838 75.7019 26.0452 77.3641L26.4005 75.3959ZM64.0417 34.2858C68.1618 48.1001 63.0533 59.0984 54.7432 66.3139C46.3758 73.5791 34.8545 76.9221 26.4005 75.3959L26.0452 77.3641C35.1909 79.0152 47.3082 75.4182 56.0544 67.8241C64.858 60.1802 70.3382 48.3998 65.9583 33.7142L64.0417 34.2858ZM90.4529 -1C79.3517 -0.992307 70.8799 1.74143 66.1176 7.69682C61.3388 13.673 60.5475 22.57 64.0417 34.2858L65.9583 33.7142C62.5456 22.2717 63.4971 14.1764 67.6796 8.94589C71.8788 3.69466 79.5873 1.00753 90.4543 1L90.4529 -1ZM90.4536 1H387V-1H90.4536V1ZM387 1C403.016 1 416 13.9837 416 30H418C418 12.8792 404.121 -1 387 -1V1ZM416 30V177H418V30H416ZM416 177C416 193.016 403.016 206 387 206V208C404.121 208 418 194.121 418 177H416ZM387 206H30V208H387V206ZM30 206C13.9837 206 1 193.016 1 177H-1C-1 194.121 12.8792 208 30 208V206ZM1 177V96H-1V177H1Z" fill="currentcolor" />
                                </g>
                            </svg>
                        </div>
                        <div class="writing-icon">
                            <i class="fal fa-user-friends"></i>
                        </div>
                        <div class="writing-content">
                            <h4 class="title">Streamline collaboration</h4>
                            <p>Unlike anything you've experienced - unique and unimaginable capabilities.</p>
                            <a href="work.html" class="link-btn">Try streamline<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-9">
                    <div class="writing-item">
                        <div class="writing-shape">
                            <svg viewBox="0 0 417 207" fill="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" preserveAspectRatio="none">
                                <g opacity="0.1">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 96C0 82 7.5 73 26.2229 76.38C43.8225 79.5573 73.5 62.5 65 34C58.0931 10.8417 68.4854 0.0152226 90.4536 0H387C403.569 0 417 13.4315 417 30V177C417 193.569 403.569 207 387 207H30C13.4315 207 0 193.569 0 177V96Z" fill="currentcolor" />
                                    <path d="M26.2229 76.38L26.0452 77.3641L26.0452 77.3641L26.2229 76.38ZM65 34L64.0417 34.2858L65 34ZM90.4536 0L90.4536 -1L90.4529 -1L90.4536 0ZM26.4005 75.3959C16.8849 73.6781 9.9765 75.0628 5.4433 78.9101C0.915622 82.7526 -1 88.8465 -1 96H1C1 89.1535 2.83438 83.7474 6.73743 80.4349C10.6349 77.1272 16.838 75.7019 26.0452 77.3641L26.4005 75.3959ZM64.0417 34.2858C68.1618 48.1001 63.0533 59.0984 54.7432 66.3139C46.3758 73.5791 34.8545 76.9221 26.4005 75.3959L26.0452 77.3641C35.1909 79.0152 47.3082 75.4182 56.0544 67.8241C64.858 60.1802 70.3382 48.3998 65.9583 33.7142L64.0417 34.2858ZM90.4529 -1C79.3517 -0.992307 70.8799 1.74143 66.1176 7.69682C61.3388 13.673 60.5475 22.57 64.0417 34.2858L65.9583 33.7142C62.5456 22.2717 63.4971 14.1764 67.6796 8.94589C71.8788 3.69466 79.5873 1.00753 90.4543 1L90.4529 -1ZM90.4536 1H387V-1H90.4536V1ZM387 1C403.016 1 416 13.9837 416 30H418C418 12.8792 404.121 -1 387 -1V1ZM416 30V177H418V30H416ZM416 177C416 193.016 403.016 206 387 206V208C404.121 208 418 194.121 418 177H416ZM387 206H30V208H387V206ZM30 206C13.9837 206 1 193.016 1 177H-1C-1 194.121 12.8792 208 30 208V206ZM1 177V96H-1V177H1Z" fill="currentcolor" />
                                </g>
                            </svg>
                        </div>
                        <div class="writing-icon">
                            <i class="far fa-cog"></i>
                        </div>
                        <div class="writing-content">
                            <h4 class="title">Powerful settings</h4>
                            <p>Unlike anything you've experienced - unique and unimaginable capabilities.</p>
                            <a href="work.html" class="link-btn">Try powerful settings<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- writing-area-end -->

    <!-- use-cases-area -->
    <section class="use-cases-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="use-cases-content">
                        <div class="section-title mb-25">
                            <h2 class="title title-animation">AI Does it <span>faster</span> & better.</h2>
                        </div>
                        <p>Have a look at one of 60+ available tools included in your SinCode AI account. Just fill out the keywords and Marve will generate your next content for you.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="use-cases-nav-wrap">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="website-tab" data-bs-toggle="tab" data-bs-target="#website-tab-pane" type="button" role="tab" aria-controls="website-tab-pane" aria-selected="true">Website</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social-tab-pane" type="button" role="tab" aria-controls="social-tab-pane" aria-selected="false">Social Media</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email-tab-pane" type="button" role="tab" aria-controls="email-tab-pane" aria-selected="false">Emails</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="code-tab" data-bs-toggle="tab" data-bs-target="#code-tab-pane" type="button" role="tab" aria-controls="code-tab-pane" aria-selected="false">Code</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="art-tab" data-bs-toggle="tab" data-bs-target="#art-tab-pane" type="button" role="tab" aria-controls="art-tab-pane" aria-selected="false">Art</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="website-tab-pane" role="tabpanel" aria-labelledby="website-tab" tabindex="0">
                                <div class="cases-details-wrap">
                                    <div class="cases-details-img">
                                        <img src="<?= base_url('themes') ?>/img/images/cases_img01.png" alt="">
                                    </div>
                                    <div class="cases-details-content">
                                        <div class="icon">
                                            <i class="fas fa-home-alt"></i>
                                        </div>
                                        <p>Meta description: Unlock the power of AI to automate your business with Since AI. Our suite of AI-powered solutions can help streamline your operations and increase efficiency.</p>
                                        <div class="content-bottom">
                                            <ul class="list-wrap">
                                                <li><a href="#"><i class="far fa-copy"></i></a></li>
                                                <li><a href="#"><i class="fal fa-download"></i></a></li>
                                                <li><a href="#"><i class="fal fa-paste"></i></a></li>
                                                <li><a href="#"><i class="far fa-trash-alt"></i></a></li>
                                                <li><a href="#"><i class="fal fa-plus-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="social-tab-pane" role="tabpanel" aria-labelledby="social-tab" tabindex="0">
                                <div class="cases-details-wrap">
                                    <div class="cases-details-img">
                                        <img src="<?= base_url('themes') ?>/img/images/cases_img01.png" alt="">
                                    </div>
                                    <div class="cases-details-content">
                                        <div class="icon">
                                            <i class="fas fa-home-alt"></i>
                                        </div>
                                        <p>Meta description: Unlock the power of AI to automate your business with Since AI. Our suite of AI-powered solutions can help streamline your operations and increase efficiency.</p>
                                        <div class="content-bottom">
                                            <ul class="list-wrap">
                                                <li><a href="#"><i class="far fa-copy"></i></a></li>
                                                <li><a href="#"><i class="fal fa-download"></i></a></li>
                                                <li><a href="#"><i class="fal fa-paste"></i></a></li>
                                                <li><a href="#"><i class="far fa-trash-alt"></i></a></li>
                                                <li><a href="#"><i class="fal fa-plus-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="email-tab-pane" role="tabpanel" aria-labelledby="email-tab" tabindex="0">
                                <div class="cases-details-wrap">
                                    <div class="cases-details-img">
                                        <img src="<?= base_url('themes') ?>/img/images/cases_img01.png" alt="">
                                    </div>
                                    <div class="cases-details-content">
                                        <div class="icon">
                                            <i class="fas fa-home-alt"></i>
                                        </div>
                                        <p>Meta description: Unlock the power of AI to automate your business with Since AI. Our suite of AI-powered solutions can help streamline your operations and increase efficiency.</p>
                                        <div class="content-bottom">
                                            <ul class="list-wrap">
                                                <li><a href="#"><i class="far fa-copy"></i></a></li>
                                                <li><a href="#"><i class="fal fa-download"></i></a></li>
                                                <li><a href="#"><i class="fal fa-paste"></i></a></li>
                                                <li><a href="#"><i class="far fa-trash-alt"></i></a></li>
                                                <li><a href="#"><i class="fal fa-plus-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="code-tab-pane" role="tabpanel" aria-labelledby="code-tab" tabindex="0">
                                <div class="cases-details-wrap">
                                    <div class="cases-details-img">
                                        <img src="<?= base_url('themes') ?>/img/images/cases_img01.png" alt="">
                                    </div>
                                    <div class="cases-details-content">
                                        <div class="icon">
                                            <i class="fas fa-home-alt"></i>
                                        </div>
                                        <p>Meta description: Unlock the power of AI to automate your business with Since AI. Our suite of AI-powered solutions can help streamline your operations and increase efficiency.</p>
                                        <div class="content-bottom">
                                            <ul class="list-wrap">
                                                <li><a href="#"><i class="far fa-copy"></i></a></li>
                                                <li><a href="#"><i class="fal fa-download"></i></a></li>
                                                <li><a href="#"><i class="fal fa-paste"></i></a></li>
                                                <li><a href="#"><i class="far fa-trash-alt"></i></a></li>
                                                <li><a href="#"><i class="fal fa-plus-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="art-tab-pane" role="tabpanel" aria-labelledby="art-tab" tabindex="0">
                                <div class="cases-details-wrap">
                                    <div class="cases-details-img">
                                        <img src="<?= base_url('themes') ?>/img/images/cases_img01.png" alt="">
                                    </div>
                                    <div class="cases-details-content">
                                        <div class="icon">
                                            <i class="fas fa-home-alt"></i>
                                        </div>
                                        <p>Meta description: Unlock the power of AI to automate your business with Since AI. Our suite of AI-powered solutions can help streamline your operations and increase efficiency.</p>
                                        <div class="content-bottom">
                                            <ul class="list-wrap">
                                                <li><a href="#"><i class="far fa-copy"></i></a></li>
                                                <li><a href="#"><i class="fal fa-download"></i></a></li>
                                                <li><a href="#"><i class="fal fa-paste"></i></a></li>
                                                <li><a href="#"><i class="far fa-trash-alt"></i></a></li>
                                                <li><a href="#"><i class="fal fa-plus-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- use-cases-area-end -->
    <!-- pricing-area -->
    <section class="pricing-area pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-50">
                        <h2 class="title title-animation">Money well <span>invested</span></h2>
                    </div>
                </div>
            </div>
            <div class="pricing-item-wrap">
                <div class="pricing-billing-duration text-center">
                    <div class="pricing-tab">
                        <span class="tab-btn monthly_tab_title">Monthly</span>
                        <span class="pricing-tab-switcher"></span>
                        <span class="tab-btn annual_tab_title">Yearly</span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6 col-md-9 col-sm-10">
                        <div class="pricing-item wow fadeInLeft" data-wow-delay=".2s">
                            <div class="pricing-shape">
                                <svg viewBox="0 0 410 616" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M85.6497 0.634114C102.343 1.89097 115.705 2.89697 134 22.4989C134.632 23.176 135.238 23.8305 135.823 24.4624C145.21 34.5995 149.203 38.9119 168.5 37.4993C179.699 36.6795 228.167 37.1659 251 37.4993H251.001C262.001 37.4993 270.501 37.4993 289 16C301.111 1.92454 315.232 0.174842 333.448 0H380C396.569 0 410 13.4315 410 30V586C410 602.569 396.569 616 380 616H30C13.4315 616 0 602.569 0 586V30C0 13.4315 13.4315 0 30 0H78.0075C80.6454 0.257338 83.1839 0.448462 85.6497 0.634114Z" fill="currentcolor" />
                                </svg>
                            </div>
                            <div class="pricing-top">
                                <div class="left-side">
                                    <div class="icon">
                                        <img src="<?= base_url('themes') ?>/img/icon/pricing_icon.svg" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Basic</h4>
                                        <span>03 Services</span>
                                    </div>
                                </div>
                                <div class="pricing-price">
                                    <h2 class="title monthly_price">Free</h2>
                                    <h2 class="title annual_price">Free</h2>
                                </div>
                            </div>
                            <div class="pricing-list">
                                <ul class="list-wrap">
                                    <li>15 000 words/month</li>
                                    <li>Write in 10 languages</li>
                                    <li>Image generation (40/month)</li>
                                    <li class="delete">25+ languages</li>
                                    <li class="delete">Unlimited projects</li>
                                    <li class="delete">Unlimited Marvel Chat</li>
                                    <li class="delete">New experimental features</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="login.html" class="btn btn-two">choose plan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-9 col-sm-10">
                        <div class="pricing-item active wow fadeInUp" data-wow-delay=".5s">
                            <span class="popular">Most popular</span>
                            <div class="pricing-shape">
                                <svg viewBox="0 0 410 616" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M85.6497 0.634114C102.343 1.89097 115.705 2.89697 134 22.4989C134.632 23.176 135.238 23.8305 135.823 24.4624C145.21 34.5995 149.203 38.9119 168.5 37.4993C179.699 36.6795 228.167 37.1659 251 37.4993H251.001C262.001 37.4993 270.501 37.4993 289 16C301.111 1.92454 315.232 0.174842 333.448 0H380C396.569 0 410 13.4315 410 30V586C410 602.569 396.569 616 380 616H30C13.4315 616 0 602.569 0 586V30C0 13.4315 13.4315 0 30 0H78.0075C80.6454 0.257338 83.1839 0.448462 85.6497 0.634114Z" fill="url(#pricing)" />
                                    <defs>
                                        <linearGradient id="pricing" x1="-35.4999" y1="-46.5001" x2="393.384" y2="749.254" gradientUnits="userSpaceOnUse">
                                            <stop offset="0.0246007" stop-color="#C8BDFF" />
                                            <stop offset="0.0246007" stop-color="#BAA6FF" />
                                            <stop offset="0.214137" stop-color="#6721FF" />
                                            <stop offset="0.486687" stop-color="#6721FF" />
                                            <stop offset="1" stop-color="#00CBFF" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <div class="pricing-top">
                                <div class="left-side">
                                    <div class="icon">
                                        <img src="<?= base_url('themes') ?>/img/icon/pricing_icon.svg" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Standard</h4>
                                        <span>05 Services</span>
                                    </div>
                                </div>
                                <div class="pricing-price">
                                    <h2 class="title monthly_price">$39</h2>
                                    <h2 class="title annual_price">$299</h2>
                                </div>
                            </div>
                            <div class="pricing-list">
                                <ul class="list-wrap">
                                    <li>15 000 words/month</li>
                                    <li>Write in 10 languages</li>
                                    <li>Image generation (40/month)</li>
                                    <li>25+ languages</li>
                                    <li>Unlimited projects</li>
                                    <li class="delete">Unlimited Marvel Chat</li>
                                    <li class="delete">New experimental features</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="login.html" class="btn btn-two">choose plan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-9 col-sm-10">
                        <div class="pricing-item wow fadeInRight" data-wow-delay=".2s">
                            <div class="pricing-shape">
                                <svg viewBox="0 0 410 616" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M85.6497 0.634114C102.343 1.89097 115.705 2.89697 134 22.4989C134.632 23.176 135.238 23.8305 135.823 24.4624C145.21 34.5995 149.203 38.9119 168.5 37.4993C179.699 36.6795 228.167 37.1659 251 37.4993H251.001C262.001 37.4993 270.501 37.4993 289 16C301.111 1.92454 315.232 0.174842 333.448 0H380C396.569 0 410 13.4315 410 30V586C410 602.569 396.569 616 380 616H30C13.4315 616 0 602.569 0 586V30C0 13.4315 13.4315 0 30 0H78.0075C80.6454 0.257338 83.1839 0.448462 85.6497 0.634114Z" fill="currentcolor" />
                                </svg>
                            </div>
                            <div class="pricing-top">
                                <div class="left-side">
                                    <div class="icon">
                                        <img src="<?= base_url('themes') ?>/img/icon/pricing_icon.svg" alt="">
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Enterprise</h4>
                                        <span>07 Services</span>
                                    </div>
                                </div>
                                <div class="pricing-price">
                                    <h2 class="title monthly_price">$99</h2>
                                    <h2 class="title annual_price">$699</h2>
                                </div>
                            </div>
                            <div class="pricing-list">
                                <ul class="list-wrap">
                                    <li>15 000 words/month</li>
                                    <li>Write in 10 languages</li>
                                    <li>Image generation (40/month)</li>
                                    <li>25+ languages</li>
                                    <li>Unlimited projects</li>
                                    <li>Unlimited Marvel Chat</li>
                                    <li>New experimental features</li>
                                </ul>
                            </div>
                            <div class="pricing-btn">
                                <a href="login.html" class="btn btn-two">choose plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing-area-end -->

    <!-- tools-area -->
    <section class="tools-area pb-140">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-80">
                        <h2 class="title title-animation">60+ Powerful <span>Copywriting</span> Tools</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center row-cols-1 row-cols-xl-5 row-cols-lg-3 row-cols-md-3 row-cols-sm-2">
                <div class="col">
                    <div class="tools-item">
                        <div class="tools-shape">
                            <svg viewBox="0 0 242 142" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.1">
                                    <mask id="tools_1" fill="currentcolor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" />
                                    </mask>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" fill="currentcolor" />
                                    <path d="M26.223 76.38L26.0454 77.3641L26.223 76.38ZM65.0001 34L64.0419 34.2858L65.0001 34ZM90.4537 0V-1L90.453 -1L90.4537 0ZM0.00015229 29.9034H1.00015L-0.999843 29.9002L0.00015229 29.9034ZM26.4007 75.3959C16.885 73.6781 9.97666 75.0628 5.44345 78.9101C0.915774 82.7526 -0.999848 88.8465 -0.999848 96H1.00015C1.00015 89.1535 2.83453 83.7474 6.73758 80.4349C10.6351 77.1272 16.8382 75.7019 26.0454 77.3641L26.4007 75.3959ZM64.0419 34.2858C68.1619 48.1001 63.0535 59.0984 54.7433 66.3139C46.3759 73.5791 34.8547 76.9221 26.4007 75.3959L26.0454 77.3641C35.191 79.0152 47.3083 75.4182 56.0546 67.8241C64.8581 60.1802 70.3384 48.3998 65.9584 33.7142L64.0419 34.2858ZM90.453 -1C79.3518 -0.992307 70.8801 1.74143 66.1178 7.69682C61.3389 13.673 60.5477 22.57 64.0419 34.2858L65.9584 33.7142C62.5458 22.2717 63.4972 14.1764 67.6798 8.94589C71.879 3.69466 79.5874 1.00753 90.4544 1L90.453 -1ZM90.4537 1H212V-1H90.4537V1ZM212 1C228.016 1 241 13.9837 241 30H243C243 12.8792 229.121 -1 212 -1V1ZM241 30V112H243V30H241ZM241 112C241 128.016 228.016 141 212 141V143C229.121 143 243 129.121 243 112H241ZM212 141H30V143H212V141ZM30 141C13.9837 141 1 128.016 1 112H-1C-1 129.121 12.8792 143 30 143V141ZM1 112V30H-1V112H1ZM1 30C1 29.9688 1.00005 29.9377 1.00015 29.9065L-0.999843 29.9002C-0.999948 29.9335 -1 29.9667 -1 30H1ZM1.00015 96V29.9034H-0.999848L-0.999848 96H1.00015Z" fill="currentcolor" mask="url(#tools_1)" />
                                </g>
                            </svg>
                        </div>
                        <div class="tools-icon">
                            <i class="far fa-thumbs-up"></i>
                        </div>
                        <div class="tools-content">
                            <h4 class="title"><a href="login.html">Social media</a></h4>
                            <a href="login.html" class="link-btn">Select & Try<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="tools-item">
                        <div class="tools-shape">
                            <svg viewBox="0 0 242 142" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.1">
                                    <mask id="tools_2" fill="currentcolor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" />
                                    </mask>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" fill="currentcolor" />
                                    <path d="M26.223 76.38L26.0454 77.3641L26.223 76.38ZM65.0001 34L64.0419 34.2858L65.0001 34ZM90.4537 0V-1L90.453 -1L90.4537 0ZM0.00015229 29.9034H1.00015L-0.999843 29.9002L0.00015229 29.9034ZM26.4007 75.3959C16.885 73.6781 9.97666 75.0628 5.44345 78.9101C0.915774 82.7526 -0.999848 88.8465 -0.999848 96H1.00015C1.00015 89.1535 2.83453 83.7474 6.73758 80.4349C10.6351 77.1272 16.8382 75.7019 26.0454 77.3641L26.4007 75.3959ZM64.0419 34.2858C68.1619 48.1001 63.0535 59.0984 54.7433 66.3139C46.3759 73.5791 34.8547 76.9221 26.4007 75.3959L26.0454 77.3641C35.191 79.0152 47.3083 75.4182 56.0546 67.8241C64.8581 60.1802 70.3384 48.3998 65.9584 33.7142L64.0419 34.2858ZM90.453 -1C79.3518 -0.992307 70.8801 1.74143 66.1178 7.69682C61.3389 13.673 60.5477 22.57 64.0419 34.2858L65.9584 33.7142C62.5458 22.2717 63.4972 14.1764 67.6798 8.94589C71.879 3.69466 79.5874 1.00753 90.4544 1L90.453 -1ZM90.4537 1H212V-1H90.4537V1ZM212 1C228.016 1 241 13.9837 241 30H243C243 12.8792 229.121 -1 212 -1V1ZM241 30V112H243V30H241ZM241 112C241 128.016 228.016 141 212 141V143C229.121 143 243 129.121 243 112H241ZM212 141H30V143H212V141ZM30 141C13.9837 141 1 128.016 1 112H-1C-1 129.121 12.8792 143 30 143V141ZM1 112V30H-1V112H1ZM1 30C1 29.9688 1.00005 29.9377 1.00015 29.9065L-0.999843 29.9002C-0.999948 29.9335 -1 29.9667 -1 30H1ZM1.00015 96V29.9034H-0.999848L-0.999848 96H1.00015Z" fill="currentcolor" mask="url(#tools_2)" />
                                </g>
                            </svg>
                        </div>
                        <div class="tools-icon">
                            <i class="fal fa-swatchbook"></i>
                        </div>
                        <div class="tools-content">
                            <h4 class="title"><a href="login.html">Design</a></h4>
                            <a href="login.html" class="link-btn">Select & Try<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="tools-item">
                        <div class="tools-shape">
                            <svg viewBox="0 0 242 142" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.1">
                                    <mask id="tools_3" fill="currentcolor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" />
                                    </mask>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" fill="currentcolor" />
                                    <path d="M26.223 76.38L26.0454 77.3641L26.223 76.38ZM65.0001 34L64.0419 34.2858L65.0001 34ZM90.4537 0V-1L90.453 -1L90.4537 0ZM0.00015229 29.9034H1.00015L-0.999843 29.9002L0.00015229 29.9034ZM26.4007 75.3959C16.885 73.6781 9.97666 75.0628 5.44345 78.9101C0.915774 82.7526 -0.999848 88.8465 -0.999848 96H1.00015C1.00015 89.1535 2.83453 83.7474 6.73758 80.4349C10.6351 77.1272 16.8382 75.7019 26.0454 77.3641L26.4007 75.3959ZM64.0419 34.2858C68.1619 48.1001 63.0535 59.0984 54.7433 66.3139C46.3759 73.5791 34.8547 76.9221 26.4007 75.3959L26.0454 77.3641C35.191 79.0152 47.3083 75.4182 56.0546 67.8241C64.8581 60.1802 70.3384 48.3998 65.9584 33.7142L64.0419 34.2858ZM90.453 -1C79.3518 -0.992307 70.8801 1.74143 66.1178 7.69682C61.3389 13.673 60.5477 22.57 64.0419 34.2858L65.9584 33.7142C62.5458 22.2717 63.4972 14.1764 67.6798 8.94589C71.879 3.69466 79.5874 1.00753 90.4544 1L90.453 -1ZM90.4537 1H212V-1H90.4537V1ZM212 1C228.016 1 241 13.9837 241 30H243C243 12.8792 229.121 -1 212 -1V1ZM241 30V112H243V30H241ZM241 112C241 128.016 228.016 141 212 141V143C229.121 143 243 129.121 243 112H241ZM212 141H30V143H212V141ZM30 141C13.9837 141 1 128.016 1 112H-1C-1 129.121 12.8792 143 30 143V141ZM1 112V30H-1V112H1ZM1 30C1 29.9688 1.00005 29.9377 1.00015 29.9065L-0.999843 29.9002C-0.999948 29.9335 -1 29.9667 -1 30H1ZM1.00015 96V29.9034H-0.999848L-0.999848 96H1.00015Z" fill="currentcolor" mask="url(#tools_3)" />
                                </g>
                            </svg>
                        </div>
                        <div class="tools-icon">
                            <i class="fal fa-code"></i>
                        </div>
                        <div class="tools-content">
                            <h4 class="title"><a href="login.html">Coding</a></h4>
                            <a href="login.html" class="link-btn">Select & Try<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="tools-item">
                        <div class="tools-shape">
                            <svg viewBox="0 0 242 142" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.1">
                                    <mask id="tools_4" fill="currentcolor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" />
                                    </mask>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" fill="currentcolor" />
                                    <path d="M26.223 76.38L26.0454 77.3641L26.223 76.38ZM65.0001 34L64.0419 34.2858L65.0001 34ZM90.4537 0V-1L90.453 -1L90.4537 0ZM0.00015229 29.9034H1.00015L-0.999843 29.9002L0.00015229 29.9034ZM26.4007 75.3959C16.885 73.6781 9.97666 75.0628 5.44345 78.9101C0.915774 82.7526 -0.999848 88.8465 -0.999848 96H1.00015C1.00015 89.1535 2.83453 83.7474 6.73758 80.4349C10.6351 77.1272 16.8382 75.7019 26.0454 77.3641L26.4007 75.3959ZM64.0419 34.2858C68.1619 48.1001 63.0535 59.0984 54.7433 66.3139C46.3759 73.5791 34.8547 76.9221 26.4007 75.3959L26.0454 77.3641C35.191 79.0152 47.3083 75.4182 56.0546 67.8241C64.8581 60.1802 70.3384 48.3998 65.9584 33.7142L64.0419 34.2858ZM90.453 -1C79.3518 -0.992307 70.8801 1.74143 66.1178 7.69682C61.3389 13.673 60.5477 22.57 64.0419 34.2858L65.9584 33.7142C62.5458 22.2717 63.4972 14.1764 67.6798 8.94589C71.879 3.69466 79.5874 1.00753 90.4544 1L90.453 -1ZM90.4537 1H212V-1H90.4537V1ZM212 1C228.016 1 241 13.9837 241 30H243C243 12.8792 229.121 -1 212 -1V1ZM241 30V112H243V30H241ZM241 112C241 128.016 228.016 141 212 141V143C229.121 143 243 129.121 243 112H241ZM212 141H30V143H212V141ZM30 141C13.9837 141 1 128.016 1 112H-1C-1 129.121 12.8792 143 30 143V141ZM1 112V30H-1V112H1ZM1 30C1 29.9688 1.00005 29.9377 1.00015 29.9065L-0.999843 29.9002C-0.999948 29.9335 -1 29.9667 -1 30H1ZM1.00015 96V29.9034H-0.999848L-0.999848 96H1.00015Z" fill="currentcolor" mask="url(#tools_4)" />
                                </g>
                            </svg>
                        </div>
                        <div class="tools-icon">
                            <i class="fal fa-bullhorn"></i>
                        </div>
                        <div class="tools-content">
                            <h4 class="title"><a href="login.html">Marketing</a></h4>
                            <a href="login.html" class="link-btn">Select & Try<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="tools-item">
                        <div class="tools-shape">
                            <svg viewBox="0 0 242 142" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.1">
                                    <mask id="tools_5" fill="currentcolor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" />
                                    </mask>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.000152349 96C0.000152323 82 7.50015 73 26.223 76.38C43.8227 79.5573 73.5001 62.5 65.0001 34C58.0933 10.8417 68.4855 0.0152226 90.4537 0H212C228.569 0 242 13.4315 242 30V112C242 128.569 228.569 142 212 142H30C13.4315 142 0 128.569 0 112V30C0 29.9678 5.07887e-05 29.9356 0.00015229 29.9034L0.000152349 96Z" fill="currentcolor" />
                                    <path d="M26.223 76.38L26.0454 77.3641L26.223 76.38ZM65.0001 34L64.0419 34.2858L65.0001 34ZM90.4537 0V-1L90.453 -1L90.4537 0ZM0.00015229 29.9034H1.00015L-0.999843 29.9002L0.00015229 29.9034ZM26.4007 75.3959C16.885 73.6781 9.97666 75.0628 5.44345 78.9101C0.915774 82.7526 -0.999848 88.8465 -0.999848 96H1.00015C1.00015 89.1535 2.83453 83.7474 6.73758 80.4349C10.6351 77.1272 16.8382 75.7019 26.0454 77.3641L26.4007 75.3959ZM64.0419 34.2858C68.1619 48.1001 63.0535 59.0984 54.7433 66.3139C46.3759 73.5791 34.8547 76.9221 26.4007 75.3959L26.0454 77.3641C35.191 79.0152 47.3083 75.4182 56.0546 67.8241C64.8581 60.1802 70.3384 48.3998 65.9584 33.7142L64.0419 34.2858ZM90.453 -1C79.3518 -0.992307 70.8801 1.74143 66.1178 7.69682C61.3389 13.673 60.5477 22.57 64.0419 34.2858L65.9584 33.7142C62.5458 22.2717 63.4972 14.1764 67.6798 8.94589C71.879 3.69466 79.5874 1.00753 90.4544 1L90.453 -1ZM90.4537 1H212V-1H90.4537V1ZM212 1C228.016 1 241 13.9837 241 30H243C243 12.8792 229.121 -1 212 -1V1ZM241 30V112H243V30H241ZM241 112C241 128.016 228.016 141 212 141V143C229.121 143 243 129.121 243 112H241ZM212 141H30V143H212V141ZM30 141C13.9837 141 1 128.016 1 112H-1C-1 129.121 12.8792 143 30 143V141ZM1 112V30H-1V112H1ZM1 30C1 29.9688 1.00005 29.9377 1.00015 29.9065L-0.999843 29.9002C-0.999948 29.9335 -1 29.9667 -1 30H1ZM1.00015 96V29.9034H-0.999848L-0.999848 96H1.00015Z" fill="currentcolor" mask="url(#tools_5)" />
                                </g>
                            </svg>
                        </div>
                        <div class="tools-icon">
                            <i class="fal fa-search-plus"></i>
                        </div>
                        <div class="tools-content">
                            <h4 class="title"><a href="login.html">SEO</a></h4>
                            <a href="login.html" class="link-btn">Select & Try<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="more-btn text-center mt-30">
                <a href="login.html" class="gradient-btn gradient-btn-two btn-two">more tools & try for free</a>
            </div>
        </div>
    </section>
    <!-- tools-area-end -->

    <!-- testimonial-area -->
    <section class="testimonial-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="section-title text-center mb-70">
                        <h2 class="title title-animation"><span>6,000,000+</span> <br> Professionals & teams choose us</h2>
                    </div>
                </div>
            </div>
            <div class="testimonial-item-wrap">
                <div class="row testimonial-active">
                    <div class="col">
                        <div class="testimonial-item">
                            <div class="testimonial-shape">
                                <svg viewBox="0 0 561 274" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M97.8407 0H531C547.569 0 561 13.4315 561 30V244C561 260.569 547.569 274 531 274H127.841C111.272 274 97.8407 260.569 97.8407 244V78.4298C97.8407 66.4626 90.7283 55.6401 79.7433 50.8921L6.37287 19.1792C-3.59343 14.8715 -0.516972 0 10.3404 0H97.8407Z" fill="currentcolor" />
                                </svg>
                            </div>
                            <div class="testimonial-thumb">
                                <img src="<?= base_url('themes') ?>/img/images/testi_avatar01.png" alt="">
                            </div>
                            <div class="testimonial-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p>"As a content writer, I was initially skeptical about using an AI tool. But after trying it out, I have to say that I'm blown away by the results.</p>
                                <div class="testimonial-bottom">
                                    <h5 class="title">Emily Johnson</h5>
                                    <span>Podcast Host</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="testimonial-item">
                            <div class="testimonial-shape">
                                <svg viewBox="0 0 561 274" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M97.8407 0H531C547.569 0 561 13.4315 561 30V244C561 260.569 547.569 274 531 274H127.841C111.272 274 97.8407 260.569 97.8407 244V78.4298C97.8407 66.4626 90.7283 55.6401 79.7433 50.8921L6.37287 19.1792C-3.59343 14.8715 -0.516972 0 10.3404 0H97.8407Z" fill="currentcolor" />
                                </svg>
                            </div>
                            <div class="testimonial-thumb">
                                <img src="<?= base_url('themes') ?>/img/images/testi_avatar02.png" alt="">
                            </div>
                            <div class="testimonial-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p>“I cant imagine my life without Goco.It has changed the game for me. I can put in a sentence or two of a generic idea and Goco. takes it in and in 30 seconds.</p>
                                <div class="testimonial-bottom">
                                    <h5 class="title">les alexander</h5>
                                    <span>Entrepreneur</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="testimonial-item">
                            <div class="testimonial-shape">
                                <svg viewBox="0 0 561 274" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M97.8407 0H531C547.569 0 561 13.4315 561 30V244C561 260.569 547.569 274 531 274H127.841C111.272 274 97.8407 260.569 97.8407 244V78.4298C97.8407 66.4626 90.7283 55.6401 79.7433 50.8921L6.37287 19.1792C-3.59343 14.8715 -0.516972 0 10.3404 0H97.8407Z" fill="currentcolor" />
                                </svg>
                            </div>
                            <div class="testimonial-thumb">
                                <img src="<?= base_url('themes') ?>/img/images/testi_avatar03.png" alt="">
                            </div>
                            <div class="testimonial-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p>"I've been using the AI writing tool for a few months now, and it's completely transformed my workflow. Not only has it saved me time and energy."</p>
                                <div class="testimonial-bottom">
                                    <h5 class="title">Michael Davis</h5>
                                    <span>Content Writer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="testimonial-item">
                            <div class="testimonial-shape">
                                <svg viewBox="0 0 561 274" fill="none" x="0px" y="0px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M97.8407 0H531C547.569 0 561 13.4315 561 30V244C561 260.569 547.569 274 531 274H127.841C111.272 274 97.8407 260.569 97.8407 244V78.4298C97.8407 66.4626 90.7283 55.6401 79.7433 50.8921L6.37287 19.1792C-3.59343 14.8715 -0.516972 0 10.3404 0H97.8407Z" fill="currentcolor" />
                                </svg>
                            </div>
                            <div class="testimonial-thumb">
                                <img src="<?= base_url('themes') ?>/img/images/testi_avatar04.png" alt="">
                            </div>
                            <div class="testimonial-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p>"I was hesitant to invest in an AI writing tool, but after seeing the results it produced, I have no regrets. The tool has helped</p>
                                <div class="testimonial-bottom">
                                    <h5 class="title">Jennifer Taylor</h5>
                                    <span>Blogger</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-area-end -->

</main>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>