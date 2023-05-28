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
    <link type="text/css" href="<?= base_url('new-assets'); ?>/assets/front/css/front.css" rel="stylesheet" />
    <title><?= getenv('web.meta.site.title') ? getenv('web.meta.site.title') : 'LAYANAN' ?></title>
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/css/select2.min.css">
    <style>
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
    </style>
    <script>
        const BASE_URL = "<?= base_url() ?>";
    </script>
</head>

<body>

    <section class="vh-100 bg-soft d-flex align-items-center">
        <div class="container content-loading">
            <div class="row justify-content-center form-bg-image" data-background="<?= base_url('new-assets') ?>/assets/front/assets/img/illustrations/signin.svg">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="signin-inner mt-3 mt-lg-0 bg-white shadow-soft border border-light rounded p-4 p-lg-5 w-100 fmxw-500" id="panel">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-3 h3">Daftar Ke Layanan</h1>
                            <p class="text-gray">Silahkan daftar untuk menggunakan semua layanan.</p>
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
                        <form class="mt-5">
                            <div class="form-group _jenis-block">
                                <label for="_jenis" class="form-control-label">Daftar Sebagai</label>
                                <select class="form-control prov" onChange="onChangeJenis(this)" name="_jenis" id="_jenis" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    <option value="">-- Daftar Sebagai --</option>
                                    <option value="umum">UMUM</option>
                                    <option value="dinas">DINAS</option>
                                    <option value="sekolah">SEKOLAH</option>
                                </select>
                                <div class="help-block _prov"></div>
                            </div>
                            <div class="form-group _prov-block">
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
                            <div class="form-group _kab-block">
                                <label for="_prov" class="form-control-label">Pilih Kabupaten</label>
                                <select class="form-control kab" onChange="onChangeKabupaten(this)" name="_kab" id="_kab" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    <option value="">-- Pilih Kabupaten --</option>
                                </select>
                                <div class="help-block _kab"></div>
                            </div>
                            <div class="form-group _kec-block" id="_kec-content" style="display: none;">
                                <label for="_kec" class="form-control-label">Pilih Kecamatan</label>
                                <select class="form-control kec" onChange="onChangeKecamatan(this)" name="_kec" id="_kec" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                </select>
                                <div class="help-block _kec"></div>
                            </div>
                            <div class="form-group _sekolah-block" id="_sekolah-content" style="display: none;">
                                <label for="_sekolah" class="form-control-label">Pilih Sekolah</label>
                                <select class="form-control sekolah" onChange="onChangeSekolah(this)" name="_sekolah" id="_sekolah" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                    <option value="">-- Pilih Sekolah --</option>
                                </select>
                                <div class="help-block _sekolah"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="email" onFocus="inputFocus(this);" id="_email" name="_email" class="form-control email" id="input-email" placeholder="Masukkan email" required>
                                </div>
                                <div class="help-block _email"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                    </div>
                                    <input class="form-control password" onFocus="inputFocus(this);" id="_password" name="_password" placeholder="Password" type="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="showPassword()"><i class="far fa-eye"></i></span>
                                    </div>
                                </div>
                                <div class="help-block _password"></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                    </div>
                                    <input class="form-control repassword" onFocus="inputFocus(this);" id="_repassword" name="_repasswrod" placeholder="Ulangi Password" type="password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="showPassword()"><i class="far fa-eye"></i></span>
                                    </div>
                                </div>
                                <div class="help-block _repassword"></div>
                                <div class="d-block d-sm-flex justify-content-between align-items-center mt-2">
                                    <div class="form-group form-check mt-3">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label form-check-sign-white" for="exampleCheck1">Remember me</label>
                                    </div>
                                    <div>
                                        <a href="<?= base_url('auth/lupapassword') ?>" class="small text-right">Lupa Password?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-block btn-primary">DAFTAR</button>
                            </div>
                        </form>
                        <div class="mt-3 mb-4 text-center">
                            <span class="font-weight-normal">atau Daftar Dengan</span>
                        </div>
                        <div class="btn-wrapper my-4 text-center">
                            <?php if (isset($loginButton)) { ?>
                                <a class="btn mr-2 btn-block btn-google" href="<?= $loginButton ?>">
                                    <span class="btn-inner-icon"><i class="fab fa-google"></i>oogle</span>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
                            <span class="font-weight-normal">Sudah punya akun?
                                <a href="./sign-up-illustration.html" class="font-weight-bold">Login Sekarang</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('new-assets') ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/headroom.js/dist/headroom.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/onscreen/dist/on-screen.umd.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/nouislider/distribute/nouislider.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/jarallax/dist/jarallax.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/countup.js/dist/countUp.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/jquery-countdown/dist/jquery.countdown.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/prismjs/prism.js"></script>

    <script src="<?= base_url('new-assets') ?>/assets/front/assets/js/front.js"></script>

    <script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            initSelect2Panel('_prov', 'panel');
            initSelect2Panel('_kab', 'panel');
        });

        function onChangeJenis(event) {
            if (event.value !== "") {
                const color = $(event).attr('name');
                $(event).removeAttr('style');
                $('.' + color).html('');

                if (event.value === "dinas") {
                    ambilId('_kec-content').css("display", "none");
                    ambilId('_sekolah-content').css("display", "none");
                } else if (event.value === "sekolah") {
                    ambilId('_kec-content').css("display", "block");
                    ambilId('_sekolah-content').css("display", "block");
                } else if (event.value === "umum") {
                    ambilId('_kec-content').css("display", "block");
                    ambilId('_sekolah-content').css("display", "none");
                } else {
                    ambilId('_kec-content').css("display", "block");
                    ambilId('_sekolah-content').css("display", "none");
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
    </script>
</body>

</html>