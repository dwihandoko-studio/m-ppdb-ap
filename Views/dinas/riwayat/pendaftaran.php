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
                                <li class="breadcrumb-item active" aria-current="page">Riwayat Pendaftaran</li>
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
            <!-- Light table -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Riwayat Pendaftaran </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (isset($pendaftaran)) {
                            if ($pendaftaran) {
                                if ((int)$pendaftaran->batal_pendaftar == 0) {
                        ?>
                                    <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                                        <div class="timeline-block">
                                            <span class="timeline-step badge-<?= (int)$pendaftaran->status_pendaftaran > 0 ? 'success' : 'info' ?>"><i class="ni ni-folder-17"></i></span>
                                            <div class="timeline-content">
                                                <small class="text-muted font-weight-bold"><?= tgl_indo2($pendaftaran->created_at) ?></small>
                                                <h5 class="mt-3 mb-0">Mendaftar</h5>
                                                <p class="text-sm mt-1 mb-0">
                                                    <?php //$data->fullname 
                                                    ?> mendaftar melalui jalur <?= $pendaftaran->via_jalur ?>.
                                                </p>
                                                <div class="mt-3">
                                                    <?php if ((int)$pendaftaran->status_pendaftaran > 0) { ?>
                                                        <span class="badge badge-pill badge-success"><i class="ni ni-check-bold"></i></span>
                                                    <?php } else { ?>
                                                        <a class="btn btn-danger" href="javascript:batalPendaftaran('<?= $pendaftaran->id ?>', '<?= $pendaftaran->kode_pendaftaran ?>', '<?= $pendaftaran->via_jalur ?>');">BATALKAN</a>
                                                        <a class="btn btn-info" href="javascript:cetakBuktiPendaftaran('<?= $pendaftaran->id ?>', '<?= $pendaftaran->kode_pendaftaran ?>', '<?= $pendaftaran->via_jalur ?>');">CETAK PENDAFTARAN</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ((int)$pendaftaran->status_pendaftaran > 0) { ?>
                                            <?php if ((int)$pendaftaran->status_pendaftaran == 1) { ?>
                                                <div class="timeline-block">
                                                    <span class="timeline-step badge-success"><i class="ni ni-spaceship"></i></span>
                                                    <div class="timeline-content">
                                                        <small class="text-muted font-weight-bold"><?= tgl_indo2($pendaftaran->updated_aproval) ?></small>
                                                        <h5 class="mt-3 mb-0">Proses Validasi</h5>
                                                        <p class="text-sm mt-1 mb-0">
                                                            <?= $pendaftaran->fullname ?> telah memvalidasi pendaftaran Melalui Jalur <?= $pendaftaran->via_jalur ?> anda.
                                                        </p>
                                                        <div class="mt-3">
                                                            <?php if ((int)$pendaftaran->status_pendaftaran > 1) { ?>
                                                                <span class="badge badge-pill badge-success"><i class="ni ni-check-bold"></i></span>
                                                            <?php } else { ?>
                                                                <a class="btn btn-info" href="javascript:cetakBuktiPendaftaran('<?= $pendaftaran->id ?>', '<?= $pendaftaran->kode_pendaftaran ?>', '<?= $pendaftaran->via_jalur ?>');">CETAK PENDAFTARAN</a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else if ((int)$pendaftaran->status_pendaftaran == 2) { ?>
                                                <div class="timeline-block">
                                                    <span class="timeline-step badge-success"><i class="ni ni-spaceship"></i></span>
                                                    <div class="timeline-content">
                                                        <small class="text-muted font-weight-bold"><?= tgl_indo2($pendaftaran->updated_at) ?></small>
                                                        <h5 class="mt-3 mb-0">Proses Validasi</h5>
                                                        <p class="text-sm mt-1 mb-0">
                                                            <?= $pendaftaran->fullname ?> telah memvalidasi pendaftaran Melalui Jalur <?= $pendaftaran->via_jalur ?> Anda.
                                                        </p>
                                                        <div class="mt-3">
                                                            <span class="badge badge-pill badge-success"><i class="ni ni-check-bold"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else if ((int)$pendaftaran->status_pendaftaran == 3) { ?>

                                                <div class="timeline-block">
                                                    <span class="timeline-step badge-danger"><i class="ni ni-fat-remove"></i></span>
                                                    <div class="timeline-content">
                                                        <small class="text-muted font-weight-bold"><?= tgl_indo2($pendaftaran->update_reject) ?></small>
                                                        <h5 class="mt-3 mb-0">Validasi Pendaftaran Ditolak</h5>
                                                        <p class="text-sm mt-1 mb-0">
                                                            <?= $pendaftaran->fullname ?> telah menolak validasi pendaftaran Melalui Jalur <?= $pendaftaran->via_jalur ?> dengan keterangan : <br><b><?= $pendaftaran->keterangan_penolakan ?>.</b>
                                                        </p>
                                                        <div class="mt-3">
                                                            <span class="badge badge-pill badge-success"><i class="ni ni-check-bold"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else if ((int)$pendaftaran->status_pendaftaran == 4) { ?>
                                                <?php if ($pendaftaran->updated_aproval) { ?>
                                                    <div class="timeline-block">
                                                        <span class="timeline-step badge-success"><i class="ni ni-spaceship"></i></span>
                                                        <div class="timeline-content">
                                                            <small class="text-muted font-weight-bold"><?= tgl_indo2($pendaftaran->updated_aproval) ?></small>
                                                            <h5 class="mt-3 mb-0">Proses Validasi</h5>
                                                            <p class="text-sm mt-1 mb-0">
                                                                <?= $pendaftaran->fullname ?> telah memvalidasi pendaftaran Melalui Jalur <?= $pendaftaran->via_jalur ?> Anda.
                                                            </p>
                                                            <div class="mt-3">
                                                                <span class="badge badge-pill badge-success"><i class="ni ni-check-bold"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="timeline-block">
                                                        <span class="timeline-step badge-danger"><i class="ni ni-fat-remove"></i></span>
                                                        <div class="timeline-content">
                                                            <small class="text-muted font-weight-bold"><?= tgl_indo2($pendaftaran->update_reject) ?></small>
                                                            <h5 class="mt-3 mb-0">Validasi Pendaftaran Ditolak</h5>
                                                            <p class="text-sm mt-1 mb-0">
                                                                <?= $pendaftaran->fullname ?> telah menolak validasi pendaftaran Melalui Jalur <?= $pendaftaran->via_jalur ?> dengan keterangan : <br><b><?= $pendaftaran->keterangan_penolakan ?>.</b>
                                                            </p>
                                                            <div class="mt-3">
                                                                <span class="badge badge-pill badge-success"><i class="ni ni-check-bold"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ((int)$pendaftaran->status_pendaftaran > 1) { ?>
                                            <?php if ((int)$pendaftaran->status_pendaftaran == 2) { ?>
                                                <div class="timeline-block">
                                                    <span class="timeline-step badge-success"><i class="ni ni-paper-diploma"></i></span>
                                                    <div class="timeline-content">
                                                        <small class="text-muted font-weight-bold"><?= tgl_indo2($pendaftaran->updated_aproval) ?></small>
                                                        <h5 class="mt-3 mb-0">PENGUMUMAN</h5>
                                                        <p class="text-sm mt-1 mb-0">
                                                            Pendaftaran Melalui Jalur <?= $pendaftaran->via_jalur ?> telah diumumkan dan anda dinyatakan <b>LOLOS</b> seleksi PPDB pada sekolah tujuan anda.</b>.
                                                        </p>
                                                        <div class="mt-3">
                                                            <span class="badge badge-pill badge-success"><i class="ni ni-check-bold"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else if ((int)$pendaftaran->status_pendaftaran == 4) { ?>
                                                <?php if ($pendaftaran->updated_at) { ?>
                                                    <div class="timeline-block">
                                                        <span class="timeline-step badge-danger"><i class="ni ni-fat-remove"></i></span>
                                                        <div class="timeline-content">
                                                            <small class="text-muted font-weight-bold"><?= tgl_indo2($pendaftaran->updated_at) ?></small>
                                                            <h5 class="mt-3 mb-0">PENGUMUMAN</h5>
                                                            <p class="text-sm mt-1 mb-0">
                                                                Pendaftaran Melalui Jalur <?= $pendaftaran->via_jalur ?> telah diumumkan dan anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB pada sekolah tujuan anda.</b>.
                                                            </p>
                                                            <div class="mt-3">
                                                                <span class="badge badge-pill badge-success"><i class="ni ni-check-bold"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                        <?php }
                            }
                        } ?>
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
    </div>
</div>
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
            document.location.href = "<?= base_url('peserta/home'); ?>";
        } else {
            document.location.href = action;
        }
    }

    function cetakBuktiPendaftaran(id, kode, jalur) {
        window.open(
            "<?= base_url('peserta/riwayat/cetakpendaftaran') ?>?id=" + id + "&kode=" + kode + "&jalur=" + jalur, "_blank");
        // $.ajax({
        //     url: "<?= base_url('peserta/riwayat/cetakpendaftaran') ?>",
        //     type: 'POST',
        //     data: {
        //         id: id,
        //         kode: kode,
        //         jalur: jalur,
        //     },
        //     dataType: 'JSON',
        //     beforeSend: function() {
        //         $('div.main-content').block({
        //             message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        //         });
        //     },
        //     success: function(resul) {
        //         $('div.main-content').unblock();

        //         if (resul.code !== 200) {
        //             Swal.fire(
        //                 'Failed!',
        //                 resul.message,
        //                 'warning'
        //             );
        //         } else {
        //             $('#contentModalLabel').html('CETAK PENDAFTARAN');
        //             $('.contentBodyModal').html(resul.data);
        //             $('#contentModal').modal({
        //                 backdrop: 'static',
        //                 keyboard: false
        //             }, 'show');
        //         }
        //     },
        //     error: function() {
        //         $('div.main-content').unblock();
        //         Swal.fire(
        //             'Failed!',
        //             "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
        //             'warning'
        //         );
        //     }
        // });
    }

    function batalPendaftaran(id, kode, jalur) {
        Swal.fire({
            title: 'Apakah anda yakin ingin membatalkan pendaftaran ini?',
            text: "Batal Daftar melalui jalur " + jalur,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batal Daftar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('peserta/riwayat/aksibatal') ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        kode: kode,
                        jalur: jalur
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
                                'SELAMAT!',
                                resul.message,
                                'success'
                            ).then((valRes) => {
                                reloadPage();
                            })
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
        // initSelect2Panel('_provinsi');
        // initSelect2Panel('_kabupaten');
        // initSelect2Panel('_kelurahan');
        // initSelect2Panel('_kecamatan');
        // initSelect2Panel('_dusun');
        <?php if (isset($pemilik)) {
            if ($pemilik->tgl_lahir != null) { ?>
                //         initializeDatetime('_tgl_lahir', '<?= $pemilik->tgl_lahir ?>');
            <?php } else { ?>
                //         initializeDatetime('_tgl_lahir', new Date().toLocaleDateString('fr-CA'));
            <?php } ?>
        <?php } else { ?>
            //     initializeDatetime('_tgl_lahir', new Date().toLocaleDateString('fr-CA'));
        <?php } ?>
    });

    function changeValidation(event) {
        $('.' + event).css('display', 'none');
    };

    function inputFocus(id) {
        const color = $(id).attr('id');
        $(id).removeAttr('style');
        $('.' + color).html('');
    }

    function ambilId(id) {
        return document.getElementById(id);
    }
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