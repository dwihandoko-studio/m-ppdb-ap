<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?> || SI-UTPG DISDIKBUD KAB. LAMPUNG TENGAH</title>
    <!-- start: META -->
    <meta charset="utf-8" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="description" content="Sistem Informasi Usulan Tunjangan Profesi Guru">
    <meta name="author" content="BJ-Hands (handokowae.my.id)">

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

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?= base_url('assets/adminsb/plugins/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= base_url('assets/adminsb/plugins/node-waves/waves.css'); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?= base_url('assets/adminsb/plugins/animate-css/animate.css'); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?= base_url('assets/adminsb/css/style.css'); ?>" rel="stylesheet">
    <style>
        @media all and (max-width: 1000px) {
            body {
                background-image: url('../assets/background-mobile.jpeg');
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        }

        @media all and (max-height: 600px) {
            body {
                background-image: url('../assets/background-mobile-none.jpeg');
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        }

        @media all and (min-width: 1001px) {
            body {
                background-image: url('../assets/background.jpeg');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        }
    </style>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
             <a href="javascript:void(0);"><b>SI-UTPG</b></a>
            <small>Sistem Informasi Usulan Tunjangan Profesi Guru</small>
            <small>Kab. Lampung Tengah</small>
        </div>
        <!--<div class="card">
            <div class="body">
                
                <div class="alert bg-green alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>SUKSES! </strong> Silahkan cek E-mail anda, jika tidak ada di inbox periksa dibagian Spam.
                </div>
                    
            </div>
        </div>-->
    </div>
    <div class="alert bg-green alert-dismissible" role="alert">
                    <?php if (isset($url)) { ?>
                        <a href="<?=$url?>" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a>
                    <?php } else { ?>
                        <a href="<?=base_url()?>" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a>
                    <?php } ?>
                    <strong>SUKSES! </strong> <?php if(isset($message)) { echo  $message;} else {
                        echo "Silahkan cek E-mail anda, jika tidak ada di inbox periksa dibagian Spam.";
                    } ?>
                </div>
    <script src="<?= base_url('assets/adminsb/plugins/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?= base_url('assets/adminsb/plugins/bootstrap/js/bootstrap.js'); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?= base_url('assets/adminsb/plugins/node-waves/waves.js'); ?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?= base_url('assets/adminsb/plugins/jquery-validation/jquery.validate.js'); ?>"></script>

    <!-- Custom Js -->
    <script src="<?= base_url('assets/adminsb/js/admin.js'); ?>"></script>
    <script src="<?= base_url('assets/adminsb/js/pages/examples/sign-in.js'); ?>"></script>

    <script>

    </script>
</body>

</html>