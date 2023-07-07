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
                                <li class="breadcrumb-item active" aria-current="page">Rekapitulasi Peserta Lolos PPDB</li>
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
                <?php if (isset($pengumuman_afirmasi) || isset($pengumuman_zonasi)) { ?>
                    <div class="card">
                        <div class="card-header">
                            <h2>REKAPITULASI PESERTA LOLOS PPDB</h2>
                        </div>
                        <div class="card-body">
                            <?php if (isset($pengumuman_afirmasi)) { ?>
                                <?php if ($pengumuman_afirmasi) { ?>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="button" onclick="downloadSptjmAfirmasi()" class="btn btn-block btn-default">Download SPTJM Afirmasi</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button type="button" onclick="downloadLampiranAfirmasi()" class="btn btn-block btn-primary">Download Lampiran Peserta Lolos PPDB Jalur Afirmasi</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php if (isset($pengumuman_zonasi)) { ?>
                                <?php if ($pengumuman_zonasi) { ?>
                                    <div class="col-lg-12 mt-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="button" onclick="downloadSptjmZonasi()" class="btn btn-block btn-default">Download SPTJM Zonasi/Prestasi/Mutasi</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button type="button" onclick="downloadLampiranZonasi()" class="btn btn-block btn-primary">Download Lampiran Peserta Lolos PPDB Jalur Zonasi/Prestasi/Mutasi</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php if (isset($pengumuman_swasta)) { ?>
                                <?php if ($pengumuman_swasta) { ?>
                                    <div class="col-lg-12 mt-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="button" onclick="downloadSptjmSwasta()" class="btn btn-block btn-default">Download SPTJM Swasta</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button type="button" onclick="downloadLampiranSwasta()" class="btn btn-block btn-primary">Download Lampiran Peserta Lolos PPDB Sekolah Swasta</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <?php if (isset($pengumuman_swasta)) { ?>
                        <div class="card">
                            <div class="card-header">
                                <h2>REKAPITULASI PESERTA LOLOS PPDB</h2>
                            </div>
                            <div class="card-body">
                                <?php if (isset($pengumuman_afirmasi)) { ?>
                                    <?php if ($pengumuman_afirmasi) { ?>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button type="button" onclick="downloadSptjmSwasta()" class="btn btn-block btn-default">Download SPTJM</button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <button type="button" onclick="downloadLampiranSwasta()" class="btn btn-block btn-primary">Download Lampiran Peserta Lolos PPDB Sekolah Swasta</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="card">
                            <div class="card-body bg-gradient-info p-0" style="border-radius: 5px; color: #fff;">
                                <!-- <div class="alert alert-success alert-dismissible fade show" role="alert"> -->
                                <center style="padding: 20px;"><span class="alert-icon"><i class="ni ni-notification-70 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br>Saat ini proses pengumuman belum dibuka.</span></button></center>
                                <br />
                                <br />
                                <!-- </div> -->
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
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
    function initSelect2Panel(event) {
        $('#' + event).select2({
            dropdownParent: "#panel"
        });
    }

    function downloadSptjmAfirmasi() {
        window.open('<?= base_url('sekolah/pengumuman/downloadsptjmafirmasi') ?>', '_blank').focus();
    }

    function downloadLampiranAfirmasi() {
        window.open('<?= base_url('sekolah/pengumuman/downloadlampiranafirmasi') ?>', '_blank').focus();
    }

    function downloadSptjmSwasta() {
        window.open('<?= base_url('sekolah/pengumuman/downloadsptjmswasta') ?>', '_blank').focus();
    }

    function downloadLampiranSwasta() {
        window.open('<?= base_url('sekolah/pengumuman/downloadlampiranswasta') ?>', '_blank').focus();
    }

    function downloadSptjmZonasi() {
        window.open('<?= base_url('sekolah/pengumuman/downloadsptjmzonasi') ?>', '_blank').focus();
    }

    function downloadLampiranZonasi() {
        window.open('<?= base_url('sekolah/pengumuman/downloadlampiranzonasi') ?>', '_blank').focus();
    }

    $(document).ready(function() {

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

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<!--<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">-->
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/css/select2.min.css">
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