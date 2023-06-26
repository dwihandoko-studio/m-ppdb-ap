<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="crm-programming">
    <div class="image-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/crm-bg.webp);"></div>
    <div class="container" style="margin-top: 90px;">>
        <div class="sec-title center">
            <h2>STATISTIK PPDB 2023<br>KABUPATEN LAMPUNG TIMUR</h2>
        </div>
        <div class="row center">
            <div class="col-lg-2 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="900ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#2eb100" data-value="<?= isset($grafik_statistik) ? (isset($grafik_statistik->afirmasi) ? ($grafik_statistik->total == 0 ? '.0' : $grafik_statistik->afirmasi / $grafik_statistik->total) : '.0') : '.0' ?>">
                            <span><?= isset($grafik_statistik) ? (isset($grafik_statistik->afirmasi) ? $grafik_statistik->afirmasi : '0') : '0' ?></span>
                        </div>
                    </div>
                    <div class="text">Jalur Afirmasi</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#393e95" data-value="<?= isset($grafik_statistik) ? (isset($grafik_statistik->zonasi) ? ($grafik_statistik->total == 0 ? '.0' : $grafik_statistik->zonasi / $grafik_statistik->total) : '.0') : '.0' ?>">
                            <span><?= isset($grafik_statistik) ? (isset($grafik_statistik->zonasi) ? $grafik_statistik->zonasi : '0') : '0' ?></span>
                        </div>
                    </div>
                    <div class="text">Jalur Zonasi</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#ff8500" data-value="<?= isset($grafik_statistik) ? (isset($grafik_statistik->prestasi) ? ($grafik_statistik->total == 0 ? '.0' : $grafik_statistik->prestasi / $grafik_statistik->total) : '.0') : '.0' ?>">
                            <span><?= isset($grafik_statistik) ? (isset($grafik_statistik->prestasi) ? $grafik_statistik->prestasi : '0') : '0' ?></span>
                        </div>
                    </div>
                    <div class="text">Jalur Prestasi</div>
                </div>
            </div>
            <!-- </div>
        <div class="row center" style="margin-top: 50px;"> -->
            <div class="col-lg-2 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#ff0000" data-value="<?= isset($grafik_statistik) ? (isset($grafik_statistik->mutasi) ? ($grafik_statistik->total == 0 ? '.0' : $grafik_statistik->mutasi / $grafik_statistik->total) : '.0') : '.0' ?>">
                            <span><?= isset($grafik_statistik) ? (isset($grafik_statistik->mutasi) ? $grafik_statistik->mutasi : '0') : '0' ?></span>
                        </div>
                    </div>
                    <div class="text">Jalur Mutasi</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-12 single-column">
                <div class="single-item wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="progress-box">
                        <div class="piechart" data-fg-color="#ff00da" data-value="<?= isset($grafik_statistik) ? (isset($grafik_statistik->swasta) ? ($grafik_statistik->total == 0 ? '.0' : $grafik_statistik->swasta / $grafik_statistik->total) : '.0') : '.0' ?>">
                            <span><?= isset($grafik_statistik) ? (isset($grafik_statistik->swasta) ? $grafik_statistik->swasta : '0') : '0' ?></span>
                        </div>
                    </div>
                    <div class="text">Swasta</div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pricing-section _pendaftaran_sekolah" id="_pendaftaran_sekolah">
    <div class="container">
        <!-- <div class="container" style="margin-top: 100px;"> -->
        <div class="sec-title center">
            <h2>DATA PENDAFTARAN</h2>
            <p>Informasi data pendaftaran pada pelaksanaan PPDB Tahun 2023 Kab. Lampung Timur, sebagai berikut:</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="cardcus loading-content-card">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-default" style="border-bottom: none;">
                            <div class="card-body">
                                <div class="callout callout-info">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group jenjang-block">
                                                <label for="filter_jenjang" class="form-control-label">Filter Jenjang</label>
                                                <select class="form-control filter-jenjang-zonasi" name="filter_jenjang" id="filter_jenjang" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="6" selected>SMP</option>
                                                    <option value="5">SD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group kecamatan-block">
                                                <label for="filter_kecamatan" class="form-control-label">Filter Kecamatan</label>
                                                <select class="form-control filter-kecamatan" name="filter_kecamatan" id="filter_kecamatan" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="">-- Pilih --</option>
                                                    <?php if (isset($kecamatans)) {
                                                        if (count($kecamatans) > 0) {
                                                            foreach ($kecamatans as $key => $value) {
                                                                echo '<option value="' . $value->id . '">' . $value->nama . '</option>';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive" style="background-color: #fff; padding: 12px;border-radius: 5px; margin-top: -8px;">
                            <table class="table table-hover" id="tabelPendaftarSekolah">
                                <thead style="border: 1px solid #273581;">
                                    <tr class="_tampilan-display-inherit">
                                        <th data-orderable="false" class="_tampilan-display-inherit">#</th>
                                        <th class="_tampilan-display-inherit">Nama Sekolah</th>
                                        <th data-orderable="false">Jalur Afirmasi</th>
                                        <th data-orderable="false">Jalur Zonasi</th>
                                        <th data-orderable="false">Jalur Mutasi</th>
                                        <th data-orderable="false">Jalur Prestasi</th>
                                        <th data-orderable="false">Swasta</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>

<script>
    function initSelect2(event) {
        $('#' + event).select2({
            dropdownParent: "#_pendaftaran_sekolah"
        });
    }

    function formatDataPendaftar(d) {
        let cRekapD = '';
        cRekapD += '<div class="col-md-12"><table cellpadding="5" cellspacing="0" border="1" style="padding-left:50px; width: 100%;">';
        cRekapD += '<thead>';
        cRekapD += '<tr>';
        cRekapD += '<th colspan="5" style="text-align: center; align-items: center;">DATA PENDAFTAR YANG TERVERIFIKASI</th>';
        cRekapD += '</tr>';
        cRekapD += '<tr>';
        cRekapD += '<th>';
        cRekapD += 'Jalur';
        cRekapD += '</th>';
        cRekapD += '<th>';
        cRekapD += 'No Pendaftaran';
        cRekapD += '</th>';
        cRekapD += '<th>';
        cRekapD += 'Nama Peserta';
        cRekapD += '</th>';
        cRekapD += '<th>';
        cRekapD += 'NISN';
        cRekapD += '</th>';
        cRekapD += '<th>';
        cRekapD += 'Asal Sekolah';
        cRekapD += '</th>';
        cRekapD += '</tr>';
        cRekapD += '</thead>';
        cRekapD += '<tbody class="data-rekap-verifikasi-';
        cRekapD += d.id;
        cRekapD += '">';
        cRekapD += '<tr>';
        cRekapD += '<td colspan="5" style="text-align: center; align-items: center;">';
        cRekapD += '......LOADING.......';
        cRekapD += '</td>';
        cRekapD += '</tr>';
        cRekapD += '</tbody>';
        cRekapD += '</table>';

        cRekapD += '<br>';
        cRekapD += '<div class="col-md-12"><table cellpadding="5" cellspacing="0" border="1" style="padding-left:50px; width: 100%;">';
        cRekapD += '<thead>';
        cRekapD += '<tr>';
        cRekapD += '<th colspan="4" style="text-align: center; align-items: center;">DATA PENDAFTAR YANG BELUM TERVERIFIKASI</th>';
        cRekapD += '</tr>';
        cRekapD += '<tr>';
        // cRekapD +=              '<th>';
        // cRekapD +=                  'No';
        // cRekapD +=              '</th>';
        cRekapD += '<th>';
        cRekapD += 'Jalur';
        cRekapD += '</th>';
        cRekapD += '<th>';
        cRekapD += 'Nama Peserta';
        cRekapD += '</th>';
        cRekapD += '<th>';
        cRekapD += 'NISN';
        cRekapD += '</th>';
        cRekapD += '<th>';
        cRekapD += 'Asal Sekolah';
        cRekapD += '</th>';
        cRekapD += '</tr>';
        cRekapD += '</thead>';
        cRekapD += '<tbody class="data-rekap-belum-verifikasi-';
        cRekapD += d.id;
        cRekapD += '">';
        cRekapD += '<tr>';
        cRekapD += '<td colspan="4" style="text-align: center; align-items: center;">';
        cRekapD += '......LOADING.......';
        cRekapD += '</td>';
        cRekapD += '</tr>';
        cRekapD += '</tbody>';
        cRekapD += '</table>';

        return cRekapD;
        // `d` is the original data object for the row

    }


    function actionDetailPendaftar(event, title) {
        // console.log(event);

        $.ajax({
            url: "<?= base_url('web/statistik/getDetailPendaftaran') ?>",
            type: 'POST',
            data: {
                id: event,
                name: title,
            },
            dataType: 'JSON',
            // beforeSend: function() {
            //     $('div.main-content').block({
            //         message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            //     });
            // },
            success: function(msg) {
                // console.log(msg);
                // $('div.main-content').unblock();
                if (msg.code != 200) {
                    console.log(msg.message);
                } else {
                    if (msg.data_terverifikasi.length > 0) {
                        let htmlRekap = "";
                        for (let stepr = 0; stepr < msg.data_terverifikasi.length; stepr++) {
                            // const numberBer = stepr +1;
                            htmlRekap += '<tr>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_terverifikasi[stepr].via_jalur;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_terverifikasi[stepr].kode_pendaftaran;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_terverifikasi[stepr].fullname;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_terverifikasi[stepr].nisn;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_terverifikasi[stepr].nama_sekolah_asal;
                            htmlRekap += '</td>';
                            htmlRekap += '</tr>';
                        }

                        $('.data-rekap-verifikasi-' + event).html(htmlRekap);

                    } else {
                        let htmlRekap = '<tr>';
                        htmlRekap += '<td colspan="5" style="text-align: center; align-items: center;">';
                        htmlRekap += 'Tidak ada data.';
                        htmlRekap += '</td>';
                        htmlRekap += '</tr>';

                        $('.data-rekap-verifikasi-' + event).html(htmlRekap);
                    }

                    if (msg.data_belum_verifikasi.length > 0) {

                        let htmlRekapB = "";
                        for (let stepb = 0; stepb < msg.data_belum_verifikasi.length; stepb++) {
                            // const numberBer = stepb +1;
                            htmlRekapB += '<tr>';
                            // htmlRekapB +=              '<td>';
                            // htmlRekapB +=                  numberBer;
                            // htmlRekapB +=              '</td>';
                            htmlRekapB += '<td>';
                            htmlRekapB += msg.data_belum_verifikasi[stepb].via_jalur;
                            htmlRekapB += '</td>';
                            htmlRekapB += '<td>';
                            htmlRekapB += msg.data_belum_verifikasi[stepb].fullname;
                            htmlRekapB += '</td>';
                            htmlRekapB += '<td>';
                            htmlRekapB += msg.data_belum_verifikasi[stepb].nisn;
                            htmlRekapB += '</td>';
                            htmlRekapB += '<td>';
                            htmlRekapB += msg.data_belum_verifikasi[stepb].nama_sekolah_asal;
                            htmlRekapB += '</td>';
                            htmlRekapB += '</tr>';
                        }

                        $('.data-rekap-belum-verifikasi-' + event).html(htmlRekapB);
                    } else {
                        let htmlRekapB = '<tr>';
                        htmlRekapB += '<td colspan="4" style="text-align: center; align-items: center;">';
                        htmlRekapB += 'Tidak ada data.';
                        htmlRekapB += '</td>';
                        htmlRekapB += '</tr>';

                        $('.data-rekap-belum-verifikasi-' + event).html(htmlRekapB);
                    }

                }
            },
            error: function(e) {
                console.log(e);
            }
        });

    }

    // function loadGrafikPendaftaran() {

    // }

    $(document).ready(function() {
        loadedAll = true;
        initSelect2('filter_kecamatan');
        initSelect2('filter_jenjang');


        // loadGrafikPendaftaran();

        let tableZonasiSekolah = $('#tabelPendaftarSekolah').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('web/statistik/getPendaftaranSekolah') ?>",
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
            'columns': [{
                    className: 'dt-control _tampilan-display-inherit',
                    orderable: false,
                    data: 'button',
                    defaultContent: '',
                },
                {
                    className: '_tampilan-display-inherit',
                    data: 'nama'
                },
                {
                    data: 'afirmasi',
                    orderable: false
                },
                {
                    data: 'zonasi',
                    orderable: false
                },
                {
                    data: 'mutasi',
                    orderable: false
                },
                {
                    data: 'prestasi',
                    orderable: false
                },
                {
                    data: 'swasta',
                    orderable: false
                }
            ],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
            }],
            lengthMenu: [
                [10, 25],
                ['10 Data', '25 Data']
            ],
        });


        $('#tabelPendaftarSekolah tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = tableZonasiSekolah.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row

                row.child(formatDataPendaftar(row.data())).show();
                tr.addClass('shown');
            }
        });

        $('#filter_kecamatan').change(function() {
            tableZonasiSekolah.draw();
        });

        $('#filter_jenjang').change(function() {
            tableZonasiSekolah.draw();
        });

    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/DataTables/datatables.css" type="text/css">
<style>
    /* @media only screen and (max-width: 2000px) { */
    canvas {
        width: 200px !important;
        height: 200px !important;
    }

    /* } */

    ._tampilan-display-inherit {
        vertical-align: inherit !important;
    }
</style>
<?= $this->endSection(); ?>