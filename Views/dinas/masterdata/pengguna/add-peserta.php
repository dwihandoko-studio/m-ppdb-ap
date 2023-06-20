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

        $.ajax({
            url: BASE_URL + '/auth/saveregis',
            type: 'POST',
            data: {
                nisn: nisn,
                key: keyD,
                npsn: npsn,
                email: email,
                nohp: nohp,
                password: password,
                repassword: repassword,
            },
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('div.loading-content-card').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                loading = false;
                // console.log(msg);
                $('div.loading-content-card').unblock();
                if (msg.code !== 200) {

                    Swal.fire(
                        'Gagal!',
                        msg.message,
                        'warning'
                    );

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

                $('div.loading-content-card').unblock();
                Swal.fire(
                    'Gagal!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );

            }
        })
    }
</script>