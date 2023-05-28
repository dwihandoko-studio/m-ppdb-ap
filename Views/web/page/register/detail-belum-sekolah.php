<?php if (isset($data)) { ?>
    <hr style="color: orange; height: 3px; opacity: 0.75;">
    <h4 style="justify-content: center; justify-items: center;">LENGKAPI DATA</h4>
    <div class="formcus-row">
        <div class="formcus-group col-md-6">
            <label for="_nama_d">NAMA LENGKAP</label>
            <input type="text" class="formcus-control" onfocus="inputFocus(this)" id="_nama_d" name="_nama_d" placeholder="Nama lengkap . . ." required>
            <div class="help-block _nama_d"></div>
        </div> 
        <div class="formcus-group col-md-6">
            <label for="_tempat_lahir_d">TEMPAT LAHIR</label>
            <input type="text" class="formcus-control tempat-lahir-d" onfocus="inputFocus(this)" id="_tempat_lahir_d" name="_tempat_lahir_d" placeholder="Tempat lahir . . ." required>
            <div class="help-block _tempat_lahir_d"></div>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_tgl_lahir_d">TANGGAL LAHIR</label>
            <input type="date" onfocus="inputFocus(this)" onfocus="inputFocus(this)" class="formcus-control datepicker tgl-lahir-d" id="_tgl_lahir_d" name="_tgl_lahir_d" required="">
            <div class="help-block _tgl_lahir_d"></div>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_jk_d">JENIS KELAMIN</label>
            <select class="form-control jk-d" name="_jk_d" onfocus="inputFocus(this)" id="_jk_d" required>
                <option value="L" selected>Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <div class="help-block _jk_d"></div>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_nama_ayah_d">NAMA AYAH KANDUNG</label>
            <input type="text" class="formcus-control nama-ayah-kandung" onfocus="inputFocus(this)" id="_nama_ayah_d" name="_nama_ayah_d" placeholder="Nama ayah kandung . . ." required>
            <div class="help-block _nama_ayah_d"></div>
        </div>
        <div class="formcus-group col-md-6">
            <label for="_nama_ibu_d">NAMA IBU KANDUNG</label>
            <input type="text" class="formcus-control nama-ibu-kandung" onfocus="inputFocus(this)" id="_nama_ibu_d" name="_nama_ibu_d" placeholder="Nama ibu kandung . . ." required>
            <div class="help-block _nama_ibu_d"></div>
        </div>
    </div>
    
    <div class="formcus-row">
        <div class="formcus-group col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <button id="btncancel" type="button" style="min-width: 100%; max-height: 40px; padding: 10px;" onclick="cancelConfirm(this)" class="btn btn-block btn-warning">BATAL</button>
                </div>
                <div class="col-md-8">
                    <button id="btnsimpan" type="button" style="min-width: 100%; max-height: 40px; padding: 10px;" onclick="submitConfirm(this)" class="btn btn-block btn-primary">LANJUTKAN</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>