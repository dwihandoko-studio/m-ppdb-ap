<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred _profil_sekolah" id="_profil_sekolah">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h2>PROFIL SEKOLAH</h2>
            <p>Informasi profil sekolah pada pelaksanaan PPDB Tahun 2023 Kab. Pesawaran, sebagai berikut:</p>
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
                                            <div class="form-group jenjang_zonasi-block">
                                                <label for="filter_jenjang_zonasi" class="form-control-label">Filter Jenjang</label>
                                                <select class="form-control filter-jenjang-zonasi" name="filter_jenjang_zonasi" id="filter_jenjang_zonasi" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
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
                            <table class="table table-hover" id="tabelZonasiSekolah">
                                <thead style="border: 1px solid #273581;">
                                    <tr>
                                        <th data-orderable="false">No</th>
                                        <th>Nama Panitia</th>
                                        <th>No Handphone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($panitia)) { ?>
                                        <?php if (count($panitia) > 0) { ?>
                                            <?php foreach ($panitia as $key => $v) { ?>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $v->nama ?></td>
                                                <td><?= $v->no_hp ?></td>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
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
            dropdownParent: "#_zonasi_sekolah"
        });
    }

    $(document).ready(function() {
        loadedAll = true;
        // initSelect2('filter_kecamatan');
        // initSelect2('filter_jenjang_zonasi');

        let tableZonasiSekolah = $('#tabelZonasiSekolah').DataTable({});


        // $('#tabelZonasiSekolah tbody').on('click', 'td.dt-control', function() {
        //     var tr = $(this).closest('tr');
        //     var row = tableZonasiSekolah.row(tr);

        //     if (row.child.isShown()) {
        //         // This row is already open - close it
        //         row.child.hide();
        //         tr.removeClass('shown');
        //     } else {
        //         // Open this row

        //         row.child(formatZonasi(row.data())).show();
        //         tr.addClass('shown');
        //     }
        // });

        $('#filter_kecamatan').change(function() {
            tableZonasiSekolah.draw();
        });

        $('#filter_jenjang_zonasi').change(function() {
            tableZonasiSekolah.draw();
        });

    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/DataTables/datatables.css" type="text/css">
<?= $this->endSection(); ?>