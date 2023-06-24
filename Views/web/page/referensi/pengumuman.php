<?= $this->extend('web/template/index') ?>

<?= $this->section('content') ?>
<div class="modal offcanvas-modal fade" id="offcanvas-modal">
    <div class="modal-dialog offcanvas-dialog">
        <div class="modal-content">
            <div class="modal-header offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- offcanvas-form-wrap start -->
            <!-- <div class="offcanvas-form-wrap">
                <form action="#" class="offcanvas-form position-relative">
                    <input class="form-control" type="text" placeholder="Enter your search key ... " />
                    <button class="btn btn-warning">search</button>
                </form>
            </div> -->
            <!-- offcanvas-form-wrap end -->
            <!-- offcanvas-menu start -->
            <nav id="offcanvas-menu" class="offcanvas-menu">
                <ul>
                    <li>
                        <a href="<?= base_url() ?>">Beranda</a>
                        <!-- add your sub menu here -->
                    </li>
                    <li>
                        <a href="<?= base_url('web/home/#alur-pendaftaran') ?>">Alur Pendaftaran</a>
                    </li>
                    <li>
                        <a href="#">Pengumuman</a>
                    </li>
                    <li>
                        <a href="<?= base_url('web/home/referensizonasi') ?>">Referensi Zonasi Sekolah</a>
                    </li>
                    <li>
                        <a href="<?= base_url('web/home/rekapitulasi') ?>">Rekapitulasi</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://nisn.data.kemdikbud.go.id/">Cek NISN</a>
                    </li>

                </ul>

                <!-- <div class="offcanvas-social">
                    <ul>
                        <li>
                            <a href="#"><i class="icofont-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icofont-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icofont-skype"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icofont-linkedin"></i></a>
                        </li>
                    </ul>
                </div> -->
            </nav>
            <!-- offcanvas-menu end -->

            <p class="text-gradient mt-3">PPDB KAB. LAMPUNG TENGAH</p>
        </div>
    </div>
</div>

<header class="header">
    <div class="header-top bg-primary">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-lg-4 d-none d-lg-block">
                    <ul class="header-social-links d-flex flex-wrap align-items-center">
                        <li class="social-link-item"><a href="javascript:;" class="social-link">P</a></li>
                        <li class="social-link-item"><a href="javascript:;" class="social-link">P</a></li>
                        <li class="social-link-item"><a href="javascript:;" class="social-link">D</a></li>
                        <li class="social-link-item"><a href="javascript:;" class="social-link">B</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-none d-md-block">
                    <p class="d-flex flex-wrap align-items-center text-gradient"><span class="hr-border d-none d-xl-block"></span><?= getenv('web.meta.site.title') ?></p>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <ul class="select-box d-flex flex-wrap align-items-center justify-content-center justify-content-md-end">
                        <li class="select-item"><a target="_blank" href="https://wa.me/62<?= str_replace('-', '', getenv('web.meta.site.cs')) ?>">CS SMP: 0<?= getenv('web.meta.site.cs') ?></a> / <a target="_blank" href="https://wa.me/62<?= str_replace('-', '', getenv('web.meta.site.cs2')) ?>">SD: 0<?= getenv('web.meta.site.cs2') ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="active-sticky" class="header-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <a href="<?= base_url() ?>" class="brand-logo">
                        <img width="130" src="<?= base_url('template/pringo') ?>/assets/images/logo/logo.png" alt="brand logo" />
                    </a>
                </div>
                <div class="col-auto">
                    <!--<a class="btn btn-warning btn-hover-warning d-none d-sm-inline-block d-lg-none" href="blog-details.html">Analyze Your Site <i class="icofont-arrow-right"></i>-->
                    <!--</a>-->

                    <button type="button" class="btn btn-warning offcanvas-toggler" data-bs-toggle="modal" data-bs-target="#offcanvas-modal">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </button>

                    <nav class="d-none d-lg-block">
                        <ul class="main-menu text-end">
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url() ?>">Beranda</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/#alur-pendaftaran') ?>">Alur Pendaftaran</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="#">Pengumuman</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/referensizonasi') ?>">
                                    Referensi Zonasi Sekolah</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="<?= base_url('web/home/rekapitulasi') ?>">Rekapitulasi</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" target="_blank" href="https://nisn.data.kemdikbud.go.id/">Cek NISN</a>
                            </li>

                            <!-- <li class="main-menu-item">
                                    <a class="btn btn-warning btn-hover-warning btn-lg" href="#">Analyze Your Site <i
                                            class="icofont-arrow-right"></i>
                                    </a>
                                </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>
<!-- working process section start -->
<section class="working-process-section" style="padding-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                <div class="section-title process text-center pb-50">
                    <!-- <div class="icon">
                            <img src="<?= base_url('template/pringo'); ?>/assets/images/icon/pencile.png" alt="Icon_not_found" />
                        </div> -->
                    <h3 class="title" style="font-size: 35px;">PENGUMUMAN PESERTA PPDB 2023 YANG LULUS SELEKSI </h3>
                    <!-- <span class="hr-secodary"></span> -->
                </div>
            </div>
        </div>

        <div class="row working-process mb-n4" style="justify-content: center; justify-items: center;">
            <div class="col-lg-12">
                <div class="cardcus loading-content-card">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-default" style="border-bottom: none;">
                            <div class="card-body">
                                <div class="callout callout-info">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group filter_jenjang-block">
                                                <label for="filter_jenjang" class="form-control-label">Filter Jenjang</label>
                                                <select class="form-control filter-jenjang" name="filter_jenjang" id="filter_jenjang" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="6">SMP</option>
                                                    <option value="5">SD</option>
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
<!-- working process section end -->

<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="<?= base_url('new-assets/assets'); ?>/js/jquery-block-ui.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>

<script>
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
            url: "<?= base_url('web/home/detailpengumuman') ?>",
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
            url: "<?= base_url('web/home/detailpengumuman') ?>",
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

        let tableRekapitulasiSekolah = $('#tabelRekapPpdb').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('web/home/getPengumuman') ?>",
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

    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets') ?>/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/DataTables/datatables.css" type="text/css">
<style>
    .cardcus {
        box-sizing: border-box;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        box-shadow: 0 0 3px 3px rgba(26, 26, 26, 0.05);
        /*border-radius: 10px;*/
        transition: all 0.3s;
    }

    .cardcus-body {
        padding: 1.25rem;
    }

    .formcus-row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -5px;
        margin-left: -5px;
    }

    .formcus-group {
        margin-bottom: 1rem;
        box-sizing: border-box;
    }

    .formcus-row>.col,
    .formcus-row>[class*="col-"] {
        padding-right: 5px;
        padding-left: 5px;
    }

    label {
        display: inline-block;
        margin-bottom: .5rem;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
        margin: 0;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
    }

    button,
    input {
        overflow: visible;
    }

    .formcus-control {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .formcus-control-group {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        -webkit-appearance: listbox;
    }

    .inputss-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }

    .inputss-group {
        box-shadow: 0 3px 2px rgba(233, 236, 239, .05);
        border-radius: .25rem;
        transition: all .15s ease-in-out;
    }

    .inputss-group>.custom-file,
    .inputss-group>.custom-select,
    .inputss-group>.formcus-control,
    .inputss-group>.formcus-control-plaintext {
        position: relative;
        flex: 1 1 0%;
        min-width: 0;
        border: none;
        margin-bottom: 0;
    }

    .inputss-group .formcus-control {
        box-shadow: none;
    }

    .inputss-group>.custom-select:not(:last-child),
    .inputss-group>.formcus-control:not(:last-child) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .inputss-group-merge .formcus-control:not(:last-child) {
        border-right: 0;
        padding-right: 0;
    }

    .inputss-group-append,
    .inputss-group-prepend {
        display: flex;
    }

    .inputss-group-append {
        margin-left: 15px;
        margin-right: 15px;
        justify-content: center;
        justify-items: center;
        align-items: center;
    }

    td.text-align-center {
        text-align: center;
        align-items: center;
    }
</style>
<?= $this->endSection(); ?>