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
                                <li class="breadcrumb-item"><a href="<?= base_url('sekolah/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Setting Penjadwalan</li>
                            </ol>
                        </nav>
                    </div>
                    <?php if (isset($data)) { ?>
                        <div class="col-lg-6 col-5 text-right">
                            <button type="button" onclick="actionEdit(this, '<?= $data->id ?>')" class="btn btn-sm btn-neutral">Edit</button>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-6 col-5 text-right">
                            <button type="button" onclick="actionAdd(this)" class="btn btn-sm btn-neutral">Tambah</button>
                        </div>
                    <?php } ?>
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
                        <h3 class="mb-0">Setting Penjadwalan</h3>
                    </div>
                    <!-- Light table -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table-id" class="table align-items-center" style="border: 1px solid;">
                                <thead style="border: 1px solid;">
                                    <tr style="border: 1px solid;">
                                        <th rowspan="2" data-orderable="false" style="text-align: center; border: 1px solid;">#</th>
                                        <th rowspan="2" style="text-align: center; border: 1px solid;">Jalur</th>
                                        <th colspan="2" style="text-align: center; border: 1px solid;">Pendaftaran</th>
                                        <th colspan="2" style="text-align: center; border: 1px solid;">Verifikasi</th>
                                        <th colspan="2" style="text-align: center; border: 1px solid;">Analisis</th>
                                        <th rowspan="2" style="text-align: center; border: 1px solid;">Pengumuman</th>
                                        <th colspan="2" style="text-align: center; border: 1px solid;">Daftar Ulang</th>
                                    </tr>
                                    <tr style="border: 1px solid;">
                                        <th style="text-align: center; border: 1px solid;">Awal</th>
                                        <th style="text-align: center; border: 1px solid;">Akhir</th>
                                        <th style="text-align: center; border: 1px solid;">Awal</th>
                                        <th style="text-align: center; border: 1px solid;">Akhir</th>
                                        <th style="text-align: center; border: 1px solid;">awal</th>
                                        <th style="text-align: center; border: 1px solid;">Akhir</th>
                                        <th style="text-align: center; border: 1px solid;">awal</th>
                                        <th style="text-align: center; border: 1px solid;">Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data)) {
                                        if ($data) { ?>
                                            <tr style="border: 1px solid;">
                                                <td style="text-align: center; border: 1px solid;">
                                                    1
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    ZONASI
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_pendaftaran_zonasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_pendaftaran_zonasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_verifikasi_zonasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_verifikasi_zonasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_analisis_zonasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_analisis_zonasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_pengumuman_zonasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_daftar_ulang_zonasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_daftar_ulang_zonasi) ?>
                                                </td>
                                            </tr>
                                            <tr style="border: 1px solid;">
                                                <td style="text-align: center; border: 1px solid;">
                                                    2
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    AFIRMASI
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_pendaftaran_afirmasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_pendaftaran_afirmasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_verifikasi_afirmasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_verifikasi_afirmasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_analisis_afirmasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_analisis_afirmasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_pengumuman_afirmasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_daftar_ulang_afirmasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_daftar_ulang_afirmasi) ?>
                                                </td>
                                            </tr>
                                            <tr style="border: 1px solid;">
                                                <td style="text-align: center; border: 1px solid;">
                                                    3
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    PRESTASI
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_pendaftaran_prestasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_pendaftaran_prestasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_verifikasi_prestasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_verifikasi_prestasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_analisis_prestasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_analisis_prestasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_pengumuman_prestasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_daftar_ulang_prestasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_daftar_ulang_prestasi) ?>
                                                </td>
                                            </tr>
                                            <tr style="border: 1px solid;">
                                                <td style="text-align: center; border: 1px solid;">
                                                    4
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    MUTASI
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_pendaftaran_mutasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_pendaftaran_mutasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_verifikasi_mutasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_verifikasi_mutasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_analisis_mutasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_analisis_mutasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_pengumuman_mutasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_awal_daftar_ulang_mutasi) ?>
                                                </td>
                                                <td style="text-align: center; border: 1px solid;">
                                                    <?= tgl_indo($data->tgl_akhir_daftar_ulang_mutasi) ?>
                                                </td>
                                            </tr>

                                    <?php }
                                    } ?>
                                </tbody>

                            </table>
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
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/moment.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/bootstrap-datetimepicker.js"></script>
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

    function actionAdd(event) {
        $.ajax({
            url: "<?= base_url('dinas/setting/penjadwalan/add') ?>",
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
                    $('#contentModalLabel').html('TAMBAH JADWAL');
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

    function actionEdit(event, id) {
        $.ajax({
            url: "<?= base_url('dinas/setting/penjadwalan/edit') ?>",
            type: 'POST',
            data: {
                id: id
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
                    $('#contentModalLabel').html('EDIT JADWAL');
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

    });

    $('#contentModal').on('click', '.simpan-data', function(e) {
        e.preventDefault();
        const tahun = document.getElementsByName('pilih_tahun')[0].value;
        const tw = document.getElementsByName('pilih_tw')[0].value;
        let status;
        if ($('#status').is(":checked")) {
            status = "1";
        } else {
            status = "0";
        }

        if (tahun === "") {
            $("select#pilih_tahun").css("color", "#dc3545");
            $("select#pilih_tahun").css("border-color", "#dc3545");
            $('.pilih_tahun').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }

        if (tw === "") {
            $("select#pilih_tw").css("color", "#dc3545");
            $("select#pilih_tw").css("border-color", "#dc3545");
            $('.pilih_tw').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }

        if (tahun === "" || tw === "") {
            // swal.fire(
            //     'Gagal!',
            //     "Isian tidak boleh kosong.",
            //     'warning'
            // );
        } else {
            $.ajax({
                url: "<?= base_url('v1/superadmin/masterdata/tahuntw/addSave') ?>",
                type: 'POST',
                data: {
                    tahun: tahun,
                    tw: tw,
                    status: status
                },
                beforeSend: function() {
                    $('.simpan-data').attr('disabled', 'disabled');
                    $('div.modal-content-loading').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        // message: '<img src="<?= base_url('busy.gif'); ?>" />'
                    });
                },
                success: function(resMsg) {
                    $('div.modal-content-loading').unblock();
                    const resul = JSON.parse(resMsg);

                    if (resul.code !== 200) {
                        $('.simpan-data').attr('disabled', false);

                        Swal.fire(
                            'Failed!',
                            resul.message,
                            'warning'
                        );
                    } else {

                        Swal.fire(
                            'SELAMAT!',
                            resul.message,
                            'success'
                        ).then((valRes) => {
                            document.location.href = "<?= current_url(true); ?>";
                        })
                    }
                },
                error: function() {
                    $('.simpan-data').attr('disabled', false);
                    $('div.modal-content-loading').unblock();
                    Swal.fire(
                        'Failed!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            });
        }
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