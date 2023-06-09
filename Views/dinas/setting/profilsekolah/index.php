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
                    <div class="col-lg-8 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="<?= base_url('dinas/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Setting Profil Sekolah</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- <div class="col-lg-4 col-5 text-right">
                        <a href="<?= base_url('dinas/setting/profilsekolah') ?>" class="btn btn-sm btn-neutral">KEMBALI</a>
                    </div> -->
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
                            <div class="col-lg-8 col-7">
                                <!--<h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>-->
                                <h5 class="h3 mb-0">SETTING PROFIL SEKOLAH</h5>
                            </div>
                            <div class="col-lg-4 col-5 text-right">
                                <button type="button" onclick="actionAdd(this)" class="btn btn-sm btn-primary">Tambah Profil Sekolah</button>
                                <button type="button" onclick="actionImport(this)" class="btn btn-sm btn-primary">Import Profil Sekolah</button>
                            </div>
                        </div>

                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table id="data-table-id" class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th data-orderable="false">Status</th>
                                    <th data-orderable="false">Aksi</th>
                                    <th>NPSN</th>
                                    <th>Nama Sekolah</th>
                                    <th>Nama Kepala Sekolah</th>
                                    <th>NIP Kepala Sekolah</th>
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
    function reloadPage(action = "") {
        if (action === "") {
            document.location.href = "<?= current_url(true); ?>";
        } else {
            document.location.href = action;
        }
    }

    function actionDetail(event) {
        $.ajax({
            url: "<?= base_url('dinas/setting/profilsekolah/detail') ?>",
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

                    $('#contentModalLabel').html('DETAIL PROFIL SEKOLAH');
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
            text: "Hapus data profil sekolah : " + title,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('dinas/setting/profilsekolah/hapus') ?>",
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

    function actionEdit(event) {
        $.ajax({
            url: "<?= base_url('dinas/setting/profilsekolah/edit') ?>",
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

                    $('#contentModalLabel').html('EDIT PROFIL SEKOLAH');
                    $('.contentBodyModal').html(resul.data);
                    $('#contentModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }, 'show');

                    // initSelect2('_prov', '#contentModal');
                    // initSelect2('_kab', '#contentModal');
                    // initSelect2('_kec', '#contentModal');
                    // initSelect2('_kel', '#contentModal');
                    // initSelect2('_dusun', '#contentModal');
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

    function actionAdd(event) {
        $.ajax({
            url: "<?= base_url('dinas/setting/profilsekolah/add') ?>",
            type: 'POST',
            data: {
                id: 'add',
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

                    $('#contentModalLabel').html('TAMBAH PROFIL SEKOLAH');
                    $('.contentBodyModal').html(resul.data);
                    $('#contentModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }, 'show');

                    // initSelect2('_prov', '#contentModal');
                    // initSelect2('_kab', '#contentModal');
                    // initSelect2('_kec', '#contentModal');
                    // initSelect2('_kel', '#contentModal');
                    // initSelect2('_dusun', '#contentModal');
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

    function actionImport(event) {
        document.location.href = BASE_URL + '/dinas/setting/profilsekolah/import';

    }

    function changeValidation(event) {
        $('.' + event).css('display', 'none');
    };

    function inputFocus(id) {
        const color = $(id).attr('id');
        $(id).removeAttr('style');
        $('.' + color).html('');
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

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    $(document).ready(function() {
        initSelect2('filter_sekolah', '#panel');
        initSelect2('filter_jenjang', '#panel');

        let tableUsulan = $('#data-table-id').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "./getAll",
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
                    title: 'Rekap Data Kuota Sekolah',
                    text: 'PDF',
                }
            ]
        });

        // $('#filter_sekolah').change(function() {
        //     tableUsulan.draw();
        // });


    });

    function initSelect2(event, parrent) {
        $('#' + event).select2({
            dropdownParent: parrent
        });
    }
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