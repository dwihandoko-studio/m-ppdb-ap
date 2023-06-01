<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="service-style-four elements sec-pad-two service-layout-5">
    <div class="container" style="margin-top: 100px;">
        <div class="inner-content">
            <div class="row">
                <?php if (isset($sekolahs)) { ?>
                    <?php if (count($sekolahs) > 0) { ?>
                        <?php foreach ($sekolahs as $key => $v) { ?>
                            <?php if ($v->bentuk_pendidikan_id == 6) { ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                                    <div class="service-block-three wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="icon-box">
                                                <div class="bg-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-bg-1.png);"></div>
                                                <i class="far fa-school"></i>
                                            </div>
                                            <h3><a href="<?= base_url('web/sekolah/detail') . '?id=' . $v->id ?>"><?= $v->nama ?></a></h3>
                                            <div class="text"><?= $v->npsn ?> - <?= $v->desa_kelurahan ?></div>
                                            <div class="link-btn"><a href="<?= base_url('web/sekolah/detail') . '?id=' . $v->id ?>"><i class="far fa-arrow-alt-circle-right"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                                    <div class="service-block-three wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="icon-box">
                                                <div class="bg-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-bg-3.png);"></div>
                                                <i class="far fa-school"></i>
                                            </div>
                                            <h3><a href="<?= base_url('web/sekolah/detail') . '?id=' . $v->id ?>"><?= $v->nama ?></a></h3>
                                            <div class="text"><?= $v->npsn ?> - <?= $v->desa_kelurahan ?></div>
                                            <div class="link-btn"><a href="<?= base_url('web/sekolah/detail') . '?id=' . $v->id ?>"><i class="far fa-arrow-alt-circle-right"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>