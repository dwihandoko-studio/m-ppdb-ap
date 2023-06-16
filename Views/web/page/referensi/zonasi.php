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
                        <a href="<?= base_url('web/home/#content-pengumuma') ?>">Pengumuman</a>
                    </li>
                    <li>
                        <a href="#">Referensi Zonasi Sekolah</a>
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

            <p class="text-gradient mt-3">PPDB KAB. LAMPUNG TIMUR</p>
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
                                <a class="main-menu-link" href="<?= base_url('web/home/#content-pengumuman') ?>">Pengumuman</a>
                            </li>
                            <li class="main-menu-item">
                                <a class="main-menu-link" href="#">
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
                    <h3 class="title" style="font-size: 35px;">INFORMASI ZONASI SEKOLAH</h3>
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
                                            <div class="form-group jenjang_zonasi-block">
                                                <label for="filter_jenjang_zonasi" class="form-control-label">Filter Jenjang</label>
                                                <select class="form-control filter-jenjang-zonasi" name="filter_jenjang_zonasi" id="filter_jenjang_zonasi" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
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
                            <table class="table table-hover" id="tabelZonasiSekolah">
                                <thead style="border: 1px solid #273581;">
                                    <tr>
                                        <th data-orderable="false">No</th>
                                        <th></th>
                                        <th>NPSN Sekolah</th>
                                        <th>Nama Sekolah</th>
                                        <th data-orderable="false">Wilayah Zonasi</th>
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
    function formatZonasi(d) {
        let cZonasiD = '<table cellpadding="5" cellspacing="0" border="1" style="padding-left:50px;>"';
        cZonasiD += '<thead>';
        cZonasiD += '<tr>';
        cZonasiD += '<th colspan="6" style="text-align: center; align-items: center;">DATA ZONASI SEKOLAH ';
        cZonasiD += d.nama;
        cZonasiD += ' (';
        cZonasiD += d.npsn;
        cZonasiD += ' )';
        cZonasiD += '</th>';
        cZonasiD += '</tr>';
        cZonasiD += '<tr>';
        cZonasiD += '<th>No</td>';
        cZonasiD += '<th>Provinsi</th>';
        cZonasiD += '<th>Kabupaten</th>';
        cZonasiD += '<th>Kecamatan</th>';
        cZonasiD += '<th>Kelurahan</th>';
        cZonasiD += '<th>Dusun</th>';
        cZonasiD += '</tr>';
        cZonasiD += '</thead>';
        cZonasiD += '<tbody class="detail-zonasi-';
        cZonasiD += d.id;
        cZonasiD += '">';
        cZonasiD += '<tr>';
        cZonasiD += '<td colspan="6" style="text-align: center; align-items: center;">';
        cZonasiD += '......LOADING.......';
        cZonasiD += '</td>';
        cZonasiD += '</tr>';
        cZonasiD += '</tbody>';
        cZonasiD += '</table>';
        return cZonasiD;
        // `d` is the original data object for the row

    }


    function actionDetailZonasi(event, title) {
        console.log(event);

        $.ajax({
            url: "<?= base_url('web/home/getDetailZonasi') ?>",
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
                    if (msg.data.length > 0) {
                        let htmlZonasi = "";
                        for (let stepr = 0; stepr < msg.data.length; stepr++) {
                            const numberBer = stepr + 1;
                            htmlZonasi += '<tr>';
                            htmlZonasi += '<td>';
                            htmlZonasi += numberBer;
                            htmlZonasi += '</td>';
                            htmlZonasi += '<td>';
                            htmlZonasi += msg.data[stepr].nama_provinsi;
                            htmlZonasi += '</td>';
                            htmlZonasi += '<td>';
                            htmlZonasi += msg.data[stepr].nama_kabupaten;
                            htmlZonasi += '</td>';
                            htmlZonasi += '<td>';
                            htmlZonasi += msg.data[stepr].nama_kecamatan;
                            htmlZonasi += '</td>';
                            htmlZonasi += '<td>';
                            htmlZonasi += msg.data[stepr].nama_kelurahan;
                            htmlZonasi += '</td>';
                            htmlZonasi += '<td>';
                            htmlZonasi += msg.data[stepr].nama_dusun;
                            htmlZonasi += '</td>';
                            htmlZonasi += '</tr>';
                        }

                        $('.detail-zonasi-' + event).html(htmlZonasi);
                    } else {
                        let cZonasiD = '<tr>';
                        cZonasiD += '<td colspan="6" style="text-align: center; align-items: center;">';
                        cZonasiD += 'Belum ada data.';
                        cZonasiD += '</td>';
                        cZonasiD += '</tr>';

                        $('.detail-zonasi-' + event).html(cZonasiD);
                    }
                }
            },
            error: function(e) {
                console.log(e);
            }
        });

    }

    $(document).ready(function() {

        let tableZonasiSekolah = $('#tabelZonasiSekolah').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('web/home/getZonasiSekolah') ?>",
                "type": "POST",
                "data": function(data) {
                    data.filter_jenjang = $('#filter_jenjang_zonasi').val();
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
                    data: 'no'
                },
                {
                    className: 'dt-control',
                    orderable: false,
                    data: 'button',
                    defaultContent: '',
                },
                {
                    data: 'npsn'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'jumlah'
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


        $('#tabelZonasiSekolah tbody').on('click', 'td.dt-control', function() {
            var tr = $(this).closest('tr');
            var row = tableZonasiSekolah.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row

                row.child(formatZonasi(row.data())).show();
                tr.addClass('shown');
            }
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
</style>
<?= $this->endSection(); ?>