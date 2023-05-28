<?php if (isset($uploadSpjLaporanTamsil2)) { ?>
    <form id="formAddData" class="form-horizontal form-add-data" method="post">
        <input type="hidden" id="_id_upload_spj_tamsil_2" name="_id_upload_spj_tamsil_2" value="<?= $uploadSpjLaporanTamsil2->id ?>">
        <div class="modal-body">
            <div class="row col-md-12">
                <div class="col-md-12">
                    <p>Usulan verifikasi pencairan Tunjangan Guru PNS NON Sertifikasi, Berdasarkan Proses Validasi Usulan Tunjangan Guru PNS NON Sertifikasi (TAMSIL) TW.<?= ((int)$uploadSpjLaporanTamsil2->tw + 1) ?> Tahun Anggaran <?= $uploadSpjLaporanTamsil2->tahun ?>, Tunjangan Guru PNS NON Sertifikasi (TAMSIL) sudah masuk ke rekening penerima (PTK). <br>Silahkan laporkan penerimaan Tunjangan Guru PNS NON Sertifikasi (TAMSIL) tersebut dengan mengunggah dokumen Surat Pernyataan Penerima Tamsil (Materai 10.000) dan Buku Rekening Bank Penerima (Rekening Koran).<br></p>
                </div>
            </div>
            <?php if ($uploadSpjLaporanTamsil2->keterangan_reject_2 == null || $uploadSpjLaporanTamsil2->keterangan_reject_2 == "") { ?>
            <?php } else { ?>
                <p style="color: #d8ff00;"><b>Laporan SPJ Anda ditolak dengan keterangan : <?= $uploadSpjLaporanTamsil2->keterangan_reject_2 ?></b></p>
            <?php } ?>
            <div class="row col-md-12">
                <div class="col-md-12">
                    <div class="form-group" id="_file_upload_spj_tamsil_2-error">
                        <h5>SCAN Surat Pernyataan dan Rekening Koran<span class="required">*</span></h5>
                        <div class="controls">
                            <input type="file" class="form-control" id="_file_upload_spj_tamsil_2" name="_file_upload_spj_tamsil_2" onFocus="inputFocus(this);" accept="application/pdf" onchange="loadFilePdf(this)" required>
                            <div class="help-block _file_upload_spj_tamsil_2" for="_file_upload_spj_tamsil_2"></div>
                        </div>
                        <p>Pilih file pdf dengan ukuran maksimal 1 Mb.</p>
                    </div>
                </div>
            </div>
            <div><progress id="progressBar" value="0" max="100" style="width:100%; display: none;"></progress></div>
            <div>
                <h3 id="status" style="font-size: 15px; margin: 8px auto;"></h3>
            </div>
            <div>
                <p id="loaded_n_total" style="margin-bottom: 0px;"></p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary logout-from-upload">LOGOUT</button>
            <button type="button" class="btn btn-success simpan-upload-spj-tamsil-2">UPLOAD</button>
        </div>
    </form>
<?php } ?>