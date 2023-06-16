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
    <meta itemprop="image" content="<?= base_url('favicons/android-icon-192x192.png'); ?>" />
    <meta name="twitter:card" content="<?= getenv('web.meta.twitter.card') ? getenv('web.meta.twitter.card') : 'product' ?>" />
    <meta name="twitter:site" content="<?= getenv('web.meta.twitter.url') ? getenv('web.meta.twitter.url') : '@' ?>" />
    <meta name="twitter:title" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'Handokowae.my.id' ?>" />
    <meta name="twitter:description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta name="twitter:creator" content="<?= getenv('web.meta.twitter.url') ? getenv('web.meta.twitter.url') : '@' ?>" />
    <meta name="twitter:image" content="<?= base_url('favicons/android-icon-192x192.png'); ?>" />
    <!-- <meta property="fb:app_id" content="<?= getenv('web.meta.fb.id') ? getenv('web.meta.fb.id') : '1586795878015101' ?>"> -->
    <meta property="og:title" content="<?= getenv('web.meta.url.author') ? getenv('web.meta.url.author') : 'Handokowae.my.id' ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:image" content="<?= base_url('favicons/android-icon-192x192.png'); ?>" />
    <meta property="og:description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta property="og:site_name" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('favicons/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('favicons/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('favicons/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('favicons/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('favicons/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('favicons/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('favicons/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('favicons/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicons/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('favicons/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicons/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('favicons/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicons/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?= base_url('favicons/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url('favicons/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">
    <link type="text/css" href="<?= base_url('new-assets'); ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/nucleo/css/nucleo.css" type="text/css" />
    <link type="text/css" href="<?= base_url('new-assets'); ?>/assets/vendor/prismjs/themes/prism.css" rel="stylesheet" />
    <link type="text/css" href="<?= base_url('new-assets'); ?>/assets/front/css/front.css" rel="stylesheet" />
    <title><?= getenv('web.meta.site.title') ? getenv('web.meta.site.title') : 'LAYANAN' ?></title>

    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/css/select2.min.css">
    <script>
        const BASE_URL = "<?= base_url() ?>";
    </script>
</head>

<body>

    <section class="vh-100 bg-soft d-flex align-items-center">
        <div class="container content-loading">
            <div class="row justify-content-center form-bg-image" data-background="<?= base_url('new-assets') ?>/assets/front/assets/img/illustrations/signin.svg">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="signin-inner mt-3 mt-lg-0 bg-white shadow-soft border border-light rounded p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-3 h3">Buat Password Baru PPDB Kab. Lampung Timur</h1>
                            <p class="text-gray">Untuk akun yang terkait dengan <?= $reset->user_id ?>.</p>
                            <?php if (isset($errorLogin)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Peringantan!</strong> <?= $errorLogin ?></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            <?php } ?>
                            <?php if (isset($statuscode)) {
                                if ($statuscode === 200) { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                        <span class="alert-text"><strong>Berhasil!</strong> <?= (isset($message)) ? $message : '-' ?></span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                        <span class="alert-text"><strong>Peringantan!</strong> <?= (isset($message)) ? $message : '-' ?></span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                        <form class="mt-5">
                            <div class="form-group _password-block _password-content" id="_password-content">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" onFocus="inputFocus(this);" id="_password" name="_password" class="form-control password" placeholder="Masukkan kata sandi baru" required>
                                    <input type="hidden" name="_email" value="<?= $reset->user_id ?>">
                                    <input type="hidden" name="_id" value="<?= $reset->id ?>">
                                </div>
                                <div class="help-block _password"></div>
                            </div>
                            <div class="form-group _repassword-block _repassword-content" id="_repassword-content">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" onFocus="inputFocus(this);" id="_repassword" name="_repassword" class="form-control repassword" placeholder="Ulangi kata sandi baru" required>
                                </div>
                                <div class="help-block _repassword"></div>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-block btn-primary" onclick="aksiLogin()">Simpan</button>
                            </div>
                        </form>
                        <!--<div class="mt-3 mb-4 text-center">-->
                        <!--    <span class="font-weight-normal">atau Masuk Dengan</span>-->
                        <!--</div>-->
                        <!--<div class="btn-wrapper my-4 text-center">-->
                        <!--    <?php if (isset($loginButton)) { ?>-->
                        <!--        <a class="btn mr-2 btn-block btn-google" href="<?= $loginButton ?>">-->
                        <!--            <span class="btn-inner-icon"><i class="fab fa-google"></i>oogle</span>-->
                        <!--        </a>-->
                        <!--    <?php } ?>-->
                        <!--</div>-->
                        <!--<div class="d-block d-sm-flex justify-content-center align-items-center mt-4">-->
                        <!--    <span class="font-weight-normal">Belum Daftar?-->
                        <!--        <a href="<?= base_url('auth/register') ?>" class="font-weight-bold">Daftar Sekarang</a>-->
                        <!--    </span>-->
                        <!--</div>-->
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
        let loading = false;

        function aksiLogin() {
            if (!loading) {
                const email = document.getElementsByName('_email')[0].value;
                const pass = document.getElementsByName('_password')[0].value;
                const repass = document.getElementsByName('_repassword')[0].value;
                const id = document.getElementsByName('_id')[0].value;

                if (pass === "") {
                    $("input#_password").css("color", "#dc3545");
                    $("input#_password").css("border-color", "#dc3545");
                    $('._password').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
                    return;
                }
                if (repass === "") {
                    $("input#_repassword").css("color", "#dc3545");
                    $("input#_repassword").css("border-color", "#dc3545");
                    $('._repassword').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
                    return;
                }
                if (repass !== pass) {
                    $("input#_repassword").css("color", "#dc3545");
                    $("input#_repassword").css("border-color", "#dc3545");
                    $('._repassword').html('<ul role="alert" style="color: #dc3545;list-style: none;"><li style="color: #dc3545;">Kata sandi dan ulangi kata sandi tidak sama.</li></ul>');
                    return;
                }

                $.ajax({
                    url: BASE_URL + '/auth/newpassword',
                    type: 'POST',
                    data: {
                        email: email,
                        password: pass,
                        repassword: repass,
                        id: id,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        loading = true;
                        $('div.content-loading').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(msg) {
                        loading = false;
                        // console.log(msg);
                        $('div.content-loading').unblock();
                        if (msg.code != 200) {
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
                                document.location.href = '<?= base_url() ?>';
                            })
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        loading = false;

                        $('div.content-loading').unblock();
                        Swal.fire(
                            'Gagal!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );

                    }
                })

            }
        }

        function inputFocus(id) {
            $(id).removeAttr('style');
        }

        function ambilId(id) {
            return document.getElementById(id);
        }

        function showPassword(event) {
            let showedPassword = document.getElementsByName('_password')[0];
            if (showedPassword.type === "password") {
                showedPassword.type = "text";
                $('.show-password').html('<i class="far fa-eye-slash"></i>');
            } else {
                showedPassword.type = "password";
                $('.show-password').html('<i class="far fa-eye"></i>');
            }
        }
    </script>
</body>

</html>