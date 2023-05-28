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
                    <span class="alert-text" style="color: #32325d !important;"><strong>Selamat Datang <?= $user->fullname ?>!</strong><br> Di <?= getenv('web.meta.title') ? getenv('web.meta.title') : 'PPDB' ?>.</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="color: #32325d !important;">&times;</span>
                    </button>
                </div>
                <!-- </div> -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pendaftar Zonasi</h5><span class="h2 font-weight-bold mb-0"><?php (isset($jumlahPendaftar)) ? $jumlahPendaftar->pendaftarZonasiVerified : 0 ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow"><i class="fas fa-map-marked-alt"></i></div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pendaftar Afirmasi</h5><span class="h2 font-weight-bold mb-0"><?php (isset($jumlahPendaftar)) ? (int)$jumlahPendaftar->pendaftarAfirmasiVerified + (int)$jumlahPendaftar->pendaftarAfirmasiAntrian : 0 ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow"><i class="ni ni-app"></i></div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pendaftar Prestasi</h5><span class="h2 font-weight-bold mb-0"><?php (isset($jumlahPendaftar)) ? (int)$jumlahPendaftar->pendaftarPrestasiVerified + (int)$jumlahPendaftar->pendaftarPrestasiAntrian : 0 ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow"><i class="ni ni-trophy"></i></div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pendaftar Mutasi</h5><span class="h2 font-weight-bold mb-0"><?php (isset($jumlahPendaftar)) ? (int)$jumlahPendaftar->pendaftarMutasiVerified + (int)$jumlahPendaftar->pendaftarMutasiAntrian : 0 ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow"><i class="ni ni-vector"></i></div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
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