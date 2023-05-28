<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title><?= $title; ?></title>
    <?= $this->include('commons/meta'); ?>
    <?= $this->renderSection('scriptTop'); ?>
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
    <script src="<?= base_url('assets/adminsb/js'); ?>/pdf.js"></script>
    <script src="<?= base_url('assets/adminsb/js'); ?>/pdf.worker.js"></script>
</head>

<body>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div id="content-ptk" class="content-ptk">
                            <div class="header">
                                <div class="row">
                                    <div class="col-sm-6" style="margin-bottom: 0px;">
                                        <h2>INFORMASI PENGGUNA</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <form id="formAdd" name="formAdd" methode="post">
                                    <div class="modal-body">
                                        <div class="row clearfix m-t-20">
                                            <div class="col-sm-6">
                                                <label for="fullname">Nama Lengkap</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="fullname" name="fullname" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="nip">NIP</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="nip" name="nip" required>
                                                    </div>
                                                    <div class="m-t-10 font-12"><b>Keterangan: </b><span class="js-nouislider-value">Jika belum mempunyai NIP, silahkan isikan dengan tanda ( - ).</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <label for="email">E-mail</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="email" name="email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="email">No Handphone</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="nohp" name="nohp" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <label for="jenisKelamin">Jenis Kelamin</label>
                                                <div class="form-group">
                                                    <select class="form-control show-tick" id="jenisKelamin" name="jenisKelamin" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="L"> Laki - Laki </option>
                                                        <option value="P"> Perempuan </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="jabatan">Jabatan</label>
                                                <div class="form-group">
                                                    <select class="form-control show-tick" id="jabatan" name="jabatan" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Admin"> ADMIN </option>
                                                        <option value="Bendahara"> BENDAHARA </option>
                                                        <option value="Guru"> GURU </option>
                                                        <option value="Kepala Sekolah"> KEPALA SEKOLAH </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <label for="newPassword">Password</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="retypeNewPassword">Retype - Password</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="retypeNewPassword" name="retypeNewPassword" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <label for="image">Surat Tugas</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <!--<input type="file" class="form-control" id="image" name="image" accept="application/pdf" required />-->
                                                        <input type="file" class="form-control image" id="image" name="image" accept="application/pdf" onchange="loadFilePdf()" required />
                                                    </div>
                                                    <div class="m-t-10 font-12"><b>Keterangan: </b><span class="js-nouislider-value">pilih file ekstensi pdf dengan ukuran maksimal 500 Kb</span></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div id="pdf-loader" style="display:none">Loading Preview ..</div>
                                                    <canvas id="pdfViewer" class="pdfViewer" width="250" style="display:none"></canvas>
                                                </div>
                                            </div>
                                            <!--<div class="col-sm-6">-->
                                            <!--    <div class="form-group">-->
                                            <!--            <div class="preview-image-upload">-->
                                            <!--                <img class="imagePreviewUpload" style="max-width: 100%;" id="imagePreviewUpload"/>-->
                                            <!--                <button type="button" class="btn-remove-preview-image">Remove</button>-->
                                            <!--            </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-10">
                                                <div><progress id="progressBar" value="0" max="100" style="width:100%; display: none;"></progress></div>
                                                <div>
                                                    <h3 id="status" style="font-size: 15px; margin: 8px auto;"></h3>
                                                </div>
                                                <div>
                                                    <p id="loaded_n_total" style="margin-bottom: 0px;"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 pull-right">
                                                <div class="form-group">
                                                    <button type="button" style="min-width: 100px;" class="btn btn-primary waves-effect pull-right simpan-new-user" id="simpan-new-user">SIMPAN</button>
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
        </div>
    </section>



    <script src="<?= base_url('assets/adminsb/plugins/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?= base_url('assets/adminsb/plugins/bootstrap/js/bootstrap.js'); ?>"></script>

    <!-- Select Plugin Js -->
    <script src="<?= base_url('assets/adminsb/plugins/bootstrap-select/js/bootstrap-select.js'); ?>"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?= base_url('assets/adminsb/plugins/jquery-slimscroll/jquery.slimscroll.js'); ?>"></script>
    <script src="<?= base_url('assets/adminsb/plugins/jquery-inputmask/jquery.inputmask.bundle.js'); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?= base_url('assets/adminsb/plugins/node-waves/waves.js'); ?>"></script>

    <!--<script src="<?= base_url('assets/adminsb/js/admin.js'); ?>"></script>-->
    <!--<script src="<?= base_url('assets/adminsb/js/demo.js'); ?>"></script>-->
    <!--<script src="<?= base_url('assets/plugins-site.js'); ?>"></script>-->

    <script src="<?= base_url('assets/adminsb/plugins/bootstrap-notify/bootstrap-notify.js'); ?>"></script>
    <script src="<?= base_url('new-assets/assets'); ?>/js/jquery-block-ui.js"></script>
    <script>
        let fileSelect;
        var _PDF_DOC,
            _OBJECT_URL,
            _CANVAS;

        function showPDF(pdf_url) {
            PDFJS.getDocument({
                url: pdf_url
            }).then(function(pdf_doc) {
                _PDF_DOC = pdf_doc;

                // show the first page of PDF
                showPage(1);

                // destroy previous object url
                URL.revokeObjectURL(_OBJECT_URL);
            }).catch(function(error) {
                // error reason
                alert(error.message);
            });;
        }

        function showPage(page_no) {
            _PDF_DOC.getPage(page_no).then(function(page) {
                _CANVAS = document.querySelector('.pdfViewer');
                // set the scale of viewport
                var scale_required = _CANVAS.width / page.getViewport(1).width;

                // get viewport of the page at required scale
                var viewport = page.getViewport(scale_required);

                // set canvas height
                _CANVAS.height = viewport.height;

                var renderContext = {
                    canvasContext: _CANVAS.getContext('2d'),
                    viewport: viewport
                };

                // render the page contents in the canvas
                page.render(renderContext).then(function() {
                    document.querySelector("#pdfViewer").style.display = 'inline-block';
                    document.querySelector("#pdf-loader").style.display = 'none';
                });
            });
        }

        function ambilId(id) {
            return document.getElementById(id);
        }

        function loadFileImage() {
            const input = document.getElementsByName('image')[0];
            if (input.files && input.files[0]) {
                var file = input.files[0];

                // allowed MIME types
                var mime_types = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];

                // validate whether PDF
                if (mime_types.indexOf(file.type) == -1) {
                    alert('Error : Hanya type Image yang diizinkan');
                    return;
                }

                // validate file size
                if (file.size > 1 * 1024 * 1024) {
                    alert('Error : Ukuran file tidak boleh lebih dari 1MB');
                    return;
                }

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.imagePreviewUpload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
                // console.log("success Load");
            } else {
                console.log("failed Load");
            }
        }

        function loadFilePdf() {
            const input = document.getElementsByName('image')[0];
            if (input.files && input.files[0]) {
                // if(input.files[0].type == "application/pdf") {
                var file = input.files[0];

                // allowed MIME types
                var mime_types = ['application/pdf'];

                // validate whether PDF
                if (mime_types.indexOf(file.type) == -1) {
                    input.value = "";

                    Swal.fire(
                        'Warning!!!',
                        "Hanya file type pdf yang diizinkan.",
                        'warning'
                    );
                    return;
                }

                // validate file size
                if (file.size > 1 * 512 * 1000) {
                    input.value = "";

                    Swal.fire(
                        'Warning!!!',
                        "Ukuran file tidak boleh lebih dari 500 Kb.",
                        'warning'
                    );
                    return;
                }

                fileSelect = input;

                // validation is successful

                // hide upload dialog
                // document.querySelector("#upload-dialog").style.display = 'none';

                // show the PDF preview loader
                document.querySelector("#pdf-loader").style.display = 'inline-block';

                // object url of PDF 
                _OBJECT_URL = URL.createObjectURL(file)

                // send the object url of the pdf to the PDF preview function
                showPDF(_OBJECT_URL);
                // } else {
                //     console.log("File pdf not valid");
                // }
            } else {
                console.log("failed Load");
            }
        }

        $('#formAdd').on('click', '.btn-remove-preview-image', function(event) {
            $('.imagePreviewUpload').removeAttr('src');
            //   $('.btn-remove-preview-image').css('display', 'none');
            document.getElementsByName("image")[0].value = "";
        });

        $('#formAdd').on('click', '.simpan-new-user', function(event) {

            // const fileName = document.getElementsByName('image')[0];
            const fullname = document.getElementsByName('fullname')[0].value;
            const nip = document.getElementsByName('nip')[0].value;
            const nohp = document.getElementsByName('nohp')[0].value;
            const email = document.getElementsByName('email')[0].value;
            const jabatan = document.getElementsByName('jabatan')[0].value;
            const jenisKelamin = document.getElementsByName('jenisKelamin')[0].value;
            const newPassword = document.getElementsByName('newPassword')[0].value;
            const retypeNewPassword = document.getElementsByName('retypeNewPassword')[0].value;

            console.log(fileSelect.value);
            console.log(fileSelect.files[0]);

            if (fileSelect.value === "") {
                Swal.fire(
                    'Gagal!',
                    "File upload tidak boleh kosong.",
                    'warning'
                );
                return;
            }
            if (fullname === "") {
                Swal.fire(
                    'Gagal!',
                    "Nama tidak boleh kosong.",
                    'warning'
                );
                return;
            }
            if (nip === "") {
                Swal.fire(
                    'Gagal!',
                    "NIP tidak boleh kosong.",
                    'warning'
                );
                return;
            }
            if (nohp === "") {
                Swal.fire(
                    'Gagal!',
                    "No handphone tidak boleh kosong.",
                    'warning'
                );
                return;
            }
            if (email === "") {
                Swal.fire(
                    'Gagal!',
                    "Email tidak boleh kosong.",
                    'warning'
                );
                return;
            }
            if (jabatan === "") {
                Swal.fire(
                    'Gagal!',
                    "Pilih jabatan terlebih dahulu.",
                    'warning'
                );
                return;
            }
            if (jenisKelamin === "") {
                Swal.fire(
                    'Gagal!',
                    "Pilih jenis kelamin terlebih dahulu.",
                    'warning'
                );
                return;
            }
            if (newPassword === "") {
                Swal.fire(
                    'Gagal!',
                    "Password tidak boleh kosong.",
                    'warning'
                );
                return;
            }
            if (retypeNewPassword === "") {
                Swal.fire(
                    'Gagal!',
                    "Ulangi Password tidak boleh kosong.",
                    'warning'
                );
            } else {
                if (newPassword !== retypeNewPassword) {
                    Swal.fire(
                        'Gagal!',
                        "password tidak sama.",
                        'warning'
                    );
                } else {
                    const formUpload = new FormData();
                    // const file = document.getElementsByName('image')[0].files[0];
                    formUpload.append('image', fileSelect.files[0]);
                    formUpload.append('fullname', fullname);
                    formUpload.append('nip', nip);
                    formUpload.append('nohp', nohp);
                    formUpload.append('email', email);
                    formUpload.append('jabatan', jabatan);
                    formUpload.append('jenisKelamin', jenisKelamin);
                    formUpload.append('newPassword', newPassword);
                    formUpload.append('retypeNewPassword', retypeNewPassword);

                    ambilId("progressBar").style.display = "block";
                    $('.simpan-new-user').attr('disabled', 'disabled');
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.addEventListener("load", completeHandler, false);
                    ajax.addEventListener("error", errorHandler, false);
                    ajax.addEventListener("abort", abortHandler, false);
                    ajax.open("POST", "<?= base_url('auth/saveNewFirsLogin'); ?>");
                    ajax.send(formUpload);
                }
            }
        });

        function progressHandler(event) {
            ambilId("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
            var percent = (event.loaded / event.total) * 100;
            ambilId("progressBar").value = Math.round(percent);
            ambilId("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
        }

        function completeHandler(event) {

            // console.log(response);
            if (event.target.responseText == false) {
                ambilId("status").innerHTML = "Proses upload Error";
                ambilId("status").style.color = "red";
                ambilId("progressBar").value = 0;
                ambilId("loaded_n_total").innerHTML = "";
                $('.simpan-new-user').attr('disabled', false);
                Swal.fire(
                    'Failed!',
                    "Proses Upload Error.",
                    'warning'
                );
            } else {
                $('.simpan-new-user').attr('disabled', false);
                console.log(event.target);
                const response = JSON.parse(event.target.response);
                if (response.code !== 200) {
                    ambilId("status").innerHTML = "Proses upload Error";
                    ambilId("status").style.color = "red";
                    ambilId("progressBar").value = 0;
                    ambilId("loaded_n_total").innerHTML = "";
                    // $('.simpan-new-user').attr('disabled', false);
                    if (response.code === 401) {
                        swal.fire({
                            icon: 'warning',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then((valRes) => {
                            document.location.href = response.url;
                        })
                    } else {
                        Swal.fire(
                            'Failed!',
                            response.message,
                            'warning'
                        );
                    }
                } else {
                    ambilId("status").innerHTML = response.message;
                    ambilId("status").style.color = "green";
                    ambilId("progressBar").value = 100;
                    // $('.simpan-new-user').attr('disabled', false);
                    document.getElementById("formAdd").reset();

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then((valRes) => {
                        document.location.href = response.url;
                    })
                }
            }

        }

        function errorHandler(event) {
            ambilId("status").innerHTML = "Upload Failed";
            ambilId("status").style.color = "red"; //#858585
            Swal.fire(
                'Failed!',
                "Simpan pengguna baru gagal.",
                'warning'
            );
            $('.simpan-new-user').attr('disabled', false);
        }

        function abortHandler(event) {
            ambilId("status").innerHTML = "Upload Aborted";
            ambilId("status").style.color = "red";
            Swal.fire(
                'Failed!',
                "Upload File Aborted.",
                'warning'
            );
            $('.simpan-new-user').attr('disabled', false);
        }
    </script>

</body>

</html>