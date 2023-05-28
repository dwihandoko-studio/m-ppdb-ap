<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>

<!--<body>-->
<!-- Main content -->
<div class="main-content" id="panel">
    <?= $this->include('templates/topnav'); ?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="<?= base_url('dinas/home'); ?>"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Info Pengumuman</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="javascript:;" class="btn btn-sm btn-neutral button-add-data">Tambah Info Pengumuman</a>
                    </div>
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
                        <h3 class="mb-0">Data Info Pengumuman</h3>
                        <br>
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible alert-sm fade show" role="alert">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-text"><?= session()->getFlashdata('pesan'); ?></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table id="data-table-id" class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>AKSI</th>
                                    <th>JUDUL</th>
                                    <th>DESKRIPSI</th>
                                    <!--<th>TAMPIL</th>-->
                                    <!--<th>STATUS</th>-->
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true" data-focus="false">
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
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
<script src="<?= base_url('new-assets/assets/js'); ?>/ckeditor5/build/build/ckeditor.js"></script>
<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script>

<script>
    let editor;
    
    
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

    function ambilId(id) {
        return document.getElementById(id);
    }
    
    function actionDetail(event) {
        $.ajax({
            url: "<?= base_url('dinas/info/pengumuman/detail') ?>",
            type: 'POST',
            data: {
                id: event,
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
                            'Failed!',
                            resul.message,
                            'warning'
                        );
                    }
                } else {

                    $('#contentModalLabel').html('DETAIL PENGUMUMAN');
                    $('.contentBodyModal').html(resul.data);
                    $('#contentModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }, 'show');
                }
            },
            error: function() {
                $('div.main-content').unblock();
                Swal.fire(
                    'Failed!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    function actionHapus(event, title = "") {
        Swal.fire({
            title: 'Apakah anda yakin ingin menghapus data ini?',
            text: "Hapus data informasi pengumuman : " + title,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('dinas/info/pengumuman/hapus') ?>",
                    type: 'POST',
                    data: {
                        id: event,
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
                                    'Failed!',
                                    resul.message,
                                    'warning'
                                );
                            }
                        } else {
                            Swal.fire(
                                'SELAMAT!',
                                resul.message,
                                'success'
                            ).then((valRes) => {
                                reloadPage();
                            })
                        }
                    },
                    error: function() {
                        $('div.main-content').unblock();
                        Swal.fire(
                            'Failed!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }
        })
    }

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    $(document).ready(function() {

        let tableUsulan = $('#data-table-id').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('dinas/info/pengumuman/getAll') ?>",
                "type": "POST",

            },
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
        });

        $('.button-add-data').on('click', function() {
            let html = '<form id="formAddData" class="form-horizontal form-add-data" method="post">';
            html += '<div class="modal-body">';
            html += '<div class="row col-md-12">';
            html += '<div class="col-md-12">';
            html += '<div class="form-group _judul-block">';
            html += '<label for="_judul" class="form-control-label">Judul</label>';
            html += '<input type="text" class="form-control judul" id="_judul" name="_judul" placeholder="Judul . . ." onFocus="inputFocus(this);" required/>';
            html += '<div class="help-block _judul"></div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row col-md-12">';
            html += '<div class="col-md-12">';
            html += '<div class="form-group _deskripsi-block">';
            html += '<label for="_deskripsi" class="form-control-label">Deskripsi</label>';
            html += '<textarea class="form-control deskripsi" id="_deskripsi" name="_deskripsi" rows="5" onFocus="inputFocus(this);" placeholder="Deskripsi . . ." required></textarea>';
            html += '<div class="help-block _deskripsi"></div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            // html += '<div class="row col-md-12">';
            // html += '<div class="col-md-4">';
            // html += '<div class="form-group _status-block">';
            // html += '<h5>Status Aktif</h5>';
            // html += '<div class="controls">';
            // html += '<label class="custom-toggle">';
            // html += '<input type="checkbox" id="_status" name="_status" checked>';
            // html += '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>';
            // html += '</label>';
            // html += '</div>';
            // html += '</div>';
            // html += '</div>';
            // html += '<div class="col-md-4">';
            // html += '<div class="form-group _tampil-block">';
            // html += '<h5>Tampil</h5>';
            // html += '<div class="controls">';
            // html += '<label class="custom-toggle">';
            // html += '<input type="checkbox" id="_tampil" name="_tampil" checked>';
            // html += '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>';
            // html += '</label>';
            // html += '</div>';
            // html += '</div>';
            // html += '</div>';
            // html += '</div>';
            // html += '</div>';
            html += '<div class="modal-footer">';
            html += '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>';
            html += '<button type="button" class="btn btn-outline-primary simpan-data">Simpan</button>';
            html += '</div>';
            html += '</form>';

            $('#contentModalLabel').html('TAMBAH DATA INFO PENGUMUMAN');
            $('.contentBodyModal').html(html);
            $('#contentModal').modal({
                focus: false,
                backdrop: 'static',
                keyboard: false
            }, 'show');


            ClassicEditor.create(document.querySelector('#_deskripsi'), {
                resizeOptions: [{
                        name: 'imageResize:original',
                        value: null,
                        icon: 'original'
                    },
                    {
                        name: 'imageResize:25',
                        value: '25',
                        icon: 'small'
                    },
                    {
                        name: 'imageResize:50',
                        value: '50',
                        icon: 'medium'
                    },
                    {
                        name: 'imageResize:75',
                        value: '75',
                        icon: 'large'
                    }
                ],
                alignment: {
                    options: ['left', 'right', 'center', 'justify']
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                image: {
                    toolbar: [
                        'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight', '|',
                        'imageResize:25', 'imageResize:50', 'imageResize:75', 'imageResize:original', '|',
                        'imageTextAlternative'
                    ],
                    styles: [
                        'full',
                        'side',
                        'alignLeft', 'alignCenter', 'alignRight'
                    ]
                },
                toolbar: {
                    items: [
                        'heading', 'code', '|',
                        'fontfamily', 'fontsize', 'fontColor', '|',
                        'bold', 'italic', 'underline', '|',
                        'link', 'bulletedList', 'numberedList', '|',
                        'insertTable', 'alignment', '|',
                        'imageUpload',
                        'imageResize',
                        'blockQuote', '|',
                        'undo',
                        'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                language: 'en',
                ckfinder: {
                    uploadUrl: "<?= base_url('v1/superadmin/informasi/popup/uploadImage'); ?>"
                }
            }).then(newEditor => {
                editor = newEditor;
            }).catch(error => {
                console.log(error);
            });

        });

        $('#data-table').on('click', '.action-edit', function(i) {
            i.preventDefault();
            const id = $(this).data('id');
            const idSekolah = $(this).data('idsekolah');
            const npsn = $(this).data('npsn');
            const namaSekolah = $(this).data('namasekolah');

            $.ajax({
                url: "<?= base_url('dinas/masterdata/kuota/chekCurrentData') ?>",
                type: 'POST',
                data: {
                    id: id,
                    idSekolah: idSekolah,
                    npsn: npsn,
                    namaSekolah: namaSekolah
                },
                beforeSend: function() {
                    $('div.content-loading').block({
                        message: '<img src="<?= base_url('busy.gif'); ?>" />'
                    });
                },
                success: function(resMsg) {
                    $('div.content-loading').unblock();
                    const msg = JSON.parse(resMsg);
                    if (msg.code != 200) {
                        if (msg.code != 201) {
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
                                    'Gagal!',
                                    msg.message,
                                    'warning'
                                );
                            }
                        } else {
                            const html = '<form id="formEdit" class="form-horizontal form-edit" method="post">' +
                                '<input type="hidden" id="_idSekolah" name="_idSekolah" value="' + idSekolah + '">' +
                                '<input type="hidden" id="_npsnSekolah" name="_npsnSekolah" value="' + npsn + '">' +
                                '<input type="hidden" id="_namaSekolah" name="_namaSekolah" value="' + namaSekolah + '">' +
                                '<div class="modal-body" style="padding-top: 1.25rem; padding-left: 1.25rem; padding-right: 1.25rem; padding-bottom: 0;">' +
                                '<div class="row col-md-12">' +
                                '<div class="col-md-12">' +
                                '<label>Jumlah Ruang Kelas</label>' +
                                '<div class="form-group jumlah-ruang-kelas-error">' +
                                '<input type="number" class="form-control" id="jumlah_ruang_kelas" name="jumlah_ruang_kelas" onFocus="inputFocus(this);" placeholder="Jumlah Ruang Kelas" required>' +
                                '<div class="help-block jumlah_ruang_kelas"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="row col-md-12">' +
                                '<div class="col-md-12">' +
                                '<label>Jumlah Rombel Saat Ini</label>' +
                                '<div class="form-group jumlah-rombel-saat-ini-error">' +
                                '<input type="number" class="form-control" id="jumlah_rombel_saat_ini" name="jumlah_rombel_saat_ini" onFocus="inputFocus(this);" placeholder="Jumlah Rombel Saat Ini" required>' +
                                '<div class="help-block jumlah_rombel_saat_ini"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="row col-md-12">' +
                                '<div class="col-md-12">' +
                                '<label>Jumlah Kebutuhan Rombel</label>' +
                                '<div class="form-group jumlah-kebutuhan-rombel-error">' +
                                '<input type="number" class="form-control" id="jumlah_kebutuhan_rombel" name="jumlah_kebutuhan_rombel" onFocus="inputFocus(this);" placeholder="Jumlah Kebutuhan Rombel" required>' +
                                '<div class="help-block jumlah_kebutuhan_rombel"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<!--<div class="row col-md-12">' +
                                '<div class="col-md-12">' +
                                '<label>Radius Wilayah Zonasi</label>' +
                                '<div class="form-group radius-error">' +
                                '<input type="number" class="form-control" id="radius" name="radius" onFocus="inputFocus(this);" value="0" placeholder="Radius wilayah Zonasi (Km)" required>' +
                                '<div class="help-block radius"></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>-->' +
                                '</div>' +
                                '<div class="modal-footer">' +
                                '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Tutup</button>' +
                                '<button type="button" class="btn btn-outline-success simpan-tambah-data">SIMPAN</button>' +
                                '</div>' +
                                '</form>';

                            $('#contentModalLabel').html('MANAGE KUOTA');
                            $('.contentBodyModal').html(html);
                            $('#contentModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            }, 'show');
                        }

                    } else {
                        const html = '<form id="formEdit" class="form-horizontal form-edit" method="post">' +
                            '<input type="hidden" id="_id" name="_id" value="' + msg.data.id + '">' +
                            '<input type="hidden" id="_oldKelas" name="_oldKelas" value="' + msg.data.jumlah_kelas + '">' +
                            '<input type="hidden" id="_oldRombel" name="_oldRombel" value="' + msg.data.jumlah_rombel_saat_ini + '">' +
                            '<input type="hidden" id="_oldKebutuhan" name="_oldKebutuhan" value="' + msg.data.jumlah_kebutuhan_rombel + '">' +
                            '<input type="hidden" id="_oldRadius" name="_oldRadius" value="' + msg.data.radius + '">' +
                            '<div class="modal-body" style="padding-top: 1.25rem; padding-left: 1.25rem; padding-right: 1.25rem; padding-bottom: 0;">' +
                            '<div class="row col-md-12">' +
                            '<div class="col-md-12">' +
                            '<label>Jumlah Ruang Kelas</label>' +
                            '<div class="form-group jumlah-ruang-kelas-error">' +
                            '<input type="number" class="form-control" id="jumlah_ruang_kelas" name="jumlah_ruang_kelas" onFocus="inputFocus(this);" value="' + msg.data.jumlah_kelas + '" placeholder="Jumlah Ruang Kelas" required>' +
                            '<div class="help-block jumlah_ruang_kelas"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row col-md-12">' +
                            '<div class="col-md-12">' +
                            '<label>Jumlah Rombel Saat Ini</label>' +
                            '<div class="form-group jumlah-rombel-saat-ini-error">' +
                            '<input type="number" class="form-control" id="jumlah_rombel_saat_ini" name="jumlah_rombel_saat_ini" onFocus="inputFocus(this);" value="' + msg.data.jumlah_rombel_saat_ini + '" placeholder="Jumlah Rombel Saat Ini" required>' +
                            '<div class="help-block jumlah_rombel_saat_ini"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row col-md-12">' +
                            '<div class="col-md-12">' +
                            '<label>Jumlah Kebutuhan Rombel</label>' +
                            '<div class="form-group jumlah-kebutuhan-rombel-error">' +
                            '<input type="number" class="form-control" id="jumlah_kebutuhan_rombel" name="jumlah_kebutuhan_rombel" onFocus="inputFocus(this);" value="' + msg.data.jumlah_kebutuhan_rombel + '" placeholder="Jumlah Kebutuhan Rombel" required>' +
                            '<div class="help-block jumlah_kebutuhan_rombel"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<!--<div class="row col-md-12">' +
                            '<div class="col-md-12">' +
                            '<label>Radius Wilayah Zonasi</label>' +
                            '<div class="form-group radius-error">' +
                            '<input type="number" class="form-control" id="radius" name="radius" onFocus="inputFocus(this);" value="' + msg.data.radius + '" placeholder="Radius wilayah Zonasi (Km)" required>' +
                            '<div class="help-block radius"></div>' +
                            '</div>' +
                            '</div>' +
                            '</div>-->' +
                            '</div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Tutup</button>' +
                            '<button type="button" class="btn btn-outline-success simpan-update-data">UPDATE</button>' +
                            '</div>' +
                            '</form>';

                        $('#contentModalLabel').html('MANAGE KUOTA');
                        $('.contentBodyModal').html(html);
                        $('#contentModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        }, 'show');
                    }
                    // $('div.content-loading').unblock();
                },
                error: function() {
                    $('div.content-loading').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan coba beberapa saat lagi.",
                        'warning'
                    );
                }
            })
        });
    });

    $('#contentModal').on('click', '.simpan-data', function(e) {
        e.preventDefault();
        const _judul = document.getElementsByName('_judul')[0].value;
        const _deskripsi = editor.getData();

        let status;
        if ($('#_status').is(":checked")) {
            status = "1";
        } else {
            status = "0";
        }

        let tampil;
        if ($('#_tampil').is(":checked")) {
            tampil = "1";
        } else {
            tampil = "0";
        }

        if (_judul === "") {
            $("input#_judul").css("color", "#dc3545");
            $("input#_judul").css("border-color", "#dc3545");
            $('._judul').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }

        if (_judul === "") {
            // swal.fire(
            //     'Gagal!',
            //     "Isian tidak boleh kosong.",
            //     'warning'
            // );
        } else {
            const formUpload = new FormData();
            formUpload.append('judul', _judul);
            formUpload.append('deskripsi', _deskripsi);
            formUpload.append('status', status);
            formUpload.append('tampil', tampil);

            $.ajax({
                url: "<?= base_url('dinas/info/pengumuman/addSave') ?>",
                type: 'POST',
                data: formUpload,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('.simpan-data').attr('disabled', 'disabled');
                    $('div.modal-content-loading').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(resMsg) {
                    $('div.modal-content-loading').unblock();
                    const resul = JSON.parse(resMsg);

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
                            $('.simpan-data').attr('disabled', false);

                            Swal.fire(
                                'Failed!',
                                resul.message,
                                'warning'
                            );
                        }
                    } else {
                        Swal.fire(
                            'SELAMAT!',
                            resul.message,
                            'success'
                        ).then((valRes) => {
                            document.location.href = "<?= current_url(true); ?>";
                        })
                    }
                },
                error: function() {
                    $('.simpan-data').attr('disabled', false);
                    $('div.modal-content-loading').unblock();
                    Swal.fire(
                        'Failed!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );
                }
            });
        }
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<style>
    body {
        --ck-z-default: 100;
        --ck-z-modal: calc(var(--ck-z-default) + 999);
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