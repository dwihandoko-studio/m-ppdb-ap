<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>

<!--<body>-->
<!-- Main content -->
<div class="main-content content-loading" id="panel">
    <?= $this->include('templates/topnav'); ?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="<?= base_url('sekolah/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">Pendaftar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sekolah Swasta</li>
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
            <div class="col">
                <div class="card loading-content">
                    <div class="card-header">
                        <h5 class="h3 mb-0">PENDAFTAR Melalui Jalur SEKOLAH SWASTA</h5>
                        <p>Daftar Peserta Yang Mendaftar Melalui Jalur Sekolah Swasta.</p>
                    </div>
                    <div class="card-header py-0">
                        <form>
                            <div class="form-group mb-0">
                                <div class="input-group input-group-lg input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><span class="fas fa-search"></span></div>
                                    </div><input type="search" class="form-control _search_item" id="_search_item" name="_search_item" placeholder="Cari NISN / Kode Pendaftaran. . ."><button type="button" onclick="cariData(this)" class="btn btn-default"><span class="fas fa-search"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list my--3 content_zonasi" id="content_zonasi">

                        </ul>
                        <div style="margin-top: 40px;" class="col-md-12 content_pagination" id="content_pagination">

                        </div>
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
        <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-tolak-loading">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tolakModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="tolakBodyModal">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
<!--<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>-->
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/moment.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/bootstrap-datetimepicker.js"></script>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script>

<script>
    let loading = false;

    function cariData(event) {
        const cari = document.getElementsByName('_search_item')[0].value;
        if (cari !== "") {
            $.ajax({
                url: "<?= base_url('sekolah/pendaftaran/swasta/getAll') ?>",
                type: 'POST',
                data: {
                    keyword: cari,
                    page: "1",
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('div.loading-content').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(resul) {
                    $('div.loading-content').unblock();

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
                            $('.content_zonasi').html('');
                            $('.content_pagination').html('');
                        }
                    } else {
                        $('.content_zonasi').html(resul.data);
                        $('.content_pagination').html(resul.pagination);
                    }
                },
                error: function() {
                    $('div.loading-content').unblock();
                    Swal.fire(
                        'Failed!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            });
        }
    }

    function getDataPendaftar(page = "1") {
        const keyword = document.getElementsByName('_search_item')[0].value;
        $.ajax({
            url: "<?= base_url('sekolah/pendaftaran/swasta/getAll') ?>",
            type: 'POST',
            data: {
                keyword: keyword,
                page: page,
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('div.loading-content').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.loading-content').unblock();

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
                        $('.content_zonasi').html('');
                        $('.content_pagination').html('');
                    }
                } else {
                    $('.content_zonasi').html(resul.data);
                    $('.content_pagination').html(resul.pagination);
                }
            },
            error: function() {
                $('div.loading-content').unblock();
                Swal.fire(
                    'Failed!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    function reloadPage(action = "") {
        if (action === "") {
            document.location.href = "<?= current_url(true); ?>";
        } else {
            document.location.href = action;
        }
    }

    function verifikasi(id) {
        $.ajax({
            url: "<?= base_url('sekolah/pendaftaran/swasta/detail') ?>",
            type: 'POST',
            data: {
                id: id,
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
                            'GAGAL!',
                            resul.message,
                            'warning'
                        );
                    }
                } else {
                    $('#contentModalLabel').html('DETAIL PESERTA');
                    $('.contentBodyModal').html(resul.data);
                    $('#contentModal').modal({
                        focus: false,
                        backdrop: 'static',
                        keyboard: false
                    }, 'show');
                }
            },
            error: function() {
                $('div.main-content').unblock();
                Swal.fire(
                    'GAGAL!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    function aksiTolakVerifikasi(id, name) {
        Swal.fire({
            title: 'Apakah anda yakin ingin menolak Verifikasi Pendaftaran Peserta Didik ini?',
            text: "Pendaftar An. : " + name.toUpperCase(),
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tolak Verifikasi!'
        }).then((result) => {
            if (result.value) {
                let tolakHtml = '';
                tolakHtml += '<form>';
                tolakHtml += '<div class="modal-body">';
                tolakHtml += '<div class="form-group">';
                tolakHtml += '<label for="_keterangan_tolak">Keterangan Penolakan</label>';
                tolakHtml += '<textarea class="form-control" id="_keterangan_tolak" name="_keterangan_tolak" placeholder="Masukkan keterangan penolakan . . ." rows="10"></textarea>';
                tolakHtml += '<input type="hidden" id="_id_pendaftar" name="_id_pendaftar" value="';
                tolakHtml += id;
                tolakHtml += '">';
                tolakHtml += '<input type="hidden" id="_nama_pendaftar" name="_nama_pendaftar" value="';
                tolakHtml += name;
                tolakHtml += '">';
                tolakHtml += '</div>';
                tolakHtml += '</div>';
                tolakHtml += '<div class="modal-footer">';
                tolakHtml += '<button onclick="saveTolakVerifikasi()" type="button" class="btn btn-outline-success">TOLAK & SIMPAN</button>';
                tolakHtml += '</div>';
                tolakHtml += '</form>';

                $('#tolakModalLabel').html('PENOLAKAN VERIFIKASI UNTUK PENDAFTARAN AN. ' + name.toUpperCase());
                $('.tolakBodyModal').html(tolakHtml);
                $('#tolakModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }, 'show');
            }
        });
    }

    function saveTolakVerifikasi() {
        const keteranganPenolakan = document.getElementsByName('_keterangan_tolak')[0].value;
        const id = document.getElementsByName('_id_pendaftar')[0].value;
        const name = document.getElementsByName('_nama_pendaftar')[0].value;

        if (keteranganPenolakan === "") {
            Swal.fire(
                'Peringatan!',
                "Keterangan penolakan tidak boleh kosong.",
                'warning'
            );
            return;
        }

        $.ajax({
            url: "<?= base_url('sekolah/pendaftaran/swasta/aksitolakverifikasi') ?>",
            type: 'POST',
            data: {
                id: id,
                name: name,
                keterangan: keteranganPenolakan
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('div.modal-tolak-loading').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.modal-tolak-loading').unblock();

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
                            'GAGAL!',
                            resul.message,
                            'warning'
                        );
                    }
                } else {
                    Swal.fire(
                        'BERHASIL!',
                        resul.message,
                        'success'
                    ).then((valRes) => {
                        reloadPage();
                    })
                }
            },
            error: function() {
                $('div.modal-tolak-loading').unblock();
                Swal.fire(
                    'GAGAL!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    function aksiVerifikasi(id, name) {
        Swal.fire({
            title: 'Apakah anda yakin ingin memverifikasi pendaftaran peserta didik ini?',
            text: "Pendaftaran Peserta Didik An. : " + name,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Verifikasi!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('sekolah/pendaftaran/swasta/aksiverifikasi') ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        name: name
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('div.modal-content-loading').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(resul) {
                        $('div.modal-content-loading').unblock();

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
                                    'GAGAL!',
                                    resul.message,
                                    'warning'
                                );
                            }
                        } else {
                            Swal.fire(
                                'BERHASIL!',
                                resul.message,
                                'success'
                            ).then((valRes) => {
                                reloadPage();
                            })
                        }
                    },
                    error: function() {
                        $('div.modal-content-loading').unblock();
                        Swal.fire(
                            'GAGAL!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }
        })
    }


    $(document).ready(function() {
        getDataPendaftar();
    });

    function ambilId(id) {
        return document.getElementById(id);
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/css/select2.min.css">
<style>
    #map_inits {
        width: 100%;
        height: 400px;
    }

    .leaflet-tooltip {
        pointer-events: auto
    }

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