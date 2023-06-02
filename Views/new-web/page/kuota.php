<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h2>JADWAL PELAKSANAAN</h2>
            <p>Untuk jadwal pelaksanaan PPDB Tahun 2023 Kab. Pesawaran, sebagai berikut:</p>
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
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>