<?php if (isset($countData)) { ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="javascript:getDataAktifitas('<?= $page - 1 ?>')">
                        <i class="fa fa-angle-left"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($page > 1) { ?>
                <li class="page-item"><a class="page-link" href="javascript:getDataAktifitas('<?= $page - 1 ?>')"><?= $page - 1 ?></a></li>
            <?php } ?>
            <li class="page-item active"><a class="page-link" href="javascript:;"><?= $page ?></a></li>
            <?php if ($page < $totalPage) { ?>
                <li class="page-item"><a class="page-link" href="javascript:getDataAktifitas('<?= $page + 1 ?>')"><?= $page + 1 ?></a></li>
            <?php } ?>
            <?php if (($page < $totalPage) && ($page === 1)) { ?>
                <li class="page-item"><a class="page-link" href="javascript:getDataAktifitas('<?= $page + 2 ?>')"><?= $page + 2 ?></a></li>
            <?php } ?>
            <?php if ($page < $totalPage) { ?>
                <li class="page-item">
                    <a class="page-link" href="javascript:getDataAktifitas('<?= $page + 1 ?>')">
                        <i class="fa fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>

<?php }
?>