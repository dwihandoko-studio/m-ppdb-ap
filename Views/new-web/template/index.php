<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= (isset($title)) ? $title . ' || ' : '' ?><?= getenv('web.meta.site.title') ? getenv('web.meta.site.title') : 'PPDB ONLINE' ?></title>
    <!-- Favicon -->
    <meta content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" name="description" />
    <meta name="author" content="<?= getenv('web.meta.author') ? getenv('web.meta.author') :  'BJ-Hands (handokowae.my.id)' ?>">
    <meta name="keywords" content="<?= getenv('web.meta.keyword') ? getenv('web.meta.keyword') :  'LAYANAN' ?>">

    <meta property="og:title" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <meta property="og:url" content="<?= getenv('web.meta.url') ? getenv('web.meta.url') : base_url() ?>" />
    <meta property="og:image" content="<?= base_url('favicons/android-icon-192x192.png'); ?>" />
    <meta property="og:description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />

    <meta itemprop="name" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <meta itemprop="description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta itemprop="image" content="<?= base_url('favicons/android-icon-192x192.png'); ?>" />

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

    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/odometer.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/slick.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/animatedheadline.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/aos.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/default.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url('themes') ?>/css/responsive.css">

    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>
    <?= $this->renderSection('scriptTop'); ?>

</head>


<body class="loading-proses">
    <div id="preloader">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>

    <?= $this->include('new-web/template/header') ?>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('new-web/template/footer') ?>

    <script src="<?= base_url('themes') ?>/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/jquery.odometer.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/jquery.appear.js"></script>
    <script src="<?= base_url('themes') ?>/js/gsap.js"></script>
    <script src="<?= base_url('themes') ?>/js/ScrollTrigger.js"></script>
    <script src="<?= base_url('themes') ?>/js/ScrollToPlugin.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/SplitText.js"></script>
    <script src="<?= base_url('themes') ?>/js/gsap-animation.js"></script>
    <script src="<?= base_url('themes') ?>/js/select2.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/slick.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/animatedheadline.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/aos.js"></script>
    <script src="<?= base_url('themes') ?>/js/ajax-form.js"></script>
    <script src="<?= base_url('themes') ?>/js/wow.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/main.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <?= $this->renderSection('scriptBottom'); ?>

</body>

</html>