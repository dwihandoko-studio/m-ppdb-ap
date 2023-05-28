<?php if (isset($result)) {
    if (count($result) > 0) {
        foreach ($result as $key => $value) { ?>
            <?php if ($value->icon == "submit") { ?>
                <div class="timeline-block"><span class="timeline-step badge-info"><i class="ni ni-archive-2"></i></span>
                    <div class="timeline-content" style="max-width: 100%;">
                        <div class="d-flex justify-content-between pt-1">
                            <div><span class="text-muted text-sm font-weight-bold"><?= $value->aksi ?></span></div>
                            <div class="text-right"><small class="text-muted"><i class="fas fa-clock mr-1"></i><?= make_time_long_ago($value->created_at) ?></small></div>
                        </div>
                        <h6 class="text-sm mt-1 mb-0"><?= $value->keterangan ?></h6>
                    </div>
                </div>
            <?php } else if ($value->icon == "batal") { ?>
                <div class="timeline-block"><span class="timeline-step badge-warning"><i class="fas fa-arrow-left"></i></span>
                    <div class="timeline-content" style="max-width: 100%;">
                        <div class="d-flex justify-content-between pt-1">
                            <div><span class="text-muted text-sm font-weight-bold"><?= $value->aksi ?></span></div>
                            <div class="text-right"><small class="text-muted"><i class="fas fa-clock mr-1"></i><?= make_time_long_ago($value->created_at) ?></small></div>
                        </div>
                        <h6 class="text-sm mt-1 mb-0"><?= $value->keterangan ?></h6>
                    </div>
                </div>
            <?php } else if ($value->icon == "delete") { ?>
                <div class="timeline-block"><span class="timeline-step badge-danger"><i class="fas fa-trash"></i></span>
                    <div class="timeline-content" style="max-width: 100%;">
                        <div class="d-flex justify-content-between pt-1">
                            <div><span class="text-muted text-sm font-weight-bold"><?= $value->aksi ?></span></div>
                            <div class="text-right"><small class="text-muted"><i class="fas fa-clock mr-1"></i><?= make_time_long_ago($value->created_at) ?></small></div>
                        </div>
                        <h6 class="text-sm mt-1 mb-0"><?= $value->keterangan ?></h6>
                    </div>
                </div>
            <?php } else if ($value->icon == "tolak") { ?>
                <div class="timeline-block"><span class="timeline-step badge-danger">X</span>
                    <div class="timeline-content" style="max-width: 100%;">
                        <div class="d-flex justify-content-between pt-1">
                            <div><span class="text-muted text-sm font-weight-bold"><?= $value->aksi ?></span></div>
                            <div class="text-right"><small class="text-muted"><i class="fas fa-clock mr-1"></i><?= make_time_long_ago($value->created_at) ?></small></div>
                        </div>
                        <h6 class="text-sm mt-1 mb-0"><?= $value->keterangan ?></h6>
                    </div>
                </div>
            <?php } else { ?>
                <div class="timeline-block"><span class="timeline-step badge-success"><i class="ni ni-ruler-pencil"></i></span>
                    <div class="timeline-content" style="max-width: 100%;">
                        <div class="d-flex justify-content-between pt-1">
                            <div><span class="text-muted text-sm font-weight-bold"><?= $value->aksi ?></span></div>
                            <div class="text-right"><small class="text-muted"><i class="fas fa-clock mr-1"></i><?= make_time_long_ago($value->created_at) ?></small></div>
                        </div>
                        <h6 class="text-sm mt-1 mb-0"><?= $value->keterangan ?></h6>
                    </div>
                </div>
            <?php } ?>
<?php
        }
    }
} ?>