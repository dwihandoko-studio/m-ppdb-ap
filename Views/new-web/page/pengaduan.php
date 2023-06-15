<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<header class="main-header style-four">
    <div class="outer-container">
        <div class="container">
            <div class="main-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="<?= base_url() ?>"><img src="<?= base_url('uploads/logo.webp') ?>" alt=""></a></figure>
                </div>
                <div class="menu-area pull-right clearfix">
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="dropdown"><a href="#">Sekolah</a>
                                    <ul>
                                        <li class="dropdown"><a href="#">SD</a>
                                            <ul>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=5' ?>">Kec. Padang Cermin</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120902&j=5' ?>">Kec. Punduh Pedada</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120903&j=5' ?>">Kec. Kedondong</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120904&j=5' ?>">Kec. Way Lima</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120905&j=5' ?>">Kec. Gedung Tataan</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120906&j=5' ?>">Kec. Negeri Katon</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120907&j=5' ?>">Kec. Tegineneng</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120908&j=5' ?>">Kec. Marga Punduh</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120909&j=5' ?>">Kec. Way Khilau</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=5' ?>">Kec. Teluk Pandan</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=5' ?>">Kec. Way Ratai</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown"><a href="#">SMP</a>
                                            <ul>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=6' ?>">Kec. Padang Cermin</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120902&j=6' ?>">Kec. Punduh Pedada</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120903&j=6' ?>">Kec. Kedondong</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120904&j=6' ?>">Kec. Way Lima</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120905&j=6' ?>">Kec. Gedung Tataan</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120906&j=6' ?>">Kec. Negeri Katon</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120907&j=6' ?>">Kec. Tegineneng</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120908&j=6' ?>">Kec. Marga Punduh</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120909&j=6' ?>">Kec. Way Khilau</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=6' ?>">Kec. Teluk Pandan</a></li>
                                                <li><a href="<?= base_url('web/sekolah/kec') . '?id=120901&j=6' ?>">Kec. Way Ratai</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="<?= base_url('web/jadwal') ?>">Jadwal</a></li>
                                <li><a href="<?= base_url('web/statistik') ?>">Statistik</a></li>
                                <li class="dropdown">
                                    <a href="#">Informasi</a>
                                    <ul>
                                        <li><a href="<?= base_url('web/profilsekolah') ?>">Profil Sekolah</a></li>
                                        <li><a href="<?= base_url('web/kuota') ?>">Kuota Sekolah</a></li>
                                        <li><a href="<?= base_url('web/zona') ?>">Zona Wilayah</a></li>
                                        <li><a href="<?= base_url('web/pengumuman') ?>">Pengumuman</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-header">
        <div class="container clearfix">
            <figure class="logo-box"><a href="<?= base_url() ?>"><img src="<?= base_url('themes') ?>/images/small-logo.webp" alt=""></a></figure>
            <div class="menu-area">
                <nav class="main-menu clearfix">
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="<?= base_url() ?>"><img src="<?= base_url('uploads/logo.webp') ?>" alt="" title=""></a></div>
        <div class="menu-outer"></div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>Komplek Pemerintah, Jl. Kedondong - Gedung Tataan</li>
                <li><a href="tel:+6282111837685">+62821-1183-7685</a></li>
                <li><a href="mailto:pesawaran.ppdb@kntechline.com">pesawaran.ppdb@kntechline.com</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                <li><a href="#"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div>
<section class="page-title style-two" style="padding: 150px 0px 0px 0px;">
    <div class="container">

    </div>
</section>
<section class="donate-section elements">
    <div class="pattern-box">
        <div class="pattern-1"><img src="<?= base_url('themes') ?>/images/icons/shap-28.png" alt=""></div>
        <div class="pattern-2"><img src="<?= base_url('themes') ?>/images/icons/shap-29.png" alt=""></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div id="image_block_46">
                    <figure class="image-box wow slideInLeft" data-wow-delay="00ms" data-wow-duration="1500ms"><img src="<?= base_url('themes') ?>/images/resource/illustration-40.png" alt=""></figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div id="content_block_51">
                    <div class="content-box">
                        <div class="upper-box">
                            <h2>Ada Kendala Mengenai PPDB?</h2>
                            <div class="text">Jika mengalami kendala atau masalah dalam proses pendaftaran PPDB, silahkan buat pengaduan pada form berikut ini.</div>
                            <!-- <div class="btn-box">
                                <a href="#" class="btn-one">Funding Progress</a>
                                <a href="#" class="btn-two">Join Us</a>
                            </div> -->
                        </div>
                        <div class="donation-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="select-box">
                                <input type="hidden" id="_nisn" name="_nisn" value="<?= isset($nisn) ? $nisn : '-' ?>">
                                <input type="hidden" id="_npsn" name="_npsn" value="<?= isset($npsn) ? $npsn : '-' ?>">
                                <div class="form-group">
                                    <p style="color: #fff;">Nama Lengkap *</p>
                                    <input type="text" name="_nama" id="_nama" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" placeholder="">
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">No Handphone *</p>
                                    <input type="text" name="_nohp" id="_nohp" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" placeholder="">
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">Deskripsi Kendala / Masalah *</p>
                                    <textarea rows="5" name="_deskripsi" id="_deskripsi" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; outline: medium none;" placeholder="Masukkan deskripsi kendala / masalah"></textarea>
                                </div>
                            </div>
                            <div class="btn-box">
                                <button onclick="submitAduanButton(this)" class="donate-box-btn _submit_aduan_button" id="_submit_aduan_button">KIRIM</button>
                            </div>
                        </div>
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
    function submitAduanButton(event) {
        const nisn = document.getElementsByName('_nisn')[0].value;
        const npsn = document.getElementsByName('_npsn')[0].value;
        const nama = document.getElementsByName('_nama')[0].value;
        const nohp = document.getElementsByName('_nohp')[0].value;
        const deskripsi = document.getElementsByName('_deskripsi')[0].value;
        const tujuan = "teknis";

        if (nama.length < 3) {
            $('._nama').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Nama tidak boleh kosong.</li></ul>');
            return;
        }
        if (nohp.length < 8) {
            $('._nohp').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">No handphone tidak valid.</li></ul>');
            return;
        }
        if (deskripsi.length < 3) {
            $('._nohp').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Deskripsi tidak boleh kosong.</li></ul>');
            return;
        }

        $.ajax({
            type: "POST",
            url: BASE_URL + '/web/pengaduan/add',
            data: {
                nisn: nisn,
                npsn: npsn,
                nama: nama,
                nohp: nohp,
                deskripsi: deskripsi,
                tujuan: tujuan,
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
                                document.location.href = msg.redirrect;
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
                            document.location.href = msg.redirrect;
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
                        document.location.href = msg.redirrect;
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

    ::placeholder {
        color: #ffffff8f;
        /* Ganti dengan warna yang Anda inginkan */
    }
</style>

<?= $this->endSection(); ?>