<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" name="description" />
    <meta name="author" content="<?= getenv('web.meta.author') ? getenv('web.meta.author') :  'BJ-Hands (handokowae.my.id)' ?>">
    <meta name="keywords" content="<?= getenv('web.meta.keyword') ? getenv('web.meta.keyword') :  'LAYANAN' ?>">

    <meta property="og:title" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <meta property="og:url" content="<?= getenv('web.meta.url') ? getenv('web.meta.url') : base_url() ?>" />
    <meta property="og:image" content="<?= base_url('faviconslmt/android-icon-192x192.png'); ?>" />
    <meta property="og:description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />

    <meta itemprop="name" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <meta itemprop="description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta itemprop="image" content="<?= base_url('faviconslmt/android-icon-192x192.png'); ?>" />

    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('faviconslmt/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('faviconslmt/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('faviconslmt/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('faviconslmt/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('faviconslmt/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('faviconslmt/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('faviconslmt/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('faviconslmt/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('faviconslmt/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('faviconslmt/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('faviconslmt/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('faviconslmt/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('faviconslmt/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?= base_url('faviconslmt/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url('faviconslmt/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">

    <title><?= (isset($title)) ? $title . ' || ' : '' ?><?= getenv('web.meta.site.title') ? getenv('web.meta.site.title') : 'LAYANAN' ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css" integrity="sha512-8Vtie9oRR62i7vkmVUISvuwOeipGv8Jd+Sur/ORKDD5JiLgTGeBSkI3ISOhc730VGvA5VVQPwKIKlmi+zMZ71w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/fontawesome.min.js" integrity="sha512-PoFg70xtc+rAkD9xsjaZwIMkhkgbl1TkoaRrgucfsct7SVy9KvTj5LtECit+ZjQ3ts+7xWzgfHOGzdolfWEgrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/css/dashboard.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/DataTables/datatables.css" type="text/css">
    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>
    <?= $this->renderSection('scriptTop'); ?>

</head>


<body class="bg-white loading-logout">
    <?= $this->include('templates/main_menu'); ?>
    <?= $this->renderSection('content'); ?>

    <script src="<?= base_url('new-assets'); ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/js/dashboard.js?v=1.2.0"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/js/demo.min.js"></script>
    <?= $this->renderSection('scriptBottom'); ?>
    <script>
        $('.tombol-logout').on('click', function(e) {
            e.preventDefault();
            const href = BASE_URL + "/auth/logout";
            Swal.fire({
                title: 'Apakah anda yakin ingin keluar?',
                text: "Dari Aplikasi ini",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Sign Out!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: href,
                        type: 'GET',
                        contentType: false,
                        cache: false,
                        beforeSend: function() {
                            $('body.loading-logout').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(resMsg) {
                            Swal.fire(
                                'Berhasil!',
                                "Anda berhasil logout.",
                                'success'
                            ).then((valRes) => {
                                document.location.href = BASE_URL + "/web/home";
                            })
                        },
                        error: function() {
                            $('body.loading-logout').unblock();
                            Swal.fire(
                                'Gagal!',
                                "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                                'warning'
                            );
                        }
                    })
                }
            })
        });

        $('.button-ganti-password').on('click', function() {
            const html = '<form id="formGantiPassword" class="form-horizontal form-ganti-password" method="post">' +
                '<div class="modal-body">' +
                '<div class="row col-md-12">' +
                '<div class="col-md-12">' +
                '<div class="form-group old-password-block">' +
                '<label class="form-control-label" for="_old_password">Password Lama</label>' +
                '<input type="password" id="_old_password" name="_old_password" class="form-control" placeholder="Masukkan password lama" onFocus="inputFocus(this);" required>' +
                '<div class="help-block _old_password"></div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-12">' +
                '<div class="form-group new-password-block">' +
                '<label class="form-control-label" for="_new_password">Password Baru</label>' +
                '<input type="password" id="_new_password" name="_new_password" class="form-control" placeholder="Masukkan password baru" onFocus="inputFocus(this);" required>' +
                '<div class="help-block _new_password"></div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-12">' +
                '<div class="form-group retype-new-password-block">' +
                '<label class="form-control-label" for="_retype_new_password">Ulangi Password Baru</label>' +
                '<input type="password" id="_retype_new_password" name="_retype_new_password" class="form-control" placeholder="Masukkan ulangi password baru" onFocus="inputFocus(this);" required>' +
                '<div class="help-block _retype_new_password"></div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Tutup</button>' +
                '<button type="button" class="btn btn-outline-primary simpan-ganti-password">Simpan</button>' +
                '</div>' +
                '</form>';

            $('#documentModalLabel').html('Ganti Password');
            $('.documentBodyModal').html(html);
            $('#documentModal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
        });


        $('#documentModal').on('click', '.simpan-ganti-password', function(e) {
            e.preventDefault();
            const oldPassword = document.getElementsByName('_old_password')[0].value;
            const newPassword = document.getElementsByName('_new_password')[0].value;
            const retypeNewPassword = document.getElementsByName('_retype_new_password')[0].value;

            if (oldPassword === "") {
                $("input#_old_password").css("color", "#dc3545");
                $("input#_old_password").css("border-color", "#dc3545");
                $('._old_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
            }

            if (newPassword === "") {
                $("input#_new_password").css("color", "#dc3545");
                $("input#_new_password").css("border-color", "#dc3545");
                $('._new_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
            }

            if (retypeNewPassword === "") {
                $("input#_retype_new_password").css("color", "#dc3545");
                $("input#_retype_new_password").css("border-color", "#dc3545");
                $('._retype_new_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
            }

            if (oldPassword === "" || newPassword === "" || retypeNewPassword === "") {
                Swal.fire(
                    'Gagal!',
                    "Isian tidak boleh kosong.",
                    'warning'
                );
            } else {

                if (newPassword.length < 6) {
                    $("input#_new_password").css("color", "#dc3545");
                    $("input#_new_password").css("border-color", "#dc3545");
                    $('._new_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Panjang password minimal 6 karakter.</li></ul>');
                }

                if (retypeNewPassword.length < 6) {
                    $("input#_retype_new_password").css("color", "#dc3545");
                    $("input#_retype_new_password").css("border-color", "#dc3545");
                    $('._retype_new_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Panjang password minimal 6 karakter.</li></ul>');
                }

                if (newPassword.length < 6 || retypeNewPassword.length < 6) {} else {
                    if (newPassword !== retypeNewPassword) {
                        $("input#_retype_new_password").css("color", "#dc3545");
                        $("input#_retype_new_password").css("border-color", "#dc3545");
                        $('._retype_new_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Password baru dan ulangi password baru tidak sama.</li></ul>');
                    } else {
                        $.ajax({
                            url: "<?= base_url('peserta/user/gantiPassword') ?>",
                            type: 'POST',
                            data: {
                                oldPassword: oldPassword,
                                newPassword: newPassword,
                                retypeNewPassword: retypeNewPassword
                            },
                            dataType: 'JSON',
                            beforeSend: function() {
                                $('.simpan-ganti-password').attr('disabled', 'disabled');
                                $('div.modal-document-loading').block({
                                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                                });
                            },
                            success: function(msg) {
                                $('.simpan-ganti-password').attr('disabled', false);
                                $('div.modal-document-loading').unblock();
                                if (msg.code != 200) {
                                    // $('.simpan-ganti-password').attr('disabled', false);
                                    // $('div.modal-document-loading').unblock();
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
                                        document.location.href = "<?= current_url(true); ?>";
                                    })
                                }
                            },
                            error: function() {
                                $('.simpan-ganti-password').attr('disabled', false);
                                $('div.modal-document-loading').unblock();
                                Swal.fire(
                                    'Gagal!',
                                    "Trafic sedang penuh, silahkan coba beberapa saat lagi...",
                                    'warning'
                                );
                            }
                        })
                    }
                }
            }
        });
    </script>

</body>

</html>