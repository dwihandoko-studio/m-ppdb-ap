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
                                <li class="breadcrumb-item active" aria-current="page">Setting Kuota</li>
                            </ol>
                        </nav>
                    </div>
                    <?php if (isset($kuota)) { ?>
                        <!-- <div class="col-lg-6 col-5 text-right">
                            <button type="button" onclick="actionEdit(this, '<?= $kuota->id ?>')" class="btn btn-sm btn-neutral">Edit Kuota</button>
                        </div> -->
                    <?php } else { ?>
                        <!-- <div class="col-lg-6 col-5 text-right">
                            <button type="button" onclick="actionAdd(this)" class="btn btn-sm btn-neutral">Tambah Kuota</button>
                        </div> -->
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
                        <h3 class="mb-0">Setting Kuota</h3>
                        <br>
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible alert-sm fade show" role="alert">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-text"><?= session()->getFlashdata('pesan'); ?></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <hr style="padding: 0px 0px; margin: 20px 0px 0px 0px" />
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table-id" class="table align-items-center table-flush">
                                <thead>
                                    <tr>
                                        <!--<th rowspan="2" data-orderable="false">#</th>-->
                                        <th rowspan="2" style="text-align: center;">Kebutuhan Rombel</th>
                                        <th colspan="5" style="text-align: center;">Kuota</th>
                                        <th rowspan="2" style="text-align: center;">Radius Zonasi</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">Zonasi</th>
                                        <th style="text-align: center;">Afirmasi</th>
                                        <th style="text-align: center;">Mutasi</th>
                                        <th style="text-align: center;">Prestasi</th>
                                        <th style="text-align: center;">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($kuota)) { ?>
                                        <tr>
                                            <!--<td>#</th>-->
                                            <th style="text-align: center;"><?= $kuota->jumlah_rombel_kebutuhan ?> Kelas</th>
                                            <th style="text-align: center;"><?= $kuota->zonasi ?> </th>
                                            <th style="text-align: center;"><?= $kuota->afirmasi ?></th>
                                            <th style="text-align: center;"><?= $kuota->mutasi ?></th>
                                            <th style="text-align: center;"><?= $kuota->prestasi ?></th>
                                            <th style="text-align: center;"><?= (int)$kuota->zonasi + (int)$kuota->afirmasi + (int)$kuota->mutasi + (int)$kuota->prestasi ?></th>
                                            <th style="text-align: center;"><?= $kuota->radius_zonasi ?> Km</th>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td rowspan="7" style="text-align: center;"> Belum Set Kuota </th>
                                        </tr>
                                    <?php } ?>
                                </tbody>

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

    function actionAdd(event) {
        $.ajax({
            url: "<?= base_url('sekolah/setting/kuota/add') ?>",
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
                    Swal.fire(
                        'Failed!',
                        resul.message,
                        'warning'
                    );
                } else {
                    $('#contentModalLabel').html('TAMBAH KUOTA');
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
            url: "<?= base_url('sekolah/setting/kuota/edit') ?>",
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
                    Swal.fire(
                        'Failed!',
                        resul.message,
                        'warning'
                    );
                } else {
                    $('#contentModalLabel').html('EDIT KUOTA');
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

        // let tableUsulan = $('#data-table-id').DataTable({
        //     "processing": true,
        //     "serverSide": true,
        //     "order": [],
        //     "ajax": {
        //         "url": "<?= base_url('v1/superadmin/masterdata/tahuntw/getAll') ?>",
        //         "type": "POST",

        //     },
        //     language: {
        //         paginate: {
        //             next: '<i class="ni ni-bold-right">',
        //             previous: '<i class="ni ni-bold-left">'  
        //         },
        //         processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
        //     },
        //     "columnDefs": [
        //         {
        //             "targets": 0,
        //             "orderable": false,
        //         }
        //     ],
        // });

        $('.button-add-data').on('click', function() {
            let pilihTahun = '';
            for (let pilihanTahun = 2020; pilihanTahun < 2101; pilihanTahun++) {
                pilihTahun += '<option value="';
                pilihTahun += pilihanTahun;
                pilihTahun += '">Tahun - ';
                pilihTahun += pilihanTahun;
                pilihTahun += '</option>';
            }
            const html = '<form id="formAddData" class="form-horizontal form-add-data" method="post">' +
                '<div class="modal-body">' +
                '<div class="row col-md-12">' +
                '<div class="col-md-12">' +
                '<div class="form-group pilih-tahun-block">' +
                '<label for="pilih_tahun" class="form-control-label">Tahun</label>' +
                '<select class="form-control pilih-tahun" name="pilih_tahun" id="pilih_tahun" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." onChange="inputChange(this);" onfocusin="inputFocus(this);" onfocusout="inputChange(this);" required>' +
                '<option value="">-- Pilih --</option>' +
                pilihTahun +
                '</select>' +
                '<!--<input type="text" class="form-control nama-role" id="nama_role" name="nama_role" placeholder="Nama role . . ." onFocus="inputFocus(this);" required/>-->' +
                '<div class="help-block pilih_tahun"></div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row col-md-12">' +
                '<div class="col-md-12">' +
                '<div class="form-group pilih-tw-block">' +
                '<label for="pilih_tw" class="form-control-label">Triwulan</label>' +
                '<select class="form-control pilih-tw" name="pilih_tw" id="pilih_tw" data-toggle="select-2" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." onChange="inputChange(this);" onfocusin="inputFocus(this);" onfocusout="inputChange(this);" required>' +
                '<option value="">-- Pilih --</option>' +
                '<option value="1">Triwulan - I</option>' +
                '<option value="2">Triwulan - II</option>' +
                '<option value="3">Triwulan - III</option>' +
                '<option value="4">Triwulan - IV</option>' +
                '</select>' +
                '<div class="help-block pilih_tw"></div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row col-md-12">' +
                '<div class="col-md-6">' +
                '<div class="form-group status-block">' +
                '<h5>Status Aktif</h5>' +
                '<div class="controls">' +
                '<label class="custom-toggle">' +
                '<input type="checkbox" id="status" name="status" checked>' +
                '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>' +
                '</label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>' +
                '<button type="button" class="btn btn-outline-primary simpan-data">Simpan</button>' +
                '</div>' +
                '</form>';

            $('#contentModalLabel').html('TAMBAH DATA TAHUN TRIWULAN');
            $('.contentBodyModal').html(html);
            $('#contentModal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');

            $("#pilih_tahun").select2({
                dropdownParent: "#contentModal"
            });
            $("#pilih_tw").select2({
                dropdownParent: "#contentModal"
            });
        });

        $('#data-table').on('click', '.action-edit', function(i) {
            i.preventDefault();
            const id = $(this).data('id');
            const idSekolah = $(this).data('idsekolah');
            const npsn = $(this).data('npsn');
            const namaSekolah = $(this).data('namasekolah');

            $.ajax({
                url: "<?= base_url('dinas/masterdata/kuota/chekCurrentData') ?>",
                type: 'POST',
                data: {
                    id: id,
                    idSekolah: idSekolah,
                    npsn: npsn,
                    namaSekolah: namaSekolah
                },
                beforeSend: function() {
                    $('div.content-loading').block({
                        message: '<img src="<?= base_url('busy.gif'); ?>" />'
                    });
                },
                success: function(resMsg) {
                    $('div.content-loading').unblock();
                    const msg = JSON.parse(resMsg);
                    if (msg.code != 200) {
                        if (msg.code != 201) {
                            Swal.fire(
                                'Gagal!',
                                msg.message,
                                'warning'
                            );
                        } else {
                            const html = '<form id="formEdit" class="form-horizontal form-edit" method="post">' +
                                '<input type="hidden" id="_idSekolah" name="_idSekolah" value="' + idSekolah + '">' +
                                '<input type="hidden" id="_npsnSekolah" name="_npsnSekolah" value="' + npsn + '">' +
                                '<input type="hidden" id="_namaSekolah" name="_namaSekolah" value="' + namaSekolah + '">' +
                                '<div class="modal-body" style="padding-top: 1.25rem; padding-left: 1.25rem; padding-right: 1.25rem; padding-bottom: 0;">' +
                                '<div class="row col-md-12">' +
                                '<div class="col-md-12">' +
                                '<label>Jumlah Ruang Kelas</label>' +
                                '<div class="form-group jumlah-ruang-kelas-error">' +
                                '<input type="number" class="form-control" id="jumlah_ruang_kelas" name="jumlah_ruang_kelas" onFocus="inputFocus(this);" placeholder="Jumlah Ruang Kelas" required>' +
                                '<div class="help-block jumlah_ruang_kelas"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="row col-md-12">' +
                                '<div class="col-md-12">' +
                                '<label>Jumlah Rombel Saat Ini</label>' +
                                '<div class="form-group jumlah-rombel-saat-ini-error">' +
                                '<input type="number" class="form-control" id="jumlah_rombel_saat_ini" name="jumlah_rombel_saat_ini" onFocus="inputFocus(this);" placeholder="Jumlah Rombel Saat Ini" required>' +
                                '<div class="help-block jumlah_rombel_saat_ini"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="row col-md-12">' +
                                '<div class="col-md-12">' +
                                '<label>Jumlah Kebutuhan Rombel</label>' +
                                '<div class="form-group jumlah-kebutuhan-rombel-error">' +
                                '<input type="number" class="form-control" id="jumlah_kebutuhan_rombel" name="jumlah_kebutuhan_rombel" onFocus="inputFocus(this);" placeholder="Jumlah Kebutuhan Rombel" required>' +
                                '<div class="help-block jumlah_kebutuhan_rombel"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<!--<div class="row col-md-12">' +
                                '<div class="col-md-12">' +
                                '<label>Radius Wilayah Zonasi</label>' +
                                '<div class="form-group radius-error">' +
                                '<input type="number" class="form-control" id="radius" name="radius" onFocus="inputFocus(this);" value="0" placeholder="Radius wilayah Zonasi (Km)" required>' +
                                '<div class="help-block radius"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>-->' +
                                '</div>' +
                                '<div class="modal-footer">' +
                                '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Tutup</button>' +
                                '<button type="button" class="btn btn-outline-success simpan-tambah-data">SIMPAN</button>' +
                                '</div>' +
                                '</form>';

                            $('#contentModalLabel').html('MANAGE KUOTA');
                            $('.contentBodyModal').html(html);
                            $('#contentModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            }, 'show');
                        }

                    } else {
                        const html = '<form id="formEdit" class="form-horizontal form-edit" method="post">' +
                            '<input type="hidden" id="_id" name="_id" value="' + msg.data.id + '">' +
                            '<input type="hidden" id="_oldKelas" name="_oldKelas" value="' + msg.data.jumlah_kelas + '">' +
                            '<input type="hidden" id="_oldRombel" name="_oldRombel" value="' + msg.data.jumlah_rombel_saat_ini + '">' +
                            '<input type="hidden" id="_oldKebutuhan" name="_oldKebutuhan" value="' + msg.data.jumlah_kebutuhan_rombel + '">' +
                            '<input type="hidden" id="_oldRadius" name="_oldRadius" value="' + msg.data.radius + '">' +
                            '<div class="modal-body" style="padding-top: 1.25rem; padding-left: 1.25rem; padding-right: 1.25rem; padding-bottom: 0;">' +
                            '<div class="row col-md-12">' +
                            '<div class="col-md-12">' +
                            '<label>Jumlah Ruang Kelas</label>' +
                            '<div class="form-group jumlah-ruang-kelas-error">' +
                            '<input type="number" class="form-control" id="jumlah_ruang_kelas" name="jumlah_ruang_kelas" onFocus="inputFocus(this);" value="' + msg.data.jumlah_kelas + '" placeholder="Jumlah Ruang Kelas" required>' +
                            '<div class="help-block jumlah_ruang_kelas"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row col-md-12">' +
                            '<div class="col-md-12">' +
                            '<label>Jumlah Rombel Saat Ini</label>' +
                            '<div class="form-group jumlah-rombel-saat-ini-error">' +
                            '<input type="number" class="form-control" id="jumlah_rombel_saat_ini" name="jumlah_rombel_saat_ini" onFocus="inputFocus(this);" value="' + msg.data.jumlah_rombel_saat_ini + '" placeholder="Jumlah Rombel Saat Ini" required>' +
                            '<div class="help-block jumlah_rombel_saat_ini"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row col-md-12">' +
                            '<div class="col-md-12">' +
                            '<label>Jumlah Kebutuhan Rombel</label>' +
                            '<div class="form-group jumlah-kebutuhan-rombel-error">' +
                            '<input type="number" class="form-control" id="jumlah_kebutuhan_rombel" name="jumlah_kebutuhan_rombel" onFocus="inputFocus(this);" value="' + msg.data.jumlah_kebutuhan_rombel + '" placeholder="Jumlah Kebutuhan Rombel" required>' +
                            '<div class="help-block jumlah_kebutuhan_rombel"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<!--<div class="row col-md-12">' +
                            '<div class="col-md-12">' +
                            '<label>Radius Wilayah Zonasi</label>' +
                            '<div class="form-group radius-error">' +
                            '<input type="number" class="form-control" id="radius" name="radius" onFocus="inputFocus(this);" value="' + msg.data.radius + '" placeholder="Radius wilayah Zonasi (Km)" required>' +
                            '<div class="help-block radius"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>-->' +
                            '</div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Tutup</button>' +
                            '<button type="button" class="btn btn-outline-success simpan-update-data">UPDATE</button>' +
                            '</div>' +
                            '</form>';

                        $('#contentModalLabel').html('MANAGE KUOTA');
                        $('.contentBodyModal').html(html);
                        $('#contentModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        }, 'show');
                    }
                    // $('div.content-loading').unblock();
                },
                error: function() {
                    $('div.content-loading').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan coba beberapa saat lagi.",
                        'warning'
                    );
                }
            })
        });
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
                        if (resul.code === 401) {
                            Swal.fire(
                                'Failed!',
                                resul.message,
                                'warning'
                            ).then((valRes) => {
                                document.location.href = BASE_URL + '/dashboard';
                            });
                        } else {
                            $('.simpan-data').attr('disabled', false);

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