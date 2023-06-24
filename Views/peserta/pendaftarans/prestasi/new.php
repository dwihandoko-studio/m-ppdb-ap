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
                                <li class="breadcrumb-item"><a href="<?= base_url('v1/admin/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Lolos Verifikasi SPJ Laporan TPG</li>
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
                    <div class="card-header">
                        <h5 class="h3 mb-0">PENDAFTARAN VIA JALUR ZONASI</h5>
                        <!-- <p>Daftar Sekolah Yang Dalam Ruang Lingkup Zonasi.</p> -->
                    </div>
                    <!-- <div class="card-header py-0">
                        <form>
                            <div class="form-group mb-0">
                                <div class="input-group input-group-lg input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="fas fa-search"></span></div>
                                    </div><input type="search" class="form-control" placeholder="Search">
                                </div>
                            </div>
                        </form>
                    </div> -->
                    <!-- Light table -->
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                        <table id="data-table-id" class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th data-orderable="false" style="padding-left: 0px; padding-right: 0px;">
                                        Daftar Sekolah Yang Dalam Ruang Lingkup Zonasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 20; $i++) { ?>
                                    <tr>
                                        <td>
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <a href="javascript:;" class="avatar rounded-circle">
                                                        <img alt="Image placeholder" src="<?= base_url('new-assets') ?>/assets/img/theme/team-1.jpg">
                                                    </a>
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0">
                                                        <a href="#!">
                                                            John Michael
                                                        </a>
                                                    </h4>
                                                    <span class="text-success">●</span> <small>Online</small>
                                                </div>

                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-sm btn-primary">Daftar</button>
                                                </div>
                                            </div>
                                            <!-- </td>
                                            <td> -->
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- </div> -->
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
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>
<script>
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

    function initSelect2(event) {
        $('#' + event).select2({
            dropdownParent: "#contentModal"
        });
    }

    function initSelect2Panel(event) {
        $('#' + event).select2({
            dropdownParent: "#panel"
        });
    }

    let editor;

    function loadFileImage() {
        const input = document.getElementsByName('_file')[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];

            // allowed MIME types
            var mime_types = ['image/jpg', 'image/jpeg', 'image/png'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type gambar yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 1 * 256 * 1000) {
                input.value = "";
                $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 250 Kb.",
                    'warning'
                );
                return;
            }

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.imagePreviewUpload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
            // console.log("success Load");
        } else {
            console.log("failed Load");
        }
    }

    function onChangeLevelUser(event) {
        if (event.value === "5") {
            ambilId("instansi-pengguna-block").style.display = "block";
            // $('.instansi-pengguna-block').style.display = "block";
        }
    }

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    $(document).ready(function() {
        // initSelect2Panel('filter_kecamatan');
        // initSelect2Panel('filter_jenjang');

        let tableUsulan = $('#data-table-id').DataTable({
            // "processing": true,
            // "serverSide": true,
            // "order": [],
            // "ajax": {
            //     "url": "<?= base_url('v1/admin/spj/tpg/disetujui/getAll') ?>",
            //     "type": "POST",
            //     "data": function(data) {
            //         data.filter_kecamatan = $('#filter_kecamatan').val();
            //         data.filter_jenjang = $('#filter_jenjang').val();
            //     }
            // },
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
            // lengthMenu: [
            //     [10, 25, 50, -1],
            //     ['10 rows', '25 rows', '50 rows', 'Show all']
            // ],
            // dom: 'Blfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel',
            //     {
            //         extend: 'pdfHtml5',
            //         orientation: 'landscape',
            //         pageSize: 'A4',
            //         // messageTop: 'Rekapitulasi Data Pendaftar PPDB DISDIKBUD Kab. Pesawaran Tahun 2021',
            //         title: 'Rekap Data Total',
            //         text: 'PDF',
            //     }
            // ]
        });

        // $('#filter_kecamatan').change(function() {
        //     tableUsulan.draw();
        // });

        // $('#filter_jenjang').change(function() {
        //     tableUsulan.draw();
        // });

        // $('#data-table-id').on('click', '.action-detail', function() {
        //     const id = $(this).data('id');
        //     const nama = $(this).data('name');

        //     $.ajax({
        //         url: "<?= base_url('v1/admin/spj/tpg/disetujui/detail') ?>",
        //         type: 'POST',
        //         data: {
        //             id: id,
        //             nama: nama
        //         },
        //         beforeSend: function() {
        //             $('div.main-content').block({
        //                 message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        //             });
        //         },
        //         success: function(resMsg) {
        //             $('div.main-content').unblock();
        //             const msg = JSON.parse(resMsg);
        //             if (msg.code != 200) {
        //                 Swal.fire(
        //                     'Gagal!',
        //                     msg.message,
        //                     'warning'
        //                 );
        //             } else {
        //                 $('#contentModalLabel').html('DETAIL PTK ' + nama.toUpperCase());
        //                 $('.contentBodyModal').html(msg.data);
        //                 $('#contentModal').modal({
        //                     backdrop: 'static',
        //                     keyboard: false
        //                 }, 'show');
        //             }
        //         },
        //         error: function() {
        //             $('div.main-content').unblock();
        //             Swal.fire(
        //                 'Gagal!',
        //                 "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
        //                 'warning'
        //             );
        //         }
        //     })
        // });
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
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