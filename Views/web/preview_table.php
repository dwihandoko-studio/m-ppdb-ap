<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" name="description" />
    <meta name="author" content="<?= getenv('web.meta.author') ? getenv('web.meta.author') :  'BJ-Hands (handokowae.my.id)' ?>">
    <meta name="keywords" content="<?= getenv('web.meta.keyword') ? getenv('web.meta.keyword') :  'LAYANAN' ?>">

    <meta property="og:title" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <meta property="og:url" content="<?= getenv('web.meta.url') ? getenv('web.meta.url') : base_url() ?>" />
    <meta property="og:image" content="<?= base_url('favicons/android-icon-192x192.png'); ?>" />
    <meta property="og:description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />

    <meta itemprop="name" content="<?= getenv('web.meta.title') ? getenv('web.meta.title') : 'LAYANAN' ?>" />
    <meta itemprop="description" content="<?= getenv('web.meta.description') ? getenv('web.meta.description') : 'Mari Wujudkan Impian Kita' ?>" />
    <meta itemprop="image" content="<?= base_url('favicons/android-icon-192x192.png'); ?>" />

    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('favicons/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('favicons/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('favicons/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('favicons/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('favicons/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('favicons/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('favicons/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('favicons/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicons/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('favicons/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicons/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('favicons/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicons/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?= base_url('favicons/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?= base_url('favicons/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">

    <title>DATA LOLOS PPDB KAB. LAMPUNG TENGAH TAHUN 2023/2024</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/css/dashboard.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/DataTables/datatables.css" type="text/css">
    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>
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

</head>


<body class="bg-white loading-logout">
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <div class="sidenav-header  d-flex  align-items-center">
                <a class="navbar-brand" href="#">
                    <h2>PPDB LAMPUNG TENGAH</h2>
                </a>
                <div class=" ml-auto ">
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button" aria-expanded="true">
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Beranda</span>
                            </a>
                        </li>
                        <hr class="my-2">
                        <h6 class="navbar-heading pl-4 text-muted">
                            <span class="docs-normal">Master Data</span>
                        </h6>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="main-content" id="panel">
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="<?= base_url('new-assets/placeholder.png') ?>" width="36px" height="36px">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">DULKEMEN</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Selamat Datang!</h6>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:;" class="dropdown-item tombol-logout">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Export</li>
                                </ol>
                            </nav>
                        </div>

                        <!--<div class="col-lg-6 col-5 text-right">-->
                        <!--    <button type="button" onclick="actionAdd(this)" class="btn btn-sm btn-neutral">Tambah Penguna</button>-->
                        <!--</div>-->

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
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-7">
                                    <h5 class="h3 mb-0">EXPORT</h5>
                                </div>
                                <div class="col-lg-6 col-7">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="form-group filter_role-block">
                                                <label for="filter_role" class="form-control-label">Filter Role</label>
                                                <select class="form-control filter-role" name="filter_role" id="filter_role" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="">-- Pilih --</option>
                                                    <?php if (isset($levels)) {
                                                        if (count($levels) > 0) {
                                                            foreach ($levels as $key => $value) {
                                                                echo '<option value="' . $value->id . '">' . $value->role . '</option>';
                                                            }
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Light table -->
                        <div class="card-body border-0">
                            <div class="table-responsive">
                                <table id="data-table-id" class="table align-items-center table-flush">
                                    <thead>
                                        <tr>
                                            <th data-orderable="false">NISN</th>
                                            <th data-orderable="false">Nama Lengkap</th>
                                            <th data-orderable="false">Jenis Kelamin</th>
                                            <th data-orderable="false">Nama Sekolah Asal (NPSN)</th>
                                            <th data-orderable="false">Nama Sekolah Tujuan (NPSN)</th>
                                            <th data-orderable="false">Kode Pendaftaran</th>
                                            <th data-orderable="false">Jalur Pendaftaran</th>
                                            <th data-orderable="false">Jarak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($data_lolos_zonasi)) {
                                            if (count($data_lolos_zonasi) > 0) {
                                                foreach ($data_lolos_zonasi as $key => $value) { ?>
                                                    <tr>
                                                        <td><?= $value->nisn == NULL || $value->nisn == "" ? "NULL" : $value->nisn ?></td>
                                                        <td><?= $value->fullname == NULL || $value->fullname == "" ? "NULL" : $value->fullname ?></td>
                                                        <td><?php
                                                            try {
                                                                $rinci = json_decode($value->data_rinci_peserta);
                                                                echo $rinci->jenis_kelamin;
                                                            } catch (\Exception $e) {
                                                                echo $value->id;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $value->nama_sekolah_asal ?> (<?= $value->npsn_sekolah_asal ?>)</td>
                                                        <td><?= $value->nama_sekolah_tujuan ?> (<?= $value->npsn_sekolah_tujuan ?>)</td>
                                                        <td><?= $value->kode_pendaftaran ?></td>
                                                        <td><?= $value->via_jalur ?></td>
                                                        <td><?= $value->jarak ?></td>
                                                    </tr>
                                        <?php }
                                            }
                                        } ?>

                                        <!--<tr>-->
                                        <!--    <th colspan="7">AFIRMASI</th>-->
                                        <!--</tr>-->
                                        <?php if (isset($data_lolos_afirmasi)) {
                                            if (count($data_lolos_afirmasi) > 0) {
                                                foreach ($data_lolos_afirmasi as $key => $value) { ?>
                                                    <tr>
                                                        <td><?= $value->nisn == NULL || $value->nisn == "" ? "NULL" : $value->nisn ?></td>
                                                        <td><?= $value->fullname == NULL || $value->fullname == "" ? "NULL" : $value->fullname ?></td>
                                                        <td><?php
                                                            try {
                                                                $rinci = json_decode($value->data_rinci_peserta);
                                                                echo $rinci->jenis_kelamin;
                                                            } catch (\Exception $e) {
                                                                echo $value->id;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $value->nama_sekolah_asal ?> (<?= $value->npsn_sekolah_asal ?>)</td>
                                                        <td><?= $value->nama_sekolah_tujuan ?> (<?= $value->npsn_sekolah_tujuan ?>)</td>
                                                        <td><?= $value->kode_pendaftaran ?></td>
                                                        <td><?= $value->via_jalur ?></td>
                                                        <td><?= $value->jarak ?></td>
                                                    </tr>
                                        <?php }
                                            }
                                        } ?>

                                        <!--<tr>-->
                                        <!--    <th colspan="7">MUTASI</th>-->
                                        <!--</tr>-->
                                        <?php if (isset($data_lolos_mutasi)) {
                                            if (count($data_lolos_mutasi) > 0) {
                                                foreach ($data_lolos_mutasi as $key => $value) { ?>
                                                    <tr>
                                                        <td><?= $value->nisn == NULL || $value->nisn == "" ? "NULL" : $value->nisn ?></td>
                                                        <td><?= $value->fullname == NULL || $value->fullname == "" ? "NULL" : $value->fullname ?></td>
                                                        <td><?php
                                                            try {
                                                                $rinci = json_decode($value->data_rinci_peserta);
                                                                echo $rinci->jenis_kelamin;
                                                            } catch (\Exception $e) {
                                                                echo $value->id;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $value->nama_sekolah_asal ?> (<?= $value->npsn_sekolah_asal ?>)</td>
                                                        <td><?= $value->nama_sekolah_tujuan ?> (<?= $value->npsn_sekolah_tujuan ?>)</td>
                                                        <td><?= $value->kode_pendaftaran ?></td>
                                                        <td><?= $value->via_jalur ?></td>
                                                        <td><?= $value->jarak ?></td>
                                                    </tr>
                                        <?php }
                                            }
                                        } ?>

                                        <!--<tr>-->
                                        <!--    <th colspan="7">PRESTASI</th>-->
                                        <!--</tr>-->
                                        <?php if (isset($data_lolos_prestasi)) {
                                            if (count($data_lolos_prestasi) > 0) {
                                                foreach ($data_lolos_prestasi as $key => $value) { ?>
                                                    <tr>
                                                        <td><?= $value->nisn == NULL || $value->nisn == "" ? "NULL" : $value->nisn ?></td>
                                                        <td><?= $value->fullname == NULL || $value->fullname == "" ? "NULL" : $value->fullname ?></td>
                                                        <td><?php
                                                            try {
                                                                $rinci = json_decode($value->data_rinci_peserta);
                                                                echo $rinci->jenis_kelamin;
                                                            } catch (\Exception $e) {
                                                                echo $value->id;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $value->nama_sekolah_asal ?> (<?= $value->npsn_sekolah_asal ?>)</td>
                                                        <td><?= $value->nama_sekolah_tujuan ?> (<?= $value->npsn_sekolah_tujuan ?>)</td>
                                                        <td><?= $value->kode_pendaftaran ?></td>
                                                        <td><?= $value->via_jalur ?></td>
                                                        <td><?= $value->jarak ?></td>
                                                    </tr>
                                        <?php }
                                            }
                                        } ?>
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

    <script src="<?= base_url('new-assets'); ?>/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/js/dashboard.js?v=1.2.0"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/js/demo.min.js"></script>
    <script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
    <script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>
    <script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script>

    <script>
        function initSelect2(event, parrent) {
            $('#' + event).select2({
                dropdownParent: parrent
            });
        }

        function reloadPage(action = "") {
            if (action === "") {
                document.location.href = "<?= current_url(true); ?>";
            } else {
                document.location.href = action;
            }
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

        $(document).ready(function() {
            // initSelect2('filter_role', '#panel');
            // initSelect2('filter_jenjang', '#panel');

            let tableUsulan = $('#data-table-id').DataTable({
                // "processing": true,
                // "serverSide": false,
                "order": [],
                // "ajax": {
                //     "url": "<?= base_url('dinas/masterdata/pengguna/getAll') ?>",
                //     "type": "POST",
                //     "data": function(data){
                //         data.filter_role = $('#filter_role').val();
                //         data.filter_jenjang = $('#filter_jenjang').val();
                //     }
                // },
                language: {
                    paginate: {
                        next: '<i class="ni ni-bold-right">',
                        previous: '<i class="ni ni-bold-left">'
                    },
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                },
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                }],
                lengthMenu: [
                    [-1],
                    ['Show all']
                ],
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: 'Rekap Data Kuota Sekolah',
                        text: 'PDF',
                    }
                ]
            });

            // $('#filter_role').change(function() {
            //     tableUsulan.draw();
            // });

            // $('#filter_jenjang').change(function() {
            //     tableUsulan.draw();
            // });
        });
    </script>

</body>

</html>