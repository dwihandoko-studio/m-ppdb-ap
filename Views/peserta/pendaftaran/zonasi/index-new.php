<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>

<!--<body>-->
<!-- Main content -->
<div class="main-content content-loading" id="panel">
    <?= $this->include('templates/topnav'); ?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="<?= base_url('peserta/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Daftar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Jalur Zonasi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card loading-content">
                    <div class="card-header">
                        <h5 class="h3 mb-0">PENDAFTARAN VIA JALUR ZONASI</h5>
                        <p>Daftar Sekolah Yang Dalam Ruang Lingkup Zonasi.</p>
                    </div>
                    <!-- <div class="card-header py-0">
                        <form>
                            <div class="form-group mb-0">
                                <div class="input-group input-group-lg input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="fas fa-search"></span></div>
                                    </div><input type="search" class="form-control _search_item" id="_search_item" name="_search_item" placeholder="Cari NPSN / Nama Sekolah. . ."><button type="button" onclick="cariData(this)" class="btn btn-default"><span class="fas fa-search"></span></button>
                                </div>
                            </div>
                        </form>
                    </div> -->
                    <div class="card-body">
                        <?php if (isset($error)) { ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <center><span class="alert-icon"><i class="ni ni-bell-55 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br><?= $error ?></span></button></center>
                                <br />
                                <?php if (isset($sekolah_pilihan)) { ?>
                                    <center>
                                        <ol>
                                            <li style="list-style: none;"><?= $sekolah_pilihan->tujuan_sekolah_id_2 !== NULL ? 'Sekolah Pilihan Pertama' : 'Sekolah yang dituju' ?> : <?= getNamaAndNpsnSekolah($sekolah_pilihan->tujuan_sekolah_id_1) ?></li>
                                            <?php if ($sekolah_pilihan->tujuan_sekolah_id_2 !== NULL) { ?>
                                                <li style="list-style: none;">Sekolah Pilihan Kedua &nbsp;&nbsp;: <?= getNamaAndNpsnSekolah($sekolah_pilihan->tujuan_sekolah_id_2) ?></li>
                                                <li style="list-style: none;">Sekolah Pilihan Ketiga &nbsp;: <?= getNamaAndNpsnSekolah($sekolah_pilihan->tujuan_sekolah_id_3) ?></li>
                                            <?php } ?>
                                        </ol>
                                    </center>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <?php if (isset($result)) { ?>
                                <?php if (count($result) > 0) { ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group _sekolah_pilihan_pertama-block">
                                                <input name="_pilihan_pertama" class="custom-control-input _pilihan_pertama" id="_pilihan_pertama" type="hidden">
                                                <label for="_sekolah_pilihan_pertama" class="form-control-label">Sekolah Pilihan 1 (Pertama)</label>
                                                <select onChange="changeValidation('_sekolah_pilihan_pertama');" class="form-control sekolah_pilihan_pertama" name="_sekolah_pilihan_pertama" id="_sekolah_pilihan_pertama" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="">-- Pilih Sekolah Pilihan Pertama --</option>
                                                    <?php if (isset($result)) { ?>
                                                        <?php if (count($result) > 0) { ?>
                                                            <?php foreach ($result as $key => $val) { ?>
                                                                <option value="<?= $val->id ?>">Jarak : <?= getJarak2Koordinat($val->latitude, $val->longitude, $usernya->latitude, $usernya->longitude, 'kilometers') . ' Km' ?> &nbsp; - <?= $val->nama ?> - NPSN: <?= $val->npsn ?> &nbsp; &nbsp;<?= ((int)$val->status_sekolah == 1) ? '(<span class="badge badge-success" style="padding: 2px;">Negeri</span>)' : '(<span class="badge badge-info" style="padding: 2px;">Swasta</span>)' ?> - Kec. <?= $val->nama_kecamatan ?> - <?= $val->nama_kabupaten ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block _sekolah_pilihan_pertama"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group _sekolah_pilihan_kedua-block">
                                                <input name="_pilihan_kedua" class="custom-control-input _pilihan_kedua" id="_pilihan_kedua" type="hidden">
                                                <label for="_sekolah_pilihan_kedua" class="form-control-label">Sekolah Pilihan 2 (Kedua)</label>
                                                <select onChange="changeValidation('_sekolah_pilihan_kedua');" class="form-control sekolah_pilihan_kedua" name="_sekolah_pilihan_kedua" id="_sekolah_pilihan_kedua" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="">-- Pilih Sekolah Pilihan Kedua --</option>
                                                    <?php if (isset($result)) { ?>
                                                        <?php if (count($result) > 0) { ?>
                                                            <?php foreach ($result as $key => $val) { ?>
                                                                <option value="<?= $val->id ?>">Jarak : <?= getJarak2Koordinat($val->latitude, $val->longitude, $usernya->latitude, $usernya->longitude, 'kilometers') . ' Km' ?> &nbsp; - <?= $val->nama ?> - NPSN: <?= $val->npsn ?> &nbsp; &nbsp;<?= ((int)$val->status_sekolah == 1) ? '(<span class="badge badge-success" style="padding: 2px;">Negeri</span>)' : '(<span class="badge badge-info" style="padding: 2px;">Swasta</span>)' ?> - Kec. <?= $val->nama_kecamatan ?> - <?= $val->nama_kabupaten ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block _sekolah_pilihan_kedua"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group _sekolah_pilihan_ketiga-block">
                                                <input name="_pilihan_ketiga" class="custom-control-input _pilihan_ketiga" id="_pilihan_ketiga" type="hidden">
                                                <label for="_sekolah_pilihan_ketiga" class="form-control-label">Sekolah Pilihan 3 (Ketiga)</label>
                                                <select onChange="changeValidation('_sekolah_pilihan_ketiga');" class="form-control sekolah_pilihan_ketiga" name="_sekolah_pilihan_ketiga" id="_sekolah_pilihan_ketiga" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="">-- Pilih Sekolah Pilihan Ketiga --</option>
                                                    <?php if (isset($result)) { ?>
                                                        <?php if (count($result) > 0) { ?>
                                                            <?php foreach ($result as $key => $val) { ?>
                                                                <option value="<?= $val->id ?>">Jarak : <?= getJarak2Koordinat($val->latitude, $val->longitude, $usernya->latitude, $usernya->longitude, 'kilometers') . ' Km' ?> &nbsp; - <?= $val->nama ?> - NPSN: <?= $val->npsn ?> &nbsp; &nbsp;<?= ((int)$val->status_sekolah == 1) ? '(<span class="badge badge-success" style="padding: 2px;">Negeri</span>)' : '(<span class="badge badge-info" style="padding: 2px;">Swasta</span>)' ?> - Kec. <?= $val->nama_kecamatan ?> - <?= $val->nama_kabupaten ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block _sekolah_pilihan_ketiga"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <center><span class="alert-icon"><i class="ni ni-bell-55 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br>Sekolah Zonasi Tidak Ditemukan</span></button></center>
                                        <br />
                                        <center>
                                            <p>Wilayah tempat tinggal pendaftar, terdeteksi tidak masuk dalam wilayah jalur zonasi.</p>
                                        </center>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <center><span class="alert-icon"><i class="ni ni-bell-55 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br>Sekolah Zonasi Tidak Ditemukan</span></button></center>
                                    <br />
                                    <center>
                                        <p>Wilayah tempat tinggal pendaftar, terdeteksi tidak masuk dalam wilayah jalur zonasi.</p>
                                    </center>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!-- <div class="col-lg-12 content-pilihan-pendaftaran-zonasi-"> -->

                        <!-- </div> -->
                        <!-- <ul class="list-group list-group-flush list my--3 content_zonasi" id="content_zonasi">

                        </ul>
                        <div style="margin-top: 40px;" class="col-md-12 content_pagination" id="content_pagination">

                        </div> -->
                    </div>
                    <div class="card-footer">
                        <?php if (!(isset($error))) { ?>
                            <?php if (isset($result)) { ?>
                                <?php if (count($result) > 0) { ?>
                                    <button type="button" onclick="actionDaftarSimpan(this);" class="btn btn-primary btn-lg btn-block _daftar_simpan" id="_daftar_simpan">DAFTAR DAN SIMPAN</button>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content modal-content-loading">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contentModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="contentBodyModal">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-tolak-loading">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tolakModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="tolakBodyModal">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-document-loading">
                    <div class="modal-header">
                        <h5 class="modal-title" id="documentModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="documentBodyModal">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<template id="my-template">
    <swal-title>
        Save changes to "Untitled 1" before closing?
    </swal-title>
    <swal-icon type="warning" color="red"></swal-icon>
    <swal-button type="confirm">
        Save As
    </swal-button>
    <swal-button type="cancel">
        Cancel
    </swal-button>
    <swal-button type="deny">
        Close without Saving
    </swal-button>
    <swal-param name="allowEscapeKey" value="false" />
    <swal-param name="customClass" value='{ "popup": "my-popup" }' />
</template>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
<!--<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>-->
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/moment.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/bootstrap-datetimepicker.js"></script>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script>

<script>
    let loading = false;

    function reloadPage(action = "") {
        if (action === "") {
            document.location.href = "<?= current_url(true); ?>";
        } else {
            document.location.href = action;
        }
    }

    function aksiDaftar(id, name) {
        Swal.fire({
            title: 'Apakah anda yakin ingin mendaftar di sekolah ini?',
            text: "Daftar ke sekolah " + name + " melalui jalur Zonasi.",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Daftar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('peserta/pendaftaran/zonasi/aksidaftar') ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        name: name
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('div.main-content').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(resul) {
                        $('div.main-content').unblock();

                        if (resul.code !== 200) {
                            if (resul.code === 401) {
                                Swal.fire(
                                    'Failed!',
                                    resul.message,
                                    'warning'
                                ).then((valRes) => {
                                    document.location.href = BASE_URL + '/dashboard';
                                });
                            } else {
                                Swal.fire(
                                    'GAGAL!',
                                    resul.message,
                                    'warning'
                                );
                            }
                        } else {
                            Swal.fire({
                                title: 'BERHASIL !!!',
                                text: resul.message,
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'Tutup',
                                confirmButtonText: 'Download Bukti Pendaftaran'
                            }).then((result) => {
                                if (result.value) {
                                    window.open(
                                        "<?= base_url('peserta/riwayat/cetakpendaftaran') ?>?id=" + resul.data.id + "&kode=" + resul.data.kode_pendaftaran + "&jalur=" + resul.data.via_jalur, "_blank");
                                    // document.location.href = "<?= base_url("peserta/home") ?>";
                                    reloadPage('<?= base_url("peserta/home") ?>');
                                } else {
                                    console.log('tutup');
                                    reloadPage();
                                }
                            })

                            // Swal.fire(
                            //     'SELAMAT!',
                            //     resul.message,
                            //     'success'
                            // ).then((valRes) => {
                            //     reloadPage();
                            // })
                        }
                    },
                    error: function() {
                        $('div.main-content').unblock();
                        Swal.fire(
                            'GAGAL!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }
        })
    }

    function actionMouseHoverLocation(event) {
        event.style.color = '#fff';
        event.style.background = '#0A48B3';
        $('.action-location-icon').css('color', '#fff');
    }

    function actionMouseOutHoverLocation(event) {
        event.style.color = '#adb5bd';
        event.style.background = '#fff';
        $('.action-location-icon').css('color', '#adb5bd');
    }

    function actionDaftarSimpan(event) {
        const sekolah1 = document.getElementsByName('_sekolah_pilihan_pertama')[0].value;
        const sekolah2 = document.getElementsByName('_sekolah_pilihan_kedua')[0].value;
        const sekolah3 = document.getElementsByName('_sekolah_pilihan_ketiga')[0].value;

        if (sekolah1 === "") {
            $("select#_sekolah_pilihan_pertama").css("color", "#dc3545");
            $("select#_sekolah_pilihan_pertama").css("border-color", "#dc3545");
            $('._sekolah_pilihan_pertama').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Siilahkan pilih sekolah pilihan pertama dulu.</li></ul>');
            return;
        }
        if (sekolah2 === "") {
            $("select#_sekolah_pilihan_kedua").css("color", "#dc3545");
            $("select#_sekolah_pilihan_kedua").css("border-color", "#dc3545");
            $('._sekolah_pilihan_kedua').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Siilahkan pilih sekolah pilihan kedua dulu.</li></ul>');
            return;
        }
        if (sekolah3 === "") {
            $("select#_sekolah_pilihan_ketiga").css("color", "#dc3545");
            $("select#_sekolah_pilihan_ketiga").css("border-color", "#dc3545");
            $('._sekolah_pilihan_ketiga').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Siilahkan pilih sekolah pilihan ketiga dulu.</li></ul>');
            return;
        }
        if (sekolah1 === sekolah2) {
            Swal.fire(
                'PERINGATAN!',
                "Sekolah pilihan pertama dan kedua tidak boleh sama.",
                'warning'
            );
            return;
        }
        if (sekolah1 === sekolah3) {
            Swal.fire(
                'PERINGATAN!',
                "Sekolah pilihan pertama dan ketiga tidak boleh sama.",
                'warning'
            );
            return;
        }
        if (sekolah2 === sekolah3) {
            Swal.fire(
                'PERINGATAN!',
                "Sekolah pilihan kedua dan ketiga tidak boleh sama.",
                'warning'
            );
            return;
        }

        Swal.fire({
            title: 'Apakah anda yakin ingin mendaftar di sekolah pilihan ini?',
            text: "Daftar ke sekolah pilihan melalui jalur Zonasi.",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Daftar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('peserta/pendaftaran/zonasi/aksidaftar') ?>",
                    type: 'POST',
                    data: {
                        sekolah1: sekolah1,
                        sekolah2: sekolah2,
                        sekolah3: sekolah3,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('div.main-content').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(resul) {
                        $('div.main-content').unblock();

                        if (resul.code !== 200) {
                            if (resul.code === 401) {
                                Swal.fire(
                                    'Failed!',
                                    resul.message,
                                    'warning'
                                ).then((valRes) => {
                                    document.location.href = BASE_URL + '/dashboard';
                                });
                            } else {
                                Swal.fire(
                                    'GAGAL!',
                                    resul.message,
                                    'warning'
                                );
                            }
                        } else {
                            Swal.fire(
                                'BERHASIL !!!',
                                resul.message,
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    reloadPage(result.redirrect);
                                } else {
                                    console.log('tutup');
                                    reloadPage();
                                }
                            })

                            // Swal.fire({
                            //     title: 'BERHASIL !!!',
                            //     text: resul.message,
                            //     showCancelButton: true,
                            //     confirmButtonColor: '#3085d6',
                            //     cancelButtonColor: '#d33',
                            //     cancelButtonText: 'Tutup',
                            //     confirmButtonText: 'Download Bukti Pendaftaran'
                            // }).then((result) => {
                            //     if (result.value) {
                            //         window.open(
                            //             "<?= base_url('peserta/riwayat/cetakpendaftaran') ?>?id=" + resul.data.id + "&kode=" + resul.data.kode_pendaftaran + "&jalur=" + resul.data.via_jalur, "_blank");
                            //         reloadPage('<?= base_url("peserta/home") ?>');
                            //     } else {
                            //         console.log('tutup');
                            //         reloadPage();
                            //     }
                            // })
                        }
                    },
                    error: function() {
                        $('div.main-content').unblock();
                        Swal.fire(
                            'GAGAL!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                })
            }
        })
    }

    function initSelect2Panel(event) {
        $('#' + event).select2({
            dropdownParent: "#panel"
        });
    }

    function initializeDatetime(event, date) {
        $('#' + event).datetimepicker({
            // defaultDate: new Date().toLocaleString('en-GB', { hour12: false }),
            defaultDate: date,
            locale: 'en-GB',
            format: 'YYYY-MM-DD',
            icons: {
                time: "fa fa-clock",
                date: "fa fa-calendar-day",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    }

    $(document).ready(function() {
        initSelect2Panel('_sekolah_pilihan_pertama');
        initSelect2Panel('_sekolah_pilihan_kedua');
        initSelect2Panel('_sekolah_pilihan_ketiga');
        // getSekolahPilihan1();
        // getSekolahPilihan2();
        // getSekolahPilihan3();
        // getDataSekolah();
    });

    function loadFilePdf(event) {
        // console.log(event);
        // const input = document.getElementsByName('_file')[0];
        const input = event;
        if (input.files && input.files[0]) {
            let file = input.files[0];

            // allowed MIME types
            let mime_types = ['application/pdf'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                // const color = event.name
                $('.' + event.name).css('display', 'block');
                $("input#" + event.name).css("color", "#dc3545");
                $("input#" + event.name).css("border-color", "#dc3545");
                $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Hanya file type pdf yang diizinkan.</li></ul>');
                // $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type pdf yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 1 * 512 * 1000) {
                input.value = "";
                $('.' + event.name).css('display', 'block');
                $("input#" + event.name).css("color", "#dc3545");
                $("input#" + event.name).css("border-color", "#dc3545");
                $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Ukuran file tidak boleh lebih dari 2 Mb.</li></ul>');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 2 Mb.",
                    'warning'
                );
                return;
            }


            $('.' + event.name).css('display', 'none');
            // $( "input#" + event.name ).css("color", "#dc3545");
            // $( "input#" + event.name ).css("border-color", "#dc3545");
            // $('.' + event.name).html('');

            // const color = $(id).attr('id');
            $(event.name).removeAttr('style');
            // $('.'+color).html('');

            // let reader = new FileReader();

            // reader.onload = function(e) {
            //     $('.imagePreviewUpload').attr('src', e.target.result);
            // }

            // reader.readAsDataURL(input.files[0]); // convert to base64 string
            // console.log("success Load");
        } else {
            console.log("failed Load");
        }
    }

    function changeValidation(event) {
        // $('.' + event).css('display', 'none');
        $('.' + event).html('');
    };

    function inputFocus(id) {
        const color = $(id).attr('id');
        $(id).removeAttr('style');
        $('.' + color).html('');
    }

    function ambilId(id) {
        return document.getElementById(id);
    }

    function onChangeProvinsi(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/peserta/referensi/getKabupaten',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kabupaten').html('<option value="" selected>--Pilih Provinsi Dulu--</option>');
                    $('.kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('.dusun').html('<option value="" selected>--Pilih Kelurahan Dulu--</option>');
                    $('div._kabupaten-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kecamatan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._dusun-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kabupaten-block').unblock();
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                    // const msg = JSON.parse(resMsg);
                    // const msg = JSON.parse(JSON.stringify(resMsg));
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kabupaten--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kabupaten').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kabupaten-block').unblock();
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                }
            })
        }
    }

    function onChangeKabupaten(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/peserta/referensi/getKecamatan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('.dusun').html('<option value="" selected>--Pilih Kelurahan Dulu--</option>');
                    $('div._kecamatan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._dusun-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kecamatan--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kecamatan').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                }
            })
        }
    }

    function onChangeKecamatan(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/peserta/referensi/getKelurahan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('.dusun').html('<option value="" selected>--Pilih Kelurahan Dulu--</option>');
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._dusun-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kelurahan--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kelurahan').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                }
            })
        }
    }

    function onChangeKelurahan(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/peserta/referensi/getDusun',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.dusun').html('<option value="" selected>--Pilih Kelurahan Dulu--</option>');
                    $('div._dusun-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._dusun-block').unblock();
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Dusun--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.dusun').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._dusun-block').unblock();
                }
            })
        }
    }

    function onChangeDusun(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");
    }


    let editor;

    function loadFileImage(event) {
        const keyName = $(event).attr('name');
        const input = document.getElementsByName(keyName)[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];

            // allowed MIME types
            var mime_types = ['image/jpg', 'image/jpeg', 'image/png'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                // $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type gambar yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 1 * 512 * 1000) {
                input.value = "";
                // $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 500 Kb.",
                    'warning'
                );
                return;
            }

            // var reader = new FileReader();

            // reader.onload = function(e) {
            //     $('.imagePreviewUpload').attr('src', e.target.result);
            // }

            // reader.readAsDataURL(input.files[0]); // convert to base64 string
            // console.log("success Load");
        } else {
            console.log("failed Load");
        }
    }

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    $('#_kirim_permohonan').on('click', function() {

        const nik = document.getElementsByName('_nik')[0].value;
        const nama = document.getElementsByName('_nama')[0].value;
        const kk = document.getElementsByName('_kk')[0].value;
        const tempatLahir = document.getElementsByName('_tempat_lahir')[0].value;
        const tglLahir = document.getElementsByName('_tgl_lahir')[0].value;
        const agama = document.getElementsByName('_agama')[0].value;
        const provinsi = document.getElementsByName('_provinsi')[0].value;
        const kabupaten = document.getElementsByName('_kabupaten')[0].value;
        const kecamatan = document.getElementsByName('_kecamatan')[0].value;
        const kelurahan = document.getElementsByName('_kelurahan')[0].value;
        const alamat = document.getElementsByName('_alamat')[0].value;

        let jk;
        if ($('#customRadio5').is(":checked")) {
            jk = "LAKI-LAKI";
        } else {
            jk = "PEREMPUAN";
        }

        if (agama === "") {
            $("select#_agama").css("color", "#dc3545");
            $("select#_agama").css("border-color", "#dc3545");
            $('._agama').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (provinsi === "") {
            $("select#_provinsi").css("color", "#dc3545");
            $("select#_provinsi").css("border-color", "#dc3545");
            $('._provinsi').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (kabupaten === "") {
            $("select#_kabupaten").css("color", "#dc3545");
            $("select#_kabupaten").css("border-color", "#dc3545");
            $('._kabupaten').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (kecamatan === "") {
            $("select#_kecamatan").css("color", "#dc3545");
            $("select#_kecamatan").css("border-color", "#dc3545");
            $('._kecamatan').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (kelurahan === "") {
            $("select#_kelurahan").css("color", "#dc3545");
            $("select#_kelurahan").css("border-color", "#dc3545");
            $('._kelurahan').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (nik === "") {
            $("input#_nik").css("color", "#dc3545");
            $("input#_nik").css("border-color", "#dc3545");
            $('._nik').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (kk === "") {
            $("input#_kk").css("color", "#dc3545");
            $("input#_kk").css("border-color", "#dc3545");
            $('._kk').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (nama === "") {
            $("input#_nama").css("color", "#dc3545");
            $("input#_nama").css("border-color", "#dc3545");
            $('._nama').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (alamat === "") {
            $("textarea#_alamat").css("color", "#dc3545");
            $("textarea#_alamat").css("border-color", "#dc3545");
            $('._alamat').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (tempatLahir === "") {
            $("input#_tempat_lahir").css("color", "#dc3545");
            $("input#_tempat_lahir").css("border-color", "#dc3545");
            $('._tempat_lahir').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (tglLahir === "") {
            $("input#_tgl_lahir").css("color", "#dc3545");
            $("input#_tgl_lahir").css("border-color", "#dc3545");
            $('._tgl_lahir').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }

        if (agama === "" || nik === "" || kk === "" || nama === "" || alamat === "" || tempatLahir === "" || tglLahir === "" || provinsi === "" || kabupaten === "" || kecamatan === "" || kelurahan === "") {
            Swal.fire(
                'Warning!!!',
                "Silahkan lengkapi semua isian wajib terlebih dahulu.",
                'warning'
            );
            return;
        }

        const formUpload = new FormData();
        formUpload.append('nik', nik);
        formUpload.append('kk', kk);
        formUpload.append('nama', nama);
        formUpload.append('tempatLahir', tempatLahir);
        formUpload.append('tglLahir', tglLahir);
        formUpload.append('jk', jk);
        formUpload.append('agama', agama);
        formUpload.append('provinsi', provinsi);
        formUpload.append('kabupaten', kabupaten);
        formUpload.append('kecamatan', kecamatan);
        formUpload.append('kelurahan', kelurahan);
        formUpload.append('alamat', alamat);

        $.ajax({
            xhr: function() {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        // ambilId("loaded_n_total").innerHTML = "Uploaded " + evt.loaded + " bytes of " + evt.total;
                        let percent = (evt.loaded / evt.total) * 100;
                        // ambilId("progressBar").value = Math.round(percent);
                        // ambilId("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
                        $('#status-_progress_laporan').html("Sedang mengupload . . . " + evt.loaded + " byte Dari " + evt.total + " byte");
                        $('#progress-percent-_progress_laporan').html("<span>" + Math.round(percent) + "%</span>");
                        $('.progressbar-_progress_laporan').attr('aria-valuenow', Math.round(percent)).css('width', Math.round(percent) + '%');
                    }
                }, false);
                return xhr;
            },
            url: BASE_URL + "/v1/umum/user/updateBiodata",
            type: 'POST',
            data: formUpload,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function() {
                $('.progress-_progress_laporan').css('display', 'block');
                $('.status-_progress_laporan').innerHTML = "Memulai mengupload . . .";
                $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                $('._kirim_permohonan').attr('disabled', 'disabled');
                $('div.content-loading').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.content-loading').unblock();
                // const resul = JSON.parse(resMsg);

                if (resul.code !== 200) {
                    $('.progress-_progress_laporan').css('display', 'none');
                    $('.status-_progress_laporan').innerHTML = "";
                    $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                    $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                    $('._kirim_permohonan').attr('disabled', false);

                    Swal.fire(
                        'Failed!',
                        resul.message,
                        'warning'
                    );
                } else {
                    $('.progress-_progress_laporan').css('display', 'none');
                    $('.status-_progress_laporan').innerHTML = "";
                    $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                    $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                    // $('.button-_progress_laporan').css('display','none');

                    Swal.fire(
                        'SELAMAT!',
                        resul.message,
                        'success'
                    ).then((valRes) => {
                        document.location.href = BASE_URL + '/auth';
                    })
                }
            },
            error: function() {
                $('div.content-loading').unblock();
                $('.progress-_progress_laporan').css('display', 'none');
                $('.status-_progress_laporan').innerHTML = "";
                $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                $('._kirim_permohonan').attr('disabled', false);
                Swal.fire(
                    'Failed!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/css/select2.min.css">
<style>
    #map_inits {
        width: 100%;
        height: 400px;
    }

    .leaflet-tooltip {
        pointer-events: auto
    }

    .preview-image-upload {
        position: relative;
    }

    .preview-image-upload .imagePreviewUpload {
        max-width: 300px;
        max-height: 300px;
        cursor: pointer;
    }

    .preview-image-upload .btn-remove-preview-image {
        display: none;
        position: absolute;
        top: 5px;
        left: 5px;
        /*top: 50%;*/
        /*left: 50%;*/
        /*transform: translate(-50%, -50%);*/
        /*-ms-transform: translate(-50%, -50%);*/
        background-color: #555;
        color: white;
        font-size: 16px;
        padding: 5px 10px;
        border: none;
        /*cursor: pointer;*/
        border-radius: 5px;
    }

    .imagePreviewUpload:hover+.btn-remove-preview-image,
    .btn-remove-preview-image:hover {
        display: block;
    }

    /*.imagePreviewUpload .btn-remove-preview-image:hover {*/

    /*    background-color: black;*/
    /*}*/
</style>
<?= $this->endSection(); ?>