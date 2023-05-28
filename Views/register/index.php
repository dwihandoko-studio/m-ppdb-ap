<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="title" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>">
    <meta name="author" content="<?= getenv('web.meta.author') ? getenv('web.meta.author') :  'BJ-Hands (handokowae.my.id)' ?>" />
    <link rel="canonical" href="<?= getenv('web.meta.url.author') ? getenv('web.meta.url.author') :  'https://handokowae.my.id' ?>" />
    <meta name="keywords" content="<?= getenv('web.meta.keyword') ? getenv('web.meta.keyword') :  'LAYANAN' ?>" />
    <meta name="description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta itemprop="name" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <meta itemprop="description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta itemprop="image" content="<?= base_url('favicon/android-icon-192x192.png'); ?>" />
    <meta name="twitter:card" content="<?= getenv('web.meta.twitter.card') ? getenv('web.meta.twitter.card') : 'product' ?>" />
    <meta name="twitter:site" content="<?= getenv('web.meta.twitter.url') ? getenv('web.meta.twitter.url') : '@' ?>" />
    <meta name="twitter:title" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'Handokowae.my.id' ?>" />
    <meta name="twitter:description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta name="twitter:creator" content="<?= getenv('web.meta.twitter.url') ? getenv('web.meta.twitter.url') : '@' ?>" />
    <meta name="twitter:image" content="<?= base_url('favicon/android-icon-192x192.png'); ?>" />
    <!-- <meta property="fb:app_id" content="<?= getenv('web.meta.fb.id') ? getenv('web.meta.fb.id') : '1586795878015101' ?>"> -->
    <meta property="og:title" content="<?= getenv('web.meta.url.author') ? getenv('web.meta.url.author') : 'Handokowae.my.id' ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:image" content="<?= base_url('favicon/android-icon-192x192.png'); ?>" />
    <meta property="og:description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta property="og:site_name" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('favicon/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('favicon/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('favicon/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('favicon/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('favicon/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('favicon/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('favicon/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('favicon/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('favicon/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('favicon/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?= base_url('favicon/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url('favicon/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">
    <link type="text/css" href="<?= base_url('new-assets'); ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/nucleo/css/nucleo.css" type="text/css" />
    <link type="text/css" href="<?= base_url('new-assets'); ?>/assets/vendor/prismjs/themes/prism.css" rel="stylesheet" />
    <link type="text/css" href="<?= base_url('new-assets'); ?>/assets/css/dashboard.css" rel="stylesheet" />
    <title><?= getenv('web.meta.site.title') ? getenv('web.meta.site.title') : 'LAYANAN' ?></title>
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/css/select2.min.css">
    <!-- <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 42px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 42px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }
    </style> -->
    <script>
        const BASE_URL = "<?= base_url() ?>";
    </script>
</head>

<body class="bg-white g-sidenav-hidden">

    <div class="main-content" id="panel">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-6">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Daftar Ke Layanan</h1>
                            <p class="text-lead text-white">Silahkan daftar untuk menggunakan semua layanan.</p>
                            <?php if (isset($errorLogin)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Peringantan!</strong> <?= $errorLogin ?></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100"><svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                </svg></div>
        </div><!-- Page content -->
        <div class="container mt--9 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary border border-soft">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form">
                                <div class="form-group _jenis-block">
                                    <label for="_jenis" class="form-control-label">Daftar Sebagai</label>
                                    <select class="form-control prov" onChange="onChangeJenis(this)" name="_jenis" id="_jenis" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                        <option value="">-- Daftar Sebagai --</option>
                                        <option value="umum">UMUM</option>
                                        <option value="dinas">DINAS</option>
                                        <option value="sekolah">SEKOLAH</option>
                                    </select>
                                    <div class="help-block _jenis"></div>
                                </div>
                                <div class="form-group _prov-block _prov-content" id="_prov-content" style="display: none;">
                                    <label for="_prov" class="form-control-label">Pilih Provinsi</label>
                                    <select class="form-control prov" onChange="onChangeProvinsi(this)" name="_prov" id="_prov" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php if (isset($provinsis)) {
                                            if (count($provinsis) > 0) {
                                                foreach ($provinsis as $key => $value) { ?>
                                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                        <?php }
                                            }
                                        } ?>
                                    </select>
                                    <div class="help-block _prov"></div>
                                </div>
                                <div class="form-group _kab-block _kab-content" id="_kab-content" style="display: none;">
                                    <label for="_kab" class="form-control-label">Pilih Kabupaten</label>
                                    <select class="form-control kab" onChange="onChangeKabupaten(this)" name="_kab" id="_kab" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                        <option value="">-- Pilih Kabupaten --</option>
                                    </select>
                                    <div class="help-block _kab"></div>
                                </div>
                                <div class="form-group _kec-block _kec-content" id="_kec-content" style="display: none;">
                                    <label for="_kec" class="form-control-label">Pilih Kecamatan</label>
                                    <select class="form-control kec" onChange="onChangeKecamatan(this)" name="_kec" id="_kec" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                    <div class="help-block _kec"></div>
                                </div>
                                <div class="form-group _kel-block _kel-content" id="_kel-content" style="display: none;">
                                    <label for="_kel" class="form-control-label">Pilih Kelurahan</label>
                                    <select class="form-control kel" onChange="onChangeKelurahan(this)" name="_kel" id="_kel" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                        <option value="">-- Pilih Kelurahan --</option>
                                    </select>
                                    <div class="help-block _kel"></div>
                                </div>
                                <div class="form-group _sekolah-block _sekolah-content" id="_sekolah-content" style="display: none;">
                                    <label for="_sekolah" class="form-control-label">Pilih Sekolah</label>
                                    <select class="form-control sekolah" onChange="onChangeSekolah(this)" name="_sekolah" id="_sekolah" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                        <option value="">-- Pilih Sekolah --</option>
                                    </select>
                                    <div class="help-block _sekolah"></div>
                                </div>
                                <div class="form-group _nama-block _nama-content" id="_nama-content" style="display: none;">
                                    <div class="input-group input-group-merge input-group-alternative mb-3 nama">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input id="_nama" name="_nama" onFocus="inputFocus(this);" class="form-control nama" placeholder="Nama" type="text">
                                    </div>
                                    <div class="help-block _nama"></div>
                                </div>
                                <div class="form-group _email-block _email-content" id="_email-content" style="display: none;">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="ni ni-email-83"></i>
                                            </span>
                                        </div>
                                        <input type="email" onFocus="inputFocus(this);" id="_email" name="_email" class="form-control email" placeholder="Masukkan email" required>
                                    </div>
                                    <div class="help-block _email"></div>
                                </div>
                                <div class="form-group _nohp-block _nohp-content" id="_nohp-content" style="display: none;">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>
                                        <input type="phone" onFocus="inputFocus(this);" id="_nohp" name="_nohp" class="form-control nohp" placeholder="Masukkan no handphone" required>
                                    </div>
                                    <div class="help-block _nohp"></div>
                                </div>
                                <div class="form-group _password-block _password-content" id="_password-content" style="display: none;">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="ni ni-lock-circle-open"></i>
                                            </span>
                                        </div>
                                        <input class="form-control password" onFocus="inputFocus(this);" id="_password" name="_password" placeholder="Password" type="password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text show-password" onclick="showPassword()"><i class="far fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="help-block _password"></div>
                                </div>
                                <div class="form-group _repassword-block _repassword-content" id="_repassword-content" style="display: none;">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="ni ni-lock-circle-open"></i>
                                            </span>
                                        </div>
                                        <input class="form-control repassword" onFocus="inputFocus(this);" id="_repassword" name="_repassword" placeholder="Password" type="password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text show-password" onclick="showPassword()"><i class="far fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="help-block _repassword"></div>
                                </div>
                                <!-- <div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div> -->
                                <div class="row my-4">
                                    <!-- <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                        <label class="custom-control-label" for="customCheckRegister">
                                            <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                                        </label>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input class="custom-control-input" onchange="setujui(this)" name="_setujui" id="_setujui" type="checkbox">
                                            <label class="custom-control-label" for="_setujui">
                                                <span class="text-muted">Saya menyetujui dengan <a href="#!">Syarat dan Ketentuan yang berlaku.</a></span>
                                            </label>
                                        </div>
                                        <div class="help-block _setujui"></div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-block btn-primary mt-4 aksi-daftar" onclick="aksiDaftar()">D A F T A R</button>
                                </div>
                            </form>
                            <div class="mt-3 mb-4 text-center">
                                <span class="font-weight-normal">atau Daftar Dengan</span>
                            </div>
                            <div class="btn-wrapper my-4 text-center">
                                <?php if (isset($loginButton)) { ?>
                                    <a class="btn mr-2 btn-block btn-danger btn-google" href="<?= $loginButton ?>">
                                        <span class="btn-inner-icon"><i class="fab fa-google"></i>oogle</span>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
                                <span class="font-weight-normal">Sudah punya akun?
                                    <a href="<?= base_url('auth') ?>" class="font-weight-bold">Login Sekarang</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('new-assets') ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script><!-- Argon JS -->
    <script src="<?= base_url('new-assets') ?>/assets/js/dashboard.js?v=1.2.0"></script><!-- Demo JS - remove this in your project -->
    <script src="<?= base_url('new-assets') ?>/assets/js/demo.min.js"></script>

    <script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
    <script>
        let jenis = "";
        let loading = false;
        $(document).ready(function() {
            initSelect2Panel('_jenis', 'panel');
            initSelect2Panel('_prov', 'panel');
            initSelect2Panel('_kab', 'panel');
            initSelect2Panel('_kec', 'panel');
            initSelect2Panel('_kel', 'panel');
            initSelect2Panel('_sekolah', 'panel');
        });

        function aksiDaftar() {
            if (!loading) {
                let setuju = "0";
                if ($('#_setujui').is(":checked")) {
                    status = "1";
                } else {
                    status = "0";
                }

                if (status === "1") {
                    if (jenis === "") {
                        $("select#_jenis").css("color", "#dc3545");
                        $("select#_jenis").css("border-color", "#dc3545");
                        $('._jenis').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Silahkan pilih jenis register terlebih dahulu.</li></ul>');
                        return;
                    }
                    const nama = document.getElementsByName('_nama')[0].value;
                    const prov = document.getElementsByName('_prov')[0].value;
                    const kab = document.getElementsByName('_kab')[0].value;
                    const kec = document.getElementsByName('_kec')[0].value;
                    const kel = document.getElementsByName('_kel')[0].value;
                    const sekolah = document.getElementsByName('_sekolah')[0].value;
                    const email = document.getElementsByName('_email')[0].value;
                    const nohp = document.getElementsByName('_nohp')[0].value;
                    const password = document.getElementsByName('_password')[0].value;
                    const repassword = document.getElementsByName('_repassword')[0].value;

                    if (nama === "") {
                        $("input#_nama").css("color", "#dc3545");
                        $("input#_nama").css("border-color", "#dc3545");
                        $('._nama').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
                        return;
                    }
                    if (email === "") {
                        $("input#_email").css("color", "#dc3545");
                        $("input#_email").css("border-color", "#dc3545");
                        $('._email').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
                        return;
                    }
                    if (nohp === "") {
                        $("input#_nohp").css("color", "#dc3545");
                        $("input#_nohp").css("border-color", "#dc3545");
                        $('._nohp').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
                        return;
                    }
                    if (password === "") {
                        $("input#_password").css("color", "#dc3545");
                        $("input#_password").css("border-color", "#dc3545");
                        $('._password').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
                        return;
                    }
                    if (repassword === "") {
                        $("input#_repassword").css("color", "#dc3545");
                        $("input#_repassword").css("border-color", "#dc3545");
                        $('._repassword').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
                        return;
                    }

                    if (prov === "") {
                        $("select#_prov").css("color", "#dc3545");
                        $("select#_prov").css("border-color", "#dc3545");
                        $('._prov').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Silahkan pilih provinsi terlebih dahulu.</li></ul>');
                        return;
                    }
                    if (kab === "") {
                        $("select#_kab").css("color", "#dc3545");
                        $("select#_kab").css("border-color", "#dc3545");
                        $('._kab').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Silahkan pilih kabupaten terlebih dahulu.</li></ul>');
                        return;
                    }

                    if (jenis === "umum") {
                        if (kec === "") {
                            $("select#_kec").css("color", "#dc3545");
                            $("select#_kec").css("border-color", "#dc3545");
                            $('._kec').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Silahkan pilih kecamatan terlebih dahulu.</li></ul>');
                            return;
                        }
                        if (kel === "") {
                            $("select#_kel").css("color", "#dc3545");
                            $("select#_kel").css("border-color", "#dc3545");
                            $('._kel').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Silahkan pilih kelurahan terlebih dahulu.</li></ul>');
                            return;
                        }
                    }
                    if (jenis === "sekolah") {
                        if (kec === "") {
                            $("select#_kec").css("color", "#dc3545");
                            $("select#_kec").css("border-color", "#dc3545");
                            $('._kec').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Silahkan pilih kecamatan terlebih dahulu.</li></ul>');
                            return;
                        }
                        if (sekolah === "") {
                            $("select#_sekolah").css("color", "#dc3545");
                            $("select#_sekolah").css("border-color", "#dc3545");
                            $('._sekolah').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Silahkan pilih sekolah terlebih dahulu.</li></ul>');
                            return;
                        }
                    }

                    $.ajax({
                        url: BASE_URL + '/auth/aksiregister',
                        type: 'POST',
                        data: {
                            jenis: jenis,
                            prov: prov,
                            kab: kab,
                            kec: kec,
                            kel: kel,
                            sekolah: sekolah,
                            nama: nama,
                            email: email,
                            nohp: nohp,
                            password: password,
                            repassword: repassword,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            loading = true;
                            $('div.main-content').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(msg) {
                            loading = false;
                            // console.log(msg);
                            $('div.main-content').unblock();
                            if (msg.code !== 200) {
                                Swal.fire(
                                    'PERINGATAN!',
                                    msg.message,
                                    'warning'
                                );
                            } else {
                                Swal.fire(
                                    'BERHASIL!',
                                    msg.message,
                                    'success'
                                ).then((valRes) => {
                                    document.location.href = "<?= base_url(); ?>";
                                })
                            }
                        },
                        error: function(data) {
                            loading = false;
                            console.log(data);
                            $('div.main-content').unblock();
                            Swal.fire(
                                'GAGAL!',
                                "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                                'warning'
                            );
                        }
                    })

                } else {
                    $('._setujui').html('<ul role="alert" style="color: #dc3545; list-style: none;"><li style="color: #dc3545;">Silahkan setujui syarat dan ketentuan yang berlaku.</li></ul>');
                }
            } else {
                console.log('error');
            }
        }

        function onChangeJenis(event) {
            if (event.value !== "") {
                jenis = event.value;
                const color = $(event).attr('name');
                $(event).removeAttr('style');
                $('.' + color).html('');

                $("._prov-content").css("display", "block");
                $("._kab-content").css("display", "block");
                $("._nama-content").css("display", "block");
                $("._email-content").css("display", "block");
                $("._nohp-content").css("display", "block");
                $("._password-content").css("display", "block");
                $("._repassword-content").css("display", "block");

                if (event.value === "dinas") {
                    $('.kec').html('<option value="" selected>--Pilih Kecamatan--</option>');
                    $("._kec-content").css("display", "none");
                    $("._kel-content").css("display", "none");
                    $('.sekolah').html('<option value="" selected>--Pilih Sekolah--</option>');
                    $("._sekolah-content").css("display", "none");
                } else if (event.value === "sekolah") {
                    $("._kec-content").css("display", "block");
                    $("._kel-content").css("display", "none");
                    $('.kec').html('<option value="" selected>--Pilih Kecamatan--</option>');
                    $("._sekolah-content").css("display", "block");
                    $('.sekolah').html('<option value="" selected>--Pilih Sekolah--</option>');
                } else if (event.value === "umum") {
                    $("._kec-content").css("display", "block");
                    $('.kec').html('<option value="" selected>--Pilih Kecamatan--</option>');
                    $("._kel-content").css("display", "block");
                    $('.kel').html('<option value="" selected>--Pilih Kelurahan--</option>');
                    $("._sekolah-content").css("display", "none");
                    $('.sekolah').html('<option value="" selected>--Pilih Sekolah--</option>');
                } else {
                    $("._kec-content").css("display", "block");
                    $('.kec').html('<option value="" selected>--Pilih Kecamatan--</option>');
                    $("._kel-content").css("display", "block");
                    $('.kel').html('<option value="" selected>--Pilih Kelurahan--</option>');
                    $("._sekolah-content").css("display", "none");
                    $('.sekolah').html('<option value="" selected>--Pilih Sekolah--</option>');
                }
            }
        }

        function onChangeKelurahan(event) {
            if (event.value !== "") {
                const color = $(event).attr('name');
                $(event).removeAttr('style');
                $('.' + color).html('');
                // $( "label#"+color ).css("color", "#555");

            }
        }

        function onChangeSekolah(event) {
            if (event.value !== "") {
                const color = $(event).attr('name');
                $(event).removeAttr('style');
                $('.' + color).html('');
                // $( "label#"+color ).css("color", "#555");

            }
        }

        function onChangeKecamatan(event) {
            if (event.value !== "") {
                const color = $(event).attr('name');
                $(event).removeAttr('style');
                $('.' + color).html('');
                // $( "label#"+color ).css("color", "#555");
                if (jenis === "sekolah") {

                    $.ajax({
                        url: BASE_URL + '/auth/getSekolah',
                        type: 'POST',
                        data: {
                            id: event.value,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            $('.sekolah').html('<option value="" selected>--Pilih Sekolah--</option>');
                            // $('.filter-kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                            // $('.filter-kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                            $('div._sekolah-block').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(msg) {
                            // console.log(msg);
                            $('div._sekolah-block').unblock();
                            // const msg = JSON.parse(resMsg);
                            // const msg = JSON.parse(JSON.stringify(resMsg));
                            if (msg.code == 200) {
                                let html = "";
                                html += '<option value="">--Pilih Sekolah--</option>';
                                if (msg.data.length > 0) {
                                    for (let step = 0; step < msg.data.length; step++) {
                                        html += '<option value="';
                                        html += msg.data[step].id;
                                        html += '">';
                                        html += msg.data[step].npsn;
                                        html += ' - ';
                                        html += msg.data[step].nama;
                                        html += '</option>';
                                    }

                                }

                                $('.sekolah').html(html);
                            }
                        },
                        error: function(data) {
                            console.log(data);
                            $('div._sekolah-block').unblock();
                        }
                    })
                }

                if (jenis === "umum") {
                    $.ajax({
                        url: BASE_URL + '/auth/getKelurahan',
                        type: 'POST',
                        data: {
                            id: event.value,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            $('.kel').html('<option value="" selected>--Pilih Kelurahan--</option>');
                            // $('.filter-kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                            // $('.filter-kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                            $('div._kel-block').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(msg) {
                            // console.log(msg);
                            $('div._kel-block').unblock();
                            // const msg = JSON.parse(resMsg);
                            // const msg = JSON.parse(JSON.stringify(resMsg));
                            if (msg.code == 200) {
                                let html = "";
                                html += '<option value="">--Pilih Kelurahan--</option>';
                                if (msg.data.length > 0) {
                                    for (let step = 0; step < msg.data.length; step++) {
                                        html += '<option value="';
                                        html += msg.data[step].id;
                                        html += '">';
                                        html += msg.data[step].nama;
                                        html += '</option>';
                                    }

                                }

                                $('.kel').html(html);
                            }
                        },
                        error: function(data) {
                            console.log(data);
                            $('div._kel-block').unblock();
                        }
                    })
                }
            }
        }

        function onChangeKabupaten(event) {
            if (event.value !== "") {
                const color = $(event).attr('name');
                $(event).removeAttr('style');
                $('.' + color).html('');
                // $( "label#"+color ).css("color", "#555");
                if (jenis === "umum" || jenis === "sekolah") {

                    $.ajax({
                        url: BASE_URL + '/auth/getKecamatan',
                        type: 'POST',
                        data: {
                            id: event.value,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            $('.kec').html('<option value="" selected>--Pilih Kecamatan--</option>');
                            if (jenis === "sekolah") {
                                $('.sekolah').html('<option value="" selected>--Pilih Sekolah--</option>');
                            }
                            if (jenis === "umum") {
                                $('.kel').html('<option value="" selected>--Pilih Kelurahan--</option>');
                            }
                            // $('.filter-kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                            // $('.filter-kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                            $('div._kec-block').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(msg) {
                            // console.log(msg);
                            $('div._kec-block').unblock();
                            // const msg = JSON.parse(resMsg);
                            // const msg = JSON.parse(JSON.stringify(resMsg));
                            if (msg.code == 200) {
                                let html = "";
                                html += '<option value="">--Pilih Kecamatan--</option>';
                                if (msg.data.length > 0) {
                                    for (let step = 0; step < msg.data.length; step++) {
                                        html += '<option value="';
                                        html += msg.data[step].id;
                                        html += '">';
                                        html += msg.data[step].nama;
                                        html += '</option>';
                                    }

                                }

                                $('.kec').html(html);
                            }
                        },
                        error: function(data) {
                            console.log(data);
                            $('div._kec-block').unblock();
                        }
                    })
                }
            }
        }

        function onChangeProvinsi(event) {
            if (event.value !== "") {
                const color = $(event).attr('name');
                $(event).removeAttr('style');
                $('.' + color).html('');
                // $( "label#"+color ).css("color", "#555");

                $.ajax({
                    url: BASE_URL + '/auth/getKabupaten',
                    type: 'POST',
                    data: {
                        id: event.value,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('.kab').html('<option value="" selected>--Pilih Kabupaten--</option>');
                        $('.kec').html('<option value="" selected>--Pilih Kecamatan--</option>');
                        if (jenis === "umum") {
                            $('.kel').html('<option value="" selected>--Pilih Kelurahan--</option>');
                        }
                        if (jenis === "sekolah") {
                            $('.sekolah').html('<option value="" selected>--Pilih Sekolah--</option>');
                        }
                        // $('.filter-kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                        // $('.filter-kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                        $('div._kab-block').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(msg) {
                        // console.log(msg);
                        $('div._kab-block').unblock();
                        // const msg = JSON.parse(resMsg);
                        // const msg = JSON.parse(JSON.stringify(resMsg));
                        if (msg.code == 200) {
                            let html = "";
                            html += '<option value="">--Pilih Kabupaten--</option>';
                            if (msg.data.length > 0) {
                                for (let step = 0; step < msg.data.length; step++) {
                                    html += '<option value="';
                                    html += msg.data[step].id;
                                    html += '">';
                                    html += msg.data[step].nama;
                                    html += '</option>';
                                }

                            }

                            $('.kab').html(html);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        $('div._kab-block').unblock();
                    }
                })
            }
        }

        function inputFocus(id) {
            $(id).removeAttr('style');
        }

        function setujui(id) {
            $(id).removeAttr('style');
            $('.' + id.name).html('');
        }

        function inputChange(event) {
            console.log(event.value);
            if (event.value === null || (event.value.length > 0 && event.value !== "")) {
                $(event).removeAttr('style');
            } else {
                $(event).css("color", "#dc3545");
                $(event).css("border-color", "#dc3545");
                // $('.nama_instansi').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
            }
        }

        function ambilId(id) {
            return document.getElementById(id);
        }

        function initSelect2Panel(event, lokasi) {
            $('#' + event).select2({
                dropdownParent: "#" + lokasi
            });
        }

        function showPassword(event) {
            let showedPassword = document.getElementsByName('_password')[0];
            let showedRePassword = document.getElementsByName('_repassword')[0];
            if (showedPassword.type === "password") {
                showedPassword.type = "text";
                showedRePassword.type = "text";
                $('.show-password').html('<i class="far fa-eye-slash"></i>');
            } else {
                showedPassword.type = "password";
                showedRePassword.type = "password";
                $('.show-password').html('<i class="far fa-eye"></i>');
            }
        }
    </script>
</body>

</html>