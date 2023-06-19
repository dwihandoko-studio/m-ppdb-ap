<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred _profil_sekolah" id="_profil_sekolah">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h2>PROFIL <?= (isset($sekolah)) ? strtoupper($sekolah->nama_sekolah) : ' SEKOLAH' ?></h2>
            <p>Informasi profil <?= (isset($sekolah)) ? $sekolah->nama_sekolah : ' sekolah' ?> pada pelaksanaan PPDB Tahun 2023 Kab. Lampung Timur, sebagai berikut:</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 col-md-12" style="text-align: left !important;">
                        <p>Nama Kepala Sekolah : <?= (isset($sekolah)) ? ($sekolah->nama_ks ? $sekolah->nama_ks : '-') : '-' ?></p>
                        <p>NIP Kepala Sekolah &nbsp;: <?= (isset($sekolah)) ? ($sekolah->nip_ks ? $sekolah->nip_ks : '-') : '-' ?></p>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="btn-box">
                            <a target="_blank" href="<?= (isset($sekolah)) ? $sekolah->url_profil : '#' ?>" class="theme-btn">Lihat Profil Sekolah Dapodik<i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="cardcus loading-content-card">
                    <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-default" style="border-bottom: none;">
                            <div class="card-body">

                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 style="text-align: left; margin-bottom: 20px;">INFORMASI PANITIA PPDB <?= (isset($sekolah)) ? $sekolah->nama_sekolah . " || " . $sekolah->npsn : ' SEKOLAH' ?></h4>
                        <div class="table-responsive" style="background-color: #fff; padding: 12px;border-radius: 5px; margin-top: -8px;">
                            <table class="table table-hover" id="tabelZonasiSekolah">
                                <thead style="border: 1px solid #273581;">
                                    <tr>
                                        <th data-orderable="false">No</th>
                                        <th data-orderable="false">Nama Panitia</th>
                                        <th data-orderable="false">No Handphone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($panitia)) { ?>
                                        <?php if (count($panitia) > 0) { ?>
                                            <?php foreach ($panitia as $key => $v) { ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $v->nama ?></td>
                                                    <td><?= $v->no_hp ?></td>
                                                </tr>
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