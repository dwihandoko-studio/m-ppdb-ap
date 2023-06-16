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
                        <a href="<?= base_url('web/home/#alur-pendaftaran') ?>">Alur Pendaftaran</a>
                    </li>
                    <li>
                        <a href="<?= base_url('web/home/#content-pengumuma') ?>">Pengumuman</a>
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

            <p class="text-gradient mt-3">PPDB KAB. LAMPUNG TIMUR</p>
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
                    <a href="<?= base_url() ?>" class="brand-logo">
                        <img width="130" src="<?= base_url('template/pringo') ?>/assets/images/logo/logo.png" alt="brand logo" />
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
                                <a class="main-menu-link" href="<?= base_url() ?>">Beranda</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/#alur-pendaftaran') ?>">Alur Pendaftaran</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/#content-pengumuman') ?>">Pengumuman</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/referensizonasi') ?>">
                                    Referensi Zonasi Sekolah</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/rekapitulasi') ?>">Rekapitulasi</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" target="_blank" href="https://nisn.data.kemdikbud.go.id/">Cek NISN</a>
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
<!-- working process section start -->
<section class="working-process-section" style="padding-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                <div class="section-title process text-center pb-50">
                    <!-- <div class="icon">
                            <img src="<?= base_url('template/pringo'); ?>/assets/images/icon/pencile.png" alt="Icon_not_found" />
                        </div> -->
                    <h3 class="title" style="font-size: 35px;">DAFTAR AKUN PPDB BELUM SEKOLAH</h3>
                    <!-- <span class="hr-secodary"></span> -->
                </div>
            </div>
        </div>

        <div class="row working-process mb-n4" style="justify-content: center; justify-items: center;">
            <div class="col-lg-8">
                <div class="row" style="margin: 0px;">
                    <div class="col-md-12" style="padding-top: 15px;padding-bottom: 15px; background-color: #fff; text-align: center; background-clip: border-box;">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <a href="<?= base_url('web/home/registertest') ?>"><b>PUNYA NISN</b></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <a href="<?= base_url('web/home/registerbelumsekolah') ?>"><b>BELUM SEKOLAH</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="cardcus loading-content-card">
                    <form id="form-daftar2">
                        <div class="cardcus-body">
                            <div class="submit-continue" style="display: block;">
                                <div class="formcus-row">

                                    <div class="formcus-group col-md-6">
                                        <label for="_nik">NIK*</label>
                                        <input type="number" onfocus="inputFocus(this)" maxlength="16" class="formcus-control nik" id="_nik" name="_nik" placeholder="NIK" autocomplete="off" required="">
                                        <div class="help-block _nik"></div>
                                    </div>
                                    <div class="formcus-group col-md-6">
                                        <label for="_kk">NO KARTU KELUARGA*</label>
                                        <input type="number" onfocus="inputFocus(this)" class="formcus-control kk" id="_kk" name="_kk" placeholder="Nomor Kartu Keluarga" autocomplete="off" required="">
                                        <div class="help-block _kk"></div>
                                    </div>
                                </div>
                                <!--<div class="formcus-row">-->
                                <!--    <div class="formcus-group col-md-6">-->
                                <!--        <label for="nisn">NPSN SEKOLAH ASAL*</label>-->
                                <!--        <input type="number" onfocus="inputFocus(this)" class="formcus-control npsn" id="_npsn" name="_npsn" placeholder="NPSN sekolah asal" autocomplete="off" required="">-->
                                <!--        <div class="help-block _npsn"></div>-->
                                <!--    </div>-->

                                <!--</div>-->
                                <div class="formcus-row btncekdata" style="display: block;">
                                    <div class="formcus-group col-md-12">
                                        <button id="btncekdata" type="button" style="min-width: 100%; max-height: 40px; padding: 10px;" onclick="submitCek(this)" class="btn btn-block btn-primary">CEK DATA</button>
                                    </div>
                                </div>
                                <div class="content-siswa" id="content-siswa" style="display: none;">

                                </div>
                            </div>
                            <div class="content-continue" style="display: none;">
                                <h5 style="justify-content: center; justify-items: center;">Buat Akun Anda</h5>
                                <div class="formcus-row">
                                    <div class="formcus-group col-md-6">
                                        <label for="_email_d">E-MAIL</label>
                                        <input type="email" onfocus="inputFocus(this)" class="formcus-control email-d" id="_email_d" name="_email_d" placeholder="E-mail . . ." autocomplete="off" required="">
                                        <div class="help-block _email_d"></div>
                                    </div>
                                    <div class="formcus-group col-md-6">
                                        <label for="_nohp_d">NO HANDPHONE</label>
                                        <input type="number" onfocus="inputFocus(this)" class="formcus-control nohp-d" id="_nohp_d" name="_nohp_d" placeholder="No Hanphone . . ." autocomplete="off" required="">
                                        <div class="help-block _nohp_d"></div>
                                    </div>
                                </div>
                                <div class="formcus-row">
                                    <div class="formcus-group col-md-6" style="margin-bottom: 5px;">
                                        <label for="_password_d">KATA SANDI</label>
                                        <div class="inputss-group inputss-group-merge">
                                            <input class="formcus-control password-d" onfocus="inputFocus(this)" id="_password_d" name="_password_d" placeholder="Kata Sandi . . ." type="password" required>
                                            <div class="inputss-group-append" onclick="showPassword(this)">
                                                <span class="inputss-group-text show-password">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="help-block _password_d"></div>
                                        <p>Kata sandi minimal 6 karakter.</p>
                                    </div>
                                    <div class="formcus-group col-md-6" style="margin-bottom: 5px;">
                                        <label for="_re_password_d">ULANGI KATA SANDI</label>
                                        <div class="inputss-group inputss-group-merge">
                                            <input class="formcus-control re-password-d" onfocus="inputFocus(this)" id="_re_password_d" name="_re_password_d" placeholder="Ulangi Kata Sandi . . ." type="password" required>
                                            <div class="inputss-group-append" onclick="showRePassword(this)">
                                                <span class="inputss-group-text show-repassword">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- <input type="password" onfocus="inputFocus(this)" class="formcus-control password-d" id="_password_d" name="_password_d" placeholder="Kata Sandi . . ." autocomplete="off" aria-describedby="show-password1" required="">
                                        <i class="fas fa-eye icon-forms"></i> -->
                                        <div class="help-block _re_password_d"></div>
                                    </div>
                                    <div class="formcus-group col-md-12">
                                        <p>Harap diingat kata sandi yang anda masukkan.</p>
                                    </div>
                                </div>
                                <div class="formcus-row">
                                    <div class="formcus-group col-md-12" style="margin-top: 20px;">
                                        <button id="btnkirimdata" type="button" style="min-width: 100%; max-height: 40px; padding: 10px;" onclick="submitRegistrasi(this)" class="btn btn-block btn-warning">S I M P A N</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- working process section end -->

<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url('new-assets/assets'); ?>/js/jquery-block-ui.js"></script>

<script>
    $('.visibility-footer').css('display', 'none');
    let loadedAll = false;
    let loading = false;
    $(document).ready(function() {
        loadedAll = true;
    });

    function showPassword(event) {
        let showedPassword = document.getElementsByName('_password_d')[0];
        if (showedPassword.type === "password") {
            showedPassword.type = "text";
            $('.show-password').html('<i class="fas fa-eye-slash"></i>');
        } else {
            showedPassword.type = "password";
            $('.show-password').html('<i class="fas fa-eye"></i>');
        }
    }

    function showRePassword(event) {
        let showedRePassword = document.getElementsByName('_re_password_d')[0];
        if (showedRePassword.type === "password") {
            showedRePassword.type = "text";
            $('.show-repassword').html('<i class="fas fa-eye-slash"></i>');
        } else {
            showedRePassword.type = "password";
            $('.show-repassword').html('<i class="fas fa-eye"></i>');
        }
    }

    function submitRegistrasi(event) {
        if (loadedAll) {
            if (loading) {
                return;
            }

            const nik = document.getElementsByName('_nik')[0].value;
            const kk = document.getElementsByName('_kk')[0].value;
            const nama = document.getElementsByName('_nama_d')[0].value;
            const tempat_lahir = document.getElementsByName('_tempat_lahir_d')[0].value;
            const tgl_lahir = document.getElementsByName('_tgl_lahir_d')[0].value;
            const jk = document.getElementsByName('_jk_d')[0].value;
            const nama_ayah = document.getElementsByName('_nama_ayah_d')[0].value;
            const nama_ibu = document.getElementsByName('_nama_ibu_d')[0].value;

            const email = document.getElementsByName('_email_d')[0].value;
            const nohp = document.getElementsByName('_nohp_d')[0].value;
            const password = document.getElementsByName('_password_d')[0].value;
            const repassword = document.getElementsByName('_re_password_d')[0].value;


            if (email === "") {
                $("input#_email_d").css("color", "#dc3545");
                $("input#_email_d").css("border-color", "#dc3545");
                $('._email_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Email tidak boleh kosong.</li></ul>');
                return;
            }
            if (nohp === "") {
                $("input#_nohp_d").css("color", "#dc3545");
                $("input#_nohp_d").css("border-color", "#dc3545");
                $('._nohp_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">No Handphone tidak boleh kosong.</li></ul>');
                return;
            }
            if (password.length < 6) {
                $("input#_password_d").css("color", "#dc3545");
                $("input#_password_d").css("border-color", "#dc3545");
                $('._password_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Kata sandi minimal 6 karakter.</li></ul>');
                return;
            }
            if (repassword === "") {
                $("input#_re_password_d").css("color", "#dc3545");
                $("input#_re_password_d").css("border-color", "#dc3545");
                $('._re_password_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Ulangi kata sandi tidak boleh kosong.</li></ul>');
                return;
            }
            if (password !== repassword) {
                $("input#_re_password_d").css("color", "#dc3545");
                $("input#_re_password_d").css("border-color", "#dc3545");
                $('._re_password_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Ulangi kata sandi tidak sama.</li></ul>');

                Swal.fire(
                    'Peringatan!',
                    "Kata sandi dan ulangi kata sandi tidak sama.",
                    'warning'
                );
                return;
            }

            $.ajax({
                url: BASE_URL + '/auth/saveregisbelumsekolah',
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
                    nohp: nohp,
                    password: password,
                    repassword: repassword,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    loading = true;
                    $('div.loading-content-card').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    loading = false;
                    // console.log(msg);
                    $('div.loading-content-card').unblock();
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

                    $('div.loading-content-card').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );

                }
            })
        }
    }

    function submitConfirm(event) {
        if (loadedAll) {
            if (loading) {
                return;
            }

            const nik = document.getElementsByName('_nik')[0].value;
            const kk = document.getElementsByName('_kk')[0].value;
            const nama = document.getElementsByName('_nama_d')[0].value;
            const tempat_lahir = document.getElementsByName('_tempat_lahir_d')[0].value;
            const tgl_lahir = document.getElementsByName('_tgl_lahir_d')[0].value;
            const jk = document.getElementsByName('_jk_d')[0].value;
            const nama_ayah = document.getElementsByName('_nama_ayah_d')[0].value;
            const nama_ibu = document.getElementsByName('_nama_ibu_d')[0].value;

            if (nik.length !== 16) {
                $("input#_nik").css("color", "#dc3545");
                $("input#_nik").css("border-color", "#dc3545");
                $('._nik').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">NIK harus 16 digit.</li></ul>');
                return;
            }
            if (kk.length !== 16) {
                $("input#_kk").css("color", "#dc3545");
                $("input#_kk").css("border-color", "#dc3545");
                $('._kk').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">KK harus 16 digit.</li></ul>');
                return;
            }
            if (nama.length < 3) {
                $("input#_nama_d").css("color", "#dc3545");
                $("input#_nama_d").css("border-color", "#dc3545");
                $('._nama_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Nama tidak boleh kosong.</li></ul>');
                return;
            }
            if (tempat_lahir.length < 3) {
                $("input#_tempat_lahir_d").css("color", "#dc3545");
                $("input#_tempat_lahir_d").css("border-color", "#dc3545");
                $('._tempat_lahir_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Tempat lahir tidak boleh kosong.</li></ul>');
                return;
            }
            if (tgl_lahir.length !== 10) {
                $("input#_tgl_lahir_d").css("color", "#dc3545");
                $("input#_tgl_lahir_d").css("border-color", "#dc3545");
                $('._tgl_lahir_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Tanggal lahir tidak boleh kosong.</li></ul>');
                return;
            }
            if (jk === "") {
                $("select#_jk_d").css("color", "#dc3545");
                $("select#_jk_d").css("border-color", "#dc3545");
                $('._jk_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Silahkan pilih jenis kelamin.</li></ul>');
                return;
            }
            if (nama_ayah.length < 3) {
                $("input#_nama_ayah_d").css("color", "#dc3545");
                $("input#_nama_ayah_d").css("border-color", "#dc3545");
                $('._nama_ayah_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Nama ayah tidak boleh kosong.</li></ul>');
                return;
            }
            if (nama_ibu.length < 3) {
                $("input#_nama_ibu_d").css("color", "#dc3545");
                $("input#_nama_ibu_d").css("border-color", "#dc3545");
                $('._nama_ibu_d').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Nama ibu tidak boleh kosong.</li></ul>');
                return;
            }

            $('.submit-continue').css('display', 'none');
            $('.content-continue').css('display', 'block');
        }
    }

    function submitCek(event) {
        if (loadedAll) {
            if (loading) {
                return;
            }

            // $('#form-daftar2').on('submit', function(e) {
            // event.preventDefault();

            const nik = document.getElementsByName('_nik')[0].value;
            const kk = document.getElementsByName('_kk')[0].value;
            // const npsn = document.getElementsByName('_npsn')[0].value;
            // const namaIbu = document.getElementsByName('_nama_ibu')[0].value;

            if (nik.length !== 16) {
                $("input#_nik").css("color", "#dc3545");
                $("input#_nik").css("border-color", "#dc3545");
                $('._nik').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">NIK harus 16 digit.</li></ul>');
                return;
            }
            if (kk.length !== 16) {
                $("input#_kk").css("color", "#dc3545");
                $("input#_kk").css("border-color", "#dc3545");
                $('._kk').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">KK harus 16 digit.</li></ul>');
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
                    $('div.loading-content-card').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    loading = false;
                    // console.log(msg);
                    $('div.loading-content-card').unblock();
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
                    loading = false;
                    // if (data.status === 200 && (data.statusText === "parsererror" || data.statusText === "OK")) {
                    // } else {
                    $('div.loading-content-card').unblock();
                    $('.content-siswa').html('');
                    $('.content-siswa').css('display', 'none');
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                    // }
                }
            })
            // })

        }
    }

    function cancelConfirm(event) {
        $('.btncekdata').css('display', 'block');
        $('.content-siswa').html('');
        $('.content-siswa').css('display', 'none');
    }

    function changeValidation(event) {
        $('.' + event).css('display', 'none');
    };

    function inputFocus(id) {
        const color = $(id).attr('id');
        $(id).removeAttr('style');
        $('.' + color).html('');
    }

    function ambilId(id) {
        return document.getElementById(id);
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/css/select2.min.css">
<style>
    .cardcus {
        box-sizing: border-box;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        box-shadow: 0 0 3px 3px rgba(26, 26, 26, 0.05);
        /*border-radius: 10px;*/
        transition: all 0.3s;
    }

    .cardcus-body {
        padding: 1.25rem;
    }

    .formcus-row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -5px;
        margin-left: -5px;
    }

    .formcus-group {
        margin-bottom: 1rem;
        box-sizing: border-box;
    }

    .formcus-row>.col,
    .formcus-row>[class*="col-"] {
        padding-right: 5px;
        padding-left: 5px;
    }

    label {
        display: inline-block;
        margin-bottom: .5rem;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }

    button,
    input {
        overflow: visible;
    }

    .formcus-control {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .formcus-control-group {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: listbox;
    }

    .inputss-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }

    .inputss-group {
        box-shadow: 0 3px 2px rgba(233, 236, 239, .05);
        border-radius: .25rem;
        transition: all .15s ease-in-out;
    }

    .inputss-group>.custom-file,
    .inputss-group>.custom-select,
    .inputss-group>.formcus-control,
    .inputss-group>.formcus-control-plaintext {
        position: relative;
        flex: 1 1 0%;
        min-width: 0;
        border: none;
        margin-bottom: 0;
    }

    .inputss-group .formcus-control {
        box-shadow: none;
    }

    .inputss-group>.custom-select:not(:last-child),
    .inputss-group>.formcus-control:not(:last-child) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .inputss-group-merge .formcus-control:not(:last-child) {
        border-right: 0;
        padding-right: 0;
    }

    .inputss-group-append,
    .inputss-group-prepend {
        display: flex;
    }

    .inputss-group-append {
        margin-left: 15px;
        margin-right: 15px;
        justify-content: center;
        justify-items: center;
        align-items: center;
    }
</style>
<?= $this->endSection(); ?>