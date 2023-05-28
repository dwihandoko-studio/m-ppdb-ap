<form id="formAddData" class="form-horizontal form-add-data" method="post">
    <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
        <div class="col-md-12">
            <div class="form-group _jumlah_kelas-block">
                <label for="_jumlah_kelas" class="form-control-label">Jumlah Ketersediaan Kelas</label>
                <input type="number" class="form-control jumlah-kelas" name="_jumlah_kelas" placeholder="Jumlah ketersediaan kelas..." id="_jumlah_kelas" onfocusin="inputFocus(this);" required>
                <div class="help-block _jumlah_kelas"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group _jumlah_rombel_current-block">
                <label for="_jumlah_rombel_current" class="form-control-label">Jumlah Rombel Akhir Saat Ini</label>
                <input type="number" class="form-control jumlah-rombel-current" name="_jumlah_rombel_current" placeholder="Jumlah rombel akhir saat ini..." id="_jumlah_rombel_current" onfocusin="inputFocus(this);" required>
                <div class="help-block _jumlah_rombel_current"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group _jumlah_rombel_kebutuhan-block">
                <label for="_jumlah_rombel_kebutuhan" class="form-control-label">Jumlah rombel_kebutuhan</label>
                <input type="number" class="form-control jumlah-rombel-kebutuhan" name="_jumlah_rombel_kebutuhan" placeholder="Jumlah rombel_kebutuhan..." id="_jumlah_rombel_kebutuhan" onfocusin="inputFocus(this);" required>
                <div class="help-block _jumlah_rombel_kebutuhan"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group _radius_zonasi-block">
                <label for="_radius_zonasi" class="form-control-label">Radius Zonasi</label>
                <input type="number" class="form-control radius-zonasi" name="_radius_zonasi" placeholder="Radius Zonasi..." id="_radius_zonasi" onfocusin="inputFocus(this);" required>
                <div class="help-block _radius_zonasi"></div>
                <p>Untuk satuan radius dalam Kilo Meter (Km).</p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="saveAdd(this)" class="btn btn-outline-primary">Simpan</button>
    </div>
</form>

<script>
    function saveAdd(event) {
        const jumlahKelas = document.getElementsByName('_jumlah_kelas')[0].value;
        const jumlahRombelCurrent = document.getElementsByName('_jumlah_rombel_current')[0].value;
        const jumlahRombelKebutuhan = document.getElementsByName('_jumlah_rombel_kebutuhan')[0].value;
        const radius = document.getElementsByName('_radius_zonasi')[0].value;

        if (jumlahKelas === "") {
            $("input#_jumlah_kelas").css("color", "#dc3545");
            $("input#_jumlah_kelas").css("border-color", "#dc3545");
            $('._jumlah_kelas').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah ruang kelas tidak boleh kosong.</li></ul>');
        }
        if (jumlahRombelCurrent === "") {
            $("input#_jumlah_rombel_current").css("color", "#dc3545");
            $("input#_jumlah_rombel_current").css("border-color", "#dc3545");
            $('._jumlah_rombel_current').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah rombel akhir saat ini tidak boleh kosong.</li></ul>');
        }
        if (jumlahRombelKebutuhan === "") {
            $("input#_jumlah_rombel_kebutuhan").css("color", "#dc3545");
            $("input#_jumlah_rombel_kebutuhan").css("border-color", "#dc3545");
            $('._jumlah_rombel_kebutuhan').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Jumlah kebutuhan rombel tidak boleh kosong.</li></ul>');
        }
        if (radius === "") {
            $("input#_radius_zonasi").css("color", "#dc3545");
            $("input#_radius_zonasi").css("border-color", "#dc3545");
            $('._radius_zonasi').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">Radius PPDB tidak boleh kosong.</li></ul>');
        }

        if (jumlahKelas === "" || jumlahRombelCurrent === "" || jumlahRombelKebutuhan === "" || radius === "") {
            return;
        } else {
            $.ajax({
                url: BASE_URL + "/sekolah/setting/kuota/addSave",
                type: 'POST',
                data: {
                    jumlahKelas: jumlahKelas,
                    jumlahRombelCurrent: jumlahRombelCurrent,
                    jumlahRombelKebutuhan: jumlahRombelKebutuhan,
                    radius: radius,
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
    }
</script>