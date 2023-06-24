<div class="row">
    <div class="col-md-12 mb-4">
        <h4>Sekolah Pilihan 1 (Pertama) :</h4>
        <input type="hidden" id="_sekolah_pilihan_pertama" name="_sekolah_pilihan_pertama" />
        <ul>
            <?php if (isset($result)) { ?>
                <?php if (count($result) > 0) { ?>
                    <?php foreach ($result as $key => $v) { ?>
                        <li style="list-style: none;">
                            <div class="custom-control custom-radio mb-4">
                                <input name="_pilihan_pertama" class="custom-control-input" value="<?= $v->id ?>" id="_pilihan_pertama_<?= $key ?>" type="radio">
                                <label class="custom-control-label" for="_pilihan_pertama_<?= $key ?>">
                                    <small style="font-size: 0.9375rem;">
                                        <?= $v->nama ?>
                                    </small>
                                    NPSN: <?= $v->npsn ?> &nbsp; &nbsp;<?= ((int)$v->status_sekolah == 1) ? '<span class="badge badge-success" style="padding: 2px;">Negeri</span>' : '<span class="badge badge-info" style="padding: 2px;">Swasta</span>' ?> &nbsp;&nbsp;Jarak : <?= getJarak2Koordinat($v->latitude, $v->longitude, $usernya->latitude, $usernya->longitude, 'kilometers') . ' Km' ?><br />
                                    Kec. <?= $v->nama_kecamatan ?> - <?= $v->nama_kabupaten ?>
                                </label>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li style="list-style: none;">
                        <p style="padding: 8px;">Tidak ada data sekolah dalam zonasi anda.</p>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li style="list-style: none;">
                    <p style="padding: 8px;">Tidak ada data sekolah dalam zonasi anda.</p>
                </li>
            <?php } ?>
        </ul>
    </div>
    <hr />
    <div class="col-md-12 mb-4">
        <h4>Sekolah Pilihan 2 (Kedua) :</h4>
        <input type="hidden" id="_sekolah_pilihan_kedua" name="_sekolah_pilihan_kedua" />
        <ul>
            <?php if (isset($result)) { ?>
                <?php if (count($result) > 0) { ?>
                    <?php foreach ($result as $key => $v) { ?>
                        <li style="list-style: none;">
                            <div class="custom-control custom-radio mb-4">
                                <input name="_pilihan_kedua" class="custom-control-input" value="<?= $v->id ?>" id="_pilihan_kedua_<?= $key ?>" type="radio">
                                <label class="custom-control-label" for="_pilihan_kedua_<?= $key ?>">
                                    <small style="font-size: 0.9375rem;">
                                        <?= $v->nama ?>
                                    </small>
                                    NPSN: <?= $v->npsn ?> &nbsp; &nbsp;<?= ((int)$v->status_sekolah == 1) ? '<span class="badge badge-success" style="padding: 2px;">Negeri</span>' : '<span class="badge badge-info" style="padding: 2px;">Swasta</span>' ?> &nbsp;&nbsp;Jarak : <?= getJarak2Koordinat($v->latitude, $v->longitude, $usernya->latitude, $usernya->longitude, 'kilometers') . ' Km' ?><br />
                                    Kec. <?= $v->nama_kecamatan ?> - <?= $v->nama_kabupaten ?>
                                </label>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li style="list-style: none;">
                        <p style="padding: 8px;">Tidak ada data sekolah dalam zonasi anda.</p>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li style="list-style: none;">
                    <p style="padding: 8px;">Tidak ada data sekolah dalam zonasi anda.</p>
                </li>
            <?php } ?>
        </ul>
    </div>
    <hr />
    <div class="col-md-12 mb-4">
        <h4>Sekolah Pilihan 3 (Ketiga) :</h4>
        <input type="hidden" id="_sekolah_pilihan_ketiga" name="_sekolah_pilihan_ketiga" />
        <ul>
            <?php if (isset($result)) { ?>
                <?php if (count($result) > 0) { ?>
                    <?php foreach ($result as $key => $v) { ?>
                        <li style="list-style: none;">
                            <div class="custom-control custom-radio mb-4">
                                <input name="_pilihan_ketiga" class="custom-control-input" value="<?= $v->id ?>" id="_pilihan_ketiga_<?= $key ?>" type="radio">
                                <label class="custom-control-label" for="_pilihan_ketiga_<?= $key ?>">
                                    <small style="font-size: 0.9375rem;">
                                        <?= $v->nama ?>
                                    </small>
                                    NPSN: <?= $v->npsn ?> &nbsp; &nbsp;<?= ((int)$v->status_sekolah == 1) ? '<span class="badge badge-success" style="padding: 2px;">Negeri</span>' : '<span class="badge badge-info" style="padding: 2px;">Swasta</span>' ?> &nbsp;&nbsp;Jarak : <?= getJarak2Koordinat($v->latitude, $v->longitude, $usernya->latitude, $usernya->longitude, 'kilometers') . ' Km' ?><br />
                                    Kec. <?= $v->nama_kecamatan ?> - <?= $v->nama_kabupaten ?>
                                </label>
                            </div>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li style="list-style: none;">
                        <p style="padding: 8px;">Tidak ada data sekolah dalam zonasi anda.</p>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li style="list-style: none;">
                    <p style="padding: 8px;">Tidak ada data sekolah dalam zonasi anda.</p>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>