<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>

<div class="main-content" id="panel">
    <?= $this->include('templates/topnav'); ?>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <!-- <div class="row"> -->
                <div class="alert alert-default bg-gradient-white alert-dismissible fade show" role="alert">
                    <span class="alert-icon" style="color: #32325d !important;"><i class="ni ni-notification-70"></i></span>
                    <span class="alert-text" style="color: #32325d !important;"><strong>Selamat Datang <?= $user->fullname ?>!</strong><br> Di <?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>.</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="color: #32325d !important;">&times;</span>
                    </button>
                </div>
                <!-- </div> -->
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <?php if (isset($lengkap_data)) {
                                if ($lengkap_data->profile_picture == null) { ?>
                                    <a href="<?= base_url('peserta/user/profile') ?>">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">LENGKAPI DATA</h5><span>Belum Lengkap</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">1</div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm"><span class="text-danger mr-2"><i class="ni ni-fat-remove"></i> Data belum dilengkapi.</span><br>Lengkapi Sekarang</p>
                                        </div>
                                    </a>
                                <?php } else { ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">LENGKAPI DATA</h5><span>Sudah Lengkap</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">1</div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-check"></i> Data telah dilengkapi dan diverifikasi.</span></p>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <a href="<?= base_url('peserta/user/profile') ?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">LENGKAPI DATA</h5><span>Belum Lengkap</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">1</div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-sm"><span class="text-danger mr-2"><i class="ni ni-fat-remove"></i> Data belum dilengkapi.</span><br>Lengkapi Sekarang</p>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <?php if (isset($lengkap_berkas)) { ?>
                                <?php if ($lengkap_berkas->lampiran_kk == null || $lengkap_berkas->lampiran_akta_kelahiran == null) { ?>
                                    <a href="<?= base_url('peserta/upload') ?>">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">UPLOAD BERKAS</h5><span>Belum Upload</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">2</div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm"><span class="text-danger mr-2"><i class="ni ni-fat-remove"></i> Berkas belum diupload.</span><br>Upload Sekarang</p>
                                        </div>
                                    </a>
                                <?php } else { ?>
                                    <?php if ($lengkap_berkas->lampiran_lulus == null) { ?>
                                        <?php if (substr($user->nisn, 0, 2) == "BS") { ?>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-0">UPLOAD BERKAS</h5><span>Sudah Upload</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">2</div>
                                                    </div>
                                                </div>
                                                <p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-check"></i> Berkas telah diupload.</span></p>
                                            </div>
                                        <?php } else { ?>
                                            <a href="<?= base_url('peserta/upload') ?>">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="card-title text-uppercase text-muted mb-0">UPLOAD BERKAS</h5><span>Belum Upload</span>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">2</div>
                                                        </div>
                                                    </div>
                                                    <p class="mt-3 mb-0 text-sm"><span class="text-danger mr-2"><i class="ni ni-fat-remove"></i> Berkas belum diupload.</span><br>Upload Sekarang</p>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">UPLOAD BERKAS</h5><span>Sudah Upload</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">2</div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-check"></i> Berkas telah diupload.</span></p>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <!-- <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">UPLOAD BERKAS</h5><span>Sudah Upload</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">2</div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-check"></i> Berkas telah diupload.</span></p>
                                    </div> -->
                            <?php } else { ?>
                                <a href="<?= base_url('peserta/upload') ?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">UPLOAD BERKAS</h5><span>Belum Upload</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">2</div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-sm"><span class="text-danger mr-2"><i class="ni ni-fat-remove"></i> Berkas belum diupload.</span><br>Upload Sekarang</p>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <?php if (isset($error)) { ?>
                                <?php if ($error) { ?>
                                    <?php if (isset($success)) { ?>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">DAFTAR SEKOLAH</h5><span>Sudah Daftar</span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">3</div>
                                                </div>
                                            </div>
                                            <p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-check"></i> Telah melakukan pendaftaran Melalui Jalur <?= $sekolah_pilihan->via_jalur ?>.</span></p>
                                        </div>
                                    <?php } else { ?>
                                        <?php if (isset($warning)) { ?>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-0">DAFTAR SEKOLAH</h5><span>Tidak Lolos</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">3</div>
                                                    </div>
                                                </div>
                                                <p class="mt-3 mb-0 text-sm"><span class="text-danger mr-2"><i class="ni ni-fat-remove"></i> Tidak lolos pendaftaran Melalui Jalur <?= $sekolah_pilihan->via_jalur ?>.</span></p>
                                            </div>
                                        <?php } else { ?>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-0">DAFTAR SEKOLAH</h5><span>Sudah Daftar</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">3</div>
                                                    </div>
                                                </div>
                                                <p class="mt-3 mb-0 text-sm"><span class="text-success mr-2"><i class="fa fa-check"></i> Telah melakukan pendaftaran Melalui Jalur <?= $sekolah_pilihan->via_jalur ?>.</span></p>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">DAFTAR SEKOLAH</h5><span>Belum Daftar</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">3</div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-sm"><span class="text-danger mr-2"><i class="ni ni-fat-remove"></i> Belum melakukan pendaftaran ke sekolah</span></p>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">DAFTAR SEKOLAH</h5><span>Belum Daftar</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">3</div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm"><span class="text-danger mr-2"><i class="ni ni-fat-remove"></i> Belum melakukan pendaftaran ke sekolah</span></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">

        <?php if (isset($error)) { ?>
            <?php if (isset($success)) { ?>
                <div class="card">
                    <div class="card-body bg-gradient-success p-0" style="border-radius: 5px; color: #fff;">
                        <!-- <div class="alert alert-success alert-dismissible fade show" role="alert"> -->
                        <center style="padding: 20px;"><span class="alert-icon"><i class="ni ni-notification-70 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br><?= $success ?></span></button></center>
                        <br />
                        <br />

                        <!-- </div> -->
                    </div>
                </div>
            <?php } else { ?>
                <?php if (isset($warning)) { ?>
                    <div class="card">
                        <div class="card-body bg-gradient-danger p-0" style="border-radius: 5px; color: #fff;">
                            <!-- <div class="alert alert-success alert-dismissible fade show" role="alert"> -->
                            <center style="padding: 20px;"><span class="alert-icon"><i class="ni ni-notification-70 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br><?= $warning ?></span></button></center>
                            <br />
                            <br />
                            <!-- </div> -->
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="card">
                        <div class="card-body bg-gradient-success p-0" style="border-radius: 5px; color: #fff;">
                            <!-- <div class="alert alert-success alert-dismissible fade show" role="alert"> -->
                            <center style="padding: 20px;"><span class="alert-icon"><i class="ni ni-notification-70 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br><?= $error ?></span></button></center>
                            <br />
                            <?php if (isset($sekolah_pilihan)) { ?>
                                <center>
                                    <ol>
                                        <li style="list-style: none;"><?= $sekolah_pilihan->tujuan_sekolah_id_2 !== NULL ? 'Sekolah Pilihan Pertama' : 'Sekolah yang dituju' ?> : <?= getNamaAndNpsnSekolah($sekolah_pilihan->tujuan_sekolah_id_1) ?></li>
                                    </ol>
                                </center>
                            <?php } ?>
                            <!-- </div> -->
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <div class="card">
            <div class="card-header">
                <h5 class="h3 mb-0">PENGUMUMAN</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <?php if (isset($pengumumans)) {
                        if (count($pengumumans) > 0) {
                            foreach ($pengumumans as $key => $value) { ?>
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <div class="d-flex w-100 align-items-center"><span class="avatar avatar-xs mr-2" style="color: #32325d !important;"><i class="ni ni-notification-70"></i></span>
                                                <h5 class="mb-1">Panitia PPDB</h5>
                                            </div>
                                        </div><small><?= make_time_long_ago($value->created_at) ?></small>
                                    </div>
                                    <h4 class="mt-3 mb-1"><?= $value->judul ?></h4>
                                    <p class="text-sm mb-0"><?= $value->isi ?></p>
                                </a>
                    <?php }
                        }
                    } ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="contentSuccessModal" tabindex="-1" role="dialog" aria-labelledby="contentSuccessModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-success modal-dialog-centered" role="document">
                <div class="modal-content bg-gradient-success content-success-data">



                </div>
            </div>

        </div>

        <div class="modal fade" id="contentDangerModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
                <div class="modal-content bg-gradient-danger content-danger-data">



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
        <!-- Footer -->
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url('new-assets/assets'); ?>/js/jquery-block-ui.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>

<script>
    let tableLayananPpdbActive;
    let tableLayananPpdbPending;
    let tableLayananPpdbSuspend;

    function loadLayananPpdbActive() {
        if (tableLayananPpdbActive === undefined) {
            tableLayananPpdbActive = $('#table-layanan-ppdb-active').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('v1/dinas/layanan/ppdb/getAllActive') ?>",
                    "type": "POST",

                },
                language: {
                    paginate: {
                        next: '<i class="ni ni-bold-right">',
                        previous: '<i class="ni ni-bold-left">'
                    },
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                },
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                }],
            });
        } else {
            tableLayananPpdbActive.draw();
        }
    }

    function loadLayananPpdbPending() {
        if (tableLayananPpdbPending === undefined) {
            tableLayananPpdbPending = $('#table-layanan-ppdb-pending').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('v1/dinas/layanan/ppdb/getAllPending') ?>",
                    "type": "POST",

                },
                language: {
                    paginate: {
                        next: '<i class="ni ni-bold-right">',
                        previous: '<i class="ni ni-bold-left">'
                    },
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                },
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                }],
            });

        } else {
            tableLayananPpdbPending.draw();
        }
    }

    function loadLayananPpdbSuspend() {
        if (tableLayananPpdbSuspend === undefined) {

            tableLayananPpdbSuspend = $('#table-layanan-ppdb-suspend').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('v1/dinas/layanan/ppdb/getAllSuspend') ?>",
                    "type": "POST",

                },
                language: {
                    paginate: {
                        next: '<i class="ni ni-bold-right">',
                        previous: '<i class="ni ni-bold-left">'
                    },
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                },
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                }],
            });

        } else {
            tableLayananPpdbSuspend.draw();
        }
    }

    function filterStr(str) {
        let pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？%+_]");
        let specialStr = "";
        for (let i = 0; i < str.length; i++) {
            specialStr += str.substr(i, 1).replace(pattern, '');
        }
        return specialStr;
    }

    function ambilId(id) {
        return document.getElementById(id);
    }

    $(document).ready(function() {
        // loadLayananPpdbActive();

        <?php if (isset($informasi)) { ?>
            let contentInformation = '';
            contentInformation += '<div class="modal-body">';
            contentInformation += '<div class="col-md-12">';
            contentInformation += '<?= $informasi->isi ?>';
            contentInformation += '</div>';
            contentInformation += '</div>';

            $('#documentModalLabel').html('PEMBERITAHUAN');
            $('.documentBodyModal').html(contentInformation);
            $('#documentModal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
        <?php } ?>
    });
</script>

<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/css/select2.min.css">
<style>
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