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
                    <?php if ((int)$user->statusSekolah == 1) { ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Pendaftar Zonasi</h5><span class="h2 font-weight-bold mb-0 jumlah_zonasi"><i class="fas fa-spinner fa-spin"></i></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow"><i class="fas fa-map-marked-alt"></i></div>
                                        </div>
                                    </div>
                                    <p class="mt-1 mb-0 text-sm"><span class="text-success mr-2 jumlah_zonasi_terverifikasi"></span><br><span class="text-warning mr-2 jumlah_zonasi_belum_verifikasi"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Pendaftar Afirmasi</h5><span class="h2 font-weight-bold mb-0 jumlah_afirmasi"><i class="fas fa-spinner fa-spin"></i></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow"><i class="ni ni-app"></i></div>
                                        </div>
                                    </div>
                                    <p class="mt-1 mb-0 text-sm"><span class="text-success mr-2 jumlah_afirmasi_terverifikasi"></span><br><span class="text-warning mr-2 jumlah_afirmasi_belum_verifikasi"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Pendaftar Prestasi</h5><span class="h2 font-weight-bold mb-0 jumlah_prestasi"><i class="fas fa-spinner fa-spin"></i></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow"><i class="ni ni-trophy"></i></div>
                                        </div>
                                    </div>
                                    <p class="mt-1 mb-0 text-sm"><span class="text-success mr-2 jumlah_prestasi_terverifikasi"></span><br><span class="text-warning mr-2 jumlah_prestasi_belum_verifikasi"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Pendaftar Mutasi</h5><span class="h2 font-weight-bold mb-0 jumlah_mutasi"><i class="fas fa-spinner fa-spin"></i></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow"><i class="ni ni-vector"></i></div>
                                        </div>
                                    </div>
                                    <p class="mt-1 mb-0 text-sm"><span class="text-success mr-2 jumlah_mutasi_terverifikasi"></span><br><span class="text-warning mr-2 jumlah_mutasi_belum_verifikasi"></span></p>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-xl-6 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Pendaftar</h5><span class="h2 font-weight-bold mb-0 jumlah_swasta"><i class="fas fa-spinner fa-spin"></i></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow"><i class="ni ni-hat-3"></i></div>
                                        </div>
                                    </div>
                                    <p class="mt-1 mb-0 text-sm"><span class="text-success mr-2 jumlah_swasta_terverifikasi"></span><br><span class="text-warning mr-2 jumlah_swasta_belum_verifikasi"></span></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
        <?php if (isset($pengumumans)) { ?>
            <?php if (count($pengumumans) > 0) { ?>
                <div id="myModal" class="modal fade show" tabindex="-1" aria-labelledby="myModalLabel" style="display: block;" aria-modal="true" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">INFORMASI</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?= $pengumumans[0]->isi ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
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
<script src="<?= base_url('new-assets') ?>/assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>

<script>
    function loadStatistik() {
        $.ajax({
            url: BASE_URL + '/sekolah/home/statistik',
            type: 'GET',
            dataType: 'JSON',
            success: function(msg) {
                if (msg.code === 200) {
                    <?php if ((int)$user->statusSekolah == 1) { ?>
                        $('.jumlah_zonasi').html(msg.data.zonasi);
                        $('.jumlah_afirmasi').html(msg.data.afirmasi);
                        $('.jumlah_mutasi').html(msg.data.mutasi);
                        $('.jumlah_prestasi').html(msg.data.prestasi);
                        $('.jumlah_zonasi_terverifikasi').html('<i class="fa fa-check"></i> Terverifikasi: ' + msg.data.zonasi_terverifikasi);
                        $('.jumlah_zonasi_belum_verifikasi').html('<i class="fa fa-spin"></i> Belum Verifikasi: ' + msg.data.zonasi_belum_terverifikasi);
                        $('.jumlah_afirmasi_terverifikasi').html('<i class="fa fa-check"></i> Terverifikasi: ' + msg.data.afirmasi_terverifikasi);
                        $('.jumlah_afirmasi_belum_verifikasi').html('<i class="fa fa-spin"></i> Belum Verifikasi: ' + msg.data.afirmasi_belum_terverifikasi);
                        $('.jumlah_prestasi_terverifikasi').html('<i class="fa fa-check"></i> Terverifikasi: ' + msg.data.prestasi_terverifikasi);
                        $('.jumlah_prestasi_belum_verifikasi').html('<i class="fa fa-spin"></i> Belum Verifikasi: ' + msg.data.prestasi_belum_terverifikasi);
                        $('.jumlah_mutasi_terverifikasi').html('<i class="fa fa-check"></i> Terverifikasi: ' + msg.data.mutasi_terverifikasi);
                        $('.jumlah_mutasi_belum_verifikasi').html('<i class="fa fa-spin"></i> Belum Verifikasi: ' + msg.data.mutasi_belum_terverifikasi);

                    <?php } else { ?>
                        $('.jumlah_swasta').html(msg.data.total_swasta);
                        $('.jumlah_swasta_terverifikasi').html('<i class="fa fa-check"></i> Terverifikasi: ' + msg.data.total_swasta_terverifikasi);
                        $('.jumlah_swasta_belum_verifikasi').html('<i class="fa fa-spin"></i> Belum Verifikasi: ' + msg.data.total_swasta_belum_terverifikasi);
                    <?php } ?>
                }
            },
            error: function(data) {
                console.log(data);
            }
        })
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

    function disabledLoad() {
        $('.jumlah_zonasi').html("&nbsp;");
        $('.jumlah_afirmasi').html("&nbsp;");
        $('.jumlah_mutasi').html("&nbsp;");
        $('.jumlah_prestasi').html("&nbsp;");
        $('.jumlah_zonasi_terverifikasi').html('');
        $('.jumlah_zonasi_belum_verifikasi').html('');
        $('.jumlah_afirmasi_terverifikasi').html('');
        $('.jumlah_afirmasi_belum_verifikasi').html('');
        $('.jumlah_prestasi_terverifikasi').html('');
        $('.jumlah_prestasi_belum_verifikasi').html('');
        $('.jumlah_mutasi_terverifikasi').html('');
        $('.jumlah_mutasi_belum_verifikasi').html('');
    }

    <?php if (isset($changednow)) { ?>
        <?php if ($changednow) { ?>
            let contenChangePassword = '';
            contenChangePassword += '<div class="modal-content bg-gradient-danger"><div class="modal-header"><h6 class="modal-title" id="modal-title-notification">Peringatan ganti password...!!!!</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body"><div class="py-3 text-center"><i class="ni ni-bell-55 ni-3x"></i><h4 class="heading mt-4">Akun anda masih menggunakan Password Default!</h4><p>Untuk keamanan dan kenyamanan anda, silahkan ganti password anda terlebih dahulu.</p></div></div><div class="modal-footer"><a href="<?= base_url('sekolah/user/gantipassword') ?>" class="btn btn-white">Ok, Ganti Sekarang</a> <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button></div></div>';

            // $('#documentModalLabel').html('PEMBERITAHUAN');
            $('.content-danger-data').html(contenChangePassword);
            $('#contentDangerModal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
        <?php } ?>
    <?php } else { ?>
        <?php if (isset($sprofilc)) { ?>
            <?php if ($sprofilc) { ?>
                const animIn = $(this).attr('data-animation-in');
                const animOut = $(this).attr('data-animation-out');
                $.notify({
                    icon: 'ni ni-bell-55',
                    title: ' Peringatan!!!',
                    message: 'Profil sekolah terdeteksi belum dilengkapi, silahkan untuk dilengkapi terlebih dahulu.',
                    url: '<?= base_url('sekolah/setting/profilsekolah') ?>'
                }, {
                    element: 'body',
                    type: 'warning',
                    allow_dismiss: true,
                    placement: {
                        from: 'top',
                        align: 'center'
                    },
                    offset: {
                        x: 15,
                        y: 15
                    },
                    spacing: 10,
                    z_index: 1080,
                    delay: 2500,
                    timer: 25000,
                    url_target: '_blank',
                    mouse_over: false,
                    animate: {
                        enter: animIn,
                        exit: animOut
                    },
                    template: '<div data-notify="container" class="alert alert-dismissible alert-{0} alert-notify" role="alert">' + '<span class="alert-icon" data-notify="icon"></span> ' + '<div class="alert-text"</div> ' + '<span class="alert-title" data-notify="title">{1}</span> ' + '<span data-notify="message">{2}</span>' + '</div>' + '<button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + '</div>'
                });
            <?php } ?>
        <?php } ?>
    <?php } ?>

    $(document).ready(function() {
        loadStatistik();
        disabledLoad();

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