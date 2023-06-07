<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>

<!--<body>-->
<!-- Main content -->
<div class="main-content" id="panel">
    <?= $this->include('templates/topnav'); ?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="<?= base_url('dinas/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Setting Kuota</li>
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
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-7">
                                <h5 class="h3 mb-0">SETTING ZONASI SEKOLAH</h5>
                            </div>
                            <div class="col-lg-6 col-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="form-group jenjang-block">
                                            <label for="filter_jenjang" class="form-control-label">Filter Jenjang</label>
                                            <select class="form-control filter-jenjang" name="filter_jenjang" id="filter_jenjang" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                <option value="">-- Pilih --</option>
                                                <?php if(isset($jenjangs)) {
                                                if(count($jenjangs) > 0) {
                                                    foreach ($jenjangs as $key => $value) {
                                                        echo '<option value="' . $value->id . '">' . $value->nama . '</option>';
                                                    }
                                                }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group filter_kecamatan-block">
                                            <label for="filter_kecamatan" class="form-control-label">Filter Kecamatan</label>
                                            <select class="form-control filter-kecamatan" name="filter_kecamatan" id="filter_kecamatan" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                <option value="">-- Pilih --</option>
                                                <?php if(isset($instansis)) {
                                                if(count($instansis) > 0) {
                                                    foreach ($instansis as $key => $value) {
                                                        echo '<option value="' . $value->id . '">' . $value->nama . '</option>';
                                                    }
                                                }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table id="data-table-id" class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    <th data-orderable="false">Aksi</th>
                                    <th data-orderable="false">Status</th>
                                    <th data-orderable="false">Jenjang</th>
                                    <th >NPSN</th>
                                    <th >Nama Sekolah</th>
                                    <th >Nama Kecamatan</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
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
<!--<script src="<?= base_url('assets/js'); ?>/ckeditor5/build/build/ckeditor.js"></script>-->
<!--<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>-->
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script>

<script>
    function initSelect2(event, parrent) {
        $('#' + event).select2({
            dropdownParent: parrent
        });
    }

    function reloadPage(action = "") {
        if (action === "") {
            document.location.href = "<?= current_url(true); ?>";
        } else {
            document.location.href = action;
        }
    }
    
    function ambilId(id) {
        return document.getElementById(id);
    }

    $(document).ready(function() {
        initSelect2('filter_jenjang', '#panel');
        initSelect2('filter_kecamatan', '#panel');

        let tableUsulan = $('#data-table-id').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('dinas/setting/zonasi/getAllSekolah') ?>",
                "type": "POST",
                "data": function(data) {
                    data.filter_kecamatan = $('#filter_kecamatan').val();
                    data.filter_jenjang = $('#filter_jenjang').val();
                }
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
        
        $('#filter_jenjang').change(function() {
            tableUsulan.draw();
        });

        $('#filter_kecamatan').change(function() {
            tableUsulan.draw();
        });

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