<?php if (isset($result)) { ?>
    <?php if (count($result) > 0) { ?>
        <?php foreach ($result as $key => $v) { ?>
            <div class="custom-control custom-radio mb-3"><input name="custom-radio-1" class="custom-control-input" id="customRadio5" type="radio"> <label class="custom-control-label" for="customRadio5">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="javascript:;" class="avatar" style="background-color: transparent;min-width: 100px;">
                                    <img style="min-width: 100px;" alt="Image placeholder" src="<?= base_url('new-assets') ?>/assets/img/icons/<?= ((int)$v->status_sekolah == 1) ? 'sekolah-negeri.png' : 'sekolah-swasta.png' ?>">
                                </a>
                            </div>
                            <div class="col ml--2">
                                <h4 class="mb-0">
                                    <a href="javascript:;">
                                        <?= $v->nama ?>
                                    </a>
                                </h4>
                                <small>NPSN: <?= $v->npsn ?></small>
                                <?= ((int)$v->status_sekolah == 1) ? '<span class="badge badge-success">Negeri</span>' : '<span class="badge badge-info">Swasta</span>' ?> &nbsp;&nbsp;<small>Jarak : <?= getJarak2Koordinat($v->latitude, $v->longitude, $user->latitude, $user->longitude, 'kilometers') . ' Km' ?></small>
                                <p style="margin: 0px; font-size: 11px;">Alamat: <?= $v->alamat_jalan ?>, Kec. <?= $v->nama_kecamatan ?> - <?= $v->nama_kabupaten ?> (<?= $v->nama_provinsi ?>)</p>
                            </div>
                            <div class="col-auto">
                                <button onclick="aksiDaftar('<?= $v->id ?>', '<?= $v->nama ?>')" type="button" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp; Daftar</button>
                            </div>
                        </div>
                    </div>
                </label></div>
        <?php } ?>
    <?php } else { ?>
        <p style="padding: 8px;">Tidak ada data sekolah dalam zonasi anda.</p>
    <?php } ?>
<?php } else { ?>
    <p style="padding: 8px;">Tidak ada data sekolah dalam zonasi anda.</p>
<?php } ?>