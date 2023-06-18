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
                                <li class="breadcrumb-item active" aria-current="page">Detail Pengaduan</li>
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
                        <h5 class="h3 mb-0">DETAIL PENGADUAN | <?= $aduan->token ?></h5>
                    </div>
                    <div class="card-header d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="#">
                                <img src="<?= base_url('new-assets'); ?>/assets/img/theme/team-3.jpg" class="avatar">
                            </a>
                            <div class="mx-3">
                                <a href="#" class="text-dark font-weight-600 text-sm"><?= $aduan->nama ?></a>
                                <small class="d-block text-muted"><?= $aduan->created_at ?></small>
                            </div>
                        </div>
                        <!-- <div class="text-right ml-auto">
                            <button type="button" class="btn btn-sm btn-primary btn-icon">
                                <span class="btn-inner--icon">
                                    <i class="ni ni-fat-add"></i>
                                </span>
                                <span class="btn-inner--text">Follow</span>
                            </button>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <p class="mb-4"><?= $aduan->deskripsi ?></p>
                        <div class="row align-items-center my-3 pb-3 border-bottom">
                            <div class="col-sm-6">
                                <div class="icon-actions">
                                    <a href="#">
                                        <i class="ni ni-chat-round"></i>
                                        <span class="text-muted jumlah-balasan-comment" id="jumlah-balasan-comment"><?= (isset($komentars)) ? (count($komentars) > 0 ? count($komentars) : '0') : '0' ?></span>
                                    </a>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6 d-none d-sm-block">
                                <div class="d-flex align-items-center justify-content-sm-end">
                                    <div class="avatar-group">
                                        <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland">
                                            <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg" class>
                                        </a>
                                        <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Audrey Love">
                                            <img alt="Image placeholder" src="../../assets/img/theme/team-2.jpg" class="rounded-circle">
                                        </a>
                                        <a href="#" class="avatar avatar-xs rounded-circle" data-toggle="tooltip" data-original-title="Michael Lewis">
                                            <img alt="Image placeholder" src="../../assets/img/theme/team-3.jpg" class="rounded-circle">
                                        </a>
                                    </div>
                                    <small class="pl-2 font-weight-bold">and 30+ more</small>
                                </div>
                            </div> -->
                        </div>
                        <div class="mb-1">
                            <div class="content-komentar-replay" id="content-komentar-replay">
                                <?php if (isset($komentars)) { ?>
                                    <?php if (count($komentars) > 0) { ?>
                                        <?php foreach ($komentars as $key => $v) { ?>
                                            <div class="media media-comment">
                                                <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle" src="<?= base_url('new-assets'); ?>/assets/img/theme/<?= $v->is_admin == 0 ? 'team-3.jpg' : 'team-1.jpg' ?>">
                                                <div class="media-body">
                                                    <div class="media-comment-text">
                                                        <h6 class="h5 mt-0"><?= $v->nama ?></h6>
                                                        <p class="text-sm lh-160"><?= $v->komentar ?></p>
                                                        <div class="icon-actions">
                                                            <a href="javascript:;">
                                                                <i class="ni ni-calendar-grid-58"></i>
                                                                <span class="text-muted"><?= $v->created_at ?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <hr>
                            <div class="media align-items-center loading-comentar">
                                <img alt="Image placeholder" class="avatar avatar-lg rounded-circle mr-4" src="<?= base_url('new-assets'); ?>/assets/img/theme/team-1.jpg">
                                <div class="media-body">
                                    <form>
                                        <textarea class="form-control" id="_balas_komentar" name="_balas_komentar" placeholder="Write your comment" rows="2"></textarea>
                                        <button style="margin-top: 10px;" type="button" onclick="sendBalasKomentar(this, '<?= $aduan->id ?>');" class="btn btn-primary btn-icon">
                                            <span class="btn-inner--icon">
                                                <i class="ni ni-send"></i>
                                            </span>
                                            <span class="btn-inner--text">Kirim</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
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
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<script src="<?= base_url('new-assets/assets/js'); ?>/jquery-block-ui.js"></script>
<!--<script src="<?= base_url('assets/js'); ?>/ckeditor5/build/build/ckeditor.js"></script>-->
<!--<script src="<?= base_url('new-assets'); ?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>-->
<!-- <script src="<?= base_url('new-assets') ?>/assets/vendor/datatables/datatables.min.js"></script> -->
<!-- <script src="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/js/select2.min.js"></script> -->

<script>
    function sendBalasKomentar(event, id) {
        const komentar = document.getElementsByName('_balas_komentar')[0].value;
        // const tujuan = "teknis";

        if (komentar === "") {
            Swal.fire(
                'Peringatan!',
                "Komentar tidak boleh kosong.",
                'warning'
            );
            return;
        }

        $.ajax({
            type: "POST",
            url: BASE_URL + '/dinas/pengaduan/balascomment',
            data: {
                id_post: id,
                nama: 'Admin',
                komentar: komentar,
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('div.loading-comentar').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                console.log(msg);
                if (msg.code != 200) {
                    $('div.loading-comentar').unblock();
                    loading = false;
                    Swal.fire(
                        'Gagal!',
                        msg.message,
                        'warning'
                    );
                } else {
                    $('div.loading-comentar').unblock();
                    document.getElementsByName('_balas_komentar')[0].value = "";
                    const newDivKomentar = document.createElement('div');
                    newDivKomentar.className = 'media media-comment';

                    // Mengisi konten HTML pada elemen div
                    const newKomentarnya = `
                        <img alt="Image placeholder" class="avatar avatar-lg media-comment-avatar rounded-circle" src="<?= base_url('new-assets'); ?>/assets/img/theme/team-1.jpg">
                        <div class="media-body">
                            <div class="media-comment-text">
                                <h6 class="h5 mt-0">{{nama}}</h6>
                                <p class="text-sm lh-160">{{komentar}}</p>
                                <div class="icon-actions">
                                    <a href="javascript:;">
                                        <i class="ni ni-calendar-grid-58"></i>
                                        <span class="text-muted">{{date}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;

                    const htmlWithReplacement = newKomentarnya.replace("{{nama}}", msg.data.nama);
                    const htmlWithReplacement1 = htmlWithReplacement.replace("{{date}}", msg.data.created_at);
                    const htmlWithReplacement2 = htmlWithReplacement1.replace("{{komentar}}", msg.data.komentar);

                    newDivKomentar.innerHTML = htmlWithReplacement2;

                    // Menemukan elemen target berdasarkan ID
                    var targetElementContentKometar = document.getElementById('content-komentar-replay');

                    // Menambahkan elemen baru ke dalam elemen target
                    targetElementContentKometar.appendChild(newDivKomentar);
                    document.getElementById('jumlah-balasan-comment').textContent = msg.data.replayed;

                }
            },
            error: function(data) {

                // loading = false;
                $('div.loading-comentar').unblock();
                Swal.fire(
                    'Gagal!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );

            }
        });
    }

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

    function ambilId(id) {
        return document.getElementById(id);
    }

    $(document).ready(function() {
        // initSelect2('filter_jenjang', '#panel');
        // initSelect2('filter_kecamatan', '#panel');

        // let tableUsulan = $('#data-table-id').DataTable({
        //     "processing": true,
        //     "serverSide": true,
        //     "order": [],
        //     "ajax": {
        //         "url": "<?= base_url('dinas/setting/zonasi/getAllSekolah') ?>",
        //         "type": "POST",
        //         "data": function(data) {
        //             data.filter_kecamatan = $('#filter_kecamatan').val();
        //             data.filter_jenjang = $('#filter_jenjang').val();
        //         }
        //     },
        //     language: {
        //         paginate: {
        //             next: '<i class="ni ni-bold-right">',
        //             previous: '<i class="ni ni-bold-left">'
        //         },
        //         processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
        //     },
        //     "columnDefs": [{
        //         "targets": 0,
        //         "orderable": false,
        //     }],
        // });

        // $('#filter_jenjang').change(function() {
        //     tableUsulan.draw();
        // });

        // $('#filter_kecamatan').change(function() {
        //     tableUsulan.draw();
        // });

    });
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