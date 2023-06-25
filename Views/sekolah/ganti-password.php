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
                                <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
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
                        <h2>GANTI PASSWORD</h2>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <form>
                                <!-- <h5 class="heading-small">Ganti Password</h5> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group _old_password-block">
                                            <label for="_old_password" class="form-control-label">Password Lama <span class="required" style="color: indigo;">* Wajib</span></label>
                                            <input type="password" class="form-control" id="_old_password" name="_old_password" placeholder="Password lama..." onFocus="inputFocus(this);" required>
                                            <div class="help-block _old_password"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group _new_password-block">
                                            <label for="_new_password" class="form-control-label">Password Baru <span class="required" style="color: indigo;">* Wajib</span></label>
                                            <input type="password" class="form-control" id="_new_password" name="_new_password" placeholder="Password baru..." onFocus="inputFocus(this);" required>
                                            <div class="help-block _new_password"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _re_new_password-block">
                                            <label for="_re_new_password" class="form-control-label">Ulangi Password Baru <span class="required" style="color: indigo;">* Wajib</span></label>
                                            <input type="password" class="form-control" id="_re_new_password" name="_re_new_password" placeholder="Password baru..." onFocus="inputFocus(this);" required>
                                            <div class="help-block _re_new_password"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top: 30px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success _kirim_permohonan" id="_kirim_permohonan" name="_kirim_permohonan">SIMPAN</button>
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
        // initSelect2Panel('_provinsi');
        initSelect2Panel('_kabupaten');
        <?php if (isset($pemilik)) {
            if ($pemilik->tgl_lahir != null) { ?>
                // initializeDatetime('_tgl_lahir', '<?= $pemilik->tgl_lahir ?>');
            <?php } else { ?>
                // initializeDatetime('_tgl_lahir', new Date().toLocaleDateString('fr-CA'));
            <?php } ?>
        <?php } else { ?>
            // initializeDatetime('_tgl_lahir', new Date().toLocaleDateString('fr-CA'));
        <?php } ?>
    });

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


    function actionMouseHoverLocation(event) {
        event.style.color = '#fff';
        event.style.background = '#0A48B3';
        $('.action-location-icon').css('color', '#fff');
    }

    function actionMouseOutHoverLocation(event) {
        event.style.color = '#adb5bd';
        event.style.background = '#fff';
        $('.action-location-icon').css('color', '#adb5bd');
    }

    $('#_kirim_permohonan').on('click', function() {
        const old_password = document.getElementsByName('_old_password')[0].value;
        const new_password = document.getElementsByName('_new_password')[0].value;
        const re_new_password = document.getElementsByName('_re_new_password')[0].value;

        if (old_password === "") {
            $("input#_old_password").css("color", "#dc3545");
            $("input#_old_password").css("border-color", "#dc3545");
            $('._old_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Password lama tidak boleh kosong.</li></ul>');
            return;
        }
        if (new_password === "") {
            $("input#_new_password").css("color", "#dc3545");
            $("input#_new_password").css("border-color", "#dc3545");
            $('._new_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Password baru tidak boleh kosong.</li></ul>');
            return;
        }
        if (re_new_password === "") {
            $("input#_re_new_password").css("color", "#dc3545");
            $("input#_re_new_password").css("border-color", "#dc3545");
            $('._re_new_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Ulangi password baru tidak boleh kosong.</li></ul>');
            return;
        }
        if (re_new_password !== new_password) {
            $("input#_re_new_password").css("color", "#dc3545");
            $("input#_re_new_password").css("border-color", "#dc3545");
            $('._re_new_password').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Ulangi password baru tidak sama.</li></ul>');
            return;
        }

        const formUpload = new FormData();
        formUpload.append('oldPassword', old_password);
        formUpload.append('newPassword', new_password);
        formUpload.append('retypeNewPassword', re_new_password);

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
            url: BASE_URL + "/sekolah/user/savePassword",
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