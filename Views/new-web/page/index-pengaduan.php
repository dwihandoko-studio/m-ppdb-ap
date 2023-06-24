<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="banner-style-14 centred" style="padding-bottom: 0px;">
    <div class="container">
        <div class="content-box">
            <h2>PENGADUAN PPDB TA. 2023/2024</h2>
            <div class="text">Kabupaten Lampung Tengah.</div>
            <div class="mail-box">
                <form action="#" method="post">
                    <div class="form-group-custom">
                        <input class="custom-input-form" type="text" name="_tiket" id="_tiket" placeholder="No tiket" required="">
                        <input class="custom-input-form-1" type="text" name="_nohp_tiket" id="_nohp_tiket" placeholder="No handphone" required="">
                        <button class="custom-button-form" onclick="submitCariAduanButton(this)" type="button">Cari Pengaduan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="subscribe-style-five home-18">
    <div class="image-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/layer-image-6.png);"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div id="image_block_38">
                    <div class="image-box">
                        <div class="bg-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/user-icon.png);"></div>
                        <figure class="image float-bob-y clearfix"><img src="<?= base_url('themes') ?>/images/resource/user-16.png" alt=""></figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div id="content_block_41">
                    <div class="content-box">
                        <div class="sec-title">
                            <h2>Ada Kendala Mengenai PPDB?</h2>
                        </div>
                        <div class="text">Jika mengalami kendala atau masalah dalam proses pendaftaran PPDB, silahkan buat pengaduan melalui tombol dibawah ini.</div>
                        <form action="<?= base_url('web/pengaduan') ?>" method="GET" class="subscribe-form">
                            <div class="form-group">
                                <button type="submit" class="theme-btn-two">Buat Pengaduan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
    function submitCariAduanButton(event) {
        const nohp_tiket = document.getElementsByName('_nohp_tiket')[0].value;
        const tiket = document.getElementsByName('_tiket')[0].value;
        // const tujuan = "teknis";

        if (tiket === "") {
            $('._tiket').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">No tiket tidak boleh kosong.</li></ul>');
            return;
        }

        if (nohp_tiket === "") {
            $('._nohp_tiket').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">No handphone tidak boleh kosong.</li></ul>');
            return;
        }

        $.ajax({
            type: "POST",
            url: BASE_URL + '/web/pengaduan/cari',
            data: {
                tiket: tiket,
                nohp: nohp_tiket,
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
                    $('div.donate-form-area').unblock();
                    loading = false;
                    Swal.fire(
                        'Gagal!',
                        msg.message,
                        'warning'
                    );
                } else {
                    // Swal.fire(
                    //     'Berhasil!',
                    //     msg.message,
                    //     'success'
                    // ).then((valRes) => {
                    // setTimeout(function() {
                    document.location.href = msg.redirrect;
                    // }, 2000);
                    // document.location.href = window.location.href + "dashboard";
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
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<style>
    .showed-on-page {
        display: none !important;
    }

    @media only screen and (max-width: 5000px) {
        .form-group-custom {
            position: relative;
            max-width: 650px;
            width: 100%;
            margin: 0 auto;
        }

        .custom-input-form {
            position: relative;
            width: 37%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
        }

        .custom-input-form-1 {
            position: relative;
            width: 60%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
        }

        .custom-button-form {
            position: absolute;
            top: 0px;
            right: 0px;
            width: 25%;
            height: 50px;
            background: #4527a4;
            text-align: center;
            font-size: 14px;
            color: #fff;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            cursor: pointer;
            transition: all 500ms ease;
        }

    }

    @media only screen and (max-width: 599px) {
        .form-group-custom {
            position: relative;
            /* max-width: 600px; */
            width: 100%;
            margin: 0 auto;
        }

        .custom-input-form {
            position: relative;
            width: 48%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
            margin-bottom: 15px;
        }

        .custom-input-form-1 {
            position: relative;
            width: 48%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
            margin-bottom: 15px;
        }

        .custom-button-form {
            position: relative;
            border-radius: 30px;
            width: 100%;
            top: 0px;
            right: 0px;
            height: 50px;
            background: #4527a4;
            text-align: center;
            font-size: 14px;
            color: #fff;
            cursor: pointer;
            transition: all 500ms ease;
        }

    }

    @media only screen and (max-width: 399px) {
        .form-group-custom {
            position: relative;
            /* max-width: 600px; */
            width: 100%;
            margin: 0 auto;
        }

        .custom-input-form {
            position: relative;
            width: 100%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
            margin-bottom: 15px;
        }

        .custom-input-form-1 {
            position: relative;
            width: 100%;
            height: 50px;
            border: 1px solid #4527a4;
            border-radius: 30px;
            font-size: 14px;
            color: #777;
            padding: 10px 20px 10px 20px;
            margin-bottom: 15px;
        }

        .custom-button-form {
            position: relative;
            border-radius: 30px;
            width: 100%;
            top: 0px;
            right: 0px;
            height: 50px;
            background: #4527a4;
            text-align: center;
            font-size: 14px;
            color: #fff;
            cursor: pointer;
            transition: all 500ms ease;
        }

    }
</style>
<?= $this->endSection(); ?>