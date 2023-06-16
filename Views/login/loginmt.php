<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="description" content="Sistem Informasi Usulan Tunjangan Profesi Guru">
    <meta name="author" content="BJ-Hands (handokowae.my.id)">

    <meta property="og:title" content="PPDB KAB. LAMPUNG TIMUR" />
    <meta property="og:url" content="https://si-utpg.lampungtengahkab.go.id" />
    <meta property="og:image" content="<?= base_url('favicon/android-icon-192x192.png'); ?>" />
    <meta property="og:description" content="Aplikasi untuk pengusulan Tunjangan Profesi Guru." />

    <meta itemprop="name" content="SI-UTPG DISDIKBUD KAB. LAMPUNG TIMUR" />
    <meta itemprop="description" content="Aplikasi untuk pengusulan Tunjangan Profesi Guru." />
    <meta itemprop="image" content="<?= base_url('favicon/android-icon-192x192.png'); ?>" />

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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('new-assets/login') ?>/fonts,_icomoon,_style.css+css,_owl.carousel.min.css+css,_bootstrap.min.css+css,_style.css.pagespeed.cc.Gajl4v2LrE.css" />
    <link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <title><?= $title; ?></title>
    <script>
        let base_url = '<?= base_url() ?>';
    </script>
    <link rel="stylesheet" href="<?= base_url(); ?>/new-assets/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
</head>

<body>
    <div class="content content-loading">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= base_url('new-assets/login') ?>/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>LOGIN UTPG</h3>
                                <p class="mb-4">Aplikasi Untuk Pengusulan Tunjangan Profesi Guru.</p>
                            </div>
                            <form action="<?= base_url('auth'); ?>" method="post">
                                <div class="form-group first username-block">
                                    <label for="_username">Username</label>
                                    <input type="text" class="form-control username" id="_username" name="_username" onfocusin="inputFocus(this);" required />
                                    <div class="help-block _username" style="display: none;"></div>
                                </div>
                                <div class="form-group last mb-4 password-block">
                                    <label for="_password">Password</label>
                                    <input type="password" class="form-control password" id="_password" name="_password" onfocusin="inputFocus(this);" required />
                                    <div class="help-block _password" style="display: none;"></div>
                                </div>
                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">&nbsp;</span>
                                        <!--    <input type="checkbox" checked />-->
                                        <!--    <div class="control__indicator"></div>-->
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                                </div>
                                <button type="button" id="action-masuk" class="btn btn-block btn-primary action-masuk">MASUK</button>
                                <!--<span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>-->
                                <!--<div class="social-login">-->
                                <!--    <a href="#" class="facebook">-->
                                <!--        <span class="icon-facebook mr-3"></span>-->
                                <!--    </a>-->
                                <!--    <a href="#" class="twitter">-->
                                <!--        <span class="icon-twitter mr-3"></span>-->
                                <!--    </a>-->
                                <!--    <a href="#" class="google">-->
                                <!--        <span class="icon-google mr-3"></span>-->
                                <!--    </a>-->
                                <!--</div>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('new-assets/login') ?>/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('new-assets/login') ?>/popper.min.js+bootstrap.min.js+main.js.pagespeed.jc.9rL6_qf-nt.js"></script>
    <script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
    <script src="<?= base_url(); ?>/new-assets/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script>
        eval(mod_pagespeed_$$cYUBAGVu);
    </script>
    <script>
        eval(mod_pagespeed_MR4O_w3mta);
    </script>
    <script>
        eval(mod_pagespeed_DPOuBfjpPE);
    </script>
    <script>
        function changeValidation(event) {
            $('.' + event).css('display', 'none');
        };

        function inputFocus(id) {
            // $(id.name).removeAttr('style');
            $('.' + id.name).css('display', 'none');
        }

        // function inputChange(event) {
        //     console.log(event.value);
        //     if(event.value === null || (event.value.length > 0 && event.value !== "")) {
        //         $(event).removeAttr('style');
        //     } else {
        //         $(event).css("color", "#dc3545");
        //         $(event).css("border-color", "#dc3545");
        //         // $('.nama_instansi').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        //     }
        // }

        function ambilId(id) {
            return document.getElementById(id);
        }

        $('#action-masuk').on('click', function(e) {
            e.preventDefault();
            const username = document.getElementsByName('_username')[0].value;
            const password = document.getElementsByName('_password')[0].value;

            if (username === "") {
                // $( "input#_username" ).css("color", "#dc3545");
                // $( "input#_username" ).css("border-color", "#dc3545");
                $('._username').html('<ul role="alert" style="color: #dc3545; list-style-type: none; margin-left: -40px;"><li style="color: #dc3545; display: list-item; text-align: -webkit-match-parent; list-style:none;font-size:12px;">Username tidak boleh kosong.</li></ul>');
                $('._username').css('display', 'block');
                return;
            }

            if (password === "") {
                // $( "input#_password" ).css("color", "#dc3545");
                // $( "input#_password" ).css("border-color", "#dc3545");
                $('._password').html('<ul role="alert" style="color: #dc3545; list-style-type: none; margin-left: -40px;"><li style="color: #dc3545; display: list-item; text-align: -webkit-match-parent; list-style:none;font-size:12px;">Password tidak boleh kosong.</li></ul>');
                $('._password').css('display', 'block');
                return;
            }

            if (password.length < 6) {
                // $( "input#_password" ).css("color", "#dc3545");
                // $( "input#_password" ).css("border-color", "#dc3545");
                $('._password').html('<ul role="alert" style="color: #dc3545; list-style-type: none; margin-left: -40px;"><li style="color: #dc3545; display: list-item; text-align: -webkit-match-parent; list-style:none;font-size:12px;">Panjang Password minimal 6 karakter.</li></ul>');
                $('._password').css('display', 'block');
                return;
            }

            $.ajax({
                url: base_url + '/auth/login',
                type: 'POST',
                data: {
                    username: username,
                    password: password,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.action-masuk').attr('disabled', 'disabled');
                    $('div.content-loading').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    console.log(msg);
                    $('div.content-loading').unblock();
                    // const msg = JSON.parse(resMsg);
                    // const msg = JSON.parse(JSON.stringify(resMsg));
                    if (msg.code != 200) {
                        if (msg.code !== 201) {
                            if (msg.code !== 202) {
                                $('.action-masuk').attr('disabled', false);
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
                                    // window.open(msg.data, '_blank').focus();
                                    document.location.href = msg.url;
                                })
                            }
                        } else {
                            Swal.fire(
                                'Berhasil!',
                                msg.message,
                                'success'
                            ).then((valRes) => {
                                // window.open(msg.data, '_blank').focus();
                                document.location.href = msg.url;
                            })
                        }
                    } else {
                        Swal.fire(
                            'Berhasil!',
                            msg.message,
                            'success'
                        ).then((valRes) => {
                            // window.open(msg.data, '_blank').focus();
                            document.location.href = "<?= current_url(true); ?>";
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                    // const msg = JSON.parse(JSON.stringify(data));
                    if (data.status === 200 && (data.statusText === "parsererror" || data.statusText === "OK")) {
                        document.location.href = "<?= current_url(true); ?>";
                    } else {
                        $('div.content-loading').unblock();
                        $('.action-masuk').attr('disabled', false);
                        Swal.fire(
                            'Gagal!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                }
            })

        });
    </script>
    <!--<script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"68c132c2cc49535b","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.8.1","si":10}'></script>-->
</body>

</html>