<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/font-awesome-all.css" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/flaticon.css" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/owl.css" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/animate.css" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/imagebg.css" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/style.css" rel="stylesheet">
    <link href="<?= base_url('themes') ?>/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">

    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>
    <?= $this->renderSection('scriptTop'); ?>

</head>

<body class="boxed_wrapper loading-proses">
    <!-- <div class="preloader"></div> -->
    <?= $this->renderSection('content'); ?>

    <?= $this->include('new-web/template/footer') ?>

    <?= $this->include('new-web/template/login') ?>
    <?= $this->include('new-web/template/register') ?>
    <script src="<?= base_url('themes') ?>/js/jquery.js"></script>
    <script src="<?= base_url('themes') ?>/js/popper.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/owl.js"></script>
    <script src="<?= base_url('themes') ?>/js/wow.js"></script>
    <script src="<?= base_url('themes') ?>/js/validation.js"></script>
    <script src="<?= base_url('themes') ?>/js/jquery.fancybox.js"></script>
    <script src="<?= base_url('themes') ?>/js/appear.js"></script>
    <script src="<?= base_url('themes') ?>/js/circle-progress.js"></script>
    <script src="<?= base_url('themes') ?>/js/jquery.countTo.js"></script>
    <script src="<?= base_url('themes') ?>/js/scrollbar.js"></script>
    <script src="<?= base_url('themes') ?>/js/jquery.paroller.min.js"></script>
    <script src="<?= base_url('themes') ?>/js/tilt.jquery.js"></script>

    <script src="<?= base_url('new-assets/assets'); ?>/js/jquery-block-ui.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <?= $this->renderSection('scriptBottom'); ?>
    <script src="<?= base_url('themes') ?>/js/script.js"></script>

</body>

</html>