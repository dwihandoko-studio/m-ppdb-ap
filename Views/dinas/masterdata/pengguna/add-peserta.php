<form id="formAddData" class="form-horizontal form-add-data" method="post">
    <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
        <div class="col-md-12">
            <div class="form-group _nisn-block">
                <label for="_nisn" class="form-control-label">NISN</label>
                <input type="text" class="form-control kode" name="_nisn" placeholder="NISN..." id="_nisn" onfocusin="inputFocus(this);" required>
                <div class="help-block _nisn"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group _npsn-block">
                <label for="_npsn" class="form-control-label">NPSN Sekolah Asal</label>
                <input type="text" class="form-control nama" name="_npsn" placeholder="NPSN..." id="_npsn" onfocusin="inputFocus(this);" required>
                <div class="help-block _npsn"></div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="cekData(this)" class="btn btn-outline-primary">CEK DATA</button>
    </div>
</form>

<script>
    function cekData(event) {
        const nisn = document.getElementsByName('_nisn')[0].value;
        const npsn = document.getElementsByName('_npsn')[0].value;

        if (nisn === "") {
            $("input#_nisn").css("color", "#dc3545");
            $("input#_nisn").css("border-color", "#dc3545");
            $('._nisn').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">NISN tidak boleh kosong.</li></ul>');
            return;
        }
        if (npsn === "") {
            $("input#_npsn").css("color", "#dc3545");
            $("input#_npsn").css("border-color", "#dc3545");
            $('._npsn').html('<ul role="alert" style="color: #dc3545; list-style: none; margin-block-start: 0px; padding-inline-start: 10px;"><li style="color: #dc3545;">NPSN Sekolah asal tidak boleh kosong.</li></ul>');
            return;
        }

        if (nisn === "" || npsn === "") {
            return;
        } else {
            $.ajax({
                url: BASE_URL + "/dinas/masterdata/pengguna/cekData",
                type: 'POST',
                data: {
                    nisn: nisn,
                    npsn: npsn,
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
                        $('.contentBodyModal').html(resul.data);
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