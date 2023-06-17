<?php if (isset($result)) {
    if (count($result) > 0) {
        foreach ($result as $key => $value) { ?>
            <li class="list-group-item px-0">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a href="javascript:;" class="avatar" style="background-color: transparent;min-width: 100px;">
                            <img style="min-width: 100px;" alt="Image placeholder" src="<?= base_url('new-assets') ?>/assets/img/icons/<?= ((int)$value->status_sekolah == 1) ? 'sekolah-negeri.png' : 'sekolah-swasta.png' ?>">
                        </a>
                    </div>
                    <div class="col ml--2">
                        <h4 class="mb-0">
                            <a href="javascript:;">
                                <?= $value->nama ?>
                            </a>
                        </h4>
                        <small>NPSN: <?= $value->npsn ?></small>
                        <?= ((int)$value->status_sekolah == 1) ? '<span class="badge badge-success">Negeri</span>' : '<span class="badge badge-info">Swasta</span>' ?> &nbsp;&nbsp;<small>Jarak : <?= getJarak2Koordinat($value->latitude, $value->longitude, $user->latitude, $user->longitude, 'kilometers') . ' Km' ?></small>
                        <p style="margin: 0px; font-size: 11px;">Alamat: <?= $value->alamat_jalan ?>, Kec. <?= $value->nama_kecamatan ?> - <?= $value->nama_kabupaten ?> (<?= $value->nama_provinsi ?>)</p>
                    </div>
                    <div class="col-auto">
                        <button onclick="aksiDaftarPilihan('<?= $value->id ?>', '<?= $value->nama ?>')" type="button" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp; Daftar</button>
                    </div>
                </div>
            </li>
        <?php } ?>
        <script>
            function aksiDaftarPilihan(id, nama) {
                $.ajax({
                    url: "<?= base_url('peserta/pendaftaran/prestasi/getpilihanprestasi') ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        nama: nama,
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
                                Swal.fire(
                                    'Failed!',
                                    resul.message,
                                    'warning'
                                );
                            }
                        } else {
                            $('#contentModalLabel').html('PILIHAN JENIS JALUR PRESTASI');
                            $('.contentBodyModal').html(resul.data);
                            $('#contentModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            }, 'show');

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
        </script>
    <?php } ?>
<?php } ?>