<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<header class="main-header style-four">
    <div class="outer-container">
        <div class="container">
            <div class="main-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="<?= base_url() ?>"><img src="<?= base_url('uploads/logo.webp') ?>" alt=""></a></figure>
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
            <figure class="logo-box"><a href="<?= base_url() ?>"><img src="<?= base_url('themes') ?>/images/small-logo.webp" alt=""></a></figure>
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
        <div class="nav-logo"><a href="<?= base_url() ?>"><img src="<?= base_url('uploads/logo.webp') ?>" alt="" title=""></a></div>
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
    <div class="pattern-box">
        <div class="pattern-1"><img src="<?= base_url('themes') ?>/images/icons/shap-28.png" alt=""></div>
        <div class="pattern-2"><img src="<?= base_url('themes') ?>/images/icons/shap-29.png" alt=""></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div id="image_block_46">
                    <figure class="image-box wow slideInLeft" data-wow-delay="00ms" data-wow-duration="1500ms"><img src="<?= base_url('themes') ?>/images/resource/illustration-40.png" alt=""></figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div id="content_block_51">
                    <div class="content-box">
                        <div class="upper-box">
                            <h2>Ada Kendala Mengenai PPDB?</h2>
                            <div class="text">Jika mengalami kendala atau masalah dalam proses pendaftaran PPDB, silahkan buat pengaduan pada form berikut ini.</div>
                            <!-- <div class="btn-box">
                                <a href="#" class="btn-one">Funding Progress</a>
                                <a href="#" class="btn-two">Join Us</a>
                            </div> -->
                        </div>
                        <div class="donation-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="select-box">
                                <input type="hidden" id="_nisn" name="_nisn" value="<?= isset($nisn) ? $nisn : '-' ?>">
                                <input type="hidden" id="_npsn" name="_npsn" value="<?= isset($npsn) ? $npsn : '-' ?>">
                                <div class="form-group">
                                    <p style="color: #fff;">Nama Lengkap *</p>
                                    <input style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" type="text" name="_nama" id="_nama" placeholder="">
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">No Handphone *</p>
                                    <input style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" type="text" name="_nohp" id="_nohp" placeholder="">
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">Deskripsi Kendala / Masalah *</p>
                                    <textarea style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; outline: medium none;" rows="5" name="_deskripsi" id="_deskripsi" placeholder="Masukkan deskripsi kendala / masalah"></textarea>
                                </div>
                            </div>
                            <div class="btn-box">
                                <button onclick="submitAduanButton(this)" class="donate-box-btn _submit_aduan_button" id="_submit_aduan_button">KIRIM</button>
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
<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
    function actionLoginButton(event) {
        $('#login-popup').addClass('popup-visible');
    }

    function actionRegisterButton(event) {
        $('#register-popup').addClass('popup-visible');
    }

    function actionLoginButtonMobile(event) {
        $('body').removeClass('mobile-menu-visible');
        $('#login-popup').addClass('popup-visible');
    }

    function actionRegisterButtonMobile(event) {
        $('body').removeClass('mobile-menu-visible');
        $('#register-popup').addClass('popup-visible');
    }
    //Hide Popup
    $('._close-login').click(function() {
        $('#login-popup').removeClass('popup-visible');
    });

    //Hide Popup
    $('._close-register').click(function() {
        $('#register-popup').removeClass('popup-visible');
    });

    function submitLoginButton(event) {
        const username = document.getElementsByName('_username')[0].value;
        const password = document.getElementsByName('_password')[0].value;

        $.ajax({
            type: "POST",
            url: BASE_URL + '/auth/login',
            data: {
                username: username,
                password: password,
            },
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('div.donate-form-area').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                console.log(msg);
                if (msg.code != 200) {
                    if (msg.code !== 201) {
                        if (msg.code !== 202) {
                            $('div.donate-form-area').unblock();
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
                    $('div.donate-form-area').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            }
        });
    }

    function submitRegisterBeforeSchoolButton(event) {
        // const jenjang = document.getElementsByName('_jenjang')[0].value;
        const nik = document.getElementsByName('_nik')[0].value;
        const kk = document.getElementsByName('_kk')[0].value;

        if (nik.length !== 16) {
            // $("input#_nisn").css("color", "#dc3545");
            // $("input#_nisn").css("border-color", "#dc3545");
            $('._nik').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">NIK tidak valid.</li></ul>');
            return;
        }
        if (kk.length !== 16) {
            // $("input#_npsn").css("color", "#dc3545");
            // $("input#_npsn").css("border-color", "#dc3545");
            $('._kk').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">KK tidak valid.</li></ul>');
            return;
        }

        $.ajax({
            url: BASE_URL + '/auth/ceknikregistered',
            type: 'POST',
            data: {
                nik: nik,
                kk: kk,
            },
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('div.donate-form-area').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                loading = false;
                // console.log(msg);
                $('div.donate-form-area').unblock();
                if (msg.code !== 200) {
                    $('.content-siswa-belum').html('');
                    $('.content-siswa-belum').css('display', 'none');

                    Swal.fire(
                        'Gagal!',
                        msg.message,
                        'warning'
                    );


                } else {
                    $('.content-siswa-belum').html(msg.data);
                    $('.content-siswa-belum').css('display', 'block');
                    $('.' + event.id).css('display', 'none');
                    // Swal.fire(
                    //     'Berhasil!',
                    //     msg.message,
                    //     'success'
                    // ).then((valRes) => {
                    //     document.location.href = msg.url;
                    // })
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
                    $('div.donate-form-area').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            }
        });
    }

    function submitRegisterAfterSchoolButton(event) {
        // const jenjang = document.getElementsByName('_jenjang')[0].value;
        const nisn = document.getElementsByName('_nisn')[0].value;
        const npsn = document.getElementsByName('_npsn')[0].value;
        const tglLahir = document.getElementsByName('_tgl_lahir')[0].value;

        if (nisn === "") {
            // $("input#_nisn").css("color", "#dc3545");
            // $("input#_nisn").css("border-color", "#dc3545");
            $('._nisn').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">NISN tidak boleh kosong.</li></ul>');
            return;
        }
        if (npsn === "") {
            // $("input#_npsn").css("color", "#dc3545");
            // $("input#_npsn").css("border-color", "#dc3545");
            $('._npsn').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">NPSN tidak boleh kosong.</li></ul>');
            return;
        }
        if (tglLahir === "") {
            // $("input#_tgl_lahir").css("color", "#dc3545");
            // $("input#_tgl_lahir").css("border-color", "#dc3545");
            $('._tgl_lahir').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Tanggal lahir tidak boleh kosong.</li></ul>');
            return;
        }

        $.ajax({
            url: BASE_URL + '/auth/getdatasiswa',
            type: 'POST',
            data: {
                nisn: nisn,
                npsn: npsn,
                tglLahir: tglLahir,
                // jenjang: jenjang,
            },
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('div.donate-form-area').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                loading = false;
                // console.log(msg);
                $('div.donate-form-area').unblock();
                if (msg.code !== 200) {
                    $('.content-siswa').html('');
                    $('.content-siswa').css('display', 'none');

                    Swal.fire(
                        'Gagal!',
                        msg.message,
                        'warning'
                    );


                } else {
                    $('.content-siswa').html(msg.data);
                    $('.content-siswa').css('display', 'block');
                    $('.' + event.id).css('display', 'none');
                    // Swal.fire(
                    //     'Berhasil!',
                    //     msg.message,
                    //     'success'
                    // ).then((valRes) => {
                    //     document.location.href = msg.url;
                    // })
                }
            },
            error: function(data) {
                console.log(data);
                if (data.status === 200 && (data.statusText === "parsererror" || data.statusText === "OK")) {
                    // setTimeout(function() {
                    // document.location.href = BASE_URL + '/dahboard';
                    // }, 2000);
                } else {
                    loading = false;
                    $('div.donate-form-area').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            }
        });
    }

    function submitRegistrasi(event) {
        // if (loadedAll) {
        //     if (loading) {
        //         return;
        //     }

        const nisn = document.getElementsByName('_nisn_d')[0].value;
        const keyD = document.getElementsByName('_key_d')[0].value;
        const npsn = document.getElementsByName('_npsn_d')[0].value;
        const email = document.getElementsByName('_email')[0].value;

        if (nisn === "") {
            // $("input#_nisn").css("color", "#dc3545");
            // $("input#_nisn").css("border-color", "#dc3545");
            $('._nisn').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">NISN tidak boleh kosong.</li></ul>');
            return
        }
        if (email === "") {
            // $("input#_nisn").css("color", "#dc3545");
            // $("input#_nisn").css("border-color", "#dc3545");
            $('._email').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Email tidak boleh kosong.</li></ul>');
            return
        }

        $.ajax({
            url: BASE_URL + '/auth/saveregisschool',
            type: 'POST',
            data: {
                nisn: nisn,
                key: keyD,
                npsn: npsn,
                email: email,
            },
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('div.donate-form-area').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                loading = false;
                // console.log(msg);
                $('div.donate-form-area').unblock();
                if (msg.code !== 200) {

                    Swal.fire(
                        'Gagal!',
                        msg.message,
                        'warning'
                    );

                } else {
                    Swal.fire(
                        'Berhasil!',
                        msg.message,
                        'success'
                    ).then((valRes) => {
                        document.location.href = msg.url;
                    })
                }
            },
            error: function(data) {
                console.log(data);
                loading = false;

                $('div.donate-form-area').unblock();
                Swal.fire(
                    'Gagal!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );

            }
        })
        // }
    }

    function submitRegistrasiBelumSekolah(event) {
        // if (loadedAll) {
        //     if (loading) {
        //         return;
        //     }

        const nik = document.getElementsByName('_nik_d_belum')[0].value;
        const kk = document.getElementsByName('_kk_d_belum')[0].value;
        const nama = document.getElementsByName('_nama_d_belum')[0].value;
        const tempat_lahir = document.getElementsByName('_tempat_lahir_d_belum')[0].value;
        const tgl_lahir = document.getElementsByName('_tgl_lahir_d_belum')[0].value;
        const jk = document.getElementsByName('_jk_d_belum')[0].value;
        const nama_ayah = document.getElementsByName('_nama_ayah_d_belum')[0].value;
        const nama_ibu = document.getElementsByName('_nama_ibu_d_belum')[0].value;
        const email = document.getElementsByName('_email')[0].value;

        if (nik === "") {
            $('._nik').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">NIK tidak boleh kosong.</li></ul>');
            return
        }
        if (kk === "") {
            $('._kk').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">KK tidak boleh kosong.</li></ul>');
            return
        }
        if (nama === "") {
            $('._nama_d_belum').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Nama tidak boleh kosong.</li></ul>');
            return
        }
        if (tempat_lahir === "") {
            $('._tempat_lahir_d_belum').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Tempat lahir tidak boleh kosong.</li></ul>');
            return
        }
        if (tgl_lahir === "") {
            $('._tgl_lahir_d_belum').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Tanggal lahir tidak boleh kosong.</li></ul>');
            return
        }
        if (nama_ayah === "") {
            $('._nama_ayah_d_belum').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Nama ayah tidak boleh kosong.</li></ul>');
            return
        }
        if (nama_ibu === "") {
            $('._nama_ibu_d_belum').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Nama ibu tidak boleh kosong.</li></ul>');
            return
        }
        if (email === "") {
            $('._email').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Email tidak boleh kosong.</li></ul>');
            return
        }

        $.ajax({
            url: BASE_URL + '/auth/saveregisbeforeschool',
            type: 'POST',
            data: {
                nik: nik,
                kk: kk,
                nama: nama,
                tempat_lahir: tempat_lahir,
                tgl_lahir: tgl_lahir,
                jk: jk,
                nama_ayah: nama_ayah,
                nama_ibu: nama_ibu,
                email: email,
            },
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('div.donate-form-area').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                loading = false;
                // console.log(msg);
                $('div.donate-form-area').unblock();
                if (msg.code !== 200) {

                    Swal.fire(
                        'Gagal!',
                        msg.message,
                        'warning'
                    );

                } else {
                    Swal.fire(
                        'Berhasil!',
                        msg.message,
                        'success'
                    ).then((valRes) => {
                        document.location.href = msg.url;
                    })
                }
            },
            error: function(data) {
                console.log(data);
                loading = false;

                $('div.donate-form-area').unblock();
                Swal.fire(
                    'Gagal!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );

            }
        })
        // }
    }

    function actionRegisterAfterSchool(event) {
        $('._punya_nisn').css('display', 'block');
        $('._belum_punya_nisn').css('display', 'none');
        $('.content-siswa').html('');
        $('.content-siswa').css('display', 'none');
        $('.content-siswa-belum').html('');
        $('.content-siswa-belum').css('display', 'none');
    }

    function actionRegisterBeforeSchool(event) {
        $('._punya_nisn').css('display', 'none');
        $('._belum_punya_nisn').css('display', 'block');
        $('.content-siswa').html('');
        $('.content-siswa').css('display', 'none');
        $('.content-siswa-belum').html('');
        $('.content-siswa-belum').css('display', 'none');
    }

    function cancelConfirm(event) {
        // $('.btncekdata').css('display', 'block');
        $('.content-siswa').html('');
        $('.content-siswa').css('display', 'none');
        $('.content-siswa-belum').html('');
        $('.content-siswa-belum').css('display', 'none');
        $('.' + event.id).css('display', 'block');
    }

    function changeValidation(event) {
        $('.' + event).css('display', 'none');
    };

    function inputFocus(id) {
        const color = $(id).attr('id');
        // $(id).removeAttr('style');
        $('.' + color).html('');
    }

    function ambilId(id) {
        return document.getElementById(id);
    }
</script>

<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<?= $this->endSection(); ?>