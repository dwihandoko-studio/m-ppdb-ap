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
                                <li class="breadcrumb-item active" aria-current="page">Ubah Profil</li>
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
                <?php if (isset($error)) { ?>
                    <?php if (isset($success)) { ?>
                        <div class="card">
                            <div class="card-body bg-gradient-success p-0" style="border-radius: 5px; color: #fff;">
                                <!-- <div class="alert alert-success alert-dismissible fade show" role="alert"> -->
                                <center style="padding: 20px;"><span class="alert-icon"><i class="ni ni-notification-70 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br><?= $success ?></span></button></center>
                                <br />
                                <br />

                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>LENGKAPI DATA PROFIL</h2>
                            </div>
                            <?php
                            $provinsi = "";
                            $kabupaten = "";
                            $kecamatan = "";
                            $kelurahan = "";
                            $dusun = "";
                            $alamat = "";
                            $dataDetail = null;
                            if (isset($user)) {
                                if (isset($details)) {
                                    $dataDetail = $details;
                                }
                                if (!(isset($user->provinsi)) || $user->provinsi == null || $user->provinsi == "") {
                                    if (isset($details)) {
                                        $provinsi = substr(trim($details->kode_wilayah), 0, 2) . '0000';
                                    }
                                } else {
                                    $provinsi = $user->provinsi;
                                }
                                if (!(isset($user->kabupaten)) || $user->kabupaten == null || $user->kabupaten == "") {
                                    if (isset($details)) {
                                        $kabupaten = substr(trim($details->kode_wilayah), 0, 4) . '00';
                                    }
                                } else {
                                    $kabupaten = $user->kabupaten;
                                }
                                if (!(isset($user->kecamatan)) || $user->kecamatan == null || $user->kecamatan == "") {
                                    if (isset($details)) {
                                        $kecamatan = substr(trim($details->kode_wilayah), 0, 6);
                                    }
                                } else {
                                    $kecamatan = $user->kecamatan;
                                }
                                if (!(isset($user->kelurahan)) || $user->kelurahan == null || $user->kelurahan == "") {
                                    if (isset($details)) {
                                        $kelurahan = substr(trim($details->kode_wilayah), 0, 8);
                                    }
                                } else {
                                    $kelurahan = $user->kelurahan;
                                }
                                if (!(isset($user->dusun)) || $user->dusun == null || $user->dusun == "") {
                                } else {
                                    $dusun = $user->dusun;
                                }
                                if (!(isset($user->alamat)) || $user->alamat == null || $user->alamat == "") {
                                    if (isset($details)) {
                                        $alamat = trim($details->alamat_jalan);
                                        // $alamat = $details->alamat_jalan;
                                    }
                                } else {
                                    $alamat = $user->alamat;
                                }
                            } ?>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <form>
                                        <h5 class="heading-small">Data Pribadi</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group _nama-block">
                                                    <label for="_nama" class="form-control-label">Nama Lengkap <span class="required" style="color: indigo;">* Wajib</span></label>
                                                    <input type="text" class="form-control" id="_nama" name="_nama" placeholder="Nama Lengkap . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->fullname) ? $user->fullname : '') : '' ?>" readonly>
                                                    <div class="help-block _nama"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _nisn-block">
                                                    <label for="_nisn" class="form-control-label">NISN</label>
                                                    <input type="text" class="form-control" id="_nisn" name="_nisn" placeholder="NISN . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->nisn) ? $user->nisn : '') : '' ?>" readonly>
                                                    <div class="help-block _nisn"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _nik-block">
                                                    <label for="_nik" class="form-control-label">NIK</label>
                                                    <input type="text" class="form-control" id="_nik" name="_nik" placeholder="NIK . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nik) ? $details->nik : '') : '' ?>" readonly>
                                                    <div class="help-block _nik"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _jenis_kelamin-block">
                                                    <label for="_jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                                                    <input type="text" class="form-control" id="_jenis_kelamin" name="_jenis_kelamin" placeholder="Jenis kelamin . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->jenis_kelamin) ? $details->jenis_kelamin : '') : '' ?>" readonly>
                                                    <div class="help-block _jenis_kelamin"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _tempat_lahir-block">
                                                    <label for="_tempat_lahir" class="form-control-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="_tempat_lahir" name="_tempat_lahir" placeholder="Tempat Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tempat_lahir) ? $details->tempat_lahir : '') : '' ?>" readonly>
                                                    <div class="help-block _tempat_lahir"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _tanggal_lahir-block">
                                                    <label for="_tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                                                    <input type="text" class="form-control" id="_tanggal_lahir" name="_tanggal_lahir" placeholder="Tanggal Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tanggal_lahir) ? $details->tanggal_lahir : '') : '' ?>" readonly>
                                                    <div class="help-block _tanggal_lahir"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _nama_ibu-block">
                                                    <label for="_nama_ibu" class="form-control-label">Nama Ibu Kandung</label>
                                                    <input type="text" class="form-control" id="_nama_ibu" name="_nama_ibu" placeholder="Nama ibu kandung . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nama_ibu_kandung) ? $details->nama_ibu_kandung : '') : '' ?>" readonly>
                                                    <div class="help-block _nama_ibu"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _email-block">
                                                    <label for="_email" class="form-control-label">Email</label>
                                                    <input type="email" class="form-control" id="_email" name="_email" placeholder="Email . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->email) ? $user->email : '') : '' ?>" readonly>
                                                    <div class="help-block _email"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _nohp-block">
                                                    <label for="_nohp" class="form-control-label">No Handphone</label>
                                                    <input type="phone" class="form-control" id="_nohp" name="_nohp" placeholder="08xxxxxxxx" onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->no_hp) ? $user->no_hp : '') : '' ?>" readonly>
                                                    <div class="help-block _nohp"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                        <h5 class="heading-small" style="margin-top: 20px;">Data Tempat Tinggal</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group _provinsi-block">
                                                    <label for="_provinsi" class="form-control-label">Provinsi</label>
                                                    <select class="form-control provinsi" name="_provinsi" id="_provinsi" data-toggle="select22" title="Simple select" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." disabled>

                                                        <?php if (isset($provinsis)) {
                                                            if (count($provinsis) > 0) {
                                                                echo "<option value=''>--Pilih Provinsi--</option>";
                                                                foreach ($provinsis as $key => $value) { ?>
                                                                    <option value="<?= $value->id ?>" <?= ($provinsi == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                        <?php }
                                                            } else {
                                                                echo "<option value='' selected>--Tidak ada data--</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='' selected>--Tidak ada data--</option>";
                                                        } ?>
                                                    </select>
                                                    <div class="help-block _provinsi"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _kabupaten-block">
                                                    <label for="_kabupaten" class="form-control-label">Kabupaten</label>
                                                    <select class="form-control kabupaten" name="_kabupaten" id="_kabupaten" data-toggle="select22" title="Simple select" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                                                        <?php if (isset($kabupatens)) {
                                                            if (count($kabupatens) > 0) {
                                                                echo "<option value=''>--Pilih Kabupaten--</option>";
                                                                foreach ($kabupatens as $key => $value) { ?>
                                                                    <option value="<?= $value->id ?>" <?= ($kabupaten == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                        <?php }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                        } ?>
                                                    </select>
                                                    <div class="help-block _kabupaten"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _kecamatan-block">
                                                    <label for="_kecamatan" class="form-control-label">Kecamatan</label>
                                                    <select class="form-control kecamatan" name="_kecamatan" id="_kecamatan" data-toggle="select22" title="Simple select" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                                                        <?php if (isset($kecamatans)) {
                                                            if (count($kecamatans) > 0) {
                                                                echo "<option value=''>--Pilih Kecamatan--</option>";
                                                                foreach ($kecamatans as $key => $value) { ?>
                                                                    <option value="<?= $value->id ?>" <?= ($kecamatan == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                        <?php }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                        } ?>
                                                    </select>
                                                    <div class="help-block _kecamatan"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _kelurahan-block">
                                                    <label for="_kelurahan" class="form-control-label">Kelurahan</label>
                                                    <select class="form-control kelurahan" name="_kelurahan" id="_kelurahan" data-toggle="select22" title="Simple select" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                                                        <?php if (isset($kelurahans)) {
                                                            if (count($kelurahans) > 0) {
                                                                echo "<option value=''>--Pilih Kelurahan--</option>";
                                                                foreach ($kelurahans as $key => $value) { ?>
                                                                    <option value="<?= $value->id ?>" <?= ($kelurahan == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                        <?php }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                        } ?>
                                                    </select>
                                                    <div class="help-block _kelurahan"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _dusun-block">
                                                    <label for="_dusun" class="form-control-label">Dusun</label>
                                                    <select class="form-control dusun" name="_dusun" id="_dusun" data-toggle="select22" title="Simple select" onChange="onChangeDusun(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                        <?php if (isset($dusuns)) {
                                                            if (count($dusuns) > 0) {
                                                                echo "<option value=''>--Pilih Dusun--</option>";
                                                                foreach ($dusuns as $key => $value) { ?>
                                                                    <option value="<?= $value->id ?>" <?= ($dusun == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                        <?php }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                        } ?>
                                                    </select>
                                                    <div class="help-block _dusun"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group _alamat-block">
                                                    <label for="_alamat" class="form-control-label">Alamat</label>
                                                    <textarea class="form-control alamat" name="_alamat" id="_alamat" onFocus="inputFocus(this);" disabled><?= $alamat ?></textarea>
                                                    <div class="help-block _alamat"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _koordinat-block">
                                                    <label for="_koordinat" class="form-control-label">Koordinat Tempat Tinggal</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="hidden" name="_latitude" id="_latitude" value="<?= (isset($user)) ? $user->latitude : '' ?>">
                                                        <input type="hidden" name="_longitude" id="_longitude" value="<?= (isset($user)) ? $user->longitude : '' ?>">
                                                        <input type="text" class="form-control koordinat" style="padding-left: 15px;" name="_koordinat" id="_koordinat" value="<?= (isset($user)) ? '(' . $user->latitude . ';' . $user->longitude . ')' : '' ?>" onFocus="inputFocus(this);" disabled>
                                                        <!-- <div class="input-group-append action-location" onmouseover="actionMouseHoverLocation(this)" onmouseout="actionMouseOutHoverLocation(this)" onclick="pickCoordinat()">
                                                                <span class="input-group-text action-location-icon" style="background-color: transparent;"><i class="fas fa-map-marker"></i></span>
                                                            </div> -->
                                                    </div>

                                                    <div class="help-block _koordinat"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                        <h5 class="heading-small" style="margin-top: 20px;">Data Asal Sekolah</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group _npsn_asal-block">
                                                    <label for="_npsn_asal" class="form-control-label">NPSN Asal Sekolah</label>
                                                    <input type="text" class="form-control alamat" name="_npsn_asal" id="_npsn_asal" value="<?= (isset($sekolah)) ? $sekolah->npsn : '' ?>" onFocus="inputFocus(this);" disabled>
                                                    <div class="help-block _npsn_asal"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group _sekolah_asal-block">
                                                    <label for="_sekolah_asal" class="form-control-label">Nama Asal Sekolah</label>
                                                    <input type="text" class="form-control alamat" name="_sekolah_asal" id="_sekolah_asal" value="<?= (isset($sekolah)) ? $sekolah->nama : '' ?>" onFocus="inputFocus(this);" disabled>
                                                    <div class="help-block _sekolah_asal"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                        <h5 class="heading-small" style="margin-top: 20px;">Upload Pas Foto</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>&nbsp;</label>
                                                <div class="form-group">
                                                    <div class="preview-image-upload">
                                                        <img class="imagePreviewUpload" <?= isset($user) ? (($user->profile_picture !== null) ? 'src="' . base_url('uploads/peserta/user') . '/' . $user->profile_picture . '"' : '') : '' ?> id="imagePreviewUpload" />
                                                        <!-- <button type="button" class="btn-remove-preview-image">Remove</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 30px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-success">Simpan Profil</button>
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
                    <?php } else { ?>
                        <?php if (isset($warning)) { ?>
                            <div class="card">
                                <div class="card-body bg-gradient-danger p-0" style="border-radius: 5px; color: #fff;">
                                    <!-- <div class="alert alert-success alert-dismissible fade show" role="alert"> -->
                                    <center style="padding: 20px;"><span class="alert-icon"><i class="ni ni-notification-70 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br><?= $warning ?></span></button></center>
                                    <br />
                                    <br />
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h2>UBAH DATA PROFIL</h2>
                                </div>
                                <?php
                                $provinsi = "";
                                $kabupaten = "";
                                $kecamatan = "";
                                $kelurahan = "";
                                $dusun = "";
                                $alamat = "";
                                $dataDetail = null;
                                if (isset($user)) {
                                    if (isset($details)) {
                                        $dataDetail = $details;
                                    }
                                    if (!(isset($user->provinsi)) || $user->provinsi == null || $user->provinsi == "") {
                                        if (isset($details)) {
                                            $provinsi = substr(trim($details->kode_wilayah), 0, 2) . '0000';
                                        }
                                    } else {
                                        $provinsi = $user->provinsi;
                                    }
                                    if (!(isset($user->kabupaten)) || $user->kabupaten == null || $user->kabupaten == "") {
                                        if (isset($details)) {
                                            $kabupaten = substr(trim($details->kode_wilayah), 0, 4) . '00';
                                        }
                                    } else {
                                        $kabupaten = $user->kabupaten;
                                    }
                                    if (!(isset($user->kecamatan)) || $user->kecamatan == null || $user->kecamatan == "") {
                                        if (isset($details)) {
                                            $kecamatan = substr(trim($details->kode_wilayah), 0, 6);
                                        }
                                    } else {
                                        $kecamatan = $user->kecamatan;
                                    }
                                    if (!(isset($user->kelurahan)) || $user->kelurahan == null || $user->kelurahan == "") {
                                        if (isset($details)) {
                                            $kelurahan = substr(trim($details->kode_wilayah), 0, 8);
                                        }
                                    } else {
                                        $kelurahan = $user->kelurahan;
                                    }
                                    if (!(isset($user->dusun)) || $user->dusun == null || $user->dusun == "") {
                                    } else {
                                        $dusun = $user->dusun;
                                    }
                                    if (!(isset($user->alamat)) || $user->alamat == null || $user->alamat == "") {
                                        if (isset($details)) {
                                            $alamat = trim($details->alamat_jalan);
                                            // $alamat = $details->alamat_jalan;
                                        }
                                    } else {
                                        $alamat = $user->alamat;
                                    }
                                } ?>
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <form>
                                            <h5 class="heading-small">Data Pribadi</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group _nama-block">
                                                        <label for="_nama" class="form-control-label">Nama Lengkap <span class="required" style="color: indigo;">* Wajib</span></label>
                                                        <input type="text" class="form-control" id="_nama" name="_nama" placeholder="Nama Lengkap . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->fullname) ? $user->fullname : '') : '' ?>" readonly>
                                                        <div class="help-block _nama"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _nisn-block">
                                                        <label for="_nisn" class="form-control-label">NISN</label>
                                                        <input type="text" class="form-control" id="_nisn" name="_nisn" placeholder="NISN . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->nisn) ? $user->nisn : '') : '' ?>" readonly>
                                                        <div class="help-block _nisn"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _nik-block">
                                                        <label for="_nik" class="form-control-label">NIK</label>
                                                        <input type="text" class="form-control" id="_nik" name="_nik" placeholder="NIK . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nik) ? $details->nik : '') : '' ?>" readonly>
                                                        <div class="help-block _nik"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _jenis_kelamin-block">
                                                        <label for="_jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                                                        <input type="text" class="form-control" id="_jenis_kelamin" name="_jenis_kelamin" placeholder="Jenis kelamin . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->jenis_kelamin) ? $details->jenis_kelamin : '') : '' ?>" readonly>
                                                        <div class="help-block _jenis_kelamin"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _tempat_lahir-block">
                                                        <label for="_tempat_lahir" class="form-control-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" id="_tempat_lahir" name="_tempat_lahir" placeholder="Tempat Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tempat_lahir) ? $details->tempat_lahir : '') : '' ?>" readonly>
                                                        <div class="help-block _tempat_lahir"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _tanggal_lahir-block">
                                                        <label for="_tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                                                        <input type="text" class="form-control" id="_tanggal_lahir" name="_tanggal_lahir" placeholder="Tanggal Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tanggal_lahir) ? $details->tanggal_lahir : '') : '' ?>" readonly>
                                                        <div class="help-block _tanggal_lahir"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _nama_ibu-block">
                                                        <label for="_nama_ibu" class="form-control-label">Nama Ibu Kandung</label>
                                                        <input type="text" class="form-control" id="_nama_ibu" name="_nama_ibu" placeholder="Nama ibu kandung . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nama_ibu_kandung) ? $details->nama_ibu_kandung : '') : '' ?>" readonly>
                                                        <div class="help-block _nama_ibu"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _email-block">
                                                        <label for="_email" class="form-control-label">Email</label>
                                                        <input type="email" class="form-control" id="_email" name="_email" placeholder="Email . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->email) ? $user->email : '') : '' ?>" required>
                                                        <div class="help-block _email"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _nohp-block">
                                                        <label for="_nohp" class="form-control-label">No Handphone</label>
                                                        <input type="phone" class="form-control" id="_nohp" name="_nohp" placeholder="08xxxxxxxx" onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->no_hp) ? $user->no_hp : '') : '' ?>" required>
                                                        <div class="help-block _nohp"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                            <h5 class="heading-small" style="margin-top: 20px;">Data Tempat Tinggal</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group _provinsi-block">
                                                        <label for="_provinsi" class="form-control-label">Provinsi</label>
                                                        <select class="form-control provinsi" name="_provinsi" id="_provinsi" data-toggle="select22" title="Simple select" onChange="onChangeProvinsi(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>

                                                            <?php if (isset($provinsis)) {
                                                                if (count($provinsis) > 0) {
                                                                    echo "<option value=''>--Pilih Provinsi--</option>";
                                                                    foreach ($provinsis as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($provinsi == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Tidak ada data--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Tidak ada data--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _provinsi"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _kabupaten-block">
                                                        <label for="_kabupaten" class="form-control-label">Kabupaten</label>
                                                        <select class="form-control kabupaten" name="_kabupaten" id="_kabupaten" data-toggle="select22" title="Simple select" onChange="onChangeKabupaten(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                            <?php if (isset($kabupatens)) {
                                                                if (count($kabupatens) > 0) {
                                                                    echo "<option value=''>--Pilih Kabupaten--</option>";
                                                                    foreach ($kabupatens as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($kabupaten == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _kabupaten"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _kecamatan-block">
                                                        <label for="_kecamatan" class="form-control-label">Kecamatan</label>
                                                        <select class="form-control kecamatan" name="_kecamatan" id="_kecamatan" data-toggle="select22" title="Simple select" onChange="onChangeKecamatan(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                            <?php if (isset($kecamatans)) {
                                                                if (count($kecamatans) > 0) {
                                                                    echo "<option value=''>--Pilih Kecamatan--</option>";
                                                                    foreach ($kecamatans as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($kecamatan == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _kecamatan"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _kelurahan-block">
                                                        <label for="_kelurahan" class="form-control-label">Kelurahan</label>
                                                        <select class="form-control kelurahan" name="_kelurahan" id="_kelurahan" data-toggle="select22" title="Simple select" onChange="onChangeKelurahan(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                            <?php if (isset($kelurahans)) {
                                                                if (count($kelurahans) > 0) {
                                                                    echo "<option value=''>--Pilih Kelurahan--</option>";
                                                                    foreach ($kelurahans as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($kelurahan == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _kelurahan"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _dusun-block">
                                                        <label for="_dusun" class="form-control-label">Dusun</label>
                                                        <select class="form-control dusun" name="_dusun" id="_dusun" data-toggle="select22" title="Simple select" onChange="onChangeDusun(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                            <?php if (isset($dusuns)) {
                                                                if (count($dusuns) > 0) {
                                                                    echo "<option value=''>--Pilih Dusun--</option>";
                                                                    foreach ($dusuns as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($dusun == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _dusun"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group _alamat-block">
                                                        <label for="_alamat" class="form-control-label">Alamat</label>
                                                        <textarea class="form-control alamat" name="_alamat" id="_alamat" onFocus="inputFocus(this);"><?= $alamat ?></textarea>
                                                        <div class="help-block _alamat"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _koordinat-block">
                                                        <label for="_koordinat" class="form-control-label">Koordinat Tempat Tinggal</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="hidden" name="_old_picture" id="_old_picture" value="<?= (isset($user)) ? $user->profile_picture : '' ?>">
                                                            <input type="hidden" name="_latitude" id="_latitude" value="<?= (isset($user)) ? $user->latitude : '' ?>">
                                                            <input type="hidden" name="_longitude" id="_longitude" value="<?= (isset($user)) ? $user->longitude : '' ?>">
                                                            <input type="text" class="form-control koordinat" style="padding-left: 15px;" name="_koordinat" id="_koordinat" value="<?= (isset($user)) ? '(' . $user->latitude . ';' . $user->longitude . ')' : '' ?>" onFocus="inputFocus(this);" readonly>
                                                            <div class="input-group-append action-location" onmouseover="actionMouseHoverLocation(this)" onmouseout="actionMouseOutHoverLocation(this)" onclick="pickCoordinat()">
                                                                <span class="input-group-text action-location-icon" style="background-color: transparent;"><i class="fas fa-map-marker"></i></span>
                                                            </div>
                                                        </div>


                                                        <div class="help-block _koordinat"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                            <h5 class="heading-small" style="margin-top: 20px;">Data Asal Sekolah</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group _npsn_asal-block">
                                                        <label for="_npsn_asal" class="form-control-label">NPSN Asal Sekolah</label>
                                                        <input type="text" class="form-control alamat" name="_npsn_asal" id="_npsn_asal" value="<?= (isset($sekolah)) ? $sekolah->npsn : '' ?>" onFocus="inputFocus(this);" readonly>
                                                        <div class="help-block _npsn_asal"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _sekolah_asal-block">
                                                        <label for="_sekolah_asal" class="form-control-label">Nama Asal Sekolah</label>
                                                        <input type="text" class="form-control alamat" name="_sekolah_asal" id="_sekolah_asal" value="<?= (isset($sekolah)) ? $sekolah->nama : '' ?>" onFocus="inputFocus(this);" readonly>
                                                        <div class="help-block _sekolah_asal"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                            <h5 class="heading-small" style="margin-top: 20px;">Upload Pas Foto</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group" id="file-error">
                                                        <h5>Pass Foto</h5>
                                                        <div class="controls">
                                                            <input type="file" class="form-control" id="_file" name="_file" onFocus="inputFocus(this);" accept="image/*" onchange="loadFileImage()" required>
                                                            <div class="help-block _file" for="file"></div>
                                                        </div>
                                                        <p>Pilih gambar dengan ukuran maksimal 512 kb.</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>&nbsp;</label>
                                                    <div class="form-group">
                                                        <div class="preview-image-upload">
                                                            <img class="imagePreviewUpload" <?= isset($user) ? (($user->profile_picture !== null) ? 'src="' . base_url('uploads/peserta/user') . '/' . $user->profile_picture . '"' : '') : '' ?> id="imagePreviewUpload" />
                                                            <!-- <button type="button" class="btn-remove-preview-image">Remove</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 30px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="button" onclick="actionSave(this)" class="btn btn-success">Simpan Profil</button>
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
                        <?php } else { ?>
                            <div class="card">
                                <div class="card-body bg-gradient-success p-0" style="border-radius: 5px; color: #fff;">
                                    <!-- <div class="alert alert-success alert-dismissible fade show" role="alert"> -->
                                    <center style="padding: 20px;"><span class="alert-icon"><i class="ni ni-notification-70 ni-3x"></i></span><br /><br /><span class="alert-text"><strong>INFORMASI !!!</strong> <br><?= $error ?></span></button></center>
                                    <br />
                                    <?php if (isset($sekolah_pilihan)) { ?>
                                        <center>
                                            <ol>
                                                <li style="list-style: none;"><?= $sekolah_pilihan->tujuan_sekolah_id_2 !== NULL ? 'Sekolah Pilihan Pertama' : 'Sekolah yang dituju' ?> : <?= getNamaAndNpsnSekolah($sekolah_pilihan->tujuan_sekolah_id_1) ?></li>
                                                <?php if ($sekolah_pilihan->tujuan_sekolah_id_2 !== NULL) { ?>
                                                    <li style="list-style: none;">Sekolah Pilihan Kedua &nbsp;&nbsp;: <?= getNamaAndNpsnSekolah($sekolah_pilihan->tujuan_sekolah_id_2) ?></li>
                                                    <li style="list-style: none;">Sekolah Pilihan Ketiga &nbsp;: <?= getNamaAndNpsnSekolah($sekolah_pilihan->tujuan_sekolah_id_3) ?></li>
                                                <?php } ?>
                                            </ol>
                                        </center>
                                    <?php } ?>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h2>LENGKAPI DATA PROFIL</h2>
                                </div>
                                <?php
                                $provinsi = "";
                                $kabupaten = "";
                                $kecamatan = "";
                                $kelurahan = "";
                                $dusun = "";
                                $alamat = "";
                                $dataDetail = null;
                                if (isset($user)) {
                                    if (isset($details)) {
                                        $dataDetail = $details;
                                    }
                                    if (!(isset($user->provinsi)) || $user->provinsi == null || $user->provinsi == "") {
                                        if (isset($details)) {
                                            $provinsi = substr(trim($details->kode_wilayah), 0, 2) . '0000';
                                        }
                                    } else {
                                        $provinsi = $user->provinsi;
                                    }
                                    if (!(isset($user->kabupaten)) || $user->kabupaten == null || $user->kabupaten == "") {
                                        if (isset($details)) {
                                            $kabupaten = substr(trim($details->kode_wilayah), 0, 4) . '00';
                                        }
                                    } else {
                                        $kabupaten = $user->kabupaten;
                                    }
                                    if (!(isset($user->kecamatan)) || $user->kecamatan == null || $user->kecamatan == "") {
                                        if (isset($details)) {
                                            $kecamatan = substr(trim($details->kode_wilayah), 0, 6);
                                        }
                                    } else {
                                        $kecamatan = $user->kecamatan;
                                    }
                                    if (!(isset($user->kelurahan)) || $user->kelurahan == null || $user->kelurahan == "") {
                                        if (isset($details)) {
                                            $kelurahan = substr(trim($details->kode_wilayah), 0, 8);
                                        }
                                    } else {
                                        $kelurahan = $user->kelurahan;
                                    }
                                    if (!(isset($user->dusun)) || $user->dusun == null || $user->dusun == "") {
                                    } else {
                                        $dusun = $user->dusun;
                                    }
                                    if (!(isset($user->alamat)) || $user->alamat == null || $user->alamat == "") {
                                        if (isset($details)) {
                                            $alamat = trim($details->alamat_jalan);
                                            // $alamat = $details->alamat_jalan;
                                        }
                                    } else {
                                        $alamat = $user->alamat;
                                    }
                                } ?>
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <form>
                                            <h5 class="heading-small">Data Pribadi</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group _nama-block">
                                                        <label for="_nama" class="form-control-label">Nama Lengkap <span class="required" style="color: indigo;">* Wajib</span></label>
                                                        <input type="text" class="form-control" id="_nama" name="_nama" placeholder="Nama Lengkap . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->fullname) ? $user->fullname : '') : '' ?>" readonly>
                                                        <div class="help-block _nama"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _nisn-block">
                                                        <label for="_nisn" class="form-control-label">NISN</label>
                                                        <input type="text" class="form-control" id="_nisn" name="_nisn" placeholder="NISN . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->nisn) ? $user->nisn : '') : '' ?>" readonly>
                                                        <div class="help-block _nisn"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _nik-block">
                                                        <label for="_nik" class="form-control-label">NIK</label>
                                                        <input type="text" class="form-control" id="_nik" name="_nik" placeholder="NIK . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nik) ? $details->nik : '') : '' ?>" readonly>
                                                        <div class="help-block _nik"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _jenis_kelamin-block">
                                                        <label for="_jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                                                        <input type="text" class="form-control" id="_jenis_kelamin" name="_jenis_kelamin" placeholder="Jenis kelamin . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->jenis_kelamin) ? $details->jenis_kelamin : '') : '' ?>" readonly>
                                                        <div class="help-block _jenis_kelamin"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _tempat_lahir-block">
                                                        <label for="_tempat_lahir" class="form-control-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" id="_tempat_lahir" name="_tempat_lahir" placeholder="Tempat Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tempat_lahir) ? $details->tempat_lahir : '') : '' ?>" readonly>
                                                        <div class="help-block _tempat_lahir"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _tanggal_lahir-block">
                                                        <label for="_tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                                                        <input type="text" class="form-control" id="_tanggal_lahir" name="_tanggal_lahir" placeholder="Tanggal Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tanggal_lahir) ? $details->tanggal_lahir : '') : '' ?>" readonly>
                                                        <div class="help-block _tanggal_lahir"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _nama_ibu-block">
                                                        <label for="_nama_ibu" class="form-control-label">Nama Ibu Kandung</label>
                                                        <input type="text" class="form-control" id="_nama_ibu" name="_nama_ibu" placeholder="Nama ibu kandung . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nama_ibu_kandung) ? $details->nama_ibu_kandung : '') : '' ?>" readonly>
                                                        <div class="help-block _nama_ibu"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _email-block">
                                                        <label for="_email" class="form-control-label">Email</label>
                                                        <input type="email" class="form-control" id="_email" name="_email" placeholder="Email . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->email) ? $user->email : '') : '' ?>" readonly>
                                                        <div class="help-block _email"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _nohp-block">
                                                        <label for="_nohp" class="form-control-label">No Handphone</label>
                                                        <input type="phone" class="form-control" id="_nohp" name="_nohp" placeholder="08xxxxxxxx" onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->no_hp) ? $user->no_hp : '') : '' ?>" readonly>
                                                        <div class="help-block _nohp"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                            <h5 class="heading-small" style="margin-top: 20px;">Data Tempat Tinggal</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group _provinsi-block">
                                                        <label for="_provinsi" class="form-control-label">Provinsi</label>
                                                        <select class="form-control provinsi" name="_provinsi" id="_provinsi" data-toggle="select22" title="Simple select" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." disabled>

                                                            <?php if (isset($provinsis)) {
                                                                if (count($provinsis) > 0) {
                                                                    echo "<option value=''>--Pilih Provinsi--</option>";
                                                                    foreach ($provinsis as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($provinsi == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Tidak ada data--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Tidak ada data--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _provinsi"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _kabupaten-block">
                                                        <label for="_kabupaten" class="form-control-label">Kabupaten</label>
                                                        <select class="form-control kabupaten" name="_kabupaten" id="_kabupaten" data-toggle="select22" title="Simple select" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                                                            <?php if (isset($kabupatens)) {
                                                                if (count($kabupatens) > 0) {
                                                                    echo "<option value=''>--Pilih Kabupaten--</option>";
                                                                    foreach ($kabupatens as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($kabupaten == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _kabupaten"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _kecamatan-block">
                                                        <label for="_kecamatan" class="form-control-label">Kecamatan</label>
                                                        <select class="form-control kecamatan" name="_kecamatan" id="_kecamatan" data-toggle="select22" title="Simple select" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                                                            <?php if (isset($kecamatans)) {
                                                                if (count($kecamatans) > 0) {
                                                                    echo "<option value=''>--Pilih Kecamatan--</option>";
                                                                    foreach ($kecamatans as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($kecamatan == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _kecamatan"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _kelurahan-block">
                                                        <label for="_kelurahan" class="form-control-label">Kelurahan</label>
                                                        <select class="form-control kelurahan" name="_kelurahan" id="_kelurahan" data-toggle="select22" title="Simple select" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." disabled>
                                                            <?php if (isset($kelurahans)) {
                                                                if (count($kelurahans) > 0) {
                                                                    echo "<option value=''>--Pilih Kelurahan--</option>";
                                                                    foreach ($kelurahans as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($kelurahan == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _kelurahan"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _dusun-block">
                                                        <label for="_dusun" class="form-control-label">Dusun</label>
                                                        <select class="form-control dusun" name="_dusun" id="_dusun" data-toggle="select22" title="Simple select" onChange="onChangeDusun(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                            <?php if (isset($dusuns)) {
                                                                if (count($dusuns) > 0) {
                                                                    echo "<option value=''>--Pilih Dusun--</option>";
                                                                    foreach ($dusuns as $key => $value) { ?>
                                                                        <option value="<?= $value->id ?>" <?= ($dusun == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                            <?php }
                                                                } else {
                                                                    echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                                }
                                                            } else {
                                                                echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                            } ?>
                                                        </select>
                                                        <div class="help-block _dusun"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group _alamat-block">
                                                        <label for="_alamat" class="form-control-label">Alamat</label>
                                                        <textarea class="form-control alamat" name="_alamat" id="_alamat" onFocus="inputFocus(this);" disabled><?= $alamat ?></textarea>
                                                        <div class="help-block _alamat"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _koordinat-block">
                                                        <label for="_koordinat" class="form-control-label">Koordinat Tempat Tinggal</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="hidden" name="_latitude" id="_latitude" value="<?= (isset($user)) ? $user->latitude : '' ?>">
                                                            <input type="hidden" name="_longitude" id="_longitude" value="<?= (isset($user)) ? $user->longitude : '' ?>">
                                                            <input type="text" class="form-control koordinat" style="padding-left: 15px;" name="_koordinat" id="_koordinat" value="<?= (isset($user)) ? '(' . $user->latitude . ';' . $user->longitude . ')' : '' ?>" onFocus="inputFocus(this);" disabled>
                                                            <!-- <div class="input-group-append action-location" onmouseover="actionMouseHoverLocation(this)" onmouseout="actionMouseOutHoverLocation(this)" onclick="pickCoordinat()">
                                                                <span class="input-group-text action-location-icon" style="background-color: transparent;"><i class="fas fa-map-marker"></i></span>
                                                            </div> -->
                                                        </div>

                                                        <div class="help-block _koordinat"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                            <h5 class="heading-small" style="margin-top: 20px;">Data Asal Sekolah</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group _npsn_asal-block">
                                                        <label for="_npsn_asal" class="form-control-label">NPSN Asal Sekolah</label>
                                                        <input type="text" class="form-control alamat" name="_npsn_asal" id="_npsn_asal" value="<?= (isset($sekolah)) ? $sekolah->npsn : '' ?>" onFocus="inputFocus(this);" disabled>
                                                        <div class="help-block _npsn_asal"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group _sekolah_asal-block">
                                                        <label for="_sekolah_asal" class="form-control-label">Nama Asal Sekolah</label>
                                                        <input type="text" class="form-control alamat" name="_sekolah_asal" id="_sekolah_asal" value="<?= (isset($sekolah)) ? $sekolah->nama : '' ?>" onFocus="inputFocus(this);" disabled>
                                                        <div class="help-block _sekolah_asal"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                            <h5 class="heading-small" style="margin-top: 20px;">Upload Pas Foto</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>&nbsp;</label>
                                                    <div class="form-group">
                                                        <div class="preview-image-upload">
                                                            <img class="imagePreviewUpload" <?= isset($user) ? (($user->profile_picture !== null) ? 'src="' . base_url('uploads/peserta/user') . '/' . $user->profile_picture . '"' : '') : '' ?> id="imagePreviewUpload" />
                                                            <!-- <button type="button" class="btn-remove-preview-image">Remove</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 30px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-success">Simpan Profil</button>
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
                        <?php } ?>
                    <?php } ?>
                <?php } else { ?>

                    <div class="card">
                        <div class="card-header">
                            <h2>UBAH DATA PROFIL</h2>
                        </div>
                        <?php
                        $provinsi = "";
                        $kabupaten = "";
                        $kecamatan = "";
                        $kelurahan = "";
                        $dusun = "";
                        $alamat = "";
                        $dataDetail = null;
                        if (isset($user)) {
                            if (isset($details)) {
                                $dataDetail = $details;
                            }
                            if (!(isset($user->provinsi)) || $user->provinsi == null || $user->provinsi == "") {
                                if (isset($details)) {
                                    $provinsi = substr(trim($details->kode_wilayah), 0, 2) . '0000';
                                }
                            } else {
                                $provinsi = $user->provinsi;
                            }
                            if (!(isset($user->kabupaten)) || $user->kabupaten == null || $user->kabupaten == "") {
                                if (isset($details)) {
                                    $kabupaten = substr(trim($details->kode_wilayah), 0, 4) . '00';
                                }
                            } else {
                                $kabupaten = $user->kabupaten;
                            }
                            if (!(isset($user->kecamatan)) || $user->kecamatan == null || $user->kecamatan == "") {
                                if (isset($details)) {
                                    $kecamatan = substr(trim($details->kode_wilayah), 0, 6);
                                }
                            } else {
                                $kecamatan = $user->kecamatan;
                            }
                            if (!(isset($user->kelurahan)) || $user->kelurahan == null || $user->kelurahan == "") {
                                if (isset($details)) {
                                    $kelurahan = substr(trim($details->kode_wilayah), 0, 8);
                                }
                            } else {
                                $kelurahan = $user->kelurahan;
                            }
                            if (!(isset($user->dusun)) || $user->dusun == null || $user->dusun == "") {
                            } else {
                                $dusun = $user->dusun;
                            }
                            if (!(isset($user->alamat)) || $user->alamat == null || $user->alamat == "") {
                                if (isset($details)) {
                                    $alamat = trim($details->alamat_jalan);
                                    // $alamat = $details->alamat_jalan;
                                }
                            } else {
                                $alamat = $user->alamat;
                            }
                        } ?>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <form>
                                    <h5 class="heading-small">Data Pribadi</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group _nama-block">
                                                <label for="_nama" class="form-control-label">Nama Lengkap <span class="required" style="color: indigo;">* Wajib</span></label>
                                                <input type="text" class="form-control" id="_nama" name="_nama" placeholder="Nama Lengkap . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->fullname) ? $user->fullname : '') : '' ?>" readonly>
                                                <div class="help-block _nama"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _nisn-block">
                                                <label for="_nisn" class="form-control-label">NISN</label>
                                                <input type="text" class="form-control" id="_nisn" name="_nisn" placeholder="NISN . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->nisn) ? $user->nisn : '') : '' ?>" readonly>
                                                <div class="help-block _nisn"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _nik-block">
                                                <label for="_nik" class="form-control-label">NIK</label>
                                                <input type="text" class="form-control" id="_nik" name="_nik" placeholder="NIK . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nik) ? $details->nik : '') : '' ?>" readonly>
                                                <div class="help-block _nik"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _jenis_kelamin-block">
                                                <label for="_jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                                                <input type="text" class="form-control" id="_jenis_kelamin" name="_jenis_kelamin" placeholder="Jenis kelamin . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->jenis_kelamin) ? $details->jenis_kelamin : '') : '' ?>" readonly>
                                                <div class="help-block _jenis_kelamin"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _tempat_lahir-block">
                                                <label for="_tempat_lahir" class="form-control-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="_tempat_lahir" name="_tempat_lahir" placeholder="Tempat Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tempat_lahir) ? $details->tempat_lahir : '') : '' ?>" readonly>
                                                <div class="help-block _tempat_lahir"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _tanggal_lahir-block">
                                                <label for="_tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                                                <input type="text" class="form-control" id="_tanggal_lahir" name="_tanggal_lahir" placeholder="Tanggal Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tanggal_lahir) ? $details->tanggal_lahir : '') : '' ?>" readonly>
                                                <div class="help-block _tanggal_lahir"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _nama_ibu-block">
                                                <label for="_nama_ibu" class="form-control-label">Nama Ibu Kandung</label>
                                                <input type="text" class="form-control" id="_nama_ibu" name="_nama_ibu" placeholder="Nama ibu kandung . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nama_ibu_kandung) ? $details->nama_ibu_kandung : '') : '' ?>" readonly>
                                                <div class="help-block _nama_ibu"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _email-block">
                                                <label for="_email" class="form-control-label">Email</label>
                                                <input type="email" class="form-control" id="_email" name="_email" placeholder="Email . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->email) ? $user->email : '') : '' ?>" required>
                                                <div class="help-block _email"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _nohp-block">
                                                <label for="_nohp" class="form-control-label">No Handphone</label>
                                                <input type="phone" class="form-control" id="_nohp" name="_nohp" placeholder="08xxxxxxxx" onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->no_hp) ? $user->no_hp : '') : '' ?>" required>
                                                <div class="help-block _nohp"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                    <h5 class="heading-small" style="margin-top: 20px;">Data Tempat Tinggal</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group _provinsi-block">
                                                <label for="_provinsi" class="form-control-label">Provinsi</label>
                                                <select class="form-control provinsi" name="_provinsi" id="_provinsi" data-toggle="select22" title="Simple select" onChange="onChangeProvinsi(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>

                                                    <?php if (isset($provinsis)) {
                                                        if (count($provinsis) > 0) {
                                                            echo "<option value=''>--Pilih Provinsi--</option>";
                                                            foreach ($provinsis as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>" <?= ($provinsi == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                    <?php }
                                                        } else {
                                                            echo "<option value='' selected>--Tidak ada data--</option>";
                                                        }
                                                    } else {
                                                        echo "<option value='' selected>--Tidak ada data--</option>";
                                                    } ?>
                                                </select>
                                                <div class="help-block _provinsi"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _kabupaten-block">
                                                <label for="_kabupaten" class="form-control-label">Kabupaten</label>
                                                <select class="form-control kabupaten" name="_kabupaten" id="_kabupaten" data-toggle="select22" title="Simple select" onChange="onChangeKabupaten(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <?php if (isset($kabupatens)) {
                                                        if (count($kabupatens) > 0) {
                                                            echo "<option value=''>--Pilih Kabupaten--</option>";
                                                            foreach ($kabupatens as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>" <?= ($kabupaten == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                    <?php }
                                                        } else {
                                                            echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                        }
                                                    } else {
                                                        echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                    } ?>
                                                </select>
                                                <div class="help-block _kabupaten"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _kecamatan-block">
                                                <label for="_kecamatan" class="form-control-label">Kecamatan</label>
                                                <select class="form-control kecamatan" name="_kecamatan" id="_kecamatan" data-toggle="select22" title="Simple select" onChange="onChangeKecamatan(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <?php if (isset($kecamatans)) {
                                                        if (count($kecamatans) > 0) {
                                                            echo "<option value=''>--Pilih Kecamatan--</option>";
                                                            foreach ($kecamatans as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>" <?= ($kecamatan == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                    <?php }
                                                        } else {
                                                            echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                        }
                                                    } else {
                                                        echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                    } ?>
                                                </select>
                                                <div class="help-block _kecamatan"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _kelurahan-block">
                                                <label for="_kelurahan" class="form-control-label">Kelurahan</label>
                                                <select class="form-control kelurahan" name="_kelurahan" id="_kelurahan" data-toggle="select22" title="Simple select" onChange="onChangeKelurahan(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <?php if (isset($kelurahans)) {
                                                        if (count($kelurahans) > 0) {
                                                            echo "<option value=''>--Pilih Kelurahan--</option>";
                                                            foreach ($kelurahans as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>" <?= ($kelurahan == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                    <?php }
                                                        } else {
                                                            echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                        }
                                                    } else {
                                                        echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                    } ?>
                                                </select>
                                                <div class="help-block _kelurahan"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _dusun-block">
                                                <label for="_dusun" class="form-control-label">Dusun</label>
                                                <select class="form-control dusun" name="_dusun" id="_dusun" data-toggle="select22" title="Simple select" onChange="onChangeDusun(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                    <?php if (isset($dusuns)) {
                                                        if (count($dusuns) > 0) {
                                                            echo "<option value=''>--Pilih Dusun--</option>";
                                                            foreach ($dusuns as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>" <?= ($dusun == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                                    <?php }
                                                        } else {
                                                            echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                        }
                                                    } else {
                                                        echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                    } ?>
                                                </select>
                                                <div class="help-block _dusun"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group _alamat-block">
                                                <label for="_alamat" class="form-control-label">Alamat</label>
                                                <textarea class="form-control alamat" name="_alamat" id="_alamat" onFocus="inputFocus(this);"><?= $alamat ?></textarea>
                                                <div class="help-block _alamat"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _koordinat-block">
                                                <label for="_koordinat" class="form-control-label">Koordinat Tempat Tinggal</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="hidden" name="_old_picture" id="_old_picture" value="<?= (isset($user)) ? $user->profile_picture : '' ?>">
                                                    <input type="hidden" name="_latitude" id="_latitude" value="<?= (isset($user)) ? $user->latitude : '' ?>">
                                                    <input type="hidden" name="_longitude" id="_longitude" value="<?= (isset($user)) ? $user->longitude : '' ?>">
                                                    <input type="text" class="form-control koordinat" style="padding-left: 15px;" name="_koordinat" id="_koordinat" value="<?= (isset($user)) ? '(' . $user->latitude . ';' . $user->longitude . ')' : '' ?>" onFocus="inputFocus(this);" readonly>
                                                    <div class="input-group-append action-location" onmouseover="actionMouseHoverLocation(this)" onmouseout="actionMouseOutHoverLocation(this)" onclick="pickCoordinat()">
                                                        <span class="input-group-text action-location-icon" style="background-color: transparent;"><i class="fas fa-map-marker"></i></span>
                                                    </div>
                                                </div>


                                                <div class="help-block _koordinat"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                    <h5 class="heading-small" style="margin-top: 20px;">Data Asal Sekolah</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group _npsn_asal-block">
                                                <label for="_npsn_asal" class="form-control-label">NPSN Asal Sekolah</label>
                                                <input type="text" class="form-control alamat" name="_npsn_asal" id="_npsn_asal" value="<?= (isset($sekolah)) ? $sekolah->npsn : '' ?>" onFocus="inputFocus(this);" readonly>
                                                <div class="help-block _npsn_asal"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group _sekolah_asal-block">
                                                <label for="_sekolah_asal" class="form-control-label">Nama Asal Sekolah</label>
                                                <input type="text" class="form-control alamat" name="_sekolah_asal" id="_sekolah_asal" value="<?= (isset($sekolah)) ? $sekolah->nama : '' ?>" onFocus="inputFocus(this);" readonly>
                                                <div class="help-block _sekolah_asal"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                    <h5 class="heading-small" style="margin-top: 20px;">Upload Pas Foto</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" id="file-error">
                                                <h5>Pass Foto</h5>
                                                <div class="controls">
                                                    <input type="file" class="form-control" id="_file" name="_file" onFocus="inputFocus(this);" accept="image/*" onchange="loadFileImage()" required>
                                                    <div class="help-block _file" for="file"></div>
                                                </div>
                                                <p>Pilih gambar dengan ukuran maksimal 512 kb.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>&nbsp;</label>
                                            <div class="form-group">
                                                <div class="preview-image-upload">
                                                    <img class="imagePreviewUpload" <?= isset($user) ? (($user->profile_picture !== null) ? 'src="' . base_url('uploads/peserta/user') . '/' . $user->profile_picture . '"' : '') : '' ?> id="imagePreviewUpload" />
                                                    <!-- <button type="button" class="btn-remove-preview-image">Remove</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 30px;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="button" onclick="actionSave(this)" class="btn btn-success">Simpan Profil</button>
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
                <?php } ?>

                <!-- <div class="card">
                    <div class="card-header">
                        <h2>UBAH DATA PROFIL</h2>
                    </div>
                    <?php
                    //$provinsi = "";
                    //$kabupaten = "";
                    //$kecamatan = "";
                    // $kelurahan = "";
                    // $dusun = "";
                    // $alamat = "";
                    // $dataDetail = null;
                    // if (isset($user)) {
                    //     if (isset($details)) {
                    //         $dataDetail = $details;
                    // }
                    // if (!(isset($user->provinsi)) || $user->provinsi == null || $user->provinsi == "") {
                    //     if (isset($details)) {
                    //         $provinsi = substr(trim($details->kode_wilayah), 0, 2) . '0000';
                    //     }
                    // } else {
                    //     $provinsi = $user->provinsi;
                    // }
                    // if (!(isset($user->kabupaten)) || $user->kabupaten == null || $user->kabupaten == "") {
                    //     if (isset($details)) {
                    //         $kabupaten = substr(trim($details->kode_wilayah), 0, 4) . '00';
                    //     }
                    // } else {
                    //     $kabupaten = $user->kabupaten;
                    // }
                    // if (!(isset($user->kecamatan)) || $user->kecamatan == null || $user->kecamatan == "") {
                    //     if (isset($details)) {
                    //         $kecamatan = substr(trim($details->kode_wilayah), 0, 6);
                    //     }
                    // } else {
                    //     $kecamatan = $user->kecamatan;
                    // }
                    // if (!(isset($user->kelurahan)) || $user->kelurahan == null || $user->kelurahan == "") {
                    //     if (isset($details)) {
                    //         $kelurahan = substr(trim($details->kode_wilayah), 0, 8);
                    //     }
                    // } else {
                    //     $kelurahan = $user->kelurahan;
                    // }
                    // if (!(isset($user->dusun)) || $user->dusun == null || $user->dusun == "") {
                    // } else {
                    //     $dusun = $user->dusun;
                    // }
                    // if (!(isset($user->alamat)) || $user->alamat == null || $user->alamat == "") {
                    //     if (isset($details)) {
                    //         $alamat = trim($details->alamat_jalan);
                    //         // $alamat = $details->alamat_jalan;
                    //     }
                    // } else {
                    //     $alamat = $user->alamat;
                    // }
                    //} 
                    ?>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <form>
                                <h5 class="heading-small">Data Pribadi</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group _nama-block">
                                            <label for="_nama" class="form-control-label">Nama Lengkap <span class="required" style="color: indigo;">* Wajib</span></label>
                                            <input type="text" class="form-control" id="_nama" name="_nama" placeholder="Nama Lengkap . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->fullname) ? $user->fullname : '') : '' ?>" readonly>
                                            <div class="help-block _nama"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _nisn-block">
                                            <label for="_nisn" class="form-control-label">NISN</label>
                                            <input type="text" class="form-control" id="_nisn" name="_nisn" placeholder="NISN . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->nisn) ? $user->nisn : '') : '' ?>" readonly>
                                            <div class="help-block _nisn"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _nik-block">
                                            <label for="_nik" class="form-control-label">NIK</label>
                                            <input type="text" class="form-control" id="_nik" name="_nik" placeholder="NIK . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nik) ? $details->nik : '') : '' ?>" readonly>
                                            <div class="help-block _nik"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _jenis_kelamin-block">
                                            <label for="_jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                                            <input type="text" class="form-control" id="_jenis_kelamin" name="_jenis_kelamin" placeholder="Jenis kelamin . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->jenis_kelamin) ? $details->jenis_kelamin : '') : '' ?>" readonly>
                                            <div class="help-block _jenis_kelamin"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _tempat_lahir-block">
                                            <label for="_tempat_lahir" class="form-control-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="_tempat_lahir" name="_tempat_lahir" placeholder="Tempat Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tempat_lahir) ? $details->tempat_lahir : '') : '' ?>" readonly>
                                            <div class="help-block _tempat_lahir"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _tanggal_lahir-block">
                                            <label for="_tanggal_lahir" class="form-control-label">Tanggal Lahir</label>
                                            <input type="text" class="form-control" id="_tanggal_lahir" name="_tanggal_lahir" placeholder="Tanggal Lahir . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->tanggal_lahir) ? $details->tanggal_lahir : '') : '' ?>" readonly>
                                            <div class="help-block _tanggal_lahir"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _nama_ibu-block">
                                            <label for="_nama_ibu" class="form-control-label">Nama Ibu Kandung</label>
                                            <input type="text" class="form-control" id="_nama_ibu" name="_nama_ibu" placeholder="Nama ibu kandung . . ." onFocus="inputFocus(this);" value="<?= (isset($details)) ? (isset($details->nama_ibu_kandung) ? $details->nama_ibu_kandung : '') : '' ?>" readonly>
                                            <div class="help-block _nama_ibu"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _email-block">
                                            <label for="_email" class="form-control-label">Email</label>
                                            <input type="email" class="form-control" id="_email" name="_email" placeholder="Email . . ." onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->email) ? $user->email : '') : '' ?>" required>
                                            <div class="help-block _email"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _nohp-block">
                                            <label for="_nohp" class="form-control-label">No Handphone</label>
                                            <input type="phone" class="form-control" id="_nohp" name="_nohp" placeholder="08xxxxxxxx" onFocus="inputFocus(this);" value="<?= (isset($user)) ? (isset($user->no_hp) ? $user->no_hp : '') : '' ?>" required>
                                            <div class="help-block _nohp"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                <h5 class="heading-small" style="margin-top: 20px;">Data Tempat Tinggal</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group _provinsi-block">
                                            <label for="_provinsi" class="form-control-label">Provinsi</label>
                                            <select class="form-control provinsi" name="_provinsi" id="_provinsi" data-toggle="select22" title="Simple select" onChange="onChangeProvinsi(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>

                                                <?php //if (isset($provinsis)) {
                                                // if (count($provinsis) > 0) {
                                                //     echo "<option value=''>--Pilih Provinsi--</option>";
                                                //foreach ($provinsis as $key => $value) { 
                                                ?>
                                                            <option value="<?php //echo $value->id 
                                                                            ?>" <?php //echo ($provinsi == $value->id) ? 'selected' : '' 
                                                                                ?>><?php //echo $value->nama 
                                                                                    ?></option>
                                                <?php //}
                                                //     //} else {
                                                //         echo "<option value='' selected>--Tidak ada data--</option>";
                                                //     }
                                                // } else {
                                                //     echo "<option value='' selected>--Tidak ada data--</option>";
                                                //} 
                                                ?>
                                            </select>
                                            <div class="help-block _provinsi"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _kabupaten-block">
                                            <label for="_kabupaten" class="form-control-label">Kabupaten</label>
                                            <select class="form-control kabupaten" name="_kabupaten" id="_kabupaten" data-toggle="select22" title="Simple select" onChange="onChangeKabupaten(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                <?php //if (isset($kabupatens)) {
                                                // if (count($kabupatens) > 0) {
                                                //     echo "<option value=''>--Pilih Kabupaten--</option>";
                                                //foreach ($kabupatens as $key => $value) { 
                                                ?>
                                                            <option value="<?php //echo $value->id 
                                                                            ?>" <?php //echo ($kabupaten == $value->id) ? 'selected' : '' 
                                                                                ?>><?php //echo $value->nama 
                                                                                    ?></option>
                                                <?php //}
                                                //     } else {
                                                //         echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                //     }
                                                // } else {
                                                //     echo "<option value='' selected>--Pilih Provinsi Dulu--</option>";
                                                //} 
                                                ?>
                                            </select>
                                            <div class="help-block _kabupaten"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _kecamatan-block">
                                            <label for="_kecamatan" class="form-control-label">Kecamatan</label>
                                            <select class="form-control kecamatan" name="_kecamatan" id="_kecamatan" data-toggle="select22" title="Simple select" onChange="onChangeKecamatan(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                <?php //if (isset($kecamatans)) {
                                                // if (count($kecamatans) > 0) {
                                                //     echo "<option value=''>--Pilih Kecamatan--</option>";
                                                //     foreach ($kecamatans as $key => $value) { 
                                                ?>
                                                            <option value="<?php //echo $value->id 
                                                                            ?>" <?php //echo ($kecamatan == $value->id) ? 'selected' : '' 
                                                                                ?>><?php //echo $value->nama 
                                                                                    ?></option>
                                                <?php //}
                                                //     } else {
                                                //         echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                //     }
                                                // } else {
                                                //     echo "<option value='' selected>--Pilih Kabupaten Dulu--</option>";
                                                // } 
                                                ?>
                                            </select>
                                            <div class="help-block _kecamatan"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _kelurahan-block">
                                            <label for="_kelurahan" class="form-control-label">Kelurahan</label>
                                            <select class="form-control kelurahan" name="_kelurahan" id="_kelurahan" data-toggle="select22" title="Simple select" onChange="onChangeKelurahan(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                <?php //if (isset($kelurahans)) {
                                                // if (count($kelurahans) > 0) {
                                                //     echo "<option value=''>--Pilih Kelurahan--</option>";
                                                //     foreach ($kelurahans as $key => $value) { 
                                                ?>
                                                            <option value="<?php //echo $value->id 
                                                                            ?>" <?php //echo ($kelurahan == $value->id) ? 'selected' : '' 
                                                                                ?>><?php //echo $value->nama 
                                                                                    ?></option>
                                                <?php //}
                                                //     } else {
                                                //         echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                //     }
                                                // } else {
                                                //     echo "<option value='' selected>--Pilih Kecamatan Dulu--</option>";
                                                // } 
                                                ?>
                                            </select>
                                            <div class="help-block _kelurahan"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _dusun-block">
                                            <label for="_dusun" class="form-control-label">Dusun</label>
                                            <select class="form-control dusun" name="_dusun" id="_dusun" data-toggle="select22" title="Simple select" onChange="onChangeDusun(this)" onFocus="inputFocus(this);" data-live-search="true" data-live-search-placeholder="Search ..." required>
                                                <?php //if (isset($dusuns)) {
                                                // if (count($dusuns) > 0) {
                                                //     echo "<option value=''>--Pilih Dusun--</option>";
                                                //     foreach ($dusuns as $key => $value) { 
                                                ?>
                                                            <option value="<?php //echo $value->id 
                                                                            ?>" <?php //echo ($dusun == $value->id) ? 'selected' : '' 
                                                                                ?>><?php //echo $value->nama 
                                                                                    ?></option>
                                                <?php //}
                                                //     } else {
                                                //         echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                //     }
                                                // } else {
                                                //     echo "<option value='' selected>--Pilih Kelurahan Dulu--</option>";
                                                // } 
                                                ?>
                                            </select>
                                            <div class="help-block _dusun"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group _alamat-block">
                                            <label for="_alamat" class="form-control-label">Alamat</label>
                                            <textarea class="form-control alamat" name="_alamat" id="_alamat" onFocus="inputFocus(this);"><?= $alamat ?></textarea>
                                            <div class="help-block _alamat"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _koordinat-block">
                                            <label for="_koordinat" class="form-control-label">Koordinat Tempat Tinggal</label>
                                            <div class="input-group input-group-merge">
                                                <input type="hidden" name="_old_picture" id="_old_picture" value="<?php //echo (isset($user)) ? $user->profile_picture : '' 
                                                                                                                    ?>">
                                                <input type="hidden" name="_latitude" id="_latitude" value="<?php //echo (isset($user)) ? $user->latitude : '' 
                                                                                                            ?>">
                                                <input type="hidden" name="_longitude" id="_longitude" value="<?php //echo (isset($user)) ? $user->longitude : '' 
                                                                                                                ?>">
                                                <input type="text" class="form-control koordinat" style="padding-left: 15px;" name="_koordinat" id="_koordinat" value="<?php //echo (isset($user)) ? '(' . $user->latitude . ';' . $user->longitude . ')' : '' 
                                                                                                                                                                        ?>" onFocus="inputFocus(this);" readonly>
                                                <div class="input-group-append action-location" onmouseover="actionMouseHoverLocation(this)" onmouseout="actionMouseOutHoverLocation(this)" onclick="pickCoordinat()">
                                                    <span class="input-group-text action-location-icon" style="background-color: transparent;"><i class="fas fa-map-marker"></i></span>
                                                </div>
                                            </div>


                                            <div class="help-block _koordinat"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                <h5 class="heading-small" style="margin-top: 20px;">Data Asal Sekolah</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group _npsn_asal-block">
                                            <label for="_npsn_asal" class="form-control-label">NPSN Asal Sekolah</label>
                                            <input type="text" class="form-control alamat" name="_npsn_asal" id="_npsn_asal" value="<?= (isset($sekolah)) ? $sekolah->npsn : '' ?>" onFocus="inputFocus(this);" readonly>
                                            <div class="help-block _npsn_asal"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group _sekolah_asal-block">
                                            <label for="_sekolah_asal" class="form-control-label">Nama Asal Sekolah</label>
                                            <input type="text" class="form-control alamat" name="_sekolah_asal" id="_sekolah_asal" value="<?= (isset($sekolah)) ? $sekolah->nama : '' ?>" onFocus="inputFocus(this);" readonly>
                                            <div class="help-block _sekolah_asal"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 0px;">
                                <h5 class="heading-small" style="margin-top: 20px;">Upload Pas Foto</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="file-error">
                                            <h5>Pass Foto</h5>
                                            <div class="controls">
                                                <input type="file" class="form-control" id="_file" name="_file" onFocus="inputFocus(this);" accept="image/*" onchange="loadFileImage()" required>
                                                <div class="help-block _file" for="file"></div>
                                            </div>
                                            <p>Pilih gambar dengan ukuran maksimal 512 kb.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>&nbsp;</label>
                                        <div class="form-group">
                                            <div class="preview-image-upload">
                                                <img class="imagePreviewUpload" <?php //echo isset($user) ? (($user->profile_picture !== null) ? 'src="' . base_url('uploads/peserta/user') . '/' . $user->profile_picture . '"' : '') : '' 
                                                                                ?> id="imagePreviewUpload" />
                                                <button type="button" class="btn-remove-preview-image">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top: 30px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="button" onclick="actionSave(this)" class="btn btn-success">Simpan Profil</button>
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
                </div> -->
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
        <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-document-loading">
                    <div class="modal-header">
                        <h5 class="modal-title" id="documentModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="documentBodyModal">

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

<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyChdWD-7HQXG7sI1tqbQ43WJuMx7TJ7uuY&sensor=false&libraries=places'></script>
<script src="<?= base_url('new-assets'); ?>/js/locationpicker.jquery.min.js"></script>

<script>
    let loading = false;

    function loadFileImage() {
        const input = document.getElementsByName('_file')[0];
        if (input.files && input.files[0]) {
            var file = input.files[0];

            // allowed MIME types
            var mime_types = ['image/jpg', 'image/jpeg', 'image/png'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type gambar yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 2 * 1024 * 1000) {
                input.value = "";
                $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 2 Mb.",
                    'warning'
                );
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

    function pickCoordinat() {
        const lat = document.getElementsByName('_latitude')[0].value;
        const long = document.getElementsByName('_longitude')[0].value;

        $.ajax({
            url: "<?= base_url('peserta/user/location') ?>",
            type: 'POST',
            data: {
                lat: lat,
                long: long,
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('div.main-content').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(resul) {
                $('div.main-content').unblock();

                if (resul.code !== 200) {
                    Swal.fire(
                        'Failed!',
                        resul.message,
                        'warning'
                    );
                } else {
                    $('#contentModalLabel').html('AMBIL LOKASI');
                    $('.contentBodyModal').html(resul.data);
                    $('#contentModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }, 'show');

                    var map = L.map("map_inits").setView([lat, long], 12);
                    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors | Supported By <a href="https://kntechline.id">Kntechline.id</a>'
                    }).addTo(map);

                    var lati = lat;
                    var longi = long;
                    var marker;

                    marker = L.marker({
                        lat: lat,
                        lng: long
                    }, {
                        draggable: true
                    }).addTo(map);
                    document.getElementById('_lat').value = lati;
                    document.getElementById('_long').value = longi;

                    var onDrag = function(e) {
                        var latlng = marker.getLatLng();
                        lati = latlng.lat;
                        longi = latlng.lng;
                        document.getElementById('_lat').value = latlng.lat;
                        document.getElementById('_long').value = latlng.lng;
                    };

                    var onClick = function(e) {
                        map.removeLayer(marker);
                        // map.off('click', onClick); //turn off listener for map click
                        marker = L.marker(e.latlng, {
                            draggable: true
                        }).addTo(map);
                        lati = e.latlng.lat;
                        longi = e.latlng.lng;
                        document.getElementById('_lat').value = lati;
                        document.getElementById('_long').value = longi;

                        // marker.on('drag', onDrag);
                    };
                    marker.on('drag', onDrag);
                    map.on('click', onClick);

                    setTimeout(function() {
                        map.invalidateSize();
                        // console.log("maps opened");
                        $("h6#title_map").css("display", "block");
                    }, 1000);

                }
            },
            error: function() {
                $('div.main-content').unblock();
                Swal.fire(
                    'Failed!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );
            }
        });
    }

    function takedKoordinat() {
        const latitu = document.getElementsByName('_lat')[0].value;
        const longitu = document.getElementsByName('_long')[0].value;

        document.getElementById('_latitude').value = latitu;
        document.getElementById('_longitude').value = longitu;
        document.getElementById('_koordinat').value = "(" + latitu + "," + longitu + ")";

        $('#contentModal').modal('hide');
    }

    function actionSave(event) {
        if (!loading) {
            const provinsi = document.getElementsByName('_provinsi')[0].value;
            const kabupaten = document.getElementsByName('_kabupaten')[0].value;
            const kecamatan = document.getElementsByName('_kecamatan')[0].value;
            const kelurahan = document.getElementsByName('_kelurahan')[0].value;
            const dusun = document.getElementsByName('_dusun')[0].value;
            const email = document.getElementsByName('_email')[0].value;
            const nohp = document.getElementsByName('_nohp')[0].value;
            const alamat = document.getElementsByName('_alamat')[0].value;
            const koordinat = document.getElementsByName('_koordinat')[0].value;
            const latitude = document.getElementsByName('_latitude')[0].value;
            const longitude = document.getElementsByName('_longitude')[0].value;
            const old_picture = document.getElementsByName('_old_picture')[0].value;
            const file_name = document.getElementsByName('_file')[0].value;

            if (email === "") {
                $("input#_email").css("color", "#dc3545");
                $("input#_email").css("border-color", "#dc3545");
                $('._email').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Email tidak boleh kosong.</li></ul>');
            }
            if (nohp === "") {
                $("input#_nohp").css("color", "#dc3545");
                $("input#_nohp").css("border-color", "#dc3545");
                $('._nohp').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">No handphone tidak boleh kosong.</li></ul>');
            }
            if (provinsi === "") {
                $("select#_provinsi").css("color", "#dc3545");
                $("select#_provinsi").css("border-color", "#dc3545");
                $('._provinsi').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Siilahkan pilih provinsi dulu.</li></ul>');
            }
            if (kabupaten === "") {
                $("select#_kabupaten").css("color", "#dc3545");
                $("select#_kabupaten").css("border-color", "#dc3545");
                $('._kabupaten').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Siilahkan pilih kabupaten dulu.</li></ul>');
            }
            if (kecamatan === "") {
                $("select#_kecamatan").css("color", "#dc3545");
                $("select#_kecamatan").css("border-color", "#dc3545");
                $('._kecamatan').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Siilahkan pilih kecamatan dulu.</li></ul>');
            }
            if (kelurahan === "") {
                $("select#_kelurahan").css("color", "#dc3545");
                $("select#_kelurahan").css("border-color", "#dc3545");
                $('._kelurahan').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Siilahkan pilih kelurahan dulu.</li></ul>');
            }
            if (dusun === "") {
                $("select#_dusun").css("color", "#dc3545");
                $("select#_dusun").css("border-color", "#dc3545");
                $('._dusun').html('<ul role="alert" style="color: #dc3545; list-style: none; padding-inline-start: 10px;"><li style="color: #dc3545;">Siilahkan pilih dusun dulu.</li></ul>');
            }
            if (alamat === "") {
                $("textarea#_alamat").css("color", "#dc3545");
                $("textarea#_alamat").css("border-color", "#dc3545");
                $('._alamat').html('<ul role="alert" style="color: #dc3545; list-style: none;padding-inline-start: 10px;"><li style="color: #dc3545;">Alamat tidak boleh kosong.</li></ul>');
            }

            // if (email === "" || nohp === "" || provinsi === "" || kabupaten === "" || kecamatan === "" || kelurahan === "" || alamat === "") {
            if (email === "" || nohp === "" || provinsi === "" || kabupaten === "" || kecamatan === "" || kelurahan === "" || dusun === "" || alamat === "") {
                return;
            }
            const formUpload = new FormData();
            if (file_name === "") {

            } else {
                const file = document.getElementsByName('_file')[0].files[0];
                formUpload.append('file', file);
            }
            formUpload.append('provinsi', provinsi);
            formUpload.append('kabupaten', kabupaten);
            formUpload.append('kecamatan', kecamatan);
            formUpload.append('kelurahan', kelurahan);
            formUpload.append('dusun', dusun);
            formUpload.append('email', email);
            formUpload.append('nohp', nohp);
            formUpload.append('alamat', alamat);
            formUpload.append('latitude', latitude);
            formUpload.append('longitude', longitude);
            formUpload.append('old_picture', old_picture);

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
                url: BASE_URL + '/peserta/user/saveprofilupdate',
                type: 'POST',
                data: formUpload,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                beforeSend: function() {
                    loading = true;
                    $('div.main-content').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    loading = false;
                    $('div.main-content').unblock();
                    if (msg.code !== 200) {
                        if (msg.code !== 201) {
                            if (msg.code === 401) {
                                Swal.fire(
                                    'Failed!',
                                    msg.message,
                                    'warning'
                                ).then((valRes) => {
                                    document.location.href = BASE_URL + '/dashboard';
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    msg.message,
                                    'warning'
                                );
                            }
                        } else {
                            Swal.fire(
                                'Peringatan!',
                                msg.message,
                                'warning'
                            ).then((valRes) => {
                                document.location.href = msg.url;
                            })
                        }
                    } else {
                        Swal.fire(
                            'Berhasil!',
                            msg.message,
                            'success'
                        ).then((valRes) => {
                            document.location.href = msg.url;
                        })
                    }
                },
                error: function(data) {
                    console.log(data);
                    loading = false;

                    $('div.main-content').unblock();
                    Swal.fire(
                        'Gagal!',
                        "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                        'warning'
                    );

                }
            })
        }
    }

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
        initSelect2Panel('_provinsi');
        initSelect2Panel('_kabupaten');
        initSelect2Panel('_kelurahan');
        initSelect2Panel('_kecamatan');
        initSelect2Panel('_dusun');
        <?php if (isset($pemilik)) {
            if ($pemilik->tgl_lahir != null) { ?>
                initializeDatetime('_tgl_lahir', '<?= $pemilik->tgl_lahir ?>');
            <?php } else { ?>
                initializeDatetime('_tgl_lahir', new Date().toLocaleDateString('fr-CA'));
            <?php } ?>
        <?php } else { ?>
            initializeDatetime('_tgl_lahir', new Date().toLocaleDateString('fr-CA'));
        <?php } ?>
    });

    function loadFilePdf(event) {
        // console.log(event);
        // const input = document.getElementsByName('_file')[0];
        const input = event;
        if (input.files && input.files[0]) {
            let file = input.files[0];

            // allowed MIME types
            let mime_types = ['application/pdf'];

            if (mime_types.indexOf(file.type) == -1) {
                input.value = "";
                // const color = event.name
                $('.' + event.name).css('display', 'block');
                $("input#" + event.name).css("color", "#dc3545");
                $("input#" + event.name).css("border-color", "#dc3545");
                $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Hanya file type pdf yang diizinkan.</li></ul>');
                // $('.imagePreviewUpload').attr('src', '');
                Swal.fire(
                    'Warning!!!',
                    "Hanya file type pdf yang diizinkan.",
                    'warning'
                );
                return;
            }

            // console.log(file.size);

            // validate file size
            if (file.size > 2 * 1024 * 1000) {
                input.value = "";
                $('.' + event.name).css('display', 'block');
                $("input#" + event.name).css("color", "#dc3545");
                $("input#" + event.name).css("border-color", "#dc3545");
                $('.' + event.name).html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Ukuran file tidak boleh lebih dari 2 Mb.</li></ul>');
                Swal.fire(
                    'Warning!!!',
                    "Ukuran file tidak boleh lebih dari 2 Mb.",
                    'warning'
                );
                return;
            }


            $('.' + event.name).css('display', 'none');
            // $( "input#" + event.name ).css("color", "#dc3545");
            // $( "input#" + event.name ).css("border-color", "#dc3545");
            // $('.' + event.name).html('');

            // const color = $(id).attr('id');
            $(event.name).removeAttr('style');
            // $('.'+color).html('');

            // let reader = new FileReader();

            // reader.onload = function(e) {
            //     $('.imagePreviewUpload').attr('src', e.target.result);
            // }

            // reader.readAsDataURL(input.files[0]); // convert to base64 string
            // console.log("success Load");
        } else {
            console.log("failed Load");
        }
    }

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

    function onChangeProvinsi(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/peserta/referensi/getKabupaten',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kabupaten').html('<option value="" selected>--Pilih Provinsi Dulu--</option>');
                    $('.kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('.dusun').html('<option value="" selected>--Pilih Kelurahan Dulu--</option>');
                    $('div._kabupaten-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kecamatan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._dusun-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kabupaten-block').unblock();
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                    // const msg = JSON.parse(resMsg);
                    // const msg = JSON.parse(JSON.stringify(resMsg));
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kabupaten--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kabupaten').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kabupaten-block').unblock();
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                }
            })
        }
    }

    function onChangeKabupaten(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/peserta/referensi/getKecamatan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kecamatan').html('<option value="" selected>--Pilih Kabupaten Dulu--</option>');
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('.dusun').html('<option value="" selected>--Pilih Kelurahan Dulu--</option>');
                    $('div._kecamatan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._dusun-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kecamatan--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kecamatan').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kecamatan-block').unblock();
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                }
            })
        }
    }

    function onChangeKecamatan(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/peserta/referensi/getKelurahan',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.kelurahan').html('<option value="" selected>--Pilih Kecamatan Dulu--</option>');
                    $('.dusun').html('<option value="" selected>--Pilih Kelurahan Dulu--</option>');
                    $('div._kelurahan-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                    $('div._dusun-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Kelurahan--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.kelurahan').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._kelurahan-block').unblock();
                    $('div._dusun-block').unblock();
                }
            })
        }
    }

    function onChangeKelurahan(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");

        if (event.value !== "") {
            $.ajax({
                url: BASE_URL + '/peserta/referensi/getDusun',
                type: 'POST',
                data: {
                    id: event.value,
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('.dusun').html('<option value="" selected>--Pilih Kelurahan Dulu--</option>');
                    $('div._dusun-block').block({
                        message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                    });
                },
                success: function(msg) {
                    // console.log(msg);
                    $('div._dusun-block').unblock();
                    if (msg.code == 200) {
                        let html = "";
                        html += '<option value="">--Pilih Dusun--</option>';
                        if (msg.data.length > 0) {
                            for (let step = 0; step < msg.data.length; step++) {
                                html += '<option value="';
                                html += msg.data[step].id;
                                html += '">';
                                html += msg.data[step].nama;
                                html += '</option>';
                            }

                        }

                        $('.dusun').html(html);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('div._dusun-block').unblock();
                }
            })
        }
    }

    function onChangeDusun(event) {
        const color = $(event).attr('name');
        $(event).removeAttr('style');
        $('.' + color).html('');
        // $( "label#"+color ).css("color", "#555");
    }


    let editor;

    $('#contentModal').on('click', '.btn-remove-preview-image', function(event) {
        $('.imagePreviewUpload').removeAttr('src');
        document.getElementsByName("_file")[0].value = "";
    });

    $('#_kirim_permohonan').on('click', function() {

        const nik = document.getElementsByName('_nik')[0].value;
        const nama = document.getElementsByName('_nama')[0].value;
        const kk = document.getElementsByName('_kk')[0].value;
        const tempatLahir = document.getElementsByName('_tempat_lahir')[0].value;
        const tglLahir = document.getElementsByName('_tgl_lahir')[0].value;
        const agama = document.getElementsByName('_agama')[0].value;
        const provinsi = document.getElementsByName('_provinsi')[0].value;
        const kabupaten = document.getElementsByName('_kabupaten')[0].value;
        const kecamatan = document.getElementsByName('_kecamatan')[0].value;
        const kelurahan = document.getElementsByName('_kelurahan')[0].value;
        const alamat = document.getElementsByName('_alamat')[0].value;

        let jk;
        if ($('#customRadio5').is(":checked")) {
            jk = "LAKI-LAKI";
        } else {
            jk = "PEREMPUAN";
        }

        if (agama === "") {
            $("select#_agama").css("color", "#dc3545");
            $("select#_agama").css("border-color", "#dc3545");
            $('._agama').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (provinsi === "") {
            $("select#_provinsi").css("color", "#dc3545");
            $("select#_provinsi").css("border-color", "#dc3545");
            $('._provinsi').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (kabupaten === "") {
            $("select#_kabupaten").css("color", "#dc3545");
            $("select#_kabupaten").css("border-color", "#dc3545");
            $('._kabupaten').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (kecamatan === "") {
            $("select#_kecamatan").css("color", "#dc3545");
            $("select#_kecamatan").css("border-color", "#dc3545");
            $('._kecamatan').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (kelurahan === "") {
            $("select#_kelurahan").css("color", "#dc3545");
            $("select#_kelurahan").css("border-color", "#dc3545");
            $('._kelurahan').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Pilih terlebih dahulu.</li></ul>');
        }
        if (nik === "") {
            $("input#_nik").css("color", "#dc3545");
            $("input#_nik").css("border-color", "#dc3545");
            $('._nik').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (kk === "") {
            $("input#_kk").css("color", "#dc3545");
            $("input#_kk").css("border-color", "#dc3545");
            $('._kk').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (nama === "") {
            $("input#_nama").css("color", "#dc3545");
            $("input#_nama").css("border-color", "#dc3545");
            $('._nama').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (alamat === "") {
            $("textarea#_alamat").css("color", "#dc3545");
            $("textarea#_alamat").css("border-color", "#dc3545");
            $('._alamat').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (tempatLahir === "") {
            $("input#_tempat_lahir").css("color", "#dc3545");
            $("input#_tempat_lahir").css("border-color", "#dc3545");
            $('._tempat_lahir').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }
        if (tglLahir === "") {
            $("input#_tgl_lahir").css("color", "#dc3545");
            $("input#_tgl_lahir").css("border-color", "#dc3545");
            $('._tgl_lahir').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">Isian tidak boleh kosong.</li></ul>');
        }

        if (agama === "" || nik === "" || kk === "" || nama === "" || alamat === "" || tempatLahir === "" || tglLahir === "" || provinsi === "" || kabupaten === "" || kecamatan === "" || kelurahan === "") {
            Swal.fire(
                'Warning!!!',
                "Silahkan lengkapi semua isian wajib terlebih dahulu.",
                'warning'
            );
            return;
        }

        const formUpload = new FormData();
        formUpload.append('nik', nik);
        formUpload.append('kk', kk);
        formUpload.append('nama', nama);
        formUpload.append('tempatLahir', tempatLahir);
        formUpload.append('tglLahir', tglLahir);
        formUpload.append('jk', jk);
        formUpload.append('agama', agama);
        formUpload.append('provinsi', provinsi);
        formUpload.append('kabupaten', kabupaten);
        formUpload.append('kecamatan', kecamatan);
        formUpload.append('kelurahan', kelurahan);
        formUpload.append('alamat', alamat);

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
            url: BASE_URL + "/v1/umum/user/updateBiodata",
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
                        document.location.href = BASE_URL + '/auth';
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script>
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/select2/dist/css/select2.min.css">
<style>
    #map_inits {
        width: 100%;
        height: 400px;
    }

    .leaflet-tooltip {
        pointer-events: auto
    }

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