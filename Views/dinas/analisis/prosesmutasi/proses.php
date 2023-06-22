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
                                <li class="breadcrumb-item active" aria-current="page">Analisis Proses Jalur Mutasi Sekolah PPDB</li>
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
                    <div class="card-header border-0" style="padding-bottom: 0px; margin-bottom: 0px;">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-7">
                                <h5 class="h3 mb-0">ANALISIS PROSES JALUR MUTASI SEKOLAH PPDB</h5>
                            </div>
                            <div class="col-lg-6 col-7" style="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group jenjang-block">
                                            <label for="filter_jenjang" class="form-control-label">Filter Jenjang</label>
                                            <select class="form-control filter-jenjang" name="filter_jenjang" id="filter_jenjang" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                <option value="5">SD</option>
                                                <option value="6" selected>SMP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="col-lg-6">-->
                                    <!--    <div class="form-group jalur-block">-->
                                    <!--        <label for="filter_jalur" class="form-control-label">Filter Jalur</label>-->
                                    <!--        <select class="form-control filter-jalur" name="filter_jalur" id="filter_jalur" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>-->
                                    <!--                <option value="">--PILIH--</option>-->
                                    <!--                <option value="ZONASI">ZONASI</option>-->
                                    <!--                <option value="AFIRMASI">AFIRMASI</option>-->
                                    <!--                <option value="MUTASI">MUTASI</option>-->
                                    <!--                <option value="PRESTASI">PRESTASI</option>-->
                                    <!--                <option value="SWASTA">SWASTA</option>-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="margin-top: 0px;">
                    <table id="data-table-id" class="table align-items-center table-flush">
                        <thead>
                            <tr>
                                <th data-orderable="false">No</th>
                                <th data-orderable="false">Aksi</th>
                                <th>Nama Sekolah Tujuan</th>
                                <th>NPSN Sekolah Tujuan</th>
                                <th>Jumlah Pendaftar</th>
                            </tr>
                        </thead>

                    </table>
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
            url: "<?= base_url('dinas/analisis/prosesmutasi/detail') ?>",
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

                    $('#contentModalLabel').html('DETAIL PENDAFTARAN');
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


    function formatAnalisis(d) {

        let cRekapD = '<h1>REKAPITULASI LOLOS PPDB ';
        cRekapD += d.nama_sekolah_tujuan;
        cRekapD += ' ( ';
        cRekapD += d.npsn_sekolah_tujuan;
        cRekapD += ' ) ';
        cRekapD += '</h1><br>';
        cRekapD += '<table cellpadding="6" cellspacing="0" border="1" style="padding-left:50px;">';
        cRekapD += '<thead>';
        cRekapD += '<tr>';
        cRekapD += '<th colspan="6" style="text-align: center; align-items: center;">JALUR ZONASI ';
        cRekapD += '</th>';
        cRekapD += '</tr>';
        cRekapD += '<tr>';
        cRekapD += '<th>Jalur</th>';
        cRekapD += '<th>Nama</th>';
        cRekapD += '<th>NISN</th>';
        cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
        cRekapD += '<th>Jarak</th>';
        cRekapD += '<th>Ranking</th>';
        cRekapD += '</tr>';
        cRekapD += '</thead>';
        cRekapD += '<tbody class="detail-jalur-zonasi-';
        cRekapD += d.tujuan_sekolah_id;
        cRekapD += '">';
        cRekapD += '<tr>';
        cRekapD += '<td colspan="6" style="text-align: center; align-items: center;">';
        cRekapD += '......LOADING.......';
        cRekapD += '</td>';
        cRekapD += '</tr>';
        cRekapD += '</tbody>';
        cRekapD += '</table>';

        cRekapD += '<br>';
        cRekapD += '<table cellpadding="6" cellspacing="0" border="1" style="padding-left:50px;">';
        cRekapD += '<thead>';
        cRekapD += '<tr>';
        cRekapD += '<th colspan="6" style="text-align: center; align-items: center;">JALUR AFIRMASI</th>';
        cRekapD += '</tr>';
        cRekapD += '<tr>';
        cRekapD += '<th>Jalur</th>';
        cRekapD += '<th>Nama</th>';
        cRekapD += '<th>NISN</th>';
        cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
        cRekapD += '<th>Jarak</th>';
        cRekapD += '<th>Ranking</th>';
        cRekapD += '</tr>';
        cRekapD += '</thead>';
        cRekapD += '<tbody class="detail-jalur-afirmasi-';
        cRekapD += d.tujuan_sekolah_id;
        cRekapD += '">';
        cRekapD += '<tr>';
        cRekapD += '<td colspan="6" style="text-align: center; align-items: center;">';
        cRekapD += '......LOADING.......';
        cRekapD += '</td>';
        cRekapD += '</tr>';
        cRekapD += '</tbody>';
        cRekapD += '</table>';

        cRekapD += '<br>';
        cRekapD += '<table cellpadding="6" cellspacing="0" border="1" style="padding-left:50px;">';
        cRekapD += '<thead>';
        cRekapD += '<tr>';
        cRekapD += '<th colspan="6" style="text-align: center; align-items: center;">JALUR MUTASI</th>';
        cRekapD += '</tr>';
        cRekapD += '<tr>';
        cRekapD += '<tr>';
        cRekapD += '<th>Jalur</th>';
        cRekapD += '<th>Nama</th>';
        cRekapD += '<th>NISN</th>';
        cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
        cRekapD += '<th>Jarak</th>';
        cRekapD += '<th>Ranking</th>';
        cRekapD += '</tr>';
        cRekapD += '</thead>';
        cRekapD += '<tbody class="detail-jalur-mutasi-';
        cRekapD += d.tujuan_sekolah_id;
        cRekapD += '">';
        cRekapD += '<tr>';
        cRekapD += '<td colspan="6" style="text-align: center; align-items: center;">';
        cRekapD += '......LOADING.......';
        cRekapD += '</td>';
        cRekapD += '</tr>';
        cRekapD += '</tbody>';
        cRekapD += '</table>';

        cRekapD += '<br>';
        cRekapD += '<table cellpadding="6" cellspacing="0" border="1" style="padding-left:50px;">';
        cRekapD += '<thead>';
        cRekapD += '<tr>';
        cRekapD += '<th colspan="6" style="text-align: center; align-items: center;">JALUR PRESTASI</th>';
        cRekapD += '</tr>';
        cRekapD += '<tr>';
        cRekapD += '<tr>';
        cRekapD += '<th>Nama</th>';
        cRekapD += '<th>NISN</th>';
        cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
        cRekapD += '<th>Jarak</th>';
        cRekapD += '<th>Ranking</th>';
        cRekapD += '</tr>';
        cRekapD += '</thead>';
        cRekapD += '<tbody class="detail-jalur-prestasi-';
        cRekapD += d.tujuan_sekolah_id;
        cRekapD += '">';
        cRekapD += '<tr>';
        cRekapD += '<td colspan="6" style="text-align: center; align-items: center;">';
        cRekapD += '......LOADING.......';
        cRekapD += '</td>';
        cRekapD += '</tr>';
        cRekapD += '</tbody>';
        cRekapD += '</table>';

        return cRekapD;
    }

    function actionDetailAnalisis(event) {
        $.ajax({
            url: "<?= base_url('dinas/analisis/prosesmutasi/detailanalisis') ?>",
            type: 'POST',
            data: {
                id: event,
            },
            dataType: 'JSON',
            // beforeSend: function() {
            //     $('div.main-content').block({
            //         message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            //     });
            // },
            success: function(msg) {
                if (msg.code != 200) {
                    console.log(msg.message);
                } else {
                    if (msg.data_lolos_zonasi.length > 0) {
                        let htmlRekap = "";
                        for (let stepr = 0; stepr < msg.data_lolos_zonasi.length; stepr++) {
                            const numberBer = stepr + 1;
                            htmlRekap += '<tr>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos_zonasi[stepr].via_jalur;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos_zonasi[stepr].fullname;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos_zonasi[stepr].nisn;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos_zonasi[stepr].nama_sekolah_asal;
                            htmlRekap += ' (';
                            htmlRekap += msg.data_lolos_zonasi[stepr].npsn_sekolah_asal;
                            htmlRekap += ')';
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos_zonasi[stepr].jarak;
                            htmlRekap += ' Km</td>';
                            htmlRekap += '<td>';
                            htmlRekap += numberBer;
                            htmlRekap += '</td>';
                            htmlRekap += '</tr>';
                        }

                        $('.detail-jalur-zonasi-' + event).html(htmlRekap);

                    } else {
                        let htmlRekap = '<tr>';
                        htmlRekap += '<td colspan="6" style="text-align: center; align-items: center;">';
                        htmlRekap += 'Tidak ada data.';
                        htmlRekap += '</td>';
                        htmlRekap += '</tr>';

                        $('.detail-jalur-zonasi-' + event).html(htmlRekap);
                    }

                    if (msg.data_lolos_afirmasi.length > 0) {
                        let htmlRekapA = "";
                        for (let steprA = 0; steprA < msg.data_lolos_afirmasi.length; steprA++) {
                            const numberBerA = steprA + 1;
                            htmlRekapA += '<tr>';
                            htmlRekapA += '<td>';
                            htmlRekapA += msg.data_lolos_afirmasi[steprA].via_jalur;
                            htmlRekapA += '</td>';
                            htmlRekapA += '<td>';
                            htmlRekapA += msg.data_lolos_afirmasi[steprA].fullname;
                            htmlRekapA += '</td>';
                            htmlRekapA += '<td>';
                            htmlRekapA += msg.data_lolos_afirmasi[steprA].nisn;
                            htmlRekapA += '</td>';
                            htmlRekapA += '<td>';
                            htmlRekapA += msg.data_lolos_afirmasi[steprA].nama_sekolah_asal;
                            htmlRekapA += ' (';
                            htmlRekapA += msg.data_lolos_afirmasi[steprA].npsn_sekolah_asal;
                            htmlRekapA += ')';
                            htmlRekapA += '</td>';
                            htmlRekapA += '<td>';
                            htmlRekapA += msg.data_lolos_afirmasi[steprA].jarak;
                            htmlRekapA += ' Km</td>';
                            htmlRekapA += '<td>';
                            htmlRekapA += numberBerA;
                            htmlRekapA += '</td>';
                            htmlRekapA += '</tr>';
                        }

                        $('.detail-jalur-afirmasi-' + event).html(htmlRekapA);

                    } else {
                        let htmlRekapA = '<tr>';
                        htmlRekapA += '<td colspan="6" style="text-align: center; align-items: center;">';
                        htmlRekapA += 'Tidak ada data.';
                        htmlRekapA += '</td>';
                        htmlRekapA += '</tr>';

                        $('.detail-jalur-afirmasi-' + event).html(htmlRekapA);
                    }

                    if (msg.data_lolos_mutasi.length > 0) {
                        let htmlRekapAB = "";
                        for (let steprAB = 0; steprAB < msg.data_lolos_mutasi.length; steprAB++) {
                            const numberBerAB = steprAB + 1;
                            htmlRekapAB += '<tr>';
                            htmlRekapAB += '<td>';
                            htmlRekapAB += msg.data_lolos_mutasi[steprAB].via_jalur;
                            htmlRekapAB += '</td>';
                            htmlRekapAB += '<td>';
                            htmlRekapAB += msg.data_lolos_mutasi[steprAB].fullname;
                            htmlRekapAB += '</td>';
                            htmlRekapAB += '<td>';
                            htmlRekapAB += msg.data_lolos_mutasi[steprAB].nisn;
                            htmlRekapAB += '</td>';
                            htmlRekapAB += '<td>';
                            htmlRekapAB += msg.data_lolos_mutasi[steprAB].nama_sekolah_asal;
                            htmlRekapAB += ' (';
                            htmlRekapAB += msg.data_lolos_mutasi[steprAB].npsn_sekolah_asal;
                            htmlRekapAB += ')';
                            htmlRekapAB += '</td>';
                            htmlRekapAB += '<td>';
                            htmlRekapAB += msg.data_lolos_mutasi[steprAB].jarak;
                            htmlRekapAB += ' Km</td>';
                            htmlRekapAB += '<td>';
                            htmlRekapAB += numberBerAB;
                            htmlRekapAB += '</td>';
                            htmlRekapAB += '</tr>';
                        }

                        $('.detail-jalur-mutasi-' + event).html(htmlRekapAB);

                    } else {
                        let htmlRekapAB = '<tr>';
                        htmlRekapAB += '<td colspan="6" style="text-align: center; align-items: center;">';
                        htmlRekapAB += 'Tidak ada data.';
                        htmlRekapAB += '</td>';
                        htmlRekapAB += '</tr>';

                        $('.detail-jalur-mutasi-' + event).html(htmlRekapAB);
                    }

                    if (msg.data_lolos_prestasi.length > 0) {
                        let htmlRekapABC = "";
                        for (let steprABC = 0; steprABC < msg.data_lolos_prestasi.length; steprABC++) {
                            const numberBerABC = steprABC + 1;
                            htmlRekapABC += '<tr>';
                            htmlRekapABC += '<td>';
                            htmlRekapABC += msg.data_lolos_prestasi[steprABC].via_jalur;
                            htmlRekapABC += '</td>';
                            htmlRekapABC += '<td>';
                            htmlRekapABC += msg.data_lolos_prestasi[steprABC].fullname;
                            htmlRekapABC += '</td>';
                            htmlRekapABC += '<td>';
                            htmlRekapABC += msg.data_lolos_prestasi[steprABC].nisn;
                            htmlRekapABC += '</td>';
                            htmlRekapABC += '<td>';
                            htmlRekapABC += msg.data_lolos_prestasi[steprABC].nama_sekolah_asal;
                            htmlRekapABC += ' (';
                            htmlRekapABC += msg.data_lolos_prestasi[steprABC].npsn_sekolah_asal;
                            htmlRekapABC += ')';
                            htmlRekapABC += '</td>';
                            htmlRekapABC += '<td>';
                            htmlRekapABC += msg.data_lolos_prestasi[steprABC].jarak;
                            htmlRekapABC += ' Km</td>';
                            htmlRekapABC += '<td>';
                            htmlRekapABC += numberBerABC;
                            htmlRekapABC += '</td>';
                            htmlRekapABC += '</tr>';
                        }

                        $('.detail-jalur-prestasi-' + event).html(htmlRekapABC);

                    } else {
                        let htmlRekapABC = '<tr>';
                        htmlRekapABC += '<td colspan="6" style="text-align: center; align-items: center;">';
                        htmlRekapABC += 'Tidak ada data.';
                        htmlRekapABC += '</td>';
                        htmlRekapABC += '</tr>';

                        $('.detail-jalur-prestasi-' + event).html(htmlRekapABC);
                    }
                }
            },
            error: function(e) {
                console.log(e);
            }
        });

    }


    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    $(document).ready(function() {

        let tableUsulan = $('#data-table-id').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('dinas/analisis/prosesmutasi/getAllProses') ?>",
                "type": "POST",
                "data": function(data) {
                    // data.filter_jalur = $('#filter_jalur').val();
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
            'columns': [{
                    orderable: false,
                    data: 'no',
                },
                {
                    className: 'dt-control',
                    orderable: false,
                    data: 'aksi',
                    defaultContent: '',
                },
                {
                    data: 'nama_sekolah_tujuan'
                },
                {
                    data: 'npsn_sekolah_tujuan'
                },
                {
                    data: 'jumlah_pendaftar',
                    className: 'text-align-center'
                }
            ],
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
                    title: 'Rekap Data Total',
                    text: 'PDF',
                }
            ]
        });


        $('#data-table-id tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = tableUsulan.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row

                row.child(formatAnalisis(row.data())).show();
                tr.addClass('shown');
            }
        });


        $('#filter_jenjang').change(function() {
            tableUsulan.draw();
        });

    });

    function initSelect2(event, parrent) {
        $('#' + event).select2({
            dropdownParent: parrent
        });
    }
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