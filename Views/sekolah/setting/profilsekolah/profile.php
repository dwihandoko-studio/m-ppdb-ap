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
                                <li class="breadcrumb-item active" aria-current="page">Profil Sekolah</li>
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
            <!-- Light table -->
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2>DATA PROFIL SEKOLAH</h2>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <form>
                                <!-- <h5 class="heading-small">Data Pribadi</h5> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group _nama_ks-block">
                                            <label for="_nama_ks" class="form-control-label">Nama Kepala Sekolah <span class="required" style="color: indigo;">* Wajib</span></label>
                                            <input type="text" class="form-control" id="_nama_ks" name="_nama_ks" placeholder="Nama Kepala Sekolah . . ." onFocus="inputFocus(this);" value="<?= (isset($ks)) ? (isset($ks->nama_ks) ? $ks->nama_ks : '') : '' ?>">
                                            <div class="help-block _nama_ks"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _nip_ks-block">
                                            <label for="_nip_ks" class="form-control-label">NIP Kepala Sekolah <span class="required" style="color: indigo;">* Wajib</span></label>
                                            <input type="text" class="form-control" id="_nip_ks" name="_nip_ks" placeholder="NIP Kepala Sekolah . . ." onFocus="inputFocus(this);" value="<?= (isset($ks)) ? (isset($ks->nip_ks) ? $ks->nip_ks : '') : '' ?>">
                                            <div class="help-block _nip_ks"></div>
                                        </div>
                                    </div>

                                </div>

                                <hr style="margin-top: 30px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success _kirim_permohonan" id="_kirim_permohonan" name="_kirim_permohonan">Simpan Profil</button>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="progress-wrapper progress-_progress_laporan" style="display: none;">
                                            <div class="progress-info">
                                                <div class="progress-label">
                                                    <span class="status-_progress_laporan" id="status-_progress_laporan">Memulai Upload . . .</span>
                                                </div>
                                                <div class="progress-percentage progress-percent-_progress_laporan" id="progress-percent-_progress_laporan">
                                                    <span>0%</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-info progressbar-_progress_laporan" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    function initSelect2Panel(event) {
        $('#' + event).select2({
            dropdownParent: "#panel"
        });
    }

    function initializeDatetime(event, date) {
        $('#' + event).datetimepicker({
            // defaultDate: new Date().toLocaleString('en-GB', { hour12: false }),
            defaultDate: date,
            locale: 'en-GB',
            format: 'YYYY-MM-DD',
            icons: {
                time: "fa fa-clock",
                date: "fa fa-calendar-day",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    }
    $(document).ready(function() {

    });

    function loadFilePdf(event) {
        // console.log(event);
        // const input = document.getElementsByName('_file')[0];
        const input = event;
        if (input.files && input.files[0]) {
            let file = input.files[0];

            // allowed MIME types
            let mime_types = ['application/pdf'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                // const color = event.name
                $('.' + event.name).css('display', 'block');
                $("input#" + event.name).css("color", "#dc3545");
                $("input#" + event.name).css("border-color", "#dc3545");
                $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Hanya file type pdf yang diizinkan.</li></ul>');
                // $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type pdf yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 1 * 512 * 1000) {
                input.value = "";
                $('.' + event.name).css('display', 'block');
                $("input#" + event.name).css("color", "#dc3545");
                $("input#" + event.name).css("border-color", "#dc3545");
                $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Ukuran file tidak boleh lebih dari 2 Mb.</li></ul>');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 2 Mb.",
                    'warning'
                );
                return;
            }


            $('.' + event.name).css('display', 'none');
            // $( "input#" + event.name ).css("color", "#dc3545");
            // $( "input#" + event.name ).css("border-color", "#dc3545");
            // $('.' + event.name).html('');

            // const color = $(id).attr('id');
            $(event.name).removeAttr('style');
            // $('.'+color).html('');

            // let reader = new FileReader();

            // reader.onload = function(e) {
            //     $('.imagePreviewUpload').attr('src', e.target.result);
            // }

            // reader.readAsDataURL(input.files[0]); // convert to base64 string
            // console.log("success Load");
        } else {
            console.log("failed Load");
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

    function onChangeProvinsi(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/sekolah/referensi/getKabupaten',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kabupaten').html('<option value="" selected>--Pilih Provinsi Dulu--</option>');
                    $('.kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('div._kabupaten-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kecamatan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kabupaten-block').unblock();
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    // const msg = JSON.parse(resMsg);
                    // const msg = JSON.parse(JSON.stringify(resMsg));
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kabupaten--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kabupaten').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kabupaten-block').unblock();
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                }
            })
        }
    }

    function onChangeKabupaten(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/sekolah/referensi/getKecamatan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('div._kecamatan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kecamatan--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kecamatan').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                }
            })
        }
    }

    function onChangeKecamatan(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/sekolah/referensi/getKelurahan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kelurahan-block').unblock();
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kelurahan--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kelurahan').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kelurahan-block').unblock();
                }
            })
        }
    }

    function onChangeKelurahan(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
    }


    let editor;

    function loadFileImage(event) {
        const keyName = $(event).attr('name');
        const input = document.getElementsByName(keyName)[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];

            // allowed MIME types
            var mime_types = ['image/jpg', 'image/jpeg', 'image/png'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                // $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type gambar yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 1 * 512 * 1000) {
                input.value = "";
                // $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 500 Kb.",
                    'warning'
                );
                return;
            }

            // var reader = new FileReader();

            // reader.onload = function(e) {
            //     $('.imagePreviewUpload').attr('src', e.target.result);
            // }

            // reader.readAsDataURL(input.files[0]); // convert to base64 string
            // console.log("success Load");
        } else {
            console.log("failed Load");
        }
    }

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    $('#_kirim_permohonan').on('click', function() {
        const nama_ks = document.getElementsByName('_nama_ks')[0].value;
        const nip_ks = document.getElementsByName('_nip_ks')[0].value;

        if (nama_ks === "") {
            $("input#_nama_ks").css("color", "#dc3545");
            $("input#_nama_ks").css("border-color", "#dc3545");
            $('._nama_ks').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Nama kepala sekolah tidak boleh kosong.</li></ul>');
            return;
        }
        if (nip_ks === "") {
            $("input#_nip_ks").css("color", "#dc3545");
            $("input#_nip_ks").css("border-color", "#dc3545");
            $('._nip_ks').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">NIP kepala sekolah tidak boleh kosong.</li></ul>');
            return;
        }

        const formUpload = new FormData();
        formUpload.append('nama_ks', nama_ks);
        formUpload.append('nip_ks', nip_ks);

        $.ajax({
            xhr: function() {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        // ambilId("loaded_n_total").innerHTML = "Uploaded " + evt.loaded + " bytes of " + evt.total;
                        let percent = (evt.loaded / evt.total) * 100;
                        // ambilId("progressBar").value = Math.round(percent);
                        // ambilId("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
                        $('#status-_progress_laporan').html("Sedang mengupload . . . " + evt.loaded + " byte Dari " + evt.total + " byte");
                        $('#progress-percent-_progress_laporan').html("<span>" + Math.round(percent) + "%</span>");
                        $('.progressbar-_progress_laporan').attr('aria-valuenow', Math.round(percent)).css('width', Math.round(percent) + '%');
                    }
                }, false);
                return xhr;
            },
            url: BASE_URL + "/sekolah/setting/profilsekolah/save",
            type: 'POST',
            data: formUpload,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function() {
                $('.progress-_progress_laporan').css('display', 'block');
                $('.status-_progress_laporan').innerHTML = "Memulai mengupload . . .";
                $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                $('._kirim_permohonan').attr('disabled', 'disabled');
                $('div.content-loading').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.content-loading').unblock();
                // const resul = JSON.parse(resMsg);

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
                        $('.progress-_progress_laporan').css('display', 'none');
                        $('.status-_progress_laporan').innerHTML = "";
                        $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                        $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                        $('._kirim_permohonan').attr('disabled', false);

                        Swal.fire(
                            'Failed!',
                            resul.message,
                            'warning'
                        );
                    }
                } else {
                    $('.progress-_progress_laporan').css('display', 'none');
                    $('.status-_progress_laporan').innerHTML = "";
                    $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                    $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                    // $('.button-_progress_laporan').css('display','none');

                    Swal.fire(
                        'SELAMAT!',
                        resul.message,
                        'success'
                    ).then((valRes) => {
                        document.location.href = BASE_URL + '/dashboard';
                    })
                }
            },
            error: function() {
                $('div.content-loading').unblock();
                $('.progress-_progress_laporan').css('display', 'none');
                $('.status-_progress_laporan').innerHTML = "";
                $('.progress-percent-_progress_laporan').innerHTML = "<span>0%</span>";
                $('.progressbar-_progress_laporan').attr('aria-valuenow', '0').css('width', '0%');
                $('._kirim_permohonan').attr('disabled', false);
                Swal.fire(
                    'Failed!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<!--<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">-->
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
<?= $this->endSection(); ?>