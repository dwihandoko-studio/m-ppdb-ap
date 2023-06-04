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
    <div class="preloader"></div>
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

            if (nisn === "") {
                $("input#_nisn").css("color", "#dc3545");
                $("input#_nisn").css("border-color", "#dc3545");
                $('._nisn').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">NISN / NIK tidak boleh kosong.</li></ul>');
                return
            }

            $.ajax({
                url: BASE_URL + '/auth/saveregisschool',
                type: 'POST',
                data: {
                    nisn: nisn,
                    key: keyD,
                    npsn: npsn,
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

    <script src="<?= base_url('themes') ?>/js/script.js"></script>

</body>

</html>