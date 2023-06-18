<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="sidebar-page-container">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center" style="margin-bottom: 40px;">
            <h4>DETAIL PENGADUAN DENGAN TICKET <?= $data->token ?></h4>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="sidebar-categories sidebar-widget" style="padding: 20px; border: 2px dashed #777777;">
                    <h4 class="sidebar-title">
                        <div class="feature-btn">
                            <?php if ($data->status == 0 || $data->status == 1) { ?>
                                <a href="#" class="theme-btn-two" style="background: #10db00;">Open</a>
                            <?php } else { ?>
                                <a href="#" class="theme-btn-two" style="background: #db2400;">Close</a>
                            <?php } ?>
                        </div>
                    </h4>
                    <div class="widget-content">
                        <ul>
                            <li>No. Tiket <span>: <?= $data->token ?></span></li>
                            <li>No. Handphone <span>: <?= $data->no_hp ?></span></li>
                            <li>Klasifikasi <span>: <?= $data->klasifikasi ?></span></li>
                            <li>Tujuan <span>: <?= $data->tujuan ?></span></li>
                        </ul>
                    </div>
                </div>
                <!-- <div id="content_block_38">
                    <div class="content-box wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="sec-title">
                            <div class="feature-btn"><a href="#" class="theme-btn-two">Open</a></div>
                            <p>Hallo <?= $data->nama ?>,<br />Kamu bisa menulis komentar dikolom komentar dan update status pengaduan kamu.</p>
                            <div style="margin-top: 35px; padding: 20px; border: 2px solid #777777;">
                                <table border="0">
                                    <thead>
                                        <tr>
                                            <td style="padding-right: 20px;">
                                                No. Tiket
                                            </td>
                                            <td style="padding-right: 20px;">:</td>
                                            <th><?= $data->token ?></th>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 20px;">
                                                No. Handphone
                                            </td>
                                            <td style="padding-right: 20px;">:</td>
                                            <th><?= $data->no_hp ?></th>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 20px;">
                                                Klasifikasi
                                            </td>
                                            <td style="padding-right: 20px;">:</td>
                                            <th><?= $data->klasifikasi ?></th>
                                        </tr>
                                        <tr>
                                            <td style="padding-right: 20px;">
                                                Tujuan
                                            </td>
                                            <td style="padding-right: 20px;">:</td>
                                            <th><?= $data->tujuan ?></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side" style="text-align: left !important; padding: 0px 20px 20px 20px;">
                <div class="blog-single-content" style="border: 2px solid #777777; padding: 20px;">
                    <div class="comments-area">
                        <div class="comment-box">
                            <div class="comment" style="margin-bottom: 30px;">
                                <figure class="author-thumb"><img src="<?= base_url('themes') ?>/images/resource/comment-1.png" alt=""></figure>
                                <div class="comment-inner">
                                    <div class="comment-info">
                                        <h5 class="name"><?= $data->nama ?></h5>
                                        <span class="date"><?= $data->created_at ?></span>
                                    </div>
                                    <div class="text"><?= $data->deskripsi ?></div>
                                    <!-- <div class="replay-btn"><a href="#">Reply</a></div> -->
                                </div>
                            </div>
                            <hr style="margin-bottom: 30px;" />
                            <div class="content-komentar-aduan" id="content-komentar-aduan">
                                <?php if ($data->status == 1) { ?>
                                    <div class="comment replay-comment" style="margin-bottom: 30px;">
                                        <figure class="author-thumb"><img src="<?= base_url('themes') ?>/images/resource/comment-2.png" alt=""></figure>
                                        <div class="comment-inner">
                                            <div class="comment-info">
                                                <h5 class="name">Admin</h5>
                                                <span class="date">October 5, 2019</span>
                                            </div>
                                            <div class="text">Masih dalam proses</div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($data->status == 0 || $data->status == 1) { ?>
                        <div class="comments-form-area">
                            <form action="#" method="post" class="comment-form default-form">
                                <input type="hidden" id="_id_aduan" name="_id_aduan" value="<?= $data->id ?>" />
                                <input type="hidden" id="_nama_pengadu" name="_nama_pengadu" value="<?= $data->nama ?>" />
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea style="height: 50px;" id="_komentar" name="_komentar" placeholder="Tulis komentar..."></textarea>
                                        <div class="help-block _komentar"></div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button type="button" onclick="submitAddKomentarButton(this)" class="theme-btn-two">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
    function submitAddKomentarButton(event) {
        const id_post = document.getElementsByName('_id_aduan')[0].value;
        const nama_pengadu = document.getElementsByName('_nama_pengadu')[0].value;
        const komentar = document.getElementsByName('_komentar')[0].value;
        // const tujuan = "teknis";

        if (komentar === "") {
            $('._komentar').html('<ul role="alert" style="color: #00fff2;"><li style="color: #00fff2;">Komentar tidak boleh kosong.</li></ul>');
            return;
        }

        $.ajax({
            type: "POST",
            url: BASE_URL + '/web/pengaduan/comment',
            data: {
                id_post: id_post,
                nama: nama_pengadu,
                komentar: komentar,
            },
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('div.comments-form-area').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                console.log(msg);
                if (msg.code != 200) {
                    $('div.comments-form-area').unblock();
                    loading = false;
                    Swal.fire(
                        'Gagal!',
                        msg.message,
                        'warning'
                    );
                } else {
                    const newDivKomentar = document.createElement('div');
                    newDivKomentar.className = 'comment replay-comment';
                    newDivKomentar.style.marginBottom = '30px';

                    // Mengisi konten HTML pada elemen div
                    const newKomentarnya = `
                        <figure class="author-thumb"><img src="<?= base_url('themes') ?>/images/resource/comment-2.png" alt=""></figure>
                        <div class="comment-inner">
                            <div class="comment-info">
                                <h5 class="name">{{nama}}</h5>
                                <span class="date">{{date}}</span>
                            </div>
                            <div class="text">{{komentar}}</div>
                        </div>
                    `;

                    const htmlWithReplacement = newKomentarnya.replace("{{nama}}", msg.data.nama);
                    const htmlWithReplacement1 = htmlWithReplacement.replace("{{date}}", msg.data.created_at);
                    const htmlWithReplacement2 = htmlWithReplacement.replace("{{komentar}}", msg.data.komentar);

                    newDivKomentar.innerHTML = htmlWithReplacement2;

                    // Menemukan elemen target berdasarkan ID
                    var targetElementContentKometar = document.getElementById('content-komentar-aduan');

                    // Menambahkan elemen baru ke dalam elemen target
                    targetElementContentKometar.appendChild(newDivKomentar);

                    // Swal.fire(
                    //     'Berhasil!',
                    //     msg.message,
                    //     'success'
                    // ).then((valRes) => {
                    // setTimeout(function() {
                    // document.location.href = msg.redirrect;
                    // }, 2000);
                    // document.location.href = window.location.href + "dashboard";
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
                    $('div.comments-form-area').unblock();
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