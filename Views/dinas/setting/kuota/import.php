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
                                <li class="breadcrumb-item"><a href="<?= base_url('dinas/setting/kuota'); ?>">Setting Kuota Sekolah</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Import Kuota Sekolah</li>
                            </ol>
                        </nav>
                    </div>
                    <!--<div class="col-lg-6 col-5 text-right">-->
                    <!--    <a href="javascript:;" class="btn btn-sm btn-neutral button-add-data">Tambah Instansi</a>-->
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
                    <div class="card-header border-0 mb--5">
                        <h3 class="mb-0">Import Data Zonasi Sekolah</h3>
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
                    <hr>
                    <div class="card-body mt--4">
                        <section>
                            <form id="formAdd" method="post" enctype="multipart/form-data">
                                <div class="content-loaded">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">IMPORT DATA ZONASI SEKOLAH</h6>
                                    <div class="row clearfix">

                                        <div class="col-lg-6">
                                            <div class="form-group _jenjang-block">
                                                <label for="_jenjang" class="form-control-label">Pilih Jenjang</label>
                                                <select class="form-control jenjang" name="_jenjang" id="_jenjang" data-toggle="select22" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <option value="5">SD</option>
                                                    <option value="6" selected>SMP</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="nama" class="form-control-label">File</label>
                                                <input type="file" class="form-control" name="file" id="file" accept=".xls, .xlsx" onchange="loadFileXl(this, 'lampiran-import');" required />
                                                <div class="invalid-feedback lampiran-import">File tidak boleh kosong.</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="float: right; margin-top: 30px;">
                                            <div class="form-group" style="float: right;">
                                                <button type="button" class="btn btn-success pull-right simpan-add" id="simpan-add" name="simpan-add" style="min-width: 200px;">IMPORT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">

                                    <div class="col-lg-12" style="float: left;">
                                        <div><progress id="progressBar" value="0" max="100" style="width:100%; display: none;"></progress></div>
                                        <div>
                                            <h3 id="status" style="font-size: 15px; margin: 8px auto;"></h3>
                                        </div>
                                        <div>
                                            <p id="loaded_n_total" style="margin-bottom: 0px;"></p>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </section>
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
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
<!--<script src="<?= base_url('assets/js'); ?>/ckeditor5/build/build/ckeditor.js"></script>-->
<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>

<script>
    function changeValidation(event) {
        $('.' + event).css('display', 'none');
    };

    function inputFocus(id) {
        $(id).removeAttr('style');
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

    let editor;

    function loadFileXl(fil, event) {
        const input = document.getElementsByName('file')[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];

            // allowed MIME types
            var mime_types = ['application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/x-xls', 'application/excel', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                Swal.fire(
                    'Warning!!!',
                    "Hanya file berekstensi .xls atau .xlsx yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 1 * 2048 * 1000) {
                input.value = "";
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 2 Mb.",
                    'warning'
                );
                return;
            }

            $('.' + event).css('display', 'none');
        } else {
            console.log("failed Load");
        }
    }

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    $(document).ready(function() {

        $('#simpan-add').on('click', function(e) {
            e.preventDefault();
            const fileName = document.getElementsByName('file')[0].value;
            const jenjang = document.getElementsByName('_jenjang')[0].value;
            // const aksiPilihan = document.getElementsByName('_jenis_aksi')[0].value;

            // if(aksiPilihan === "") {
            //     $( "select#_jenis_aksi" ).css("color", "#dc3545");
            //     $( "select#_jenis_aksi" ).css("border-color", "#dc3545");
            //     $('._jenis_aksi').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih jenis upload dulu.</li></ul>');
            //     return;
            // }

            if (fileName === "") {
                $("input#file").css("color", "#dc3545");
                $("input#file").css("border-color", "#dc3545");
                $('.file').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
            }

            if (fileName === "") {
                swal.fire(
                    'Gagal!',
                    "Isian tidak boleh kosong.",
                    'warning'
                );
            } else {
                const formUpload = new FormData();
                const file = document.getElementsByName('file')[0].files[0];
                formUpload.append('file', file);
                formUpload.append('jenjang', jenjang);
                // formUpload.append('jenis', aksiPilihan);

                $.ajax({
                    xhr: function() {
                        let xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                ambilId("loaded_n_total").innerHTML = "Uploaded " + evt.loaded + " bytes of " + evt.total;
                                let percent = (evt.loaded / evt.total) * 100;
                                ambilId("progressBar").value = Math.round(percent);
                                ambilId("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
                            }
                        }, false);
                        return xhr;
                    },
                    url: "<?= base_url('dinas/setting/kuota/uploadData') ?>",
                    type: 'POST',
                    data: formUpload,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'JSON',
                    beforeSend: function() {

                        ambilId("progressBar").style.display = "block";
                        $('.simpan-add').attr('disabled', 'disabled');
                        ambilId("status").innerHTML = "Mulai mengupload . . .";
                        ambilId("status").style.color = "blue"; //#858585
                        ambilId("progressBar").value = 0;
                        ambilId("loaded_n_total").innerHTML = "";
                        $('div.content-loading').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });
                    },
                    success: function(data) {
                        $('div.content-loading').unblock();

                        $('div.content-loaded').block({
                            message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                        });

                        if (data.success) {
                            ambilId("status").innerHTML = "Menyimpan Data . . .";
                            console.log(data.data);
                            console.log(data.data.length);

                            // return;

                            let jumlahDataBerhasil = [];
                            let jumlahDataGagal = [];

                            let sendToServer = function(lines, index) {
                                if (index > lines.length - 1) {
                                    $('div.content-loaded').unblock();
                                    ambilId("progressBar").style.display = "none";
                                    ambilId("status").innerHTML = "Data berhasil diimport semua.";
                                    ambilId("status").style.color = "green";
                                    ambilId("progressBar").value = 0;

                                    Swal.fire(
                                        'SELAMAT!',
                                        "Data berhasil diimport semua. <br>Total Jumlah Data : " + (data.data.length).toString() + " <br>Total Berhasil Import: " + jumlahDataBerhasil.length + " <br> Total Gagal Import: " + (jumlahDataGagal.length).toString(),
                                        'success'
                                    ).then((valRes) => {
                                        document.location.href = "<?= base_url('dinas/setting/kuota'); ?>";
                                    })
                                    return; // guard condition
                                }

                                item = lines[index];
                                let total = ((index + 1) / lines.length) * 100;
                                total = total.toFixed(2);

                                $.ajax({
                                    url: "<?= base_url('dinas/setting/kuota/importData'); ?>",
                                    type: 'POST',
                                    data: {
                                        npsn: item.npsn,
                                        jenjang: item.jenjang,
                                        kuota: item.kuota,
                                    },
                                    success: function(resMsg) {
                                        const msg = JSON.parse(resMsg);
                                        if (msg.code != 200) {
                                            jumlahDataGagal.push("gagal" + index);

                                            ambilId("status").style.color = "blue";
                                            ambilId("progressBar").value = total;
                                            ambilId("loaded_n_total").innerHTML = total + '%';
                                            console.log(msg.message);
                                            if (index + 1 === lines.length) {

                                                $('div.content-loaded').unblock();
                                                ambilId("progressBar").style.display = "none";
                                                ambilId("status").innerHTML = msg.message;
                                                ambilId("status").style.color = "green";
                                                ambilId("progressBar").value = 0;

                                                Swal.fire(
                                                    'SELAMAT!',
                                                    "Data berhasil diimport semua. <br>Total Jumlah Data : " + (data.data.length).toString() + " <br>Total Berhasil Import: " + jumlahDataBerhasil.length + " <br> Total Gagal Import: " + (jumlahDataGagal.length).toString(),
                                                    'success'
                                                ).then((valRes) => {
                                                    document.location.href = "<?= base_url('dinas/setting/kuota'); ?>";
                                                })
                                            }
                                        } else {
                                            jumlahDataBerhasil.push("berhasil" + index);

                                            ambilId("status").style.color = "blue";
                                            ambilId("progressBar").value = total;
                                            ambilId("loaded_n_total").innerHTML = total + '%';
                                            if (index + 1 === lines.length) {
                                                $('div.content-loaded').unblock();
                                                ambilId("progressBar").style.display = "none";
                                                ambilId("status").innerHTML = msg.message;
                                                ambilId("status").style.color = "green";
                                                ambilId("progressBar").value = 0;

                                                Swal.fire(
                                                    'SELAMAT!',
                                                    "Data berhasil diimport semua. <br>Total Jumlah Data : " + (data.data.length).toString() + " <br>Total Berhasil Import: " + jumlahDataBerhasil.length + " <br> Total Gagal Import: " + (jumlahDataGagal.length).toString(),
                                                    'success'
                                                ).then((valRes) => {
                                                    document.location.href = "<?= base_url('dinas/setting/kuota'); ?>";
                                                })

                                            }
                                        }

                                        setTimeout(
                                            function() {
                                                sendToServer(lines, index + 1);
                                            },
                                            350 // delay in ms
                                        );
                                    },
                                    error: function(error) {
                                        $('div.content-loaded').unblock();
                                        ambilId("progressBar").style.display = "none";
                                        ambilId("status").innerHTML = msg.message;
                                        ambilId("status").style.color = "green";
                                        ambilId("progressBar").value = 0;
                                        $('.simpan-add').attr('disabled', false);
                                        Swal.fire(
                                            'Failed!',
                                            "Gagal.",
                                            'warning'
                                        );
                                    }
                                });
                            };

                            sendToServer(data.data, 0);

                        }

                        if (data.error) {
                            ambilId("progressBar").style.display = "none";
                            ambilId("status").innerHTML = data.error;
                            ambilId("status").style.color = "red";
                            ambilId("progressBar").value = 0;
                            ambilId("loaded_n_total").innerHTML = "";
                            $('.simpan-add').attr('disabled', false);
                            $('div.content-loading').unblock();

                            Swal.fire(
                                'Failed!',
                                data.error,
                                'warning'
                            );

                        }

                    },
                    error: function() {
                        ambilId("progressBar").style.display = "none";
                        ambilId("status").innerHTML = "Upload Failed";
                        ambilId("status").style.color = "red"; //#858585
                        $('.simpan-add').attr('disabled', false);
                        $('div.content-loading').unblock();
                        Swal.fire(
                            'Failed!',
                            "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                            'warning'
                        );
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
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