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
                        <?= ((int)$value->status_sekolah == 1) ? '<span class="badge badge-success">Negeri</span>' : '<span class="badge badge-info">Swasta</span>' ?> &nbsp;&nbsp;<small>Jarak : <?php //echo getJarak2Koordinat($value->latitude, $value->longitude, $user->latitude, $user->longitude, 'kilometers') . ' Km' 
                                                                                                                                                                                                    ?><?= $value->jarak . ' Km' ?></small>
                        <p style="margin: 0px; font-size: 11px;">Alamat: <?= $value->alamat_jalan ?>, Kec. <?= $value->nama_kecamatan ?> - <?= $value->nama_kabupaten ?> (<?= $value->nama_provinsi ?>)</p>
                    </div>
                    <div class="col-auto">
                        <button onclick="aksiDaftar('<?= $value->id ?>', '<?= $value->nama ?>')" type="button" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp; Daftar</button>
                    </div>
                </div>
            </li>
<?php
        }
    }
} ?>