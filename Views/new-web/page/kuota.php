<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred _kuota_sekolah" id="_kuota_sekolah">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h2>KUOTA SEKOLAH</h2>
            <p>Informasi kuota sekolah pada pelaksanaan PPDB Tahun 2023 Kab. Lampung Timur, sebagai berikut:</p>
        </div>
        <div class="row">
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
                    <table class="table table-hover" id="tabelKuotaSekolah">
                        <thead style="border: 1px solid #273581;">
                            <tr>
                                <th data-orderable="false" style="vertical-align: middle;">#</th>
                                <th style="vertical-align: middle;">Nama Sekolah</th>
                                <th style="vertical-align: middle;">NPSN</th>
                                <th style="vertical-align: middle;">Nama Kecamatan</th>
                                <th style="vertical-align: middle;">Daya Tampung</th>
                            </tr>

                        </thead>
                    </table>
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
            dropdownParent: "#_kuota_sekolah"
        });
    }

    function formatKuota(d) {
        return ('<table cellpadding="5" cellspacing="0" border="1" style="padding-left:50px;">' +
            '<tr>' +
            '<td>Rincian Total Kuota: <b>' + d.jumlah + '</b></td>' +
            '<td></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Zonasi:</td>' +
            '<td>' +
            d.zonasi +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Afirmasi:</td>' +
            '<td>' +
            d.afirmasi +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Mutasi:</td>' +
            '<td>' +
            d.mutasi +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Prestasi:</td>' +
            '<td>' +
            d.prestasi +
            '</td>' +
            '</tr>' +
            '</table>'
        );
        // `d` is the original data object for the row

    }

    $(document).ready(function() {
        loadedAll = true;
        initSelect2('filter_kecamatan');
        initSelect2('filter_jenjang');

        let tableKuotaSekolah = $('#tabelKuotaSekolah').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('web/kuota/getKuotaSekolah') ?>",
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
            'columns': [
                // {
                //     'data': 'button',
                //     'className': 'dt-control',
                //     "defaultContent": "",
                //     'name': 'Aksi'
                {
                    className: 'dt-control',
                    orderable: false,
                    data: 'button',
                    defaultContent: '',
                },
                {
                    data: 'nama'
                },
                {
                    data: 'npsn'
                },
                {
                    data: 'kecamatan'
                },
                {
                    data: 'jumlah',
                    orderable: false
                }
            ],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
            }],
        });

        $('#tabelKuotaSekolah tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = tableKuotaSekolah.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row

                row.child(formatKuota(row.data())).show();
                tr.addClass('shown');
            }
        });

        $('#filter_kecamatan').change(function() {
            tableKuotaSekolah.draw();
        });

        $('#filter_jenjang').change(function() {
            tableKuotaSekolah.draw();
        });

    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/DataTables/datatables.css" type="text/css">
<?= $this->endSection(); ?>