<?php if(isset($data)) { ?>
<form id="formAddData" class="form-horizontal form-add-data" method="post">
    <div class="modal-body">
        <div class="row col-md-12">
            <div class="col-md-12">
                <div class="form-group _judul-block">
                    <label for="_judul" class="form-control-label">Judul</label>
                    <input type="text" class="form-control judul" id="_judul" name="_judul" value="<?= $data->judul ?>" readonly/>
                </div>
            </div>
        </div>
        <div class="row col-md-12">
            <div class="col-md-12">
                <div class="form-group _deskripsi-block">
                    <label for="_deskripsi" class="form-control-label">Deskripsi</label>
                    <textarea class="form-control deskripsid" id="_deskripsid" name="_deskripsid" rows="5" readonly><?= $data->isi ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
    </div>
</form>
<script>
    ClassicEditor.create(document.querySelector('#_deskripsid'), {
                resizeOptions: [{
                        name: 'imageResize:original',
                        value: null,
                        icon: 'original'
                    },
                    {
                        name: 'imageResize:25',
                        value: '25',
                        icon: 'small'
                    },
                    {
                        name: 'imageResize:50',
                        value: '50',
                        icon: 'medium'
                    },
                    {
                        name: 'imageResize:75',
                        value: '75',
                        icon: 'large'
                    }
                ],
                alignment: {
                    options: ['left', 'right', 'center', 'justify']
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                image: {
                    toolbar: [
                        'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight', '|',
                        'imageResize:25', 'imageResize:50', 'imageResize:75', 'imageResize:original', '|',
                        'imageTextAlternative'
                    ],
                    styles: [
                        'full',
                        'side',
                        'alignLeft', 'alignCenter', 'alignRight'
                    ]
                },
                toolbar: {
                    items: [
                        'heading', 'code', '|',
                        'fontfamily', 'fontsize', 'fontColor', '|',
                        'bold', 'italic', 'underline', '|',
                        'link', 'bulletedList', 'numberedList', '|',
                        'insertTable', 'alignment', '|',
                        'imageUpload',
                        'imageResize',
                        'blockQuote', '|',
                        'undo',
                        'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                language: 'en',
                ckfinder: {
                    uploadUrl: "<?= base_url('v1/superadmin/informasi/popup/uploadImage'); ?>"
                }
            }).then(newEditor => {
                editor = newEditor;
            }).catch(error => {
                console.log(error);
            });
</script>
<?php } ?>