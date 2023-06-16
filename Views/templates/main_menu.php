<?php $uri = current_url(true); ?>
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header  d-flex  align-items-center">
            <a class="navbar-brand" href="#">
                <h2>PPDB LAMPUNG TIMUR</h2>
            </a>
            <div class=" ml-auto ">
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <?php if ((int)$user->role_user == 1) : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin" && $uri->getSegment(3) == "home") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/superadmin/home'); ?>" role="button" aria-expanded="true">
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Beranda</span>
                            </a>
                        </li>
                        <hr class="my-2">
                        <h6 class="navbar-heading pl-4 text-muted">
                            <span class="docs-normal">Master Data</span>
                        </h6>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi") ? '' : ' collapsed' ?>" href="#navbar-masterdata-referensi" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi") ? 'true' : 'false' ?>" aria-controls="navbar-masterdata-referensi">
                                <i class="ni ni-folder-17" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi") ? ' style="color: #00BCD4 !important"' : '' ?>>Referensi</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi") ? ' show' : '' ?>" id="navbar-masterdata-referensi">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi"  && $uri->getSegment(5) == "provinsi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/masterdata/referensi/provinsi') ?>">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal"> Provinsi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi"  && $uri->getSegment(5) == "kabupaten") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/masterdata/referensi/kabupaten') ?>">
                                            <span class="sidenav-mini-icon"> K </span>
                                            <span class="sidenav-normal"> Kabupaten </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi"  && $uri->getSegment(5) == "kecamatan") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/masterdata/referensi/kecamatan') ?>">
                                            <span class="sidenav-mini-icon"> K </span>
                                            <span class="sidenav-normal"> Kecamatan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi"  && $uri->getSegment(5) == "kelurahan") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/masterdata/referensi/kelurahan') ?>">
                                            <span class="sidenav-mini-icon"> K </span>
                                            <span class="sidenav-normal"> Kelurahan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi"  && $uri->getSegment(5) == "jenispendidikan") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/masterdata/referensi/jenispendidikan') ?>">
                                            <span class="sidenav-mini-icon"> J </span>
                                            <span class="sidenav-normal"> Jenjang </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "referensi"  && $uri->getSegment(5) == "sekolah") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/masterdata/referensi/sekolah') ?>">
                                            <span class="sidenav-mini-icon"> S </span>
                                            <span class="sidenav-normal"> Sekolah </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "role") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/superadmin/masterdata/role') ?>">
                                <i class="ni ni-atom"></i>
                                <span class="nav-link-text">Role</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "setting") ? '' : ' collapsed' ?>" href="#navbar-masterdata-setting" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "setting") ? 'true' : 'false' ?>" aria-controls="navbar-usulan-tpg">
                                <i class="ni ni-settings" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "setting") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "setting") ? ' style="color: #00BCD4 !important"' : '' ?>>Setting</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "setting") ? ' show' : '' ?>" id="navbar-masterdata-setting">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "setting"  && $uri->getSegment(4) == "roleaccess") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/setting/roleaccess') ?>">
                                            <span class="sidenav-mini-icon"> R </span>
                                            <span class="sidenav-normal"> Role Akses </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "setting"  && $uri->getSegment(4) == "sptjm") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/setting/sptjm') ?>">
                                            <span class="sidenav-mini-icon"> S </span>
                                            <span class="sidenav-normal"> SPTJM </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(3) == "pengguna") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/superadmin/masterdata/pengguna') ?>">
                                <i class="ni ni-single-02"></i>
                                <span class="nav-link-text">Pengguna</span>
                            </a>
                        </li>

                        <hr class="my-2">
                        <h6 class="navbar-heading pl-4 text-muted">
                            <span class="docs-normal">LAYANAN</span>
                        </h6>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan") ? '' : ' collapsed' ?>" href="#navbar-layanan" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan") ? 'true' : 'false' ?>" aria-controls="navbar-layanan">
                                <i class="ni ni-diamond" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan") ? ' style="color: #00BCD4 !important"' : '' ?>>Layanan Anda</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan") ? ' show' : '' ?>" id="navbar-layanan">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan"  && $uri->getSegment(4) == "ppdb") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/layanan/ppdb') ?>">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal"> PPDB </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan"  && $uri->getSegment(4) == "domain") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/layanan/domain') ?>">
                                            <span class="sidenav-mini-icon"> D </span>
                                            <span class="sidenav-normal"> Domain </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan"  && $uri->getSegment(4) == "hosting") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/layanan/hosting') ?>">
                                            <span class="sidenav-mini-icon"> H </span>
                                            <span class="sidenav-normal"> Hosting </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "layanan"  && $uri->getSegment(4) == "aplikasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/layanan/aplikasi') ?>">
                                            <span class="sidenav-mini-icon"> A </span>
                                            <span class="sidenav-normal"> Aplikasi </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <hr class="my-2">
                        <h6 class="navbar-heading pl-4 text-muted">
                            <span class="docs-normal">SPJ</span>
                        </h6>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? '' : ' collapsed' ?>" href="#navbar-spj-tpg" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? 'true' : 'false' ?>" aria-controls="navbar-spj-tpg">
                                <i class="ni ni-tag" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? ' style="color: #00BCD4 !important"' : '' ?>>TPG</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? ' show' : '' ?>" id="navbar-spj-tpg">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "antrian") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/spj/tpg/antrian') ?>">
                                            <span class="sidenav-mini-icon"> A </span>
                                            <span class="sidenav-normal"> Antrian </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "belum") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/spj/tpg/belum') ?>">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal"> Belum Upload </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "disetujui") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/spj/tpg/disetujui') ?>">
                                            <span class="sidenav-mini-icon"> LV </span>
                                            <span class="sidenav-normal"> Lolos Verifikasi </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? '' : ' collapsed' ?>" href="#navbar-spj-tamsil" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? 'true' : 'false' ?>" aria-controls="navbar-spj-tamsil">
                                <i class="ni ni-bag-17" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? ' style="color: #00BCD4 !important"' : '' ?>>TAMSIL</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? ' show' : '' ?>" id="navbar-spj-tamsil">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "antrian") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/spj/tamsil/antrian') ?>">
                                            <span class="sidenav-mini-icon"> A </span>
                                            <span class="sidenav-normal"> Antrian </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "belum") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/spj/tamsil/belum') ?>">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal"> Belum Upload </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "disetujui") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/spj/tamsil/disetujui') ?>">
                                            <span class="sidenav-mini-icon"> S </span>
                                            <span class="sidenav-normal"> Disetujui </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <hr class="my-2">
                        <h6 class="navbar-heading pl-4 text-muted">
                            <span class="docs-normal">UPLOAD</span>
                        </h6>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tpg") ? '' : ' collapsed' ?>" href="#navbar-upload-tpg" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tpg") ? 'true' : 'false' ?>" aria-controls="navbar-upload-tpg">
                                <i class="ni ni-ungroup" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tpg") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tpg") ? ' style="color: #00BCD4 !important"' : '' ?>>TPG</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tpg") ? ' show' : '' ?>" id="navbar-upload-tpg">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "matching") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/upload/tpg/matching') ?>">
                                            <span class="sidenav-mini-icon"> M </span>
                                            <span class="sidenav-normal"> Matching Simtun </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "terbitsk") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/upload/tpg/terbitsk') ?>">
                                            <span class="sidenav-mini-icon"> T </span>
                                            <span class="sidenav-normal"> Terbit SK </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "prosestransfer") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/upload/tpg/prosestransfer') ?>">
                                            <span class="sidenav-mini-icon"> T </span>
                                            <span class="sidenav-normal"> Proses Transfer </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tamsil") ? '' : ' collapsed' ?>" href="#navbar-upload-tamsil" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tamsil") ? 'true' : 'false' ?>" aria-controls="navbar-upload-tamsil">
                                <i class="ni ni-bag-17" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tamsil") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tamsil") ? ' style="color: #00BCD4 !important"' : '' ?>>TAMSIL</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tamsil") ? ' show' : '' ?>" id="navbar-upload-tamsil">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "upload"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "prosestransfer") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/superadmin/upload/tamsil/prosestransfer') ?>">
                                            <span class="sidenav-mini-icon"> T </span>
                                            <span class="sidenav-normal"> Proses Transfer </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <hr class="my-2">
                        <h6 class="navbar-heading pl-4 text-muted">
                            <span class="docs-normal">INFORMASI</span>
                        </h6>
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "superadmin"  && $uri->getSegment(3) == "informasi"  && $uri->getSegment(3) == "popup") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/superadmin/informasi/popup') ?>">
                                <i class="ni ni-single-02"></i>
                                <span class="nav-link-text">Informasi Popup</span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
                <?php if ((int)$user->role_user == 2) : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin" && $uri->getSegment(3) == "home") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/admin/home'); ?>" role="button" aria-expanded="true">
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Beranda</span>
                            </a>
                        </li>
                        <hr class="my-2">
                        <h6 class="navbar-heading pl-4 text-muted">
                            <span class="docs-normal">Master Data</span>
                        </h6>
                        <?php if (isset($hakAksesMenu)) { ?>
                            <?php if ((int)$hakAksesMenu->sekolah == 1) { ?>
                                <li class="nav-item">
                                    <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "sekolah") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/admin/masterdata/sekolah') ?>">
                                        <i class="ni ni-building"></i>
                                        <span class="nav-link-text">Sekolah</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ((int)$hakAksesMenu->ptk == 1) { ?>
                                <li class="nav-item">
                                    <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "ptk") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/admin/masterdata/ptk') ?>">
                                        <i class="ni ni-badge"></i>
                                        <span class="nav-link-text">PTK</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ((int)$hakAksesMenu->triwulan == 1) { ?>
                                <li class="nav-item">
                                    <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "tahuntw") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/admin/masterdata/tahuntw') ?>">
                                        <i class="ni ni-support-16"></i>
                                        <span class="nav-link-text">Tahun Triwulan</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ((int)$hakAksesMenu->gaji == 1) { ?>
                                <li class="nav-item">
                                    <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "gaji") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/admin/masterdata/gaji') ?>">
                                        <i class="ni ni-money-coins"></i>
                                        <span class="nav-link-text">Referensi Gaji</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ((int)$hakAksesMenu->pengguna == 1) { ?>
                                <li class="nav-item">
                                    <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "masterdata"  && $uri->getSegment(4) == "pengguna") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/admin/masterdata/pengguna') ?>">
                                        <i class="ni ni-circle-08"></i>
                                        <span class="nav-link-text">Pengguna</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ((int)$hakAksesMenu->usulan == 1) { ?>
                                <hr class="my-2">
                                <h6 class="navbar-heading pl-4 text-muted">
                                    <span class="docs-normal">USULAN</span>
                                </h6>
                                <?php if ((int)$hakAksesMenu->usulan_tpg == 1) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg") ? '' : ' collapsed' ?>" href="#navbar-usulan-tpg" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg") ? 'true' : 'false' ?>" aria-controls="navbar-usulan-tpg">
                                            <i class="ni ni-tag" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                            <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg") ? ' style="color: #00BCD4 !important"' : '' ?>>TPG</span>
                                        </a>
                                        <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg") ? ' show' : '' ?>" id="navbar-usulan-tpg">
                                            <ul class="nav nav-sm flex-column">
                                                <?php if ((int)$hakAksesMenu->usulan_tpg_antrian == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "antrian") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tpg/antrian') ?>">
                                                            <span class="sidenav-mini-icon"> A </span>
                                                            <span class="sidenav-normal"> Antrian </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->usulan_tpg_ditolak == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "ditolak") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tpg/ditolak') ?>">
                                                            <span class="sidenav-mini-icon"> T </span>
                                                            <span class="sidenav-normal"> Ditolak </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->usulan_tpg_disetujui == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "disetujui") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tpg/disetujui') ?>">
                                                            <span class="sidenav-mini-icon"> LV </span>
                                                            <span class="sidenav-normal"> Lolos Verifikasi </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->usulan_tpg_siapsk == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "siapsk") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tpg/siapsk') ?>">
                                                            <span class="sidenav-mini-icon"> SK </span>
                                                            <span class="sidenav-normal"> Siap SK </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->usulan_tpg_terbitsk == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "terbitsk") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tpg/terbitsk') ?>">
                                                            <span class="sidenav-mini-icon"> ST </span>
                                                            <span class="sidenav-normal"> SK Terbit </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->usulan_tpg_prosestransfer == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "prosestransfer") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tpg/prosestransfer') ?>">
                                                            <span class="sidenav-mini-icon"> PT </span>
                                                            <span class="sidenav-normal"> Proses Transfer </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if ((int)$hakAksesMenu->usulan_tamsil == 1) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil") ? '' : ' collapsed' ?>" href="#navbar-usulan-tamsil" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil") ? 'true' : 'false' ?>" aria-controls="navbar-usulan-tamsil">
                                            <i class="ni ni-bag-17" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                            <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil") ? ' style="color: #00BCD4 !important"' : '' ?>>TAMSIL</span>
                                        </a>
                                        <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil") ? ' show' : '' ?>" id="navbar-usulan-tamsil">
                                            <ul class="nav nav-sm flex-column">
                                                <?php if ((int)$hakAksesMenu->usulan_tamsil_antrian == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "antrian") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tamsil/antrian') ?>">
                                                            <span class="sidenav-mini-icon"> A </span>
                                                            <span class="sidenav-normal"> Antrian </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->usulan_tamsil_ditolak == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "ditolak") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tamsil/ditolak') ?>">
                                                            <span class="sidenav-mini-icon"> T </span>
                                                            <span class="sidenav-normal"> Ditolak </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->usulan_tamsil_disetujui == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "disetujui") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tamsil/disetujui') ?>">
                                                            <span class="sidenav-mini-icon"> LV </span>
                                                            <span class="sidenav-normal"> Lolos Verifikasi </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->usulan_tamsil_prosestransfer == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "usulan"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "prosestransfer") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/usulan/tamsil/prosestransfer') ?>">
                                                            <span class="sidenav-mini-icon"> PT </span>
                                                            <span class="sidenav-normal"> Proses Transfer </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            <?php if ((int)$hakAksesMenu->spj == 1) { ?>
                                <hr class="my-2">
                                <h6 class="navbar-heading pl-4 text-muted">
                                    <span class="docs-normal">SPJ LAPORAN</span>
                                </h6>
                                <?php if ((int)$hakAksesMenu->spj_tpg == 1) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? '' : ' collapsed' ?>" href="#navbar-spj-tpg" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? 'true' : 'false' ?>" aria-controls="navbar-spj-tpg">
                                            <i class="ni ni-tag" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                            <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? ' style="color: #00BCD4 !important"' : '' ?>>TPG</span>
                                        </a>
                                        <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg") ? ' show' : '' ?>" id="navbar-spj-tpg">
                                            <ul class="nav nav-sm flex-column">
                                                <?php if ((int)$hakAksesMenu->spj_tpg_antrian == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "antrian") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/spj/tpg/antrian') ?>">
                                                            <span class="sidenav-mini-icon"> A </span>
                                                            <span class="sidenav-normal"> Antrian </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->spj_tpg_belum == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "belum") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/spj/tpg/belum') ?>">
                                                            <span class="sidenav-mini-icon"> T </span>
                                                            <span class="sidenav-normal"> Belum Upload </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->spj_tpg_disetujui == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tpg"  && $uri->getSegment(5) == "disetujui") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/spj/tpg/disetujui') ?>">
                                                            <span class="sidenav-mini-icon"> LV </span>
                                                            <span class="sidenav-normal"> Lolos Verifikasi </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if ((int)$hakAksesMenu->spj_tamsil == 1) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? '' : ' collapsed' ?>" href="#navbar-spj-tamsil" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? 'true' : 'false' ?>" aria-controls="navbar-spj-tamsil">
                                            <i class="ni ni-bag-17" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                            <span class="nav-link-text" <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? ' style="color: #00BCD4 !important"' : '' ?>>TAMSIL</span>
                                        </a>
                                        <div class="collapse<?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil") ? ' show' : '' ?>" id="navbar-spj-tamsil">
                                            <ul class="nav nav-sm flex-column">
                                                <?php if ((int)$hakAksesMenu->spj_tamsil_antrian == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "antrian") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/spj/tamsil/antrian') ?>">
                                                            <span class="sidenav-mini-icon"> A </span>
                                                            <span class="sidenav-normal"> Antrian </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->spj_tamsil_belum == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "belum") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/spj/tamsil/belum') ?>">
                                                            <span class="sidenav-mini-icon"> T </span>
                                                            <span class="sidenav-normal"> Belum Upload </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ((int)$hakAksesMenu->spj_tamsil_disetujui == 1) { ?>
                                                    <li class="nav-item">
                                                        <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "spj"  && $uri->getSegment(4) == "tamsil"  && $uri->getSegment(5) == "disetujui") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('v1/admin/spj/tamsil/disetujui') ?>">
                                                            <span class="sidenav-mini-icon"> LV </span>
                                                            <span class="sidenav-normal"> Lolos Verifikasi </span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            <?php if ((int)$hakAksesMenu->informasi == 1) { ?>
                                <hr class="my-2">
                                <h6 class="navbar-heading pl-4 text-muted">
                                    <span class="docs-normal">INFORMASI</span>
                                </h6>
                                <li class="nav-item">
                                    <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "admin"  && $uri->getSegment(3) == "informasi"  && $uri->getSegment(3) == "popup") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/admin/informasi/popup') ?>">
                                        <i class="ni ni-single-02"></i>
                                        <span class="nav-link-text">Informasi Popup</span>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                <?php endif; ?>
                <?php if ((int)$user->role_user == 3) : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "home") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('dinas/home'); ?>" role="button" aria-expanded="true">
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Beranda</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting") ? '' : ' collapsed' ?>" href="#navbar-setting" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting") ? 'true' : 'false' ?>" aria-controls="navbar-setting">
                                <i class="ni ni-settings-gear-65" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting") ? ' style="color: #00BCD4 !important"' : '' ?>>Setting</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting") ? ' show' : '' ?>" id="navbar-setting">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "penjadwalan") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/setting/penjadwalan') ?>">
                                            <span class="sidenav-mini-icon"> J </span>
                                            <span class="sidenav-normal"> Penjadwalan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "profilsekolah") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/setting/profilsekolah') ?>">
                                            <span class="sidenav-mini-icon"> PS </span>
                                            <span class="sidenav-normal"> Profil Sekolah </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "kuota") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/setting/kuota') ?>">
                                            <span class="sidenav-mini-icon"> K </span>
                                            <span class="sidenav-normal"> Kuota </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "zonasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/setting/zonasi') ?>">
                                            <span class="sidenav-mini-icon"> Z </span>
                                            <span class="sidenav-normal"> Zonasi </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata") ? '' : ' collapsed' ?>" href="#navbar-masterdata" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata") ? 'true' : 'false' ?>" aria-controls="navbar-masterdata">
                                <i class="ni ni-briefcase-24" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata") ? ' style="color: #00BCD4 !important"' : '' ?>>Master Data</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata") ? ' show' : '' ?>" id="navbar-masterdata">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata"  && $uri->getSegment(3) == "pengguna") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/masterdata/pengguna') ?>">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal"> Pengguna </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata"  && $uri->getSegment(3) == "kelurahan") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/masterdata/kelurahan') ?>">
                                            <span class="sidenav-mini-icon"> K </span>
                                            <span class="sidenav-normal"> Kelurahan </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata"  && $uri->getSegment(3) == "sekolah") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/masterdata/sekolah') ?>">
                                            <span class="sidenav-mini-icon"> S </span>
                                            <span class="sidenav-normal"> Sekolah </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "masterdata"  && $uri->getSegment(3) == "pemetaanzonasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/masterdata/pemetaanzonasi') ?>">
                                            <span class="sidenav-mini-icon"> PZ </span>
                                            <span class="sidenav-normal"> Pemetaan Zonasi </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "info") ? '' : ' collapsed' ?>" href="#navbar-info" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "info") ? 'true' : 'false' ?>" aria-controls="navbar-info">
                                <i class="ni ni-notification-70" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "info") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "info") ? ' style="color: #00BCD4 !important"' : '' ?>>Informasi</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "info") ? ' show' : '' ?>" id="navbar-info">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "info"  && $uri->getSegment(3) == "pengumuman") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/info/pengumuman') ?>">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal"> Pengumuman </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "rekap") ? '' : ' collapsed' ?>" href="#navbar-rekap" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "rekap") ? 'true' : 'false' ?>" aria-controls="navbar-rekap">
                                <i class="ni ni-books" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "rekap") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "rekap") ? ' style="color: #00BCD4 !important"' : '' ?>>Rekapitulasi</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "rekap") ? ' show' : '' ?>" id="navbar-rekap">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "rekap"  && $uri->getSegment(3) == "antrian") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/rekap/antrian') ?>">
                                            <span class="sidenav-mini-icon"> An </span>
                                            <i class="ni ni-atom"></i>
                                            <span class="sidenav-normal"> Antrian </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "rekap"  && $uri->getSegment(3) == "diverifikasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/rekap/diverifikasi') ?>">
                                            <span class="sidenav-mini-icon"> DV </span>
                                            <i class="ni ni-app"></i>
                                            <span class="sidenav-normal"> Diverifikasi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "rekap"  && $uri->getSegment(3) == "ditolak") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/rekap/ditolak') ?>">
                                            <span class="sidenav-mini-icon"> DT </span>
                                            <i class="">X</i>
                                            <span class="sidenav-normal"> Ditolak </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "analisis"  && $uri->getSegment(3) == "proses") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/analisis/proses') ?>">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <!--<i class="">X</i>-->
                                            <span class="sidenav-normal"> Proses </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan") ? '' : ' collapsed' ?>" href="#navbar-pelimpahan" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan") ? 'true' : 'false' ?>" aria-controls="navbar-pelimpahan">
                                <i class="ni ni-vector" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan") ? ' style="color: #00BCD4 !important"' : '' ?>>Pelimpahan</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan") ? ' show' : '' ?>" id="navbar-pelimpahan">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan"  && $uri->getSegment(3) == "sd") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/pelimpahan/sd') ?>">
                                            <span class="sidenav-mini-icon"> SD </span>
                                            <!--<i class="ni ni-app"></i>-->
                                            <span class="sidenav-normal"> SD </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan"  && $uri->getSegment(3) == "smp") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/pelimpahan/smp') ?>">
                                            <span class="sidenav-mini-icon"> SP </span>
                                            <!--<i class="ni ni-app"></i>-->
                                            <span class="sidenav-normal"> SMP </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan"  && $uri->getSegment(3) == "rekap") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/pelimpahan/rekap') ?>">
                                            <span class="sidenav-mini-icon"> RK </span>
                                            <!--<i class="ni ni-app"></i>-->
                                            <span class="sidenav-normal"> REKAP </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "analisis") ? '' : ' collapsed' ?>" href="#navbar-analisis" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "analisis") ? 'true' : 'false' ?>" aria-controls="navbar-analisis">
                                <i class="ni ni-vector" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "analisis") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "analisis") ? ' style="color: #00BCD4 !important"' : '' ?>>Analisis</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "analisis") ? ' show' : '' ?>" id="navbar-analisis">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "pelimpahan"  && $uri->getSegment(3) == "sd") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/analisis/proses') ?>">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <!--<i class="ni ni-app"></i>-->
                                            <span class="sidenav-normal"> Rekap </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "riwayat") ? '' : ' collapsed' ?>" href="#navbar-riwayat" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "riwayat") ? 'true' : 'false' ?>" aria-controls="navbar-riwayat">
                                <i class="ni ni-ui-04" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "riwayat") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "riwayat") ? ' style="color: #00BCD4 !important"' : '' ?>>Riwayat</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "riwayat") ? ' show' : '' ?>" id="navbar-riwayat">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "dinas" && $uri->getSegment(2) == "riwayat"  && $uri->getSegment(3) == "aktifitas") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('dinas/riwayat/aktifitas') ?>">
                                            <span class="sidenav-mini-icon"> RA </span>
                                            <i class="ni ni-app"></i>
                                            <span class="sidenav-normal"> Riwayat Aktifitas </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                <?php endif; ?>
                <?php if ((int)$user->role_user == 4) : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "home") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('sekolah/home'); ?>" role="button" aria-expanded="true">
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Beranda</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting") ? '' : ' collapsed' ?>" href="#navbar-setting" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting") ? 'true' : 'false' ?>" aria-controls="navbar-setting">
                                <i class="ni ni-settings-gear-65" <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting") ? ' style="color: #00BCD4 !important"' : '' ?>>Setting</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting") ? ' show' : '' ?>" id="navbar-setting">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "profilsekolah") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/setting/profilsekolah') ?>">
                                            <span class="sidenav-mini-icon"> PS </span>
                                            <span class="sidenav-normal"> Profil Sekolah </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "panitia") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/setting/panitia') ?>">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal"> Panitia </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "kuota") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/setting/kuota') ?>">
                                            <span class="sidenav-mini-icon"> K </span>
                                            <span class="sidenav-normal"> Kuota </span>
                                        </a>
                                    </li>
                                    <?php if ((int)$user->statusSekolah === 1) { ?>
                                        <!-- <li class="nav-item">
                                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "zonasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/setting/zonasi') ?>">
                                                <span class="sidenav-mini-icon"> Z </span>
                                                <span class="sidenav-normal"> Zonasi </span>
                                            </a>
                                        </li> -->
                                    <?php } ?>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "setting"  && $uri->getSegment(3) == "barcode") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/setting/barcode') ?>">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal"> Barcode </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pedaftaran") ? '' : ' collapsed' ?>" href="#navbar-pendaftaran" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran") ? 'true' : 'false' ?>" aria-controls="navbar-pendaftaran">
                                <i class="ni ni-credit-card" <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran") ? ' style="color: #00BCD4 !important"' : '' ?>>Pendaftaran</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran") ? ' show' : '' ?>" id="navbar-pendaftaran">
                                <ul class="nav nav-sm flex-column">
                                    <?php if ((int)$user->statusSekolah === 1) { ?>
                                        <li class="nav-item">
                                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "zonasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/pendaftaran/zonasi') ?>">
                                                <span class="sidenav-mini-icon"> JZ </span>
                                                <i class="fas fa-map-marked-alt"></i>
                                                <span class="sidenav-normal"> Jalur Zonasi </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "afirmasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/pendaftaran/afirmasi') ?>">
                                                <span class="sidenav-mini-icon"> JA </span>
                                                <i class="ni ni-app"></i>
                                                <span class="sidenav-normal"> Jalur Afirmasi </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "prestasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/pendaftaran/prestasi') ?>">
                                                <span class="sidenav-mini-icon"> JP </span>
                                                <i class="ni ni-trophy"></i>
                                                <span class="sidenav-normal"> Jalur Prestasi </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "mutasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/pendaftaran/mutasi') ?>">
                                                <span class="sidenav-mini-icon"> JM </span>
                                                <i class="ni ni-vector"></i>
                                                <span class="sidenav-normal"> Jalur Mutasi </span>
                                            </a>
                                        </li>
                                    <?php } else { ?>
                                        <li class="nav-item">
                                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "swasta") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/pendaftaran/swasta') ?>">
                                                <span class="sidenav-mini-icon"> SS </span>
                                                <i class="ni ni-shop"></i>
                                                <span class="sidenav-normal"> Sekolah Swasta </span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "rekap") ? '' : ' collapsed' ?>" href="#navbar-rekap" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "rekap") ? 'true' : 'false' ?>" aria-controls="navbar-rekap">
                                <i class="ni ni-books" <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "rekap") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "rekap") ? ' style="color: #00BCD4 !important"' : '' ?>>Rekapitulasi</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "rekap") ? ' show' : '' ?>" id="navbar-rekap">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "rekap"  && $uri->getSegment(3) == "diverifikasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/rekap/diverifikasi') ?>">
                                            <span class="sidenav-mini-icon"> DV </span>
                                            <i class="ni ni-app"></i>
                                            <span class="sidenav-normal"> Diverifikasi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "rekap"  && $uri->getSegment(3) == "ditolak") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/rekap/ditolak') ?>">
                                            <span class="sidenav-mini-icon"> DT </span>
                                            <i class="">X</i>
                                            <span class="sidenav-normal"> Ditolak Verifikasi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "rekap"  && $uri->getSegment(3) == "rangking") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/rekap/rangking') ?>">
                                            <span class="sidenav-mini-icon"> RP </span>
                                            <i class="ni ni-check-bold"></i>
                                            <span class="sidenav-normal"> Ranking PPDB </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "pengumuman") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('sekolah/pengumuman'); ?>" role="button" aria-expanded="true">
                                <i class="ni ni-single-copy-04"></i>
                                <span class="nav-link-text">Pengumuman Peserta</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "konfirmasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('sekolah/konfirmasi'); ?>" role="button" aria-expanded="true">
                                <i class="ni ni-compass-04"></i>
                                <span class="nav-link-text">Konfirmasi Daftar Ulang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "riwayat") ? '' : ' collapsed' ?>" href="#navbar-riwayat" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "riwayat") ? 'true' : 'false' ?>" aria-controls="navbar-riwayat">
                                <i class="ni ni-ui-04" <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "riwayat") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "riwayat") ? ' style="color: #00BCD4 !important"' : '' ?>>Riwayat</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "riwayat") ? ' show' : '' ?>" id="navbar-riwayat">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "sekolah" && $uri->getSegment(2) == "riwayat"  && $uri->getSegment(3) == "aktifitas") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('sekolah/riwayat/aktifitas') ?>">
                                            <span class="sidenav-mini-icon"> RA </span>
                                            <i class="ni ni-app"></i>
                                            <span class="sidenav-normal"> Riwayat Aktifitas </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "v1" && $uri->getSegment(2) == "sekolah" && $uri->getSegment(3) == "courseforum") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('v1/sekolah/courseforum'); ?>" role="button" aria-expanded="true">
                                <i class="ni ni-paper-diploma"></i>
                                <span class="nav-link-text">Course dan Forum</span>
                            </a>
                        </li> -->
                    </ul>
                <?php endif; ?>
                <?php if ((int)$user->role_user == 6) : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "home") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('peserta/home'); ?>" role="button" aria-expanded="true">
                                <i class="fa fa-home text-primary"></i>
                                <span class="nav-link-text">Beranda</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a <?= (($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "user") || ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "user" && $uri->getSegment(3) == "profile")) ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('peserta/user'); ?>" role="button" aria-expanded="true">
                                <i class="ni ni-single-copy-04"></i>
                                <span class="nav-link-text">Data Individu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "upload") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"'; ?> href="<?= base_url('peserta/upload'); ?>" role="button" aria-expanded="true">
                                <i class="ni ni-cloud-upload-96"></i>
                                <span class="nav-link-text">Upload Berkas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran") ? '' : ' collapsed' ?>" href="#navbar-pendaftaran" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran") ? 'true' : 'false' ?>" aria-controls="navbar-pendaftaran">
                                <i class="ni ni-credit-card" <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran") ? ' style="color: #00BCD4 !important"' : '' ?>>Pendaftaran</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran") ? ' show' : '' ?>" id="navbar-pendaftaran">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "afirmasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('peserta/pendaftaran/afirmasi') ?>">
                                            <span class="sidenav-mini-icon"> JA </span>
                                            <i class="ni ni-app"></i>
                                            <span class="sidenav-normal"> Jalur Afirmasi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "zonasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('peserta/pendaftaran/zonasi') ?>">
                                            <span class="sidenav-mini-icon"> JZ </span>
                                            <i class="fas fa-map-marked-alt"></i>
                                            <span class="sidenav-normal"> Jalur Zonasi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "prestasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('peserta/pendaftaran/prestasi') ?>">
                                            <span class="sidenav-mini-icon"> JP </span>
                                            <i class="ni ni-trophy"></i>
                                            <span class="sidenav-normal"> Jalur Prestasi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "mutasi") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('peserta/pendaftaran/mutasi') ?>">
                                            <span class="sidenav-mini-icon"> JM </span>
                                            <i class="ni ni-vector"></i>
                                            <span class="sidenav-normal"> Jalur Mutasi </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "pendaftaran"  && $uri->getSegment(3) == "swasta") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('peserta/pendaftaran/swasta') ?>">
                                            <span class="sidenav-mini-icon"> SS </span>
                                            <i class="ni ni-shop"></i>
                                            <span class="sidenav-normal"> Sekolah Swasta </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "riwayat") ? '' : ' collapsed' ?>" href="#navbar-riwayat" data-toggle="collapse" role="button" aria-expanded="<?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "riwayat") ? 'true' : 'false' ?>" aria-controls="navbar-riwayat">
                                <i class="ni ni-ui-04" <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "riwayat") ? ' style="color: #00BCD4 !important"' : '' ?>></i>
                                <span class="nav-link-text" <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "riwayat") ? ' style="color: #00BCD4 !important"' : '' ?>>Riwayat</span>
                            </a>
                            <div class="collapse<?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "riwayat") ? ' show' : '' ?>" id="navbar-riwayat">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "riwayat"  && $uri->getSegment(3) == "pendaftaran") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('peserta/riwayat/pendaftaran') ?>">
                                            <span class="sidenav-mini-icon"> RP </span>
                                            <i class="ni ni-bullet-list-67"></i>
                                            <span class="sidenav-normal"> Riwayat Pendaftaran </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a <?= ($uri->getSegment(1) == "peserta" && $uri->getSegment(2) == "riwayat"  && $uri->getSegment(3) == "aktifitas") ? 'class="nav-link active" style="color: #00BCD4 !important"' : 'class="nav-link"' ?> href="<?= base_url('peserta/riwayat/aktifitas') ?>">
                                            <span class="sidenav-mini-icon"> RA </span>
                                            <i class="ni ni-app"></i>
                                            <span class="sidenav-normal"> Riwayat Aktifitas </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>