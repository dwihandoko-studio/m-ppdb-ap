<div class="modal-body">
    <!-- <div class="form-horizontal" style="width: 550px"> -->
    <h6 id="title_map" class="title_map" style="display:none;">Loaded Map</h6>
    <div id="map_inits" style="width: 100%; height: 400px;"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group _lat-block">
                <label for="_lat" class="form-control-label">Latitude</label>
                <input type="text" class="form-control" id="_lat" name="_lat" placeholder="Latitude . . ." onFocus="inputFocus(this);" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group _long-block">
                <label for="_long" class="form-control-label">Longitude</label>
                <input type="text" class="form-control" id="_long" name="_long" placeholder="Longitude . . ." onFocus="inputFocus(this);" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <button type="button" onclick="onChangeValueLatLongFromInput()" class="btn btn-success">SET Koordinat</button>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" onclick="takedKoordinat()" class="btn btn-primary">Simpan Koordinat</button>
</div>
<script>
    function onChangeValueLatLongFromInput() {
        const after_change_lat = document.getElementsByName('_lat')[0].value;
        const after_change_long = document.getElementsByName('_long')[0].value;

        const latitudeFix = parseFloat(after_change_lat);
        const longitudeFix = parseFloat(after_change_long);
        if (!isNaN(latitudeFix) && !isNaN(longitudeFix)) {
            changeValueLatLongFromInput(latitudeFix, longitudeFix);
        } else {
            Swal.fire(
                'Warning!',
                "Nilai yang anda inputkan tidak valid.",
                'warning'
            );
        }
    }
</script>