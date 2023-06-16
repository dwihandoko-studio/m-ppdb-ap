<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred _pengumuman_sekolah" id="_pengumuman_sekolah">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h2>PENGUMUMAN PESERTA PPDB 2023 YANG LULUS SELEKSI</h2>
            <p>Informasi pengumuman peserta yang lulus seleksi pada pelaksanaan PPDB Tahun 2023 Kab. Lampung Timur, sebagai berikut:</p>
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
                                                <select class="form-control filter-jenjang" name="filter_jenjang" id="filter_jenjang" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="6">SMP</option>
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
                            <table class="table table-hover" id="tabelRekapPpdb">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>NAMA</th>
                                        <th>NPSN</th>
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
            dropdownParent: "#_pengumuman_sekolah"
        });
    }

    function formatAnalisis(d) {
        if (parseInt(d.status_sekolah) === 2) {
            let cRekapD = '<h4>REKAPITULASI LOLOS PPDB ';
            cRekapD += d.nama_sekolah_tujuan;
            cRekapD += ' ( ';
            cRekapD += d.npsn_sekolah_tujuan;
            cRekapD += ' ) ';
            cRekapD += '</h4><br>';
            cRekapD += '<table cellpadding="6" cellspacing="0" border="1" style="padding-left:50px;">';
            cRekapD += '<thead>';
            cRekapD += '<tr>';
            cRekapD += '<th colspan="6" style="text-align: center; align-items: center;">JALUR SWASTA ';
            cRekapD += '</th>';
            cRekapD += '</tr>';
            cRekapD += '<tr>';
            cRekapD += '<th>No</th>';
            cRekapD += '<th>Jalur</th>';
            cRekapD += '<th>Nama</th>';
            cRekapD += '<th>NISN</th>';
            cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
            // cRekapD +=              '<th>Jarak</th>';
            // cRekapD +=              '<th>Ranking</th>';
            cRekapD += '</tr>';
            cRekapD += '</thead>';
            cRekapD += '<tbody class="detail-jalur-swasta-';
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
        } else {
            let cRekapD = '<h4>REKAPITULASI LOLOS PPDB ';
            cRekapD += d.nama_sekolah_tujuan;
            cRekapD += ' ( ';
            cRekapD += d.npsn_sekolah_tujuan;
            cRekapD += ' ) ';
            cRekapD += '</h4><br>';
            cRekapD += '<table cellpadding="6" cellspacing="0" border="1" style="padding-left:50px;">';
            cRekapD += '<thead>';
            cRekapD += '<tr>';
            cRekapD += '<th colspan="6" style="text-align: center; align-items: center;">JALUR ZONASI ';
            cRekapD += '</th>';
            cRekapD += '</tr>';
            cRekapD += '<tr>';
            cRekapD += '<th>No</th>';
            cRekapD += '<th>Jalur</th>';
            cRekapD += '<th>Nama</th>';
            cRekapD += '<th>NISN</th>';
            cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
            // cRekapD +=              '<th>Jarak</th>';
            // cRekapD +=              '<th>Ranking</th>';
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
            cRekapD += '<th>No</th>';
            cRekapD += '<th>Jalur</th>';
            cRekapD += '<th>Nama</th>';
            cRekapD += '<th>NISN</th>';
            cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
            // cRekapD +=              '<th>Jarak</th>';
            // cRekapD +=              '<th>Ranking</th>';
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
            cRekapD += '<th>No</th>';
            cRekapD += '<th>Jalur</th>';
            cRekapD += '<th>Nama</th>';
            cRekapD += '<th>NISN</th>';
            cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
            // cRekapD +=              '<th>Jarak</th>';
            // cRekapD +=              '<th>Ranking</th>';
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
            cRekapD += '<th>No</th>';
            cRekapD += '<th>Jalur</th>';
            cRekapD += '<th>Nama</th>';
            cRekapD += '<th>NISN</th>';
            cRekapD += '<th>Sekolah Asal (NPSN Asal)</th>';
            // cRekapD +=              '<th>Jarak</th>';
            // cRekapD +=              '<th>Ranking</th>';
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
    }

    function actionDetailAnalisis(event) {
        $.ajax({
            url: "<?= base_url('web/pengumuman/detailpengumuman') ?>",
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
                            htmlRekap += numberBer;
                            htmlRekap += '</td>';
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
                            // htmlRekap +=              '<td>';
                            // htmlRekap +=                  msg.data_lolos_zonasi[stepr].jarak;
                            // htmlRekap +=              ' Km</td>';
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
                            htmlRekapA += numberBerA;
                            htmlRekapA += '</td>';
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
                            // htmlRekapA +=              '<td>';
                            // htmlRekapA +=                  msg.data_lolos_afirmasi[steprA].jarak;
                            // htmlRekapA +=              ' Km</td>';
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
                            htmlRekapAB += numberBerAB;
                            htmlRekapAB += '</td>';
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
                            // htmlRekapAB +=              '<td>';
                            // htmlRekapAB +=                  msg.data_lolos_mutasi[steprAB].jarak;
                            // htmlRekapAB +=              ' Km</td>';
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
                            htmlRekapABC += numberBerABC;
                            htmlRekapABC += '</td>';
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
                            // htmlRekapABC +=              '<td>';
                            // htmlRekapABC +=                  msg.data_lolos_prestasi[steprABC].jarak;
                            // htmlRekapABC +=              ' Km</td>';
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

    function actionDetailAnalisisSwasta(event) {
        $.ajax({
            url: "<?= base_url('web/pengumuman/detailpengumuman') ?>",
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
                    if (msg.data_lolos.length > 0) {
                        let htmlRekap = "";
                        for (let stepr = 0; stepr < msg.data_lolos.length; stepr++) {
                            const numberBer = stepr + 1;
                            htmlRekap += '<tr>';
                            htmlRekap += '<td>';
                            htmlRekap += numberBer;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos[stepr].via_jalur;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos[stepr].fullname;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos[stepr].nisn;
                            htmlRekap += '</td>';
                            htmlRekap += '<td>';
                            htmlRekap += msg.data_lolos[stepr].nama_sekolah_asal;
                            htmlRekap += ' (';
                            htmlRekap += msg.data_lolos[stepr].npsn_sekolah_asal;
                            htmlRekap += ')';
                            htmlRekap += '</td>';
                            // htmlRekap +=              '<td>';
                            // htmlRekap +=                  msg.data_lolos_zonasi[stepr].jarak;
                            // htmlRekap +=              ' Km</td>';
                            htmlRekap += '</tr>';
                        }

                        $('.detail-jalur-swasta-' + event).html(htmlRekap);

                    } else {
                        let htmlRekap = '<tr>';
                        htmlRekap += '<td colspan="6" style="text-align: center; align-items: center;">';
                        htmlRekap += 'Tidak ada data.';
                        htmlRekap += '</td>';
                        htmlRekap += '</tr>';

                        $('.detail-jalur-swasta-' + event).html(htmlRekap);
                    }
                }
            },
            error: function(e) {
                console.log(e);
            }
        });

    }

    $(document).ready(function() {
        loadedAll = true;
        initSelect2('filter_kecamatan');
        initSelect2('filter_jenjang');

        let tableRekapitulasiSekolah = $('#tabelRekapPpdb').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('web/pengumuman/getPengumuman') ?>",
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
                // { defaultContent: '', }, 
                // { defaultContent: '', }, 
                // { defaultContent: '', }, 
                // { data: 'jumlah_pendaftar', className: 'text-align-center' }
            ],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
            }],
        });

        $('#tabelRekapPpdb tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = tableRekapitulasiSekolah.row(tr);

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
            tableRekapitulasiSekolah.draw();
        });

        $('#filter_kecamatan').change(function() {
            tableRekapitulasiSekolah.draw();
        });

    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/DataTables/datatables.css" type="text/css">
<?= $this->endSection(); ?>