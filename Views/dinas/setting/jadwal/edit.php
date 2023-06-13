<?php if (isset($data)) { ?>
    <form id="formAddData" class="form-horizontal form-add-data" method="post">
        <input type="hidden" id="_id" name="_id" value="<?= $data->id ?>" />
        <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
            <div class="row">
                <div class="col-md-12">
                    <h2>JALUR ZONASI</h2>
                    <div class="row">
                        <div class="col-md-6" style="background-color: #0a48b36e; padding: 15px;">
                            <h4>Pelaksanaan Pendaftaran</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_pendaftaran_zonasi-block">
                                        <label for="_tgl_awal_pendaftaran_zonasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-pendaftaran-zonasi" name="_tgl_awal_pendaftaran_zonasi" placeholder="Awal..." id="_tgl_awal_pendaftaran_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_pendaftaran_zonasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_pendaftaran_zonasi-block">
                                        <label for="_tgl_akhir_pendaftaran_zonasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-pendaftaran-zonasi" name="_tgl_akhir_pendaftaran_zonasi" placeholder="Akhir..." id="_tgl_akhir_pendaftaran_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_pendaftaran_zonasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #b30a0a6e; padding: 15px;">
                            <h4>Verifikasi Berkas</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_verifikasi_zonasi-block">
                                        <label for="_tgl_awal_verifikasi_zonasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-verifikasi-zonasi" name="_tgl_awal_verifikasi_zonasi" placeholder="Awal..." id="_tgl_awal_verifikasi_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_verifikasi_zonasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_verifikasi_zonasi-block">
                                        <label for="_tgl_akhir_verifikasi_zonasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-verifikasi-zonasi" name="_tgl_akhir_verifikasi_zonasi" placeholder="Akhir..." id="_tgl_akhir_verifikasi_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_verifikasi_zonasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #2cb30a6e; padding: 15px;">
                            <h4>Analisis dan Penyusunan Peringkat</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_analisis_zonasi-block">
                                        <label for="_tgl_awal_analisis_zonasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-analisis-zonasi" name="_tgl_awal_analisis_zonasi" placeholder="Awal..." id="_tgl_awal_analisis_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_analisis_zonasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_analisis_zonasi-block">
                                        <label for="_tgl_akhir_analisis_zonasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-analisis-zonasi" name="_tgl_akhir_analisis_zonasi" placeholder="Akhir..." id="_tgl_akhir_analisis_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_analisis_zonasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #890ab36e; padding: 15px;">
                            <h4>Pengumuman</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_pengumuman_zonasi-block">
                                        <label for="_tgl_pengumuman_zonasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-pengumuman-zonasi" name="_tgl_pengumuman_zonasi" placeholder="Pengumuman..." id="_tgl_pengumuman_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_pengumuman_zonasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #b3ae0a6e; padding: 15px;">
                            <h4>Daftar Ulang</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_daftar_ulang_zonasi-block">
                                        <label for="_tgl_awal_daftar_ulang_zonasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-daftar-ulang-zonasi" name="_tgl_awal_daftar_ulang_zonasi" placeholder="Awal..." id="_tgl_awal_daftar_ulang_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_daftar_ulang_zonasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_daftar_ulang_zonasi-block">
                                        <label for="_tgl_akhir_daftar_ulang_zonasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-daftar-ulang-zonasi" name="_tgl_akhir_daftar_ulang_zonasi" placeholder="Akhir..." id="_tgl_akhir_daftar_ulang_zonasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_daftar_ulang_zonasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <h2>JALUR AFIRMASI</h2>
                    <div class="row">
                        <div class="col-md-6" style="background-color: #0a48b36e; padding: 15px;">
                            <h4>Pelaksanaan Pendaftaran</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_pendaftaran_afirmasi-block">
                                        <label for="_tgl_awal_pendaftaran_afirmasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-pendaftaran-afirmasi" name="_tgl_awal_pendaftaran_afirmasi" placeholder="Awal..." id="_tgl_awal_pendaftaran_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_pendaftaran_afirmasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_pendaftaran_afirmasi-block">
                                        <label for="_tgl_akhir_pendaftaran_afirmasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-pendaftaran-afirmasi" name="_tgl_akhir_pendaftaran_afirmasi" placeholder="Akhir..." id="_tgl_akhir_pendaftaran_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_pendaftaran_afirmasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #b30a0a6e; padding: 15px;">
                            <h4>Verifikasi Berkas</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_verifikasi_afirmasi-block">
                                        <label for="_tgl_awal_verifikasi_afirmasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-verifikasi-afirmasi" name="_tgl_awal_verifikasi_afirmasi" placeholder="Awal..." id="_tgl_awal_verifikasi_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_verifikasi_afirmasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_verifikasi_afirmasi-block">
                                        <label for="_tgl_akhir_verifikasi_afirmasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-verifikasi-afirmasi" name="_tgl_akhir_verifikasi_afirmasi" placeholder="Akhir..." id="_tgl_akhir_verifikasi_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_verifikasi_afirmasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #2cb30a6e; padding: 15px;">
                            <h4>Analisis dan Penyusunan Peringkat</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_analisis_afirmasi-block">
                                        <label for="_tgl_awal_analisis_afirmasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-analisis-afirmasi" name="_tgl_awal_analisis_afirmasi" placeholder="Awal..." id="_tgl_awal_analisis_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_analisis_afirmasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_analisis_afirmasi-block">
                                        <label for="_tgl_akhir_analisis_afirmasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-analisis-afirmasi" name="_tgl_akhir_analisis_afirmasi" placeholder="Akhir..." id="_tgl_akhir_analisis_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_analisis_afirmasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #890ab36e; padding: 15px;">
                            <h4>Pengumuman</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_pengumuman_afirmasi-block">
                                        <label for="_tgl_pengumuman_afirmasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-pengumuman-afirmasi" name="_tgl_pengumuman_afirmasi" placeholder="Pengumuman..." id="_tgl_pengumuman_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_pengumuman_afirmasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #b3ae0a6e; padding: 15px;">
                            <h4>Daftar Ulang</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_daftar_ulang_afirmasi-block">
                                        <label for="_tgl_awal_daftar_ulang_afirmasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-daftar-ulang-afirmasi" name="_tgl_awal_daftar_ulang_afirmasi" placeholder="Awal..." id="_tgl_awal_daftar_ulang_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_daftar_ulang_afirmasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_daftar_ulang_afirmasi-block">
                                        <label for="_tgl_akhir_daftar_ulang_afirmasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-daftar-ulang-afirmasi" name="_tgl_akhir_daftar_ulang_afirmasi" placeholder="Akhir..." id="_tgl_akhir_daftar_ulang_afirmasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_daftar_ulang_afirmasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <h2>JALUR PRESTASI</h2>
                    <div class="row">
                        <div class="col-md-6" style="background-color: #0a48b36e; padding: 15px;">
                            <h4>Pelaksanaan Pendaftaran</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_pendaftaran_prestasi-block">
                                        <label for="_tgl_awal_pendaftaran_prestasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-pendaftaran-prestasi" name="_tgl_awal_pendaftaran_prestasi" placeholder="Awal..." id="_tgl_awal_pendaftaran_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_pendaftaran_prestasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_pendaftaran_prestasi-block">
                                        <label for="_tgl_akhir_pendaftaran_prestasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-pendaftaran-prestasi" name="_tgl_akhir_pendaftaran_prestasi" placeholder="Akhir..." id="_tgl_akhir_pendaftaran_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_pendaftaran_prestasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #b30a0a6e; padding: 15px;">
                            <h4>Verifikasi Berkas</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_verifikasi_prestasi-block">
                                        <label for="_tgl_awal_verifikasi_prestasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-verifikasi-prestasi" name="_tgl_awal_verifikasi_prestasi" placeholder="Awal..." id="_tgl_awal_verifikasi_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_verifikasi_prestasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_verifikasi_prestasi-block">
                                        <label for="_tgl_akhir_verifikasi_prestasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-verifikasi-prestasi" name="_tgl_akhir_verifikasi_prestasi" placeholder="Akhir..." id="_tgl_akhir_verifikasi_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_verifikasi_prestasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #2cb30a6e; padding: 15px;">
                            <h4>Analisis dan Penyusunan Peringkat</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_analisis_prestasi-block">
                                        <label for="_tgl_awal_analisis_prestasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-analisis-prestasi" name="_tgl_awal_analisis_prestasi" placeholder="Awal..." id="_tgl_awal_analisis_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_analisis_prestasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_analisis_prestasi-block">
                                        <label for="_tgl_akhir_analisis_prestasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-analisis-prestasi" name="_tgl_akhir_analisis_prestasi" placeholder="Akhir..." id="_tgl_akhir_analisis_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_analisis_prestasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #890ab36e; padding: 15px;">
                            <h4>Pengumuman</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_pengumuman_prestasi-block">
                                        <label for="_tgl_pengumuman_prestasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-pengumuman-prestasi" name="_tgl_pengumuman_prestasi" placeholder="Pengumuman..." id="_tgl_pengumuman_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_pengumuman_prestasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #b3ae0a6e; padding: 15px;">
                            <h4>Daftar Ulang</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_daftar_ulang_prestasi-block">
                                        <label for="_tgl_awal_daftar_ulang_prestasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-daftar-ulang-prestasi" name="_tgl_awal_daftar_ulang_prestasi" placeholder="Awal..." id="_tgl_awal_daftar_ulang_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_daftar_ulang_prestasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_daftar_ulang_prestasi-block">
                                        <label for="_tgl_akhir_daftar_ulang_prestasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-daftar-ulang-prestasi" name="_tgl_akhir_daftar_ulang_prestasi" placeholder="Akhir..." id="_tgl_akhir_daftar_ulang_prestasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_daftar_ulang_prestasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <h2>JALUR MUTASI</h2>
                    <div class="row">
                        <div class="col-md-6" style="background-color: #0a48b36e; padding: 15px;">
                            <h4>Pelaksanaan Pendaftaran</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_pendaftaran_mutasi-block">
                                        <label for="_tgl_awal_pendaftaran_mutasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-pendaftaran-mutasi" name="_tgl_awal_pendaftaran_mutasi" placeholder="Awal..." id="_tgl_awal_pendaftaran_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_pendaftaran_mutasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_pendaftaran_mutasi-block">
                                        <label for="_tgl_akhir_pendaftaran_mutasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-pendaftaran-mutasi" name="_tgl_akhir_pendaftaran_mutasi" placeholder="Akhir..." id="_tgl_akhir_pendaftaran_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_pendaftaran_mutasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #b30a0a6e; padding: 15px;">
                            <h4>Verifikasi Berkas</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_verifikasi_mutasi-block">
                                        <label for="_tgl_awal_verifikasi_mutasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-verifikasi-mutasi" name="_tgl_awal_verifikasi_mutasi" placeholder="Awal..." id="_tgl_awal_verifikasi_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_verifikasi_mutasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_verifikasi_mutasi-block">
                                        <label for="_tgl_akhir_verifikasi_mutasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-verifikasi-mutasi" name="_tgl_akhir_verifikasi_mutasi" placeholder="Akhir..." id="_tgl_akhir_verifikasi_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_verifikasi_mutasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #2cb30a6e; padding: 15px;">
                            <h4>Analisis dan Penyusunan Peringkat</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_analisis_mutasi-block">
                                        <label for="_tgl_awal_analisis_mutasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-analisis-mutasi" name="_tgl_awal_analisis_mutasi" placeholder="Awal..." id="_tgl_awal_analisis_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_analisis_mutasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_analisis_mutasi-block">
                                        <label for="_tgl_akhir_analisis_mutasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-analisis-mutasi" name="_tgl_akhir_analisis_mutasi" placeholder="Akhir..." id="_tgl_akhir_analisis_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_analisis_mutasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #890ab36e; padding: 15px;">
                            <h4>Pengumuman</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_pengumuman_mutasi-block">
                                        <label for="_tgl_pengumuman_mutasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-pengumuman-mutasi" name="_tgl_pengumuman_mutasi" placeholder="Pengumuman..." id="_tgl_pengumuman_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_pengumuman_mutasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color: #b3ae0a6e; padding: 15px;">
                            <h4>Daftar Ulang</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group _tgl_awal_daftar_ulang_mutasi-block">
                                        <label for="_tgl_awal_daftar_ulang_mutasi" class="form-control-label">Awal</label>
                                        <input type="text" class="form-control tgl-awal-daftar-ulang-mutasi" name="_tgl_awal_daftar_ulang_mutasi" placeholder="Awal..." id="_tgl_awal_daftar_ulang_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_awal_daftar_ulang_mutasi"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group _tgl_akhir_daftar_ulang_mutasi-block">
                                        <label for="_tgl_akhir_daftar_ulang_mutasi" class="form-control-label">Akhir</label>
                                        <input type="text" class="form-control tgl-akhir-daftar-ulang-mutasi" name="_tgl_akhir_daftar_ulang_mutasi" placeholder="Akhir..." id="_tgl_akhir_daftar_ulang_mutasi" onfocusin="inputFocus(this);" required>
                                        <div class="help-block _tgl_akhir_daftar_ulang_mutasi"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="saveEdit(this)" class="btn btn-outline-primary">Update</button>
        </div>
    </form>

    <script>
        function saveEdit(event) {
            const id = document.getElementsByName('_id')[0].value;
            const tgl_awal_pendaftaran_zonasi = document.getElementsByName('_tgl_awal_pendaftaran_zonasi')[0].value;
            const tgl_akhir_pendaftaran_zonasi = document.getElementsByName('_tgl_akhir_pendaftaran_zonasi')[0].value;
            const tgl_awal_verifikasi_zonasi = document.getElementsByName('_tgl_awal_verifikasi_zonasi')[0].value;
            const tgl_akhir_verifikasi_zonasi = document.getElementsByName('_tgl_akhir_verifikasi_zonasi')[0].value;
            const tgl_awal_analisis_zonasi = document.getElementsByName('_tgl_awal_analisis_zonasi')[0].value;
            const tgl_akhir_analisis_zonasi = document.getElementsByName('_tgl_akhir_analisis_zonasi')[0].value;
            const tgl_pengumuman_zonasi = document.getElementsByName('_tgl_pengumuman_zonasi')[0].value;
            const tgl_awal_daftar_ulang_zonasi = document.getElementsByName('_tgl_awal_daftar_ulang_zonasi')[0].value;
            const tgl_akhir_daftar_ulang_zonasi = document.getElementsByName('_tgl_akhir_daftar_ulang_zonasi')[0].value;
            const tgl_awal_pendaftaran_afirmasi = document.getElementsByName('_tgl_awal_pendaftaran_afirmasi')[0].value;
            const tgl_akhir_pendaftaran_afirmasi = document.getElementsByName('_tgl_akhir_pendaftaran_afirmasi')[0].value;
            const tgl_awal_verifikasi_afirmasi = document.getElementsByName('_tgl_awal_verifikasi_afirmasi')[0].value;
            const tgl_akhir_verifikasi_afirmasi = document.getElementsByName('_tgl_akhir_verifikasi_afirmasi')[0].value;
            const tgl_awal_analisis_afirmasi = document.getElementsByName('_tgl_awal_analisis_afirmasi')[0].value;
            const tgl_akhir_analisis_afirmasi = document.getElementsByName('_tgl_akhir_analisis_afirmasi')[0].value;
            const tgl_pengumuman_afirmasi = document.getElementsByName('_tgl_pengumuman_afirmasi')[0].value;
            const tgl_awal_daftar_ulang_afirmasi = document.getElementsByName('_tgl_awal_daftar_ulang_afirmasi')[0].value;
            const tgl_akhir_daftar_ulang_afirmasi = document.getElementsByName('_tgl_akhir_daftar_ulang_afirmasi')[0].value;
            const tgl_awal_pendaftaran_prestasi = document.getElementsByName('_tgl_awal_pendaftaran_prestasi')[0].value;
            const tgl_akhir_pendaftaran_prestasi = document.getElementsByName('_tgl_akhir_pendaftaran_prestasi')[0].value;
            const tgl_awal_verifikasi_prestasi = document.getElementsByName('_tgl_awal_verifikasi_prestasi')[0].value;
            const tgl_akhir_verifikasi_prestasi = document.getElementsByName('_tgl_akhir_verifikasi_prestasi')[0].value;
            const tgl_awal_analisis_prestasi = document.getElementsByName('_tgl_awal_analisis_prestasi')[0].value;
            const tgl_akhir_analisis_prestasi = document.getElementsByName('_tgl_akhir_analisis_prestasi')[0].value;
            const tgl_pengumuman_prestasi = document.getElementsByName('_tgl_pengumuman_prestasi')[0].value;
            const tgl_awal_daftar_ulang_prestasi = document.getElementsByName('_tgl_awal_daftar_ulang_prestasi')[0].value;
            const tgl_akhir_daftar_ulang_prestasi = document.getElementsByName('_tgl_akhir_daftar_ulang_prestasi')[0].value;
            const tgl_awal_pendaftaran_mutasi = document.getElementsByName('_tgl_awal_pendaftaran_mutasi')[0].value;
            const tgl_akhir_pendaftaran_mutasi = document.getElementsByName('_tgl_akhir_pendaftaran_mutasi')[0].value;
            const tgl_awal_verifikasi_mutasi = document.getElementsByName('_tgl_awal_verifikasi_mutasi')[0].value;
            const tgl_akhir_verifikasi_mutasi = document.getElementsByName('_tgl_akhir_verifikasi_mutasi')[0].value;
            const tgl_awal_analisis_mutasi = document.getElementsByName('_tgl_awal_analisis_mutasi')[0].value;
            const tgl_akhir_analisis_mutasi = document.getElementsByName('_tgl_akhir_analisis_mutasi')[0].value;
            const tgl_pengumuman_mutasi = document.getElementsByName('_tgl_pengumuman_mutasi')[0].value;
            const tgl_awal_daftar_ulang_mutasi = document.getElementsByName('_tgl_awal_daftar_ulang_mutasi')[0].value;
            const tgl_akhir_daftar_ulang_mutasi = document.getElementsByName('_tgl_akhir_daftar_ulang_mutasi')[0].value;

            if (tgl_awal_pendaftaran_zonasi === "") {
                $("input#_tgl_awal_pendaftaran_zonasi").css("color", "#dc3545");
                $("input#_tgl_awal_pendaftaran_zonasi").css("border-color", "#dc3545");
                $('._tgl_awal_pendaftaran_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_pendaftaran_zonasi === "") {
                $("input#_tgl_akhir_pendaftaran_zonasi").css("color", "#dc3545");
                $("input#_tgl_akhir_pendaftaran_zonasi").css("border-color", "#dc3545");
                $('._tgl_akhir_pendaftaran_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_verifikasi_zonasi === "") {
                $("input#_tgl_awal_verifikasi_zonasi").css("color", "#dc3545");
                $("input#_tgl_awal_verifikasi_zonasi").css("border-color", "#dc3545");
                $('._tgl_awal_verifikasi_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_verifikasi_zonasi === "") {
                $("input#_tgl_akhir_verifikasi_zonasi").css("color", "#dc3545");
                $("input#_tgl_akhir_verifikasi_zonasi").css("border-color", "#dc3545");
                $('._tgl_akhir_verifikasi_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_analisis_zonasi === "") {
                $("input#_tgl_awal_analisis_zonasi").css("color", "#dc3545");
                $("input#_tgl_awal_analisis_zonasi").css("border-color", "#dc3545");
                $('._tgl_awal_analisis_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_analisis_zonasi === "") {
                $("input#_tgl_akhir_analisis_zonasi").css("color", "#dc3545");
                $("input#_tgl_akhir_analisis_zonasi").css("border-color", "#dc3545");
                $('._tgl_akhir_analisis_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_pengumuman_zonasi === "") {
                $("input#_tgl_pengumuman_zonasi").css("color", "#dc3545");
                $("input#_tgl_pengumuman_zonasi").css("border-color", "#dc3545");
                $('._tgl_pengumuman_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_daftar_ulang_zonasi === "") {
                $("input#_tgl_awal_daftar_ulang_zonasi").css("color", "#dc3545");
                $("input#_tgl_awal_daftar_ulang_zonasi").css("border-color", "#dc3545");
                $('._tgl_awal_daftar_ulang_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_daftar_ulang_zonasi === "") {
                $("input#_tgl_akhir_daftar_ulang_zonasi").css("color", "#dc3545");
                $("input#_tgl_akhir_daftar_ulang_zonasi").css("border-color", "#dc3545");
                $('._tgl_akhir_daftar_ulang_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_pendaftaran_afirmasi === "") {
                $("input#_tgl_awal_pendaftaran_afirmasi").css("color", "#dc3545");
                $("input#_tgl_awal_pendaftaran_afirmasi").css("border-color", "#dc3545");
                $('._tgl_awal_pendaftaran_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_pendaftaran_afirmasi === "") {
                $("input#_tgl_akhir_pendaftaran_afirmasi").css("color", "#dc3545");
                $("input#_tgl_akhir_pendaftaran_afirmasi").css("border-color", "#dc3545");
                $('._tgl_akhir_pendaftaran_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_verifikasi_afirmasi === "") {
                $("input#_tgl_awal_verifikasi_afirmasi").css("color", "#dc3545");
                $("input#_tgl_awal_verifikasi_afirmasi").css("border-color", "#dc3545");
                $('._tgl_awal_verifikasi_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_verifikasi_afirmasi === "") {
                $("input#_tgl_akhir_verifikasi_afirmasi").css("color", "#dc3545");
                $("input#_tgl_akhir_verifikasi_afirmasi").css("border-color", "#dc3545");
                $('._tgl_akhir_verifikasi_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_analisis_afirmasi === "") {
                $("input#_tgl_awal_analisis_afirmasi").css("color", "#dc3545");
                $("input#_tgl_awal_analisis_afirmasi").css("border-color", "#dc3545");
                $('._tgl_awal_analisis_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_analisis_afirmasi === "") {
                $("input#_tgl_akhir_analisis_afirmasi").css("color", "#dc3545");
                $("input#_tgl_akhir_analisis_afirmasi").css("border-color", "#dc3545");
                $('._tgl_akhir_analisis_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_pengumuman_afirmasi === "") {
                $("input#_tgl_pengumuman_afirmasi").css("color", "#dc3545");
                $("input#_tgl_pengumuman_afirmasi").css("border-color", "#dc3545");
                $('._tgl_pengumuman_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_daftar_ulang_afirmasi === "") {
                $("input#_tgl_awal_daftar_ulang_afirmasi").css("color", "#dc3545");
                $("input#_tgl_awal_daftar_ulang_afirmasi").css("border-color", "#dc3545");
                $('._tgl_awal_daftar_ulang_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_daftar_ulang_afirmasi === "") {
                $("input#_tgl_akhir_daftar_ulang_afirmasi").css("color", "#dc3545");
                $("input#_tgl_akhir_daftar_ulang_afirmasi").css("border-color", "#dc3545");
                $('._tgl_akhir_daftar_ulang_afirmasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_pendaftaran_prestasi === "") {
                $("input#_tgl_awal_pendaftaran_prestasi").css("color", "#dc3545");
                $("input#_tgl_awal_pendaftaran_prestasi").css("border-color", "#dc3545");
                $('._tgl_awal_pendaftaran_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_pendaftaran_prestasi === "") {
                $("input#_tgl_akhir_pendaftaran_prestasi").css("color", "#dc3545");
                $("input#_tgl_akhir_pendaftaran_prestasi").css("border-color", "#dc3545");
                $('._tgl_akhir_pendaftaran_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_verifikasi_prestasi === "") {
                $("input#_tgl_awal_verifikasi_prestasi").css("color", "#dc3545");
                $("input#_tgl_awal_verifikasi_prestasi").css("border-color", "#dc3545");
                $('._tgl_awal_verifikasi_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_verifikasi_prestasi === "") {
                $("input#_tgl_akhir_verifikasi_prestasi").css("color", "#dc3545");
                $("input#_tgl_akhir_verifikasi_prestasi").css("border-color", "#dc3545");
                $('._tgl_akhir_verifikasi_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_analisis_prestasi === "") {
                $("input#_tgl_awal_analisis_prestasi").css("color", "#dc3545");
                $("input#_tgl_awal_analisis_prestasi").css("border-color", "#dc3545");
                $('._tgl_awal_analisis_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_analisis_prestasi === "") {
                $("input#_tgl_akhir_analisis_prestasi").css("color", "#dc3545");
                $("input#_tgl_akhir_analisis_prestasi").css("border-color", "#dc3545");
                $('._tgl_akhir_analisis_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_pengumuman_prestasi === "") {
                $("input#_tgl_pengumuman_prestasi").css("color", "#dc3545");
                $("input#_tgl_pengumuman_prestasi").css("border-color", "#dc3545");
                $('._tgl_pengumuman_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_daftar_ulang_prestasi === "") {
                $("input#_tgl_awal_daftar_ulang_prestasi").css("color", "#dc3545");
                $("input#_tgl_awal_daftar_ulang_prestasi").css("border-color", "#dc3545");
                $('._tgl_awal_daftar_ulang_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_daftar_ulang_prestasi === "") {
                $("input#_tgl_akhir_daftar_ulang_prestasi").css("color", "#dc3545");
                $("input#_tgl_akhir_daftar_ulang_prestasi").css("border-color", "#dc3545");
                $('._tgl_akhir_daftar_ulang_prestasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_pendaftaran_mutasi === "") {
                $("input#_tgl_awal_pendaftaran_mutasi").css("color", "#dc3545");
                $("input#_tgl_awal_pendaftaran_mutasi").css("border-color", "#dc3545");
                $('._tgl_awal_pendaftaran_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_pendaftaran_mutasi === "") {
                $("input#_tgl_akhir_pendaftaran_mutasi").css("color", "#dc3545");
                $("input#_tgl_akhir_pendaftaran_mutasi").css("border-color", "#dc3545");
                $('._tgl_akhir_pendaftaran_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_verifikasi_mutasi === "") {
                $("input#_tgl_awal_verifikasi_mutasi").css("color", "#dc3545");
                $("input#_tgl_awal_verifikasi_mutasi").css("border-color", "#dc3545");
                $('._tgl_awal_verifikasi_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_verifikasi_mutasi === "") {
                $("input#_tgl_akhir_verifikasi_mutasi").css("color", "#dc3545");
                $("input#_tgl_akhir_verifikasi_mutasi").css("border-color", "#dc3545");
                $('._tgl_akhir_verifikasi_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_analisis_mutasi === "") {
                $("input#_tgl_awal_analisis_mutasi").css("color", "#dc3545");
                $("input#_tgl_awal_analisis_mutasi").css("border-color", "#dc3545");
                $('._tgl_awal_analisis_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_analisis_mutasi === "") {
                $("input#_tgl_akhir_analisis_mutasi").css("color", "#dc3545");
                $("input#_tgl_akhir_analisis_mutasi").css("border-color", "#dc3545");
                $('._tgl_akhir_analisis_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_pengumuman_mutasi === "") {
                $("input#_tgl_pengumuman_mutasi").css("color", "#dc3545");
                $("input#_tgl_pengumuman_mutasi").css("border-color", "#dc3545");
                $('._tgl_pengumuman_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_awal_daftar_ulang_mutasi === "") {
                $("input#_tgl_awal_daftar_ulang_mutasi").css("color", "#dc3545");
                $("input#_tgl_awal_daftar_ulang_mutasi").css("border-color", "#dc3545");
                $('._tgl_awal_daftar_ulang_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }
            if (tgl_akhir_daftar_ulang_mutasi === "") {
                $("input#_tgl_akhir_daftar_ulang_mutasi").css("color", "#dc3545");
                $("input#_tgl_akhir_daftar_ulang_mutasi").css("border-color", "#dc3545");
                $('._tgl_akhir_daftar_ulang_mutasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
            }

            if (id === "" || tgl_awal_pendaftaran_zonasi === "" || tgl_akhir_pendaftaran_zonasi === "" || tgl_awal_verifikasi_zonasi === "" || tgl_akhir_verifikasi_zonasi === "" || tgl_awal_analisis_zonasi === "" || tgl_akhir_analisis_zonasi === "" || tgl_pengumuman_zonasi === "" || tgl_awal_daftar_ulang_zonasi === "" || tgl_akhir_daftar_ulang_zonasi === "") {
                return;
            }
            if (tgl_awal_pendaftaran_afirmasi === "" || tgl_akhir_pendaftaran_afirmasi === "" || tgl_awal_verifikasi_afirmasi === "" || tgl_akhir_verifikasi_afirmasi === "" || tgl_awal_analisis_afirmasi === "" || tgl_akhir_analisis_afirmasi === "" || tgl_pengumuman_afirmasi === "" || tgl_awal_daftar_ulang_afirmasi === "" || tgl_akhir_daftar_ulang_afirmasi === "") {
                return;
            }
            if (tgl_awal_pendaftaran_prestasi === "" || tgl_akhir_pendaftaran_prestasi === "" || tgl_awal_verifikasi_prestasi === "" || tgl_akhir_verifikasi_prestasi === "" || tgl_awal_analisis_prestasi === "" || tgl_akhir_analisis_prestasi === "" || tgl_pengumuman_prestasi === "" || tgl_awal_daftar_ulang_prestasi === "" || tgl_akhir_daftar_ulang_prestasi === "") {
                return;
            }
            if (tgl_awal_pendaftaran_mutasi === "" || tgl_akhir_pendaftaran_mutasi === "" || tgl_awal_verifikasi_mutasi === "" || tgl_akhir_verifikasi_mutasi === "" || tgl_awal_analisis_mutasi === "" || tgl_akhir_analisis_mutasi === "" || tgl_pengumuman_mutasi === "" || tgl_awal_daftar_ulang_mutasi === "" || tgl_akhir_daftar_ulang_mutasi === "") {
                return;
            }
            Swal.fire({
                title: 'Apakah anda yakin ingin mengupdate data ini?',
                text: "Update Jadwal PPDB.",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: BASE_URL + "/dinas/setting/penjadwalan/editSave",
                        type: 'POST',
                        data: {
                            id: id,
                            tgl_awal_pendaftaran_zonasi: tgl_awal_pendaftaran_zonasi,
                            tgl_akhir_pendaftaran_zonasi: tgl_akhir_pendaftaran_zonasi,
                            tgl_awal_verifikasi_zonasi: tgl_awal_verifikasi_zonasi,
                            tgl_akhir_verifikasi_zonasi: tgl_akhir_verifikasi_zonasi,
                            tgl_awal_analisis_zonasi: tgl_awal_analisis_zonasi,
                            tgl_akhir_analisis_zonasi: tgl_akhir_analisis_zonasi,
                            tgl_pengumuman_zonasi: tgl_pengumuman_zonasi,
                            tgl_awal_daftar_ulang_zonasi: tgl_awal_daftar_ulang_zonasi,
                            tgl_akhir_daftar_ulang_zonasi: tgl_akhir_daftar_ulang_zonasi,
                            tgl_awal_pendaftaran_afirmasi: tgl_awal_pendaftaran_afirmasi,
                            tgl_akhir_pendaftaran_afirmasi: tgl_akhir_pendaftaran_afirmasi,
                            tgl_awal_verifikasi_afirmasi: tgl_awal_verifikasi_afirmasi,
                            tgl_akhir_verifikasi_afirmasi: tgl_akhir_verifikasi_afirmasi,
                            tgl_awal_analisis_afirmasi: tgl_awal_analisis_afirmasi,
                            tgl_akhir_analisis_afirmasi: tgl_akhir_analisis_afirmasi,
                            tgl_pengumuman_afirmasi: tgl_pengumuman_afirmasi,
                            tgl_awal_daftar_ulang_afirmasi: tgl_awal_daftar_ulang_afirmasi,
                            tgl_akhir_daftar_ulang_afirmasi: tgl_akhir_daftar_ulang_afirmasi,
                            tgl_awal_pendaftaran_prestasi: tgl_awal_pendaftaran_prestasi,
                            tgl_akhir_pendaftaran_prestasi: tgl_akhir_pendaftaran_prestasi,
                            tgl_awal_verifikasi_prestasi: tgl_awal_verifikasi_prestasi,
                            tgl_akhir_verifikasi_prestasi: tgl_akhir_verifikasi_prestasi,
                            tgl_awal_analisis_prestasi: tgl_awal_analisis_prestasi,
                            tgl_akhir_analisis_prestasi: tgl_akhir_analisis_prestasi,
                            tgl_pengumuman_prestasi: tgl_pengumuman_prestasi,
                            tgl_awal_daftar_ulang_prestasi: tgl_awal_daftar_ulang_prestasi,
                            tgl_akhir_daftar_ulang_prestasi: tgl_akhir_daftar_ulang_prestasi,
                            tgl_awal_pendaftaran_mutasi: tgl_awal_pendaftaran_mutasi,
                            tgl_akhir_pendaftaran_mutasi: tgl_akhir_pendaftaran_mutasi,
                            tgl_awal_verifikasi_mutasi: tgl_awal_verifikasi_mutasi,
                            tgl_akhir_verifikasi_mutasi: tgl_akhir_verifikasi_mutasi,
                            tgl_awal_analisis_mutasi: tgl_awal_analisis_mutasi,
                            tgl_akhir_analisis_mutasi: tgl_akhir_analisis_mutasi,
                            tgl_pengumuman_mutasi: tgl_pengumuman_mutasi,
                            tgl_awal_daftar_ulang_mutasi: tgl_awal_daftar_ulang_mutasi,
                            tgl_akhir_daftar_ulang_mutasi: tgl_akhir_daftar_ulang_mutasi,
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            $('div.modal-content-loading').block({
                                message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                            });
                        },
                        success: function(resul) {
                            $('div.modal-content-loading').unblock();

                            if (resul.code !== 200) {
                                if (resul.code !== 201) {
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
                                            'GAGAL!',
                                            resul.message,
                                            'warning'
                                        );
                                    }
                                } else {
                                    Swal.fire(
                                        'Peringatan!',
                                        resul.message,
                                        'success'
                                    ).then((valRes) => {
                                        reloadPage();
                                    })
                                }
                            } else {
                                Swal.fire(
                                    'SELAMAT!',
                                    resul.message,
                                    'success'
                                ).then((valRes) => {
                                    reloadPage();
                                })
                            }
                        },
                        error: function() {
                            $('div.modal-content-loading').unblock();
                            Swal.fire(
                                'PERINGATAN!',
                                "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                                'warning'
                            );
                        }
                    });
                }
            })

        }

        function initializeDatetime(event, date) {
            $('#' + event).datetimepicker({
                // defaultDate: new Date().toLocaleString('en-GB', { hour12: false }),
                defaultDate: date,
                locale: 'en-GB',
                format: 'YYYY-MM-DD HH:mm:ss',
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
            initializeDatetime('_tgl_awal_pendaftaran_zonasi', <?php if ($data->tgl_awal_pendaftaran_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_pendaftaran_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_pendaftaran_zonasi', <?php if ($data->tgl_akhir_pendaftaran_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_pendaftaran_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_verifikasi_zonasi', <?php if ($data->tgl_awal_verifikasi_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_verifikasi_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_verifikasi_zonasi', <?php if ($data->tgl_akhir_verifikasi_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_verifikasi_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_analisis_zonasi', <?php if ($data->tgl_awal_analisis_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_analisis_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_analisis_zonasi', <?php if ($data->tgl_akhir_analisis_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_analisis_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_pengumuman_zonasi', <?php if ($data->tgl_pengumuman_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_pengumuman_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_daftar_ulang_zonasi', <?php if ($data->tgl_awal_daftar_ulang_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_daftar_ulang_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_daftar_ulang_zonasi', <?php if ($data->tgl_akhir_daftar_ulang_zonasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_daftar_ulang_zonasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_pendaftaran_afirmasi', <?php if ($data->tgl_awal_pendaftaran_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_pendaftaran_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_pendaftaran_afirmasi', <?php if ($data->tgl_akhir_pendaftaran_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_pendaftaran_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_verifikasi_afirmasi', <?php if ($data->tgl_awal_verifikasi_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_verifikasi_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_verifikasi_afirmasi', <?php if ($data->tgl_akhir_verifikasi_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_verifikasi_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_analisis_afirmasi', <?php if ($data->tgl_awal_analisis_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_analisis_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_analisis_afirmasi', <?php if ($data->tgl_akhir_analisis_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_analisis_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_pengumuman_afirmasi', <?php if ($data->tgl_pengumuman_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_pengumuman_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_daftar_ulang_afirmasi', <?php if ($data->tgl_awal_daftar_ulang_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_daftar_ulang_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_daftar_ulang_afirmasi', <?php if ($data->tgl_akhir_daftar_ulang_afirmasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_daftar_ulang_afirmasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_pendaftaran_prestasi', <?php if ($data->tgl_awal_pendaftaran_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_pendaftaran_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_pendaftaran_prestasi', <?php if ($data->tgl_akhir_pendaftaran_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_pendaftaran_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_verifikasi_prestasi', <?php if ($data->tgl_awal_verifikasi_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_verifikasi_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_verifikasi_prestasi', <?php if ($data->tgl_akhir_verifikasi_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_verifikasi_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_analisis_prestasi', <?php if ($data->tgl_awal_analisis_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_analisis_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_analisis_prestasi', <?php if ($data->tgl_akhir_analisis_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_analisis_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_pengumuman_prestasi', <?php if ($data->tgl_pengumuman_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_pengumuman_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_daftar_ulang_prestasi', <?php if ($data->tgl_awal_daftar_ulang_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_daftar_ulang_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_daftar_ulang_prestasi', <?php if ($data->tgl_akhir_daftar_ulang_prestasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_daftar_ulang_prestasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_pendaftaran_mutasi', <?php if ($data->tgl_awal_pendaftaran_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_pendaftaran_mutasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_pendaftaran_mutasi', <?php if ($data->tgl_akhir_pendaftaran_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_pendaftaran_mutasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_verifikasi_mutasi', <?php if ($data->tgl_awal_verifikasi_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_verifikasi_mutasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_verifikasi_mutasi', <?php if ($data->tgl_akhir_verifikasi_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_verifikasi_mutasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_analisis_mutasi', <?php if ($data->tgl_awal_analisis_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_analisis_mutasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_analisis_mutasi', <?php if ($data->tgl_akhir_analisis_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_analisis_mutasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_pengumuman_mutasi', <?php if ($data->tgl_pengumuman_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_pengumuman_mutasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_awal_daftar_ulang_mutasi', <?php if ($data->tgl_awal_daftar_ulang_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_awal_daftar_ulang_mutasi ?>'
                <?php } ?>);
            initializeDatetime('_tgl_akhir_daftar_ulang_mutasi', <?php if ($data->tgl_akhir_daftar_ulang_mutasi == null) { ?> new Date().toLocaleDateString('fr-CA') <?php } else { ?> '<?= $data->tgl_akhir_daftar_ulang_mutasi ?>'
                <?php } ?>);

        });
    </script>

<?php } ?>