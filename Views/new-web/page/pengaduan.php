<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header1') ?>
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
                    <figure class="image-box wow slideInLeft" data-wow-delay="00ms" data-wow-duration="1500ms"><img src="<?= base_url('themes') ?>/images/resource/bg-aduan.webp" alt=""></figure>
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
                                    <p style="color: #fff;">Klasifikasi *</p>
                                    <select id="_klasifikasi" name="_klasifikasi" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                        <option value="" selected>&nbsp;</option>
                                        <option value="Sudah punya NISN, data peserta tidak ditemukan">Sudah punya NISN, data peserta tidak ditemukan</option>
                                        <option value="Data yang tampil dari sekolah asal tidak sesuai">Data yang tampil dari sekolah asal tidak sesuai</option>
                                        <option value="Lupa Password">Lupa Password</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                    <div class="help-block _klasifikasi"></div>
                                    <!-- <input type="text" name="_nama" id="_nama" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" placeholder=""> -->
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">Tujuan *</p>
                                    <select id="_tujuan" name="_tujuan" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                        <option value="" selected>&nbsp;</option>
                                        <option value="Bagian Teknis Layanan PPDB Daring">Bagian Teknis Layanan PPDB Daring</option>
                                        <option value="Panitia PPDB Dinas Kabupaten">Panitia PPDB Dinas Kabupaten</option>
                                    </select>
                                    <div class="help-block _tujuan"></div>
                                    <!-- <input type="text" name="_nama" id="_nama" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" placeholder=""> -->
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">Nama Lengkap *</p>
                                    <input type="text" name="_nama" id="_nama" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" placeholder="">
                                    <div class="help-block _nama"></div>
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">Email *</p>
                                    <input type="email" name="_email" id="_email" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" placeholder="">
                                    <div class="help-block _email"></div>
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">No Handphone *</p>
                                    <input type="text" name="_nohp" id="_nohp" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" placeholder="">
                                    <div class="help-block _nohp"></div>
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">Deskripsi Kendala / Masalah *</p>
                                    <textarea rows="5" name="_deskripsi" id="_deskripsi" style="padding: 10px; width: 100% !important; background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; outline: medium none;" placeholder="Masukkan deskripsi kendala / masalah"></textarea>
                                    <div class="help-block _deskripsi"></div>
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
        const email = document.getElementsByName('_email')[0].value;
        const nohp = document.getElementsByName('_nohp')[0].value;
        const deskripsi = document.getElementsByName('_deskripsi')[0].value;
        const klasifikasi = document.getElementsByName('_klasifikasi')[0].value;
        const tujuan = document.getElementsByName('_tujuan')[0].value;
        // const tujuan = "teknis";

        if (klasifikasi === "") {
            $('._klasifikasi').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Pilih klasifikasi aduan.</li></ul>');
            return;
        }

        if (tujuan === "") {
            $('._tujuan').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Pilih tujuan aduan.</li></ul>');
            return;
        }

        if (nama.length < 3) {
            $('._nama').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Nama tidak boleh kosong.</li></ul>');
            return;
        }
        if (email.length < 3) {
            $('._email').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Email tidak boleh kosong.</li></ul>');
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
                email: email,
                nohp: nohp,
                deskripsi: deskripsi,
                tujuan: tujuan,
                klasifikasi: klasifikasi,
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