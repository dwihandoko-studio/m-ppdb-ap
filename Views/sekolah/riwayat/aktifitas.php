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
                                <li class="breadcrumb-item"><a href="<?= base_url('sekolah/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Riwayat Aktifitas</li>
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
                                <h3 class="mb-0">Riwayat Aktifitas </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-one-side content_data" id="content_data" data-timeline-content="axis" data-timeline-axis-style="dashed">

                        </div>
                        <div style="margin-top: 40px;" class="col-md-12 content_pagination" id="content_pagination">

                        </div>
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
            document.location.href = "<?= base_url('sekolah/riwayat/aktifitas'); ?>";
        } else {
            document.location.href = action;
        }
    }

    function getDataAktifitas(page = "1") {
        // const keyword = document.getElementsByName('_search_item')[0].value;
        $.ajax({
            url: "<?= base_url('sekolah/riwayat/getAllAktifitas') ?>",
            type: 'POST',
            data: {
                keyword: "",
                page: page,
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
                    $('.content_data').html('');
                    $('.content_pagination').html('');
                } else {
                    $('.content_data').html(resul.data);
                    $('.content_pagination').html(resul.pagination);
                }
            },
            error: function() {
                $('div.main-content').unblock();
                Swal.fire(
                    'Failed!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    $(document).ready(function() {
        getDataAktifitas();
    });

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