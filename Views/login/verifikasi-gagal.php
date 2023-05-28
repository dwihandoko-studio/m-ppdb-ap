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
</head>

<body>

    <section class="vh-100 bg-soft d-flex align-items-center">
        <div class="container content-loading">
            <div class="row justify-content-center form-bg-image" data-background="<?= base_url('new-assets') ?>/assets/front/assets/img/illustrations/signin.svg">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="signin-inner mt-3 mt-lg-0 bg-white shadow-soft border border-light rounded p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-3 h3">VERIFIKASI AKUN LAYANAN</h1>
                            <p class="text-gray"><?= (isset($message)) ? $message : '' ?></p>
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

                            <div class="mt-3">
                                <button type="button" id="_via_email" name="_via_email" data-id="<?= isset($id) ? $id : '' ?>" class="btn btn-block btn-primary _via_email">KIRIM ULANG KODE VERIFIKASI</button>
                            </div>
                        </form>
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

    <script>
        $('._via_email').on('click', function() {
            const id = $(this).data('id');

            $.ajax({
                url: base_url + '/auth/sendaktivasi',
                type: 'POST',
                data: {
                    id: id,
                    via: 'email',
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('div.content-loading').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(resMsg) {
                    console.log(resMsg);
                    if (resMsg.code !== 200) {
                        $('div.content-loading').unblock();
                        Swal.fire(
                            'GAGAL!',
                            resMsg.message,
                            'warning'
                        );
                    } else {
                        Swal.fire(
                            'SELAMAT!',
                            resMsg.message,
                            'success'
                        ).then((valRes) => {
                            document.location.href = "<?= base_url(); ?>";
                        })
                    }
                },
                error: function() {
                    $('div.content-loading').unblock();
                    Swal.fire(
                        'Failed!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            });
        });
    </script>
</body>

</html>