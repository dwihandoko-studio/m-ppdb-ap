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
                                <li class="breadcrumb-item"><a href="<?= base_url('dinas/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Referensi Kelurahan</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-lg-6 col-5 text-right">
                        <button type="button" onclick="actionAdd(this)" class="btn btn-sm btn-neutral">Tambah Kelurahan</button>
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
                                <!--<h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>-->
                                <h5 class="h3 mb-0">DATA REFERENSI KELURAHAN</h5>
                            </div>
                            <div class="col-lg-6 col-7">
                                <div class="form-group kec-block">
                                    <label for="filter_kec" class="form-control-label">Filter Kecamatan</label>
                                    <select class="form-control filter-kec" name="filter_kec" id="filter_kec" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                        <option value="">-- Pilih --</option>
                                        <?php if (isset($kecamatans)) {
                                            if (count($kecamatans) > 0) {
                                                foreach ($kecamatans as $key => $value) { ?>
                                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                        <?php }
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table-id" class="table align-items-center table-flush cell-border" style="border-bottom-width: 1px; border-bottom-style: solid;border-bottom-color: rgb(17, 17, 17);border-right-width: 1px; border-right-style: solid;border-right-color: rgb(17, 17, 17);border-left-color: rgb(17, 17, 17);">
                                <thead style="border-bottom-width: 1px; border-bottom-style: solid;border-bottom-color: rgb(17, 17, 17);border-right-width: 1px; border-right-style: solid;border-right-color: rgb(17, 17, 17);border-left-color: rgb(17, 17, 17);">
                                    <tr>

                                        <th data-orderable="false">#</th>
                                        <th data-orderable="false">ACTION</th>
                                        <th>KODE WILAYAH</th>
                                        <th>NAMA KELURAHAN</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-loading">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contentModalLabel">Modal title</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
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
<script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>

<script>

    function reloadPage(action = "") {
        if (action === "") {
            document.location.href = "<?= current_url(true); ?>";
        } else {
            document.location.href = action;
        }
    }
    
    function changeValidation(event) {
        $('.' + event).css('display', 'none');
    };

    function inputFocus(id) {
        $(id).removeAttr('style');
    }

    function inputChange(event) {
        console.log(event.value);
        if (event.value === null || (event.value.length > 0 && event.value !== "")) {
            $(event).removeAttr('style');
        } else {
            $(event).css("color", "#dc3545");
            $(event).css("border-color", "#dc3545");
            // $('.nama_instansi').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
    }

    function ambilId(id) {
        return document.getElementById(id);
    }

    function initSelect2(event, lokasi) {
        $('#' + event).select2({
            dropdownParent: lokasi
        });
    }

    function actionAdd(event) {
        $.ajax({
            url: "<?= base_url('dinas/masterdata/kelurahan/add') ?>",
            type: 'GET',
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
                            'Failed!',
                            resul.message,
                            'warning'
                        );
                    }
                } else {
                    $('#contentModalLabel').html('TAMBAH KELURAHAN');
                    $('.contentBodyModal').html(resul.data);
                    $('#contentModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }, 'show');
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

    function actionHapus(event, title = "") {
        Swal.fire({
            title: 'Apakah anda yakin ingin menghapus data ini?',
            text: "Referensi Kelurahan/Desa : " + title,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('dinas/masterdata/kelurahan/hapus') ?>",
                    type: 'POST',
                    data: {
                        id: event,
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
                                    'Failed!',
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
                            'Failed!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }
        })
    }

    $(document).ready(function() {
        initSelect2('filter_kec', '#panel');

        let tableUsulan = $('#data-table-id').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('dinas/masterdata/kelurahan/getAll') ?>",
                "type": "POST",
                "data": function(data) {
                    data.filter_kec = $('#filter_kec').val();
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
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    // messageTop: 'Rekapitulasi Data Pendaftar PPDB DISDIKBUD Kab. Lampung Tengah Tahun 2021',
                    title: 'Rekap Data Referensi',
                    text: 'PDF',
                }
            ]
        });

        $('#filter_kec').change(function() {
            tableUsulan.draw();
        });

    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
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