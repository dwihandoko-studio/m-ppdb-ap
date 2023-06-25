<form id="formAddData" class="form-horizontal form-add-data" method="post">
    <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px;">
        <div class="col-md-12">
            <div class="form-group _npsn-block">
                <label for="_npsn" class="form-control-label">NPSN Sekolah</label>
                <input type="text" class="form-control nama" name="_npsn" placeholder="NPSN..." id="_npsn" onfocusin="inputFocus(this);" required>
                <div class="help-block _npsn"></div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="saveDataAkun(this)" class="btn btn-outline-primary">GENERATE AKUN SEKOLAH</button>
    </div>
</form>
<script>
    function saveDataAkun(event) {
        const npsn = document.getElementsByName('_npsn')[0].value;

        if (npsn === "") {
            $("input#_npsn").css("color", "#dc3545");
            $("input#_npsn").css("border-color", "#dc3545");
            $('._npsn').html('<ul role="alert" style="color: #dc3545;"><li style="color: #dc3545;">NPSN tidak boleh kosong.</li></ul>');
            return;
        }

        $.ajax({
            url: BASE_URL + '/dinas/masterdata/pengguna/savePengunaSekolah',
            type: 'POST',
            data: {
                npsn: npsn,
            },
            dataType: 'JSON',
            beforeSend: function() {
                loading = true;
                $('div.modal-content-loading').block({
                    message: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
                });
            },
            success: function(msg) {
                $('div.modal-content-loading').unblock();
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
                        reloadPage(msg.url);
                    })
                }
            },
            error: function(data) {
                $('div.modal-content-loading').unblock();
                Swal.fire(
                    'Gagal!',
                    "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.",
                    'warning'
                );

            }
        })
    }
</script>