<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>

<section class="banner-style-14 centred" style="padding-bottom: 0px;">
    <div class="container">
        <div class="content-box">
            <h2>Penerimaan Peserta Didik Baru Dinas Pendidikan dan Kebudayaan<br>Kabupaten Lampung Tengah Tahun Pelajaran 2023/2024</h2>
            <div class="text">Website ini dipersiapkan sebagai pusat informasi dan pengolahan data seleksi penerimaan peserta didik baru Dinas Pendidikan Kabupaten Lampung Tengah Tahun Pelajaran 2023/2024 secara online dan realtime.</div>
            <div class="mail-box loading-cari-data">
                <form action="#" method="post">
                    <div class="form-group">
                        <input type="text" name="_search" id="_search" placeholder="Masukkan NISN/NIK" required="">
                        <button onclick="cariDataSiswa(this)" type="button">Cari Data Siswa</button>
                    </div>
                </form>
            </div>
            <!-- <div class="image-box">
                <figure class="image-1 js-tilt"><img src="<?= base_url('themes') ?>/images/resource/illustration-26.png" alt=""></figure>
                <figure class="image-2 float-bob-x"><img src="<?= base_url('themes') ?>/images/icons/cloud-1.png" alt=""></figure>
                <figure class="image-3 float-bob-x"><img src="<?= base_url('themes') ?>/images/icons/cloud-2.png" alt=""></figure>
            </div> -->
        </div>
    </div>
</section>

<!-- <section class="domain-section">
    <div class="container">
        <div class="inner-container" style="margin-top: -75px;">
            <div class="sec-title center">
                <h2>Looking For Domain Name?</h2>
            </div>
            <div class="search-form">
                <form action="#" method="post">
                    <div class="form-group">
                        <input type="text" name="domain_name" placeholder="Enter Your Domain Name" required="">
                        <button type="submit">Search Now</button>
                    </div>
                </form>
            </div>
            <ul class="domain-name clearfix">
                <li><a href="#"><span>.com</span> $6.50</a></li>
                <li><a href="#"><span>.sg</span> $10</a></li>
                <li><a href="#"><span>.info</span> $11</a></li>
                <li><a href="#"><span>.co</span> $9.50</a></li>
                <li><a href="#"><span>.net</span> $7.50</a></li>
            </ul>
        </div>
    </div>
</section> -->

<section class="transactions-work" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                <div id="content_block_39">
                    <div class="content-box">
                        <div class="sec-title">
                            <h2>CARA DAFTAR</h2>
                        </div>
                        <!-- <h5>Crypto is the best crowdsale service!</h5>
                        <div class="text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="btn-box"><a href="#" class="theme-btn-two">Read More</a></div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                <div id="content_block_40">
                    <div class="inner-box">
                        <div class="single-item wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="count-box" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-9.webp);">01</div>
                            <div class="box">
                                <div class="pattern-bg">
                                    <div class="pattern-1" style="background-image: url(<?= base_url('themes') ?>/images/icons/shap-19.webp);"></div>
                                    <div class="pattern-2" style="background-image: url(<?= base_url('themes') ?>/images/icons/shap-20.webp);"></div>
                                </div>
                                <h4><a href="#">Klik Registrasi Akun</a></h4>
                                <div class="text">Klik button “Registrasi Akun” apabila belum pernah bersekolah atau sekolah di Luar Lingkup Dinas Pendidikan dan Kebudayaan Kab. Lampung Tengah.</div>
                            </div>
                        </div>
                        <div class="single-item wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="count-box" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-10.webp);">02</div>
                            <div class="box">
                                <div class="pattern-bg">
                                    <div class="pattern-1" style="background-image: url(<?= base_url('themes') ?>/images/icons/shap-19.webp);"></div>
                                    <div class="pattern-2" style="background-image: url(<?= base_url('themes') ?>/images/icons/shap-21.webp);"></div>
                                </div>
                                <h4><a href="#">Login ke dashboard siswa</a></h4>
                                <div class="text">Login dengan username (NISN/NIK) dan password yang telah diberikan saat kamu berhasil melakukan pendaftaran.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                <div id="content_block_40">
                    <div class="inner-box">
                        <div class="single-item wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="count-box" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-11.webp);">03</div>
                            <div class="box">
                                <div class="pattern-bg">
                                    <div class="pattern-1" style="background-image: url(<?= base_url('themes') ?>/images/icons/shap-19.webp);"></div>
                                    <div class="pattern-2" style="background-image: url(<?= base_url('themes') ?>/images/icons/shap-22.webp);"></div>
                                </div>
                                <h4><a href="#">Lengkapi Pemutakhiran data</a></h4>
                                <div class="text">Kamu akan diarahkan kehalaman dashboard kemudian cari button “Lihat Data Pribadi” untuk melengkapi formulir pemuktakhiran data.</div>
                            </div>
                        </div>
                        <div class="single-item wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="count-box" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-11.webp);">04</div>
                            <div class="box">
                                <div class="pattern-bg">
                                    <div class="pattern-1" style="background-image: url(<?= base_url('themes') ?>/images/icons/shap-19.webp);"></div>
                                    <div class="pattern-2" style="background-image: url(<?= base_url('themes') ?>/images/icons/shap-22.webp);"></div>
                                </div>
                                <h4><a href="#">Klik Daftar PPDB</a></h4>
                                <div class="text">Kamu bisa melakukan pendaftaran dengan klik button “Daftar PPDB” yang ada dihalaman dashboard.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="clients-section centred">
    <div class="container">
        <div class="clients-carousel owl-carousel owl-theme owl-dots-none">
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-1.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-2.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-3.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-4.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-1.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-2.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-3.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-4.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-1.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-2.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-3.png" alt=""></a></figure>
            <figure class="image-box"><a href="#"><img src="<?= base_url('themes') ?>/images/clients/client-4.png" alt=""></a></figure>
        </div>
        <div class="trusted-box">Trusted by 18,000+ happy customers worldwide</div>
    </div>
</section> -->

<section class="managed-wordpress">
    <div class="image-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/layer-image-5.web);"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 image-column wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div id="image_block_42">
                    <figure class="image-box js-tilt"><img src="<?= base_url('themes') ?>/images/resource/vactor-image-10.webp" alt=""></figure>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                <div id="content_block_45">
                    <div class="content-box">
                        <div class="sec-title">
                            <h2>Ayo Daftar PPDB Sekarang Juga!!</h2>
                        </div>
                        <div class="text">Kamu bisa mengikuti prosedur yang telah dijelaskan di atas dan mengikuti langkah dibawah ini.</div>
                        <div class="btn-box"><a href="<?= base_url('web/register') ?>">Daftar PPDB Sekarang</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="download-apps elements sec-pad-three">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div id="image_block_16">
                    <div class="image-box">
                        <div class="bg-layer  wow slideInLeft" data-wow-delay="00ms" data-wow-duration="1500ms" style="background-image: url(<?= base_url('themes') ?>/images/icons/image-shap-6.webp);"></div>
                        <figure class="image image-1 wow slideInLeft" data-wow-delay="300ms" data-wow-duration="1500ms"><img src="<?= base_url('themes') ?>/images/resource/phone-9.webp" alt=""></figure>
                        <figure class="image image-2 wow slideInLeft" data-wow-delay="600ms" data-wow-duration="1500ms"><img src="<?= base_url('themes') ?>/images/resource/phone-10.webp" alt=""></figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div id="content_block_16">
                    <div class="content-box wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="sec-title">
                            <h2>Dapatkan Aplikasinya Sekarang Juga!</h2>
                        </div>
                        <div class="text">Tersedia di platform android,<br>Silahkan download aplikasi di playStore pada link berikut:</div>
                        <div class="download-btn">
                            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.kntechline.ppdb.duatiga.lamteng&hl=id-ID" class="google-play-btn">
                                <i class="fab fa-android"></i>
                                <span>Get on it</span>
                                Google Play
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="subscribe-style-three" style="padding-bottom: 0px;">
    <div class="pattern-bg wow slideInUp" data-wow-delay="00ms" data-wow-duration="1500ms" style="background-image: url(<?= base_url('themes') ?>/images/icons/map-shap-4.webp);"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12 offset-lg-1 inner-column">
                <div class="inner-box">
                    <div class="sec-title center">
                        <h2>Dapatkan Berbagai Informasi Mengenai PPDB Tahun 2023<br>Kabupaten Lampung Tengah</h2>
                    </div>
                    <div class="text"><a href="#" style="position: relative; display: inline-block; overflow: hidden; font-size: 16px; color: #fff; line-height: 30px; background: #4527a4; padding: 15px 47px; text-align: center; border-radius: 30px; z-index: 1; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);">Lihat Informasi PPDB 2023</a></div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
    function cariDataSiswa(event) {
        const keyword = document.getElementsByName('_search')[0].value;

        if (keyword.lenght < 10) {
            Swal.fire(
                'Peringatan!',
                "Silahkan masukkan NISN / NIK dengan benar.",
                'warning'
            );
            return;
        }

        $.ajax({
            type: "POST",
            url: BASE_URL + '/web/home/cari',
            data: {
                keyword: keyword,
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('div.loading-cari-data').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                if (msg.code != 200) {
                    $('div.loading-cari-data').unblock();
                    loading = false;
                    Swal.fire(
                        'Peringatan!',
                        msg.message,
                        'warning'
                    );
                } else {
                    // Swal.fire(
                    //     'Berhasil!',
                    //     msg.message,
                    //     'success'
                    // ).then((valRes) => {
                    // setTimeout(function() {
                    document.location.href = msg.url;
                    // }, 2000);
                    // document.location.href = window.location.href + "dashboard";
                    // })
                }
            },
            error: function(data) {

                $('div.loading-cari-data').unblock();
                Swal.fire(
                    'Gagal!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );

            }
        });
    }
</script>
<?php if (isset($pengumuman)) { ?>
    <?php if ($pengumuman) { ?>
        <!-- <div id="myModal" class="modal fade show" tabindex="-1" aria-labelledby="myModalLabel" style="display: block;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Default Modal Heading</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Overflowing text to show scroll behavior</h5>
                        <p>Cras mattis consectetur purus sit amet fermentum.
                            Cras justo odio, dapibus ac facilisis in,
                            egestas eget quam. Morbi leo risus, porta ac
                            consectetur ac, vestibulum at eros.</p>
                        <p>Praesent commodo cursus magna, vel scelerisque
                            nisl consectetur et. Vivamus sagittis lacus vel
                            augue laoreet rutrum faucibus dolor auctor.</p>
                        <p>Aenean lacinia bibendum nulla sed consectetur.
                            Praesent commodo cursus magna, vel scelerisque
                            nisl consectetur et. Donec sed odio dui. Donec
                            ullamcorper nulla non metus auctor
                            fringilla.</p>
                        <p>Cras mattis consectetur purus sit amet fermentum.
                            Cras justo odio, dapibus ac facilisis in,
                            egestas eget quam. Morbi leo risus, porta ac
                            consectetur ac, vestibulum at eros.</p>
                        <p>Praesent commodo cursus magna, vel scelerisque
                            nisl consectetur et. Vivamus sagittis lacus vel
                            augue laoreet rutrum faucibus dolor auctor.</p>
                        <p>Aenean lacinia bibendum nulla sed consectetur.
                            Praesent commodo cursus magna, vel scelerisque
                            nisl consectetur et. Donec sed odio dui. Donec
                            ullamcorper nulla non metus auctor
                            fringilla.</p>
                        <p>Cras mattis consectetur purus sit amet fermentum.
                            Cras justo odio, dapibus ac facilisis in,
                            egestas eget quam. Morbi leo risus, porta ac
                            consectetur ac, vestibulum at eros.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </div>
            </div>
        </div> -->
        <div id="donate-popup" style="background: rgb(0 0 0 / 47%); width: 600px; overflow-x: hidden; overflow-y: auto;" class="donate-popup popup-visible">
            <div class="popup-inner">
                <div class="container" style="margin-right: auto !important; margin-left: auto !important; max-width: 600px;">
                    <div class="close-donate"><i class="far fa-window-close"></i></div>
                    <div class="donate-form-area">
                        <h2>INFORMASI...!!!</h2>
                        <div>
                            <?= $pengumuman->isi ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<?= $this->endSection(); ?>