<?php if (isset($result)) {
    if (count($result) > 0) {
        foreach ($result as $key => $value) { ?>
            <li class="list-group-item px-0">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a href="javascript:;" class="avatar" style="display:flex; background-color: transparent;min-width: 100px; max-width: 100px;">
                            <img style="min-width: 100px; max-width: 100px;" alt="Image placeholder" src="<?= ($value->profile_picture == null || $value->profile_picture == "") ? base_url('new-assets/placeholder.png') : base_url('uploads/peserta/user') . '/' . $value->profile_picture ?>">
                        </a>
                    </div>
                    <div class="col ml--2">
                        <h4 class="mb-0">
                            <a href="javascript:;">
                                <?= $value->fullname ?>
                            </a>
                        </h4>
                        <?php if($value->latitude == null || $value->latitude == '' || $value->latitude == 'null' || $value->latitude == 'NULL') {
                            $latitude = '-0.0';
                            $longitude = '0.0';
                        } else {
                            $latitude = $value->latitude;
                            $longitude = $value->longitude;
                        }
                        ?>
                        <small>NISN: <?= $value->nisn ?></small><br>
                        <small>No. Pendaftaran : &nbsp;<b><?= $value->kode_pendaftaran ?></b></small><br>
                        <span class="badge badge-success">AFIRMASI</span> &nbsp;&nbsp;<small>Jarak : <?= getJarak2Koordinat($latitude, $longitude, $value->latitude_sekolah_tujuan, $value->longitude_sekolah_tujuan, 'kilometers') . ' Km' ?></small>
                        <p style="margin: 0px; font-size: 11px;">Alamat: <?= $value->alamat ?>, Kec. <?= $value->nama_kecamatan ?> - <?= $value->nama_kabupaten ?> (<?= $value->nama_provinsi ?>)</p>
                        <p style="margin: 0px; font-size: 12px;">Asal Sekolah: <b><?= $value->nama_sekolah_asal ?> (NPSN: <?= ($value->npsn_sekolah_asal == '10000001') ? '-' : $value->npsn_sekolah_asal ?>)</b></p>
                    </div>
                    <div class="col-auto">
                        <button onclick="verifikasi('<?= $value->id_pendaftaran ?>')" type="button" class="btn btn-sm btn-success"><i class="ni ni-bullet-list-67"></i>&nbsp;&nbsp; Verifikasi</button>
                    </div>
                </div>
            </li>
<?php
        }
    }
} ?>